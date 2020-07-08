<form 
method="<?= $form->getConfig()['method'] ?>" 
action="<?= $form->getConfig()['action'] ?>"
name="<?= $form->getName() ?>"
<?php foreach($form->getConfig()['attr'] as $attr => $value)
{
  echo "$attr = '$value' ";
}
?>>

<?php
      if(!$form->isValid())
      {
        foreach($form->getErrors() as $key => $errorsPerField)
        {
          foreach($errorsPerField as $error)
          {
             echo "Erreur : $error <br>";

          }
         
        }
      }

      echo "<br><br>";
?>


      <?php foreach ($form->getElements() as $key => $field):?>
        <div class="form-group row">
          <div class="col-sm-12">

          <!---------------SUBMIT --->
            <?php if($field->getType() == "submit"):?>
              <div class="button_wrapper">
							
                <button
                <?php 
                  if(isset($field->getOptions()['attr'])) {
                    foreach($field->getOptions()['attr'] as $attr => $value)
                      {
                        echo "$attr = '$value' ";
                      }
                    }
                    ?>
                >
                  
                <?= $field->getOptions()["label"]??'' ?>
              </button>
            </div>
            <?php endif;?>
            <!---------------TEXT --->
            <?php if($field->getType() == "text"):?>
              <label
                  <?php 
                  if(isset($field->getOptions()['attr_label'])) {
                    foreach($field->getOptions()['attr_label'] as $attr => $value)
                      {
                        echo "$attr = '$value' ";
                      }
                  }
                  
                    ?>
              ><?= (!empty($field->getOptions()["label"]))?'':''?><br><br></label>
              
              
              <input 
                value="<?= (isset($field->getOptions()['value'])) ? $field->getOptions()['value']:'' ?>"
                type="text"
                name="<?= $form->getName().'_'.$field->getName() ?>"
               
                <?php 
                if(isset($field->getOptions()['attr'])) {
                  foreach($field->getOptions()['attr'] as $attr => $value)
                    {
                      echo "$attr = '$value' ";
                    }
                  }
                  ?>
                <?=(!empty($field->getOptions()["required"]))?"required='required'":''?> 
                <?=(!empty($field->getOptions()["placeholder"]))? "placeholder = '".$field->getOptions()['placeholder'].'\'':''?>>
              <?php endif;?>  
              
              <!---------------EMAIL --->
            <?php if($field->getType() == "email"):?>
              <div class="label-password">
                <label
                    <?php 
                    if(isset($field->getOptions()['attr_label'])) {
                      foreach($field->getOptions()['attr_label'] as $attr => $value)
                        {
                          echo "$attr = '$value' ";
                        }
                    }
                    
                      ?>
                ><?= (!empty($field->getOptions()["label"]))?'':''?><br><br></label>
                
                
                <input 
                  value="<?= (isset($field->getOptions()['value'])) ? $field->getOptions()['value']:'' ?>"
                  type="email"
                  name="<?= $form->getName().'_'.$field->getName() ?>"
                
                  <?php 
                  if(isset($field->getOptions()['attr'])) {
                    foreach($field->getOptions()['attr'] as $attr => $value)
                      {
                        echo "$attr = '$value' ";
                      }
                    }
                    ?>
                  <?=(!empty($field->getOptions()["required"]))?"required='required'":''?> 
                  <?=(!empty($field->getOptions()["placeholder"]))? "placeholder = '".$field->getOptions()['placeholder'].'\'':''?>>
                </div>
              <?php endif;?> 

              <!---------------PASSWORD --->
            <?php if($field->getType() == "password"):?>
              <label
                  <?php 
                  if(isset($field->getOptions()['attr_label'])) {
                    foreach($field->getOptions()['attr_label'] as $attr => $value)
                      {
                        echo "$attr = '$value' ";
                      }
                  }
                  
                    ?>
              ><?= (!empty($field->getOptions()["label"]))?'':''?><br><br></label>
              
              
              <input 
                value="<?= (isset($field->getOptions()['value'])) ? $field->getOptions()['value']:'' ?>"
                type="password"
                name="<?= $form->getName().'_'.$field->getName() ?>"
               
                <?php 
                if(isset($field->getOptions()['attr'])) {
                  foreach($field->getOptions()['attr'] as $attr => $value)
                    {
                      echo "$attr = '$value' ";
                    }
                  }
                  ?>
                <?=(!empty($field->getOptions()["required"]))?"required='required'":''?> 
                <?=(!empty($field->getOptions()["placeholder"]))? "placeholder = '".$field->getOptions()['placeholder'].'\'':''?>>
                <div class="label-password">
                    <input type="checkbox"/>
                    <span style="margin-right: 30%; padding: 9px;">Se souvenir de moi</span>
                    <span>Mot de passe oublié ?</span>
                  </div>
                <?php endif;?>  
              
          </div>
      </div>
      <?php endforeach;?>
</form>
