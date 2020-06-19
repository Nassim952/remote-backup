<head>
	<title>NEAR BY - Connexion</title>
</head>

<main class="container">
	<section class="section1">
		<!-- IMAGE RED.PNG -->
	</section>

	<section class="section2">
		<header class="headerSection2">
			<div class="containerImg">
				<img src="../../src/images/logo.png">
			</div>
		</header>

		<section class="row">
            <?php foreach ($sections as $oSections): ?>
                <div class="col-sm-3 col-md-2">
                    <?php
                        $dataSection = $oSection->getData();
                        $aType = $oSection->getClass();
                        $this->addSection($aType, $dataSection);
                    ?>
                </div>
            <?php endforeach  ?>
		</section>
	</section>
</main>