<?php

namespace cms\controllers;

use cms\core\Controller;
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
            
            $conf[] = "CURRENT_FONT=$font \n";
            $conf[] = "CURRENT_FONT_SIZE=$font_size \n";
            $conf[] = "CURRENT_FONT_COLOR=$font_color \n";
            $conf[] = "CURRENT_TEMPLATE=$template".PHP_EOL;

            file_put_contents(".conf", $conf);


        }else
        {
            $this->render("custom-front", "back", [
                "configFormCustom" => $form,
            ]);
        }
    }
}