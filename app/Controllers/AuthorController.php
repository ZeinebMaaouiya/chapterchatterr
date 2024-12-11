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
        if (!$this->isAdmin()) {
            return redirect()->to('/author')->with('error', 'You do not have permission to perform this action.');
        }

        return view('authors/create');
    }

    public function store()
    {
        if (!$this->isAdmin()) {
            return redirect()->to('/author')->with('error', 'You do not have permission to perform this action.');
        }

        // Validate form input
        if (!$this->validate([
            'name' => 'required|min_length[3]|max_length[255]',
            'profile_picture' => 'uploaded[profile_picture]|is_image[profile_picture]|max_size[profile_picture,1024]|mime_in[profile_picture,image/jpg,image/jpeg,image/png,image/gif]',
        ])) {
            return redirect()->back()->withInput()->with('errors', \Config\Services::validation()->getErrors());
        }

        // Handle the image upload
        $imageFile = $this->request->getFile('profile_picture');
        $imagePath = '';

        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'public/img', $newName);
            $imagePath = 'public/img/' . $newName;
        }

        $model = new AuthorModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'bio'  => $this->request->getPost('bio'),
            'profile_picture' => $imagePath,
            'birthdate' => $this->request->getPost('birthdate'),
        ];

        $model->save($data);

        return redirect()->to('/author');
    }

    public function edit($id)
    {
        if (!$this->isAdmin()) {
            return redirect()->to('/author')->with('error', 'You do not have permission to perform this action.');
        }

        $model = new AuthorModel();
        $data['author'] = $model->find($id);

        if (!$data['author']) {
            return redirect()->to('/author')->with('error', 'Author not found.');
        }

        return view('authors/edit', $data);
    }

    public function update($id)
    {
        if (!$this->isAdmin()) {
            return redirect()->to('/author')->with('error', 'You do not have permission to perform this action.');
        }

        $model = new AuthorModel();

        if (!$this->validate([
            'name' => 'required|min_length[3]|max_length[255]',
            'bio'  => 'permit_empty|string',
            'profile_picture' => 'is_image[profile_picture]|max_size[profile_picture,1024]|mime_in[profile_picture,image/jpg,image/jpeg,image/png,image/gif]',
        ])) {
            return redirect()->back()->withInput()->with('errors', \Config\Services::validation()->getErrors());
        }

        $imageFile = $this->request->getFile('profile_picture');
        $imagePath = $this->request->getPost('existing_profile_picture');

        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'public/img', $newName);
            $imagePath = 'public/img/' . $newName;
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'bio'  => $this->request->getPost('bio'),
            'profile_picture' => $imagePath,
            'birthdate' => $this->request->getPost('birthdate'),
            'age' => $this->request->getPost('age'),
            'gender' => $this->request->getPost('gender'),
            'nationality' => $this->request->getPost('nationality'),
        ];

        $model->update($id, $data);

        return redirect()->to('/author');
    }

    public function delete($id)
    {
        if (!$this->isAdmin()) {
            return redirect()->to('/author')->with('error', 'You do not have permission to perform this action.');
        }

        $model = new AuthorModel();
        $author = $model->find($id);

        if ($author) {
            if (!empty($author['profile_picture']) && file_exists(FCPATH . 'public/' . $author['profile_picture'])) {
                unlink(FCPATH . 'public/' . $author['profile_picture']);
            }

            $model->delete($id);
        }

        return redirect()->to('/author');
    }

    private function isAdmin()
    {
        return session('user_type') === 'admin';
    }
}
