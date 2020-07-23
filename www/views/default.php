<main class="container">
	<section class="col-md-6">
		<?php foreach ($page->getSections() as $section): ?>
			<?php
				$components = $section->getComponents();
				$this->addSection($section, $components);
			?>
		<?php endforeach; ?>
		<?php if(reset($current_user)->getAllow() >= 2): ?>
			<button style="position:fixed;" class="open-button" id="ajout-section" onclick="openForm(this.id)">Ajout Section</button>
				<div class="form-popup" id="myForm_ajout-section">
					<form action="" class="form-container" method="POST">
						<h1>Ajout nouvelle section</h1>
                
						<div style="display: flex;
						justify-content: space-around;
						margin-bottom: 20px;">
							<label for="size"><b>Taille de la section :</b></label>
							<select type="select" name="size" required>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
						</div>

						<button type="submit" class="btn">Valider</button>
						<button type="button" id="ajout-section" class="btn cancel" onclick="closeForm(this.id)">Close</button>
					</form>
				</div>
		<?php endif; ?>
	</section>
</main>
