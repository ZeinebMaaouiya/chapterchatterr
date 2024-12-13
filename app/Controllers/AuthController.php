<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function showRegisterForm()
    {
        return view('auth/register');
    }

    public function saveRegistration()
    {
        $userModel = new UserModel();

        $validation = $this->validate([
            'nom'       => 'required|max_length[255]',
            'prenom'    => 'required|max_length[255]',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'password'  => 'required|min_length[8]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $hashedPassword = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);

        $data = [
            'nom'       => $this->request->getPost('nom'),
            'prenom'    => $this->request->getPost('prenom'),
            'email'     => $this->request->getPost('email'),
            'password'  => $hashedPassword,
        ];

        $userModel->insert($data);
        return redirect()->to('/login')->with('success', 'Registration successful!');
    }

    public function showLoginForm()
    {
        return view('auth/login');
    }

    public function login()
    {
        $userModel = new UserModel();
    
        $validation = $this->validate([
            'email'    => 'required|valid_email',
            'password' => 'required',
        ]);
    
        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $user = $userModel->where('email', $this->request->getPost('email'))->first();
    
        if (!$user || !password_verify($this->request->getPost('password'), $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
        }
    
        // Set session data
        session()->set('user', [
            'id'    => $user['id'],
            'nom'   => $user['nom'],
            'prenom' => $user['prenom'],
            'email' => $user['email'],
        ]);
    
        // Debugging: Check if the session is set
        if (!session()->has('user')) {
            log_message('error', 'Session not set properly after login.');
        } else {
            log_message('info', 'Session set for user: ' . session()->get('user')['id']);
        }
    
        return redirect()->to('/')->with('success', 'Logged in successfully!');
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Logged out successfully!');
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
        // Afficher les erreurs de débogage
        echo $emailService->printDebugger(['headers', 'subject', 'body']);
        return redirect()->back()->with('error', 'Impossible d\'envoyer l\'email.');
    }

    return redirect()->to('/forgot-password')->with('success', 'Un lien de réinitialisation a été envoyé à votre email.');
}



public function showResetPasswordForm($token)
{
    $userModel = new \App\Models\UserModel();
    $user = $userModel->where('reset_token', $token)->first();

    if (!$user) {
        return redirect()->to('/login')->with('error', 'Token invalide ou expiré.');
    }

    return view('auth/reset_password', ['token' => $token]);
}

public function resetPassword()
{
    $token = $this->request->getPost('token');
    $password = $this->request->getPost('password');

    $userModel = new \App\Models\UserModel();
    $user = $userModel->where('reset_token', $token)->first();

    if (!$user) {
        return redirect()->to('/login')->with('error', 'Token invalide ou expiré.');
    }

    // Valider le mot de passe
    if (strlen($password) < 8) {
        return redirect()->back()->with('error', 'Le mot de passe doit contenir au moins 8 caractères.');
    }

    // Mettre à jour le mot de passe et supprimer le token
    $userModel->update($user['id'], [
        'password'     => password_hash($password, PASSWORD_BCRYPT),
        'reset_token'  => null, // Invalider le token
    ]);

    return redirect()->to('/login')->with('success', 'Mot de passe réinitialisé avec succès !');
}

}
