<!DOCTYPE html>
<html lang="en">
  <head>
    <title>NEAR BY CMS - Recherche de film</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/show-research.css">
  </head>

  <body>
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

            <span><a href="/show-movie (LE-FILM-EN-QUESTION)" style="font-weight: bold;" class="hover">Voir plus</a></span>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </body>
</html>