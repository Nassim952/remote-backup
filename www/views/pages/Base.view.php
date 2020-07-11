<div 
    method="<?= $form->getConfig()['method'] ?>" 
    action="<?= $form->getConfig()['action'] ?>"
    name="<?= $form->getName() ?>"

    <?php foreach ($page->getElements() as $section):?>
        <div class="col-sm-3 col-md-2">
            <?php
                $dataSection = $section->getData();
                $aType = $section->getClass();
                $this->addmodal($aType, $dataComponent);
            ?>
        </div>
    <?php endforeach ?>      
</div>