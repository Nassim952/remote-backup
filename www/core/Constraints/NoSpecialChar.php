<?php

namespace cms\core\Constraints;


class NoSpecialChar implements ConstraintInterface
{
    protected $matchs;
    protected $specialCharMsg;
    protected $errors = [];

    // mettre un message par défaut si minMessage et maxMessage sont nuls, et setter les valeurs
    public function __construct(string $specialCharMsg = null)
    {
        $this->match = '@ &amp;|&quot;|&#039;|&lt;|&gt;@';
        
        $this->specialCharMsg = $specialCharMsg;

        if(NULL == $this->specialCharMsg)
        {
            $this->specialCharMsg = "Vous avez saisie un caractere incorrecte";
        }
    }

    // vérifie que la valeur est entre min et max
    // sinon on ajoute dans errors l'erreur associé
    public function isValid(string $value): bool
    {
        $value = htmlspecialchars ($value,ENT_QUOTES);

        $this->errors = [];
            if(preg_match( $this->match , $value) )
            {
                $this->errors[] = $this->specialCharMsg;
            }
            return (0 == count($this->errors));
    }

    // On retourne le tableau d'erreurs, vide si pas d'erreur
    public function getErrors(): array
    {
        return $this->errors;
    }
}
