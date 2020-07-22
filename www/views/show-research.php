<!DOCTYPE html>
<html lang="en">
  <head>
    <title>NEAR BY CMS - Recherche de film</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/show-research.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>

  <body>
    <script>
      jQuery(document).ready(function() {
        var duration = 300;
        jQuery(window).scroll(function() {
          if (jQuery(this).scrollTop() > 300) {
            // Défillement de 300 pixels ou plus
            // Ajoute le bouton
            jQuery('.top').fadeIn(duration);
          } else {
            // Enlève le bouton
            jQuery('.top').fadeOut(duration);
          }
        });
              
        jQuery('.top').click(function(event) {
          // Retour en haut animé au clic
          event.preventDefault();
          jQuery('html, body').animate({scrollTop: 0}, duration);
          return false;
        })
      });
    </script>

    <table class="tableMovie">
      <?php foreach($searched as $movie): ?>
        <tr class="trMovie">
          <td class="tdPicture">
            <img class="imgMovie" src="<?= $movie->getImage_poster() ?>">
          </td>

          <td class="tdDescription">
            <h1><?= $movie->getTitle() ?></h1>
            
            <p><?= $movie->getKind() ?>, 
            <?= $movie->getMovie_type() ?>, 
            âge <?= $movie->getAge_require() ?>+
            </p>

            <span><a href="/show-movie/<?= $movie->getId() ?>" style="font-weight: bold;" class="hover">Voir plus</a></span>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
    
    <a class="top" title="Go to top"> Remonter</a>
  </body>
</html>