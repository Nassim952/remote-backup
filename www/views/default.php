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
            <?php foreach ($page as $oSections): ?>
                <div class="col-sm-3 col-md-2">
                    <?php
                        $sections = $oSection->getData();
						$classSection = $oSection->getClass();
                        $this->addSection($classSection, $sections);
                    ?>
                </div>
            <?php endforeach  ?>
		</section>
	</section>
</main>