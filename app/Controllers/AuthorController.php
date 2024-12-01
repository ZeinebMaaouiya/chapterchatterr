<?php

namespace App\Controllers;
use App\Models\AuthorModel;

class AuthorController extends BaseController
{
    public function index()
    {
        $model = new AuthorModel();
        $data['authors'] = $model->findAll();
        return view('authors/index', $data);
    }

    public function create()
    {
        return view('authors/create');
    }

    public function store()
    {
        $model = new AuthorModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'bio'  => $this->request->getPost('bio'),
        ];
        $model->save($data);
        return redirect()->to('/author');
    }

    public function edit($id)
    {
        $model = new AuthorModel();
        $data['author'] = $model->find($id);
        return view('authors/edit', $data);
    }

    public function update($id)
    {
        $model = new AuthorModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'bio'  => $this->request->getPost('bio'),
        ];
        $model->update($id, $data);
        return redirect()->to('/author');
    }

    public function delete($id)
    {
        $model = new AuthorModel();
        $model->delete($id);
        return redirect()->to('/author');
    }
}
