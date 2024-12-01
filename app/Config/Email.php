<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail='zeinebou.maaouiya.2r@edu.uiz.ac.ma';
    public string $fromName;
    public string $recipients;
   
    public string $userAgent = 'CodeIgniter';
    public string $protocol = 'smtp';
    public string $mailPath = '/usr/sbin/sendmail';
    public string $SMTPHost = 'smtp.gmail.com';

    // On ne met pas getenv() directement ici, mais dans le constructeur
    public string $SMTPUser;
    public string $SMTPPass;
    
    public int $SMTPPort = 465;
    public int $SMTPTimeout = 5;
    public bool $SMTPKeepAlive = false;
    public string $SMTPCrypto = 'ssl';
    public bool $wordWrap = true;
    public int $wrapChars = 76;
    public string $mailType = 'html';  // Vous pouvez utiliser 'html' pour plus de flexibilité
    public string $charset = 'UTF-8';
    public bool $validate = false;
    public int $priority = 3;
    public string $CRLF = "\r\n";
    public string $newline = "\r\n";
    public bool $BCCBatchMode = false;
    public int $BCCBatchSize = 200;
    public bool $DSN = false;

    // Le constructeur pour initialiser les valeurs des propriétés
    public function __construct()
    {
        // Initialisation des propriétés avec les valeurs provenant des variables d'environnement
       // $this->fromEmail = getenv('CI_EMAIL_SMTP_USER');  // Email de l'expéditeur
        $this->fromName = 'chapterChatter';      // Nom de l'expéditeur (ajustez à votre besoin)
        $this->SMTPUser = getenv('CI_EMAIL_SMTP_USER');    // Utilisateur SMTP (souvent l'email)
        $this->SMTPPass = getenv('CI_EMAIL_SMTP_PASS');    // Mot de passe SMTP ou token d'application

        // Si vous avez d'autres valeurs à récupérer de .env, vous pouvez aussi les ajouter ici
    }
}
