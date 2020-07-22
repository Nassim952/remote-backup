<?php

namespace cms\core\Constraints;


class ConfirmPwd implements ConstraintInterface
{
    protected $password;
    protected $pwdMessage;
    protected $errors = [];

    // mettre un message par défaut si minMessage et maxMessage sont nuls, et setter les valeurs
    public function __construct(string $formName, string $pwdMessage = null)
    {
        (isset($_POST[$formName.'_password'])) ? $this->password = $_POST[$formName.'_password'] : '';
        $this->pwdMessage = $pwdMessage;

        if(NULL == $this->pwdMessage)
        {
            $this->pwdMessage = "Vos mots de passe doivent être identique";
        }
        
    }

    public function isValid(string $value): bool
    {
        $this->errors = [];

        if($value != $this->password){
            $this->errors[] = $this->pwdMessage;
        }

        return (0 == count($this->errors));
    }

    // On retourne le tableau d'erreurs, vide si pas d'erreur
    public function getErrors(): array
    {
        return $this->errors;
    }
}