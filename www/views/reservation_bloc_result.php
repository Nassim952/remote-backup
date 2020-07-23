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
                <th>Email</th>
                <th>Cinema</th>
                <th>Salle</th>
                <th>Film</th>
                <th>Séance</th>
                <th>Nbr places reservées</th>
                <th>Action</th>
            </tr><p>
        </thead>
        <tbody>
        <?php foreach($data as $row){ 
            $url = Helpers::getUrl("MovieReservation", "deleteReservation").'/'.$row["id_resa"].'-'.$row["nbr_places"].'-'.$row["id"];
            ?>
            <tr>
                <td><?php echo $row["user_email"] ?></td>
                <td><?php echo $row["name"] ?></td>
                <td><?php echo $row["name_room"] ?></td>
                <td><?php echo $row["title"] ?></td>
                <td><?php echo $row["date_screaning"] ?></td>
                <td><?php echo $row["nbr_places"]?></td>
                <?php if(reset($current_user)->getAllow() >= 2): ?>
                <td><a href=<?php echo $url ?>><button>Supprimer</button></a></td>
                <?php endif ?>
            </tr>
        <?php } ?> 
        </tbody>
    </table>
<?php } ?>

