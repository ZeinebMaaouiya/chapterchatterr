<?php

namespace App\Controllers;

use App\Models\LivreModel;
use App\Models\AuthorModel;
use App\Models\CategoryModel;
use App\Models\BookCategoriesModel;

class BookController extends BaseController
{
    public function __construct()
    {
        helper(['form']);
    }

    // Show all books
    public function index()
    {
        $livreModel = new LivreModel();
        $db = \Config\Database::connect();
    
        // Fetch all books with author details
        $books = $livreModel
            ->select('livre.*, authors.name as author_name')
            ->join('authors', 'authors.id = livre.author_id', 'left')
            ->findAll();
    
        // Fetch categories for each book
        foreach ($books as &$book) {
            $categories = $db->table('book_categories')
                ->select('categories.name')
                ->join('categories', 'categories.id = book_categories.category_id', 'left')
                ->where('book_categories.livre_id', $book['id'])
                ->get()
                ->getResultArray();
            
            $book['categories'] = $categories;
        }
    
        $data['book'] = $books;
        return view('books/index', $data);
    }
    
    

    // Show the form to create a new book
    public function create()
    {
        $authorModel = new AuthorModel();
        $categoryModel = new CategoryModel();

        // Fetch authors and categories for the form
        $data['authors'] = $authorModel->findAll();
        $data['categories'] = $categoryModel->findAll();

        return view('books/create', $data);
    }

    // Store the newly created book
    public function store()
    {
        $livreModel = new LivreModel();
        $bookCategoryModel = new BookCategoriesModel();

        // Validation rules
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required',
            'author_id' => 'required|integer',
            'category_id' => 'required', // Array of selected category IDs
            'summary' => 'required',
            'pages' => 'required|integer',
            
            'format' => 'required',
            'isbn' => 'required|is_unique[livre.isbn]',
            'asin' => 'required|is_unique[livre.asin]',
            // 'cover_image' => 'uploaded[cover_image]|max_size[cover_image,2048]|is_image[cover_image]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Handle file upload for cover image
        $coverImage = $this->request->getFile('cover_image');
        $coverImageName = "";
        if ($coverImage && $coverImage->isValid() && !$coverImage->hasMoved()) {
            $coverImageName = $coverImage->getRandomName();
            $coverImage->move(WRITEPATH . 'uploads', $coverImageName);
        }

        // Save book data to 'livre' table
        $bookData = [
            'name' => $this->request->getPost('name'),
            'author_id' => $this->request->getPost('author_id'),
            'summary' => $this->request->getPost('summary'),
            'pages' => $this->request->getPost('pages'),
            'published_date' => $this->request->getPost('published_date'),
            'format' => $this->request->getPost('format'),
            'isbn' => $this->request->getPost('isbn'),
            'asin' => $this->request->getPost('asin'),
            'language' => $this->request->getPost('language'),
            'cover_image' => $coverImageName,
        ];

        // Insert book data and get book ID
        $bookId = $livreModel->insert($bookData);

        if (!$bookId) {
            // Log and check for database errors
            log_message('error', 'Error inserting book: ' . json_encode($livreModel->errors()));
            return redirect()->back()->with('errors', 'Error inserting book.');
        }

        // Insert categories into the 'book_categories' pivot table
        $selectedCategories = $this->request->getPost('category_id'); // Get selected categories
        if ($selectedCategories) {
            foreach ($selectedCategories as $categoryId) {
                $bookCategoryModel->insert([
                    'livre_id' => $bookId,
                    'category_id' => $categoryId,
                ]);
            }
        }

        return redirect()->to('/books')->with('success', 'Book added successfully!');
    }

    // Show the form to edit an existing book
    public function edit($id)
    {
        $livreModel = new LivreModel();
        $authorModel = new AuthorModel();
        $categoryModel = new CategoryModel();
        $bookCategoryModel = new BookCategoriesModel();

        // Get the book details
        $data['book'] = $livreModel->find($id);
        $data['authors'] = $authorModel->findAll();
        $data['categories'] = $categoryModel->findAll();

        // Get selected categories for the book
        $bookCategories = $bookCategoryModel->where('livre_id', $id)->findAll();
        $data['selected_categories'] = array_map(function($item) {
            return $item['category_id'];
        }, $bookCategories);

        return view('books/edit', $data);
    }

    // Update the book
    public function update($id)
    {
        $livreModel = new LivreModel();
        $bookCategoryModel = new BookCategoriesModel();

        // Validation rules
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required',
            'author_id' => 'required|integer',
            'category_id' => 'required', // Array of selected category IDs
            'summary' => 'required',
            'pages' => 'required|integer',
            'published_date' => 'valid_date',
            'format' => 'required',
            'isbn' => 'required',
            'asin' => 'required',
            'cover_image' => 'uploaded[cover_image]|max_size[cover_image,2048]|is_image[cover_image]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Handle file upload for cover image
        $coverImage = $this->request->getFile('cover_image');
        $coverImageName = "";
        if ($coverImage && $coverImage->isValid() && !$coverImage->hasMoved()) {
            $coverImageName = $coverImage->getRandomName();
            $coverImage->move(WRITEPATH . 'uploads', $coverImageName);
        }

        // Save updated book data to 'livre' table
        $bookData = [
            'name' => $this->request->getPost('name'),
            'author_id' => $this->request->getPost('author_id'),
            'summary' => $this->request->getPost('summary'),
            'pages' => $this->request->getPost('pages'),
            'published_date' => $this->request->getPost('published_date'),
            'format' => $this->request->getPost('format'),
            'isbn' => $this->request->getPost('isbn'),
            'asin' => $this->request->getPost('asin'),
            'language' => $this->request->getPost('language'),
            'cover_image' => $coverImageName ?: $this->request->getPost('existing_cover_image'),
        ];

        $livreModel->update($id, $bookData);

        // Remove old categories
        $bookCategoryModel->where('livre_id', $id)->delete();

        // Insert new categories
        $selectedCategories = $this->request->getPost('category_id');
        if ($selectedCategories) {
            foreach ($selectedCategories as $categoryId) {
                $bookCategoryModel->insert([
                    'livre_id' => $id,
                    'category_id' => $categoryId,
                ]);
            }
        }

        return redirect()->to('/book')->with('success', 'Book updated successfully!');
    }

    // Delete a book
    public function delete($id)
    {
        $livreModel = new LivreModel();
        $bookCategoryModel = new BookCategoriesModel();

        // Delete related book categories first
        $bookCategoryModel->where('livre_id', $id)->delete();

        // Delete the book
        $livreModel->delete($id);

        return redirect()->to('/books')->with('success', 'Book deleted successfully!');
    }

    // Show a single book's details
    public function show($id)
    {
        $livreModel = new LivreModel();
        $bookCategoryModel = new BookCategoriesModel();
        $categoryModel = new CategoryModel();

        // Get the book details
        $data['book'] = $livreModel->find($id);

        // Get the associated categories
        $bookCategories = $bookCategoryModel->where('livre_id', $id)->findAll();
        $categoryIds = array_map(function($item) {
            return $item['category_id'];
        }, $bookCategories);

        $data['categories'] = $categoryModel->whereIn('id', $categoryIds)->findAll();

        return view('books/show', $data);
    }
}
