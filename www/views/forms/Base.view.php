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
              <?php if(!empty($field->getOptions()["label"])):?>
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
              <?php endif ?> 
              
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
                </input>
            <?php endif;?>  

             <!---------------TIME --->
             <?php if($field->getType() == "time"):?>
              <?php if(!empty($field->getOptions()["label"])):?>
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
              <?php endif ?> 
              
              <input 
                value="<?= (isset($field->getOptions()['value'])) ? $field->getOptions()['value']:'' ?>"
                type="time"
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
                </input>
            <?php endif;?>  

            <!---------------SELECT --->
            <?php if($field->getType() == "select"):?>
              <?php if(!empty($field->getOptions()["label"])):?>
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
                <?php endif;?>
              
                <select 
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
                  
                  <?php foreach ($field->getOptions()['options'] as $key => $option):?>
                    <option value="<?= $key?>"> <?=$option?></option>
                  <?php endforeach;?> 
                </select>
            <?php endif;?> 
              
              <!---------------EMAIL --->
            <?php if($field->getType() == "email"):?>
              <?php if(!empty($field->getOptions()["label"])):?>
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
              <?php endif;?>  
                
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