<main class="container">
	
	<section class="container">
		<?php foreach ($page->getSections() as $section): ?>
			<?php
				$components = $section->getComponents();
				$this->addSection($section, $components);
			?>
		<?php endforeach  ?>
	</section>
</main>