<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        // Vérifier si l'utilisateur est connecté (au cas où le middleware ne fonctionnerait pas)
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        // Récupérer les informations utilisateur
        $user = session('user');

        // Charger la vue du tableau de bord avec les données utilisateur
        return view('acceille', [
            'user' => $user,
        ]);
    }
}
