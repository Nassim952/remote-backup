<?php

namespace cms\core\Constraints;


class Password implements ConstraintInterface
{

    protected $emailMessage;
    protected $errors = [];

    // mettre un message par défaut si minMessage et maxMessage sont nuls, et setter les valeurs
    public function __construct(string $emailMessage = null)
    {
        $this->matchs = ['@[A-Z]@','@[a-z]@','@[0-9]@'];
        $this->emailMessage = $emailMessage;

        if(NULL == $this->emailMessage)
        {
            $this->emailMessage = "Adresse mail non valide";
        }  
    }

    // vérifie que la valeur est entre min et max
    // sinon on ajoute dans errors l'erreur associé
    public function isValid(string $value): bool
    {
        $this->errors = [];
        
            if(filter_var($value, FILTER_VALIDATE_EMAIL) )
            {
                $this->errors[] = $this->emailMessage;
            }

        return (0 == count($this->errors));
    }

    // On retourne le tableau d'erreurs, vide si pas d'erreur
    public function getErrors(): array
    {
        return $this->errors;
    }
}