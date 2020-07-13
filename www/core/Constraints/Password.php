<?php

namespace cms\core\Constraints;


class Password implements ConstraintInterface
{
    protected $matchs;
    protected $pwdMessage;
    protected $errors = [];

    // mettre un message par défaut si minMessage et maxMessage sont nuls, et setter les valeurs
    public function __construct(string $pwdMessage = null)
    {
        $this->matchs = ['@[A-Z]@','@[a-z]@','@[0-9]@'];
        $this->pwdMessage = $pwdMessage;

        if(NULL == $this->pwdMessage)
        {
            $this->pwdMessage = "Votre mot de passe doit contenir Minuscule, Majuscule et un chiffre compris entre 0-9";
        }
           
    }

    // vérifie que la valeur est entre min et max
    // sinon on ajoute dans errors l'erreur associé
    public function isValid(string $value): bool
    {
        $this->errors = [];

        foreach($this->matchs as $match)
        {
            if(!preg_match($match, $value) )
            {
                $this->errors[] = $this->minMessage;
                break;
            }
        }

        return (0 == count($this->errors));
    }

    // On retourne le tableau d'erreurs, vide si pas d'erreur
    public function getErrors(): array
    {
        return $this->errors;
    }
}