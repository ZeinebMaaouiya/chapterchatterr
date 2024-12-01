<?php

namespace App\Controllers;
use App\Models\LivreModel;
use App\Models\AuthorModel;
use App\Models\CategoryModel;
use App\Models\GenreModel;

class BookController extends BaseController
{
    public function index()
    {
        $livreModel = new LivreModel();
        $authorModel = new AuthorModel();
        $categoryModel = new CategoryModel();
        $genreModel = new GenreModel();

        $livres = $livreModel->findAll();
        $booksWithDetails = [];

        foreach ($livres as $livre) {
            $author = $authorModel->find($livre['author_id']);
            $category = $categoryModel->find($livre['category_id']);
            $genre = $genreModel->find($livre['genre_id']);
            $booksWithDetails[] = [
                'book' => $livre,
                'author' => $author,
                'category' => $category,
                'genre' => $genre
            ];
        }

        return view('books/index', ['books' => $booksWithDetails]);
    }

    public function create()
    {
        $authorModel = new AuthorModel();
        $categoryModel = new CategoryModel();
        $genreModel = new GenreModel();

        $data['authors'] = $authorModel->findAll();
        $data['categories'] = $categoryModel->findAll();
        $data['genres'] = $genreModel->findAll();

        return view('books/create', $data);
    }

    public function store()
    {
        $model = new LivreModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'author_id' => $this->request->getPost('author_id'),
            'category_id' => $this->request->getPost('category_id'),
            'genre_id' => $this->request->getPost('genre_id'),
            'description' => $this->request->getPost('description'),
        ];
        $model->save($data);
        return redirect()->to('/book');
    }

    public function edit($id)
    {
        $model = new LivreModel();
        $authorModel = new AuthorModel();
        $categoryModel = new CategoryModel();
        $genreModel = new GenreModel();

        $data['book'] = $model->find($id);
        $data['authors'] = $authorModel->findAll();
        $data['categories'] = $categoryModel->findAll();
        $data['genres'] = $genreModel->findAll();

        return view('books/edit', $data);
    }

    public function update($id)
    {
        $model = new LivreModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'author_id' => $this->request->getPost('author_id'),
            'category_id' => $this->request->getPost('category_id'),
            'genre_id' => $this->request->getPost('genre_id'),
            'description' => $this->request->getPost('description'),
        ];
        $model->update($id, $data);
        return redirect()->to('/book');
    }

    public function delete($id)
    {
        $model = new LivreModel();
        $model->delete($id);
        return redirect()->to('/book');
    }
}
