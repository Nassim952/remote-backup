<?php
use cms\core\Helpers;
?>
<span class="separator"> </span>
<?php if(empty($data)){ ?>
    <p>Aucun resultats pour votre recherche</p>
<?php  }else{ ?>
    <table style="margin:auto;">
        <thead>
            <tr>
                <th>Cinema</th>
                <th>Salle</th>
                <th>Film</th>
                <th>Seance</th>
                <th>Nombre de place</th>
                <th>Actions</th>
            </tr><p>
        </thead>
        <tbody>
        <?php foreach($data as $row){
            $editUrl = Helpers::getUrl("MovieSession", "editSeance").'/'.$row["id"].'-'.$row["cinema_id"].'-'.$row["room_id"].'-'.$row["movie_id"];
            $deleteUrl = Helpers::getUrl("MovieSession", "deleteSeance").'/'.$row["id"];
            if ($row['nbr_place_rest'] <= 0) {
                $url = '';
                $disabled = 'disabled';
            } else {
                if(reset($current_user)->getAllow() >= 2){
                    $url = '/reservation?idms='.urlencode($row["id"]).'&cinema='.urlencode($row["name"]).'&salle='.urlencode($row["name_room"]).'&film='.urlencode($row["title"]).'&seance='.urlencode($row["date_screaning"]).'&maxticket='.urlencode($row["nbr_place_rest"]);
                }else{
                    $url = '/showReservation?idms='.urlencode($row["id"]).'&cinema='.urlencode($row["name"]).'&salle='.urlencode($row["name_room"]).'&film='.urlencode($row["title"]).'&seance='.urlencode($row["date_screaning"]).'&maxticket='.urlencode($row["nbr_place_rest"]);
                }
                $disabled = '';
            }
            ?>
            <tr>
                <td><?php echo $row["name"] ?></td>
                <td><?php echo $row["name_room"] ?></td>
                <td><?php echo $row["title"] ?></td>
                <td><?php echo $row["date_screaning"] ?></td>
                <td><?php echo $row["nbr_place_rest"]." /".$row["nbr_places"] ?></td>
                <td>
                    <a href=<?php echo $url ?>><button <?php echo $disabled ?>>Réserver</button></a>
                    <?php if(reset($current_user)->getAllow() >= 2): ?>
                    <a href=<?php echo $editUrl ?>><button>Modifier</button></a>
                    <a href=<?php echo $deleteUrl ?>><button>Supprimer</button></a>
                    <?php endif ?>
                </td>
            </tr>
        <?php } ?> 
        </tbody>
    </table>
<?php } ?>

