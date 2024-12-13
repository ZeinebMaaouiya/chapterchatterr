<?php

namespace App\Controllers;

use App\Models\LivreModel;
use App\Models\AuthorModel;
use App\Models\CategoryModel;
use App\Models\CommentModel;
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
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Handle file upload for cover image
        $coverImage = $this->request->getFile('cover_image');
        $coverImageName = "";
        if ($coverImage && $coverImage->isValid() && !$coverImage->hasMoved()) {
            $coverImageName = $coverImage->getRandomName();
            $coverImage->move(FCPATH . 'public/img', $coverImageName);  // Move image to public/img
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
            'cover_image' => $coverImageName, // Save image filename
        ];

        // Insert book data and get book ID
        $bookId = $livreModel->insert($bookData);

        if (!$bookId) {
            log_message('error', 'Error inserting book: ' . json_encode($livreModel->errors()));
            return redirect()->back()->with('errors', 'Error inserting book.');
        }

        // Insert categories into the 'book_categories' pivot table
        $selectedCategories = $this->request->getPost('category_id'); 
        if ($selectedCategories) {
            foreach ($selectedCategories as $categoryId) {
                $bookCategoryModel->insert([
                    'livre_id' => $bookId,
                    'category_id' => $categoryId,
                ]);
            }
        }

        return redirect()->to('/book')->with('success', 'Book added successfully!');
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
            $coverImage->move(FCPATH . 'public/img', $coverImageName);  // Move image to public/img
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
            'cover_image' => $coverImageName ?: $this->request->getPost('existing_cover_image'), // Use existing if no new image
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
    public function shows($id)
    {
        // Load models
        $livreModel = new LivreModel();
        $bookCategoryModel = new BookCategoriesModel();
        $categoryModel = new CategoryModel();
        
        // Get the book details with author info
        $data['book'] = $livreModel
            ->select('livre.*, authors.name as author_name')
            ->join('authors', 'authors.id = livre.author_id', 'left')
            ->find($id);
    
        // Check if the book exists
        if (!$data['book']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Book not found');
        }
    
        // Get the associated categories
        $bookCategories = $bookCategoryModel->where('livre_id', $id)->findAll();
        $categoryIds = array_map(function ($item) {
            return $item['category_id'];
        }, $bookCategories);
    
        // Get the category details for the book
        $data['categories'] = $categoryModel->whereIn('id', $categoryIds)->findAll();
    
        // Load the view with the data
        return view('books/display', $data);
    }

    public function comment()
    {
        // Check if the user is logged in
        if (!session()->has('user')) {
            return $this->response->setJSON(['success' => false, 'message' => 'You must be logged in to comment.']);
        }

        // Get comment data
        $comment = $this->request->getPost('comment');
        $bookId = $this->request->getPost('book_id');
        $userId = session()->get('user_id');  // Get user ID from session

        // Validate comment data
        if (empty($comment) || empty($bookId) || empty($userId)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Missing data.']);
        }

        // Create a new comment model
        $commentModel = new CommentModel();
        
        // Prepare data to be saved
        $data = [
            'book_id' => $bookId,
            'user_id' => $userId,
            'content' => $comment,
        ];

        // Save the comment to the database
        if ($commentModel->save($data)) {
            // Return the success response with the username
            return $this->response->setJSON([
                'success' => true,
                'username' => session('user')['name'],  // Or 'nom' and 'prenom' if those are used
                'comment' => $comment
            ]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to add comment.']);
        }
    }
    
}
