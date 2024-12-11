<?php

namespace App\Controllers;
use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    public function index()
    {
        $model = new CategoryModel();
        $data['categories'] = $model->findAll();
        return view('categories/index', $data);
    }
    
    public function create()
    {
        return view('categories/create');
    }

    public function store()
    {
        $model = new CategoryModel();
        $data = [
            'name' => $this->request->getPost('name'),
        ];
        $model->save($data);
        return redirect()->to('/category');
    }

    public function edit($id)
    {
        $model = new CategoryModel();
        $data['category'] = $model->find($id);
        return view('categories/edit', $data);
    }

    public function update($id)
    {
        $model = new CategoryModel();
        $data = [
            'name' => $this->request->getPost('name'),
        ];
        $model->update($id, $data);
        return redirect()->to('/category');
    }

    public function delete($id)
    {
        $model = new CategoryModel();
        $model->delete($id);
        return redirect()->to('/category');
    }
}
