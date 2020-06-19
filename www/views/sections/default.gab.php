<section class="row">
    <?php foreach ($components as $oComponent): ?>
        <div class="col-sm-3 col-md-2">
            <?php
                $dataComponent = $oComponent->getData();
                $aType = $oComponent->getClass();
                $this->addmodal($aType, $dataComponent);
            ?>
        </div>
    <?php endforeach  ?>
</section>