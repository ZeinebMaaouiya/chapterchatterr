<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    // Function to load the registration view
    public function showRegisterForm()
    {
        return view('auth/register'); // Return the registration form
    }

    // Function to handle form submission and save data to the database
    public function saveRegistration()
    {
        if ($this->request->getMethod() === 'post') {
            // Get form input
            $nom = $this->request->getPost('nom');
            $prenom = $this->request->getPost('prenom');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // Validate form input
            if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
                return redirect()->back()->with('error', 'All fields are required!');
            }

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Save data to the database
            $userModel = new UserModel();
            $data = [
                'nom'       => $nom,
                'prenom'    => $prenom,
                'email'     => $email,
                'password'  => $hashedPassword,
            ];

            if ($userModel->insert($data)) {
                return redirect()->to('/success')->with('message', 'Registration successful!');
            } else {
                // If insertion fails, return errors
                return redirect()->back()->with('error', 'Failed to register user.');
            }
        }

        return redirect()->to('/register')->with('error', 'Invalid request method.');
    }
    public function showForgotPasswordForm()
{
    return view('auth/forgot_password');
}

public function sendResetLink()
{
    $email = $this->request->getPost('email');

    // Vérifier si l'email existe
    $userModel = new \App\Models\UserModel();
    $user = $userModel->where('email', $email)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'Cet email n\'existe pas.');
    }

    // Générer un token de réinitialisation
    $token = bin2hex(random_bytes(50));

    // Mettre à jour le token dans la base de données
    $userModel->update($user['id'], ['reset_token' => $token]);

    // Construire le lien de réinitialisation
    $resetLink = base_url("/reset-password/$token");

    // Envoyer l'email (exemple basique)
    $emailService = \Config\Services::email();
    $emailService->setTo($email);
    $emailService->setSubject('Réinitialisation de votre mot de passe');
    $emailService->setMessage("Cliquez sur le lien suivant pour réinitialiser votre mot de passe : <a href='$resetLink'>$resetLink</a>");

    if (!$emailService->send()) {
        return redirect()->back()->with('error', 'Impossible d\'envoyer l\'email.');
    }

    return redirect()->to('/forgot-password')->with('success', 'Un lien de réinitialisation a été envoyé à votre email.');
}

}
