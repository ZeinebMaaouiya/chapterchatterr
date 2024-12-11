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
            // Generate a unique file name
            $newName = $imageFile->getRandomName();
            // Move the image to the img folder
            $imageFile->move(WRITEPATH . 'public/img', $newName);
            // Set the image path to store in the database
            $imagePath = 'public/img/' . $newName;
        }

        // Insert author data into the database
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
        $model = new AuthorModel();
        $data['author'] = $model->find($id);
        return view('authors/edit', $data);
    }

    public function update($id)
    {
        $model = new AuthorModel();
        
        // Validate form input
        $validation =  \Config\Services::validation();
        if (!$this->validate([
            'name' => 'required|min_length[3]|max_length[255]',
            'bio'  => 'permit_empty|string',
            'profile_picture' => 'is_image[profile_picture]|max_size[profile_picture,1024]|mime_in[profile_picture,image/jpg,image/jpeg,image/png,image/gif]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Handle the image upload if a new picture is provided
        $imageFile = $this->request->getFile('profile_picture');
        $imagePath = $this->request->getPost('existing_profile_picture');  // Use the existing image if no new one is uploaded

        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            // Generate a unique file name
            $newName = $imageFile->getRandomName();
            // Move the image to the img folder
            $imageFile->move(WRITEPATH . 'public/img', $newName);
            // Set the new image path to store in the database
            $imagePath = 'img/' . $newName;  // Store the relative path
        }

        // Update author data in the database
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
        $model = new AuthorModel();
        $author = $model->find($id);

        if ($author) {
            // If there's a profile picture, delete it from the server
            if (!empty($author['profile_picture']) && file_exists(WRITEPATH . 'public/img/' . $author['profile_picture'])) {
                unlink(WRITEPATH . 'public/' . $author['profile_picture']);
            }

            // Delete the author from the database
            $model->delete($id);
        }

        return redirect()->to('/author');
    }
}
