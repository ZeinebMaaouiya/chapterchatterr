<?php

namespace App\Controllers;
use App\Models\GenreModel;

class GenreController extends BaseController
{
    public function index()
    {
        $model = new GenreModel();
        $data['genres'] = $model->findAll();
        return view('genres/index', $data);
    }

    public function create()
    {
        return view('genres/create');
    }

    public function store()
    {
        $model = new GenreModel();
        $data = [
            'name' => $this->request->getPost('name'),
        ];
        $model->save($data);
        return redirect()->to('/genre');
    }

    public function edit($id)
    {
        $model = new GenreModel();
        $data['genre'] = $model->find($id);
        return view('genres/edit', $data);
    }

    public function update($id)
    {
        $model = new GenreModel();
        $data = [
            'name' => $this->request->getPost('name'),
        ];
        $model->update($id, $data);
        return redirect()->to('/genre');
    }

    public function delete($id)
    {
        $model = new GenreModel();
        $model->delete($id);
        return redirect()->to('/genre');
    }
}
