<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;

class EmailController extends Controller
{
    public function sendTestEmail()
    {
        // Créer l'instance de service d'email
        $emailService = Services::email();
        
        // Paramètres de l'email
        $emailService->setFrom('chapterchatter788@gmail.com', 'Nom de votre application');
        $emailService->setTo('destinataire@example.com');
        $emailService->setSubject('Test Email');
        $emailService->setMessage('Ceci est un email de test pour vérifier l\'envoi via CodeIgniter.');

        // Envoyer l'email
        if ($emailService->send()) {
            echo 'Email envoyé avec succès!';
        } else {
            echo 'Erreur lors de l\'envoi de l\'email.';
            // Affiche les erreurs de débogage si l'email n'a pas été envoyé
            print_r($emailService->printDebugger());
        }
    }
}
