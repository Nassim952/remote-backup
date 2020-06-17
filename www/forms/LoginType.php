<?php

namespace App\Forms;

use App\Core\Helper;

class LoginType extends Form {

    public function getForm(){
        return $this->builder
            ->addField("firstname", "text", [
                'placeholder' => 'toto'
            ])
            ->addField;
    }
}
