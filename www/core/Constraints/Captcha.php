<?php

namespace cms\core\Constraints;

session_start();


class Captcha implements ConstraintInterface
{

    protected $msg;
    protected $errors = [];
    

    // mettre un message par défaut si le captch n'est pas rempli
    public function __construct(string $msg = null)
    {
        $this->msg = $msg;

        if(NULL == $this->msg)
            $this->msg = "Veuillez recopier les caractères de l'image";

    }

    // vérifie que la captcha est valid
    // sinon on ajoute dans errors l'erreur associé
    public function isValid(string $value): bool
    {
        $this->errors = [];

        // If the captcha is valid 
        if ($_POST['Register_captcha'] !== $_SESSION['captcha']) {
            $this->errors[] = $this->msg; 
        } 

        return (0 == count($this->errors));
    }

    // On retourne le tableau d'erreurs, vide si pas d'erreur
    public function getErrors(): array
    {
        return $this->errors;
    }
}