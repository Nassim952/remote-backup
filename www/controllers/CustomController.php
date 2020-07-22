<?php

namespace cms\controllers;

use cms\core\Controller;
use cms\core\Helpers;
use cms\forms\CustomType;

class CustomController extends Controller{

    public function customAction(){
        $form = $this->createForm(CustomType::class);
        $form->handle();

        if($form->isSubmit() && $form->isValid())
        { 
            file_put_contents(".conf", '');

            $font = $_POST[$form->getName().'_font'];
            $font_size = $_POST[$form->getName().'_font_size'];
            $font_color = $_POST[$form->getName().'_font_color'];
            $template = $_POST[$form->getName().'_template'];
            
            $conf[] = "CURRENT_FONT=$font \r\n";
            $conf[] = "CURRENT_FONT_SIZE=$font_size \r\n";
            $conf[] = "CURRENT_FONT_COLOR=$font_color \r\n";
            $conf[] = "CURRENT_TEMPLATE=$template \r\n";

            file_put_contents(".conf", $conf);

            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else
        {
            $this->render("custom-front", "back", [
                "configFormCustom" => $form,
            ]);
        }
    }
}