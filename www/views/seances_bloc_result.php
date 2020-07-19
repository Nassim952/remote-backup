<span class="separator"> </span>
<?php if(empty($data)){ ?>
    <p>Aucun resultats pour votre recherche</p>
<?php  }else{ ?>
    <table class="">
        <thead>
            <tr>
                <th>Cinema</th>
                <th>Salle</th>
                <th>Film</th>
                <th>Seance</th>
                <th>Nombre de place</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data as $row){ 
            if ($row['nbr_place_rest'] <= 0) {
                $url = '';
                $disabled = 'disabled';
            } else {
                $url = '/reservation?idms='.urlencode($row["id"]).'&cinema='.urlencode($row["name"]).'&salle='.urlencode($row["name_room"]).'&film='.urlencode($row["title"]).'&seance='.urlencode($row["date_screaning"]).'&maxticket='.urlencode($row["nbr_place_rest"]);
                $disabled = '';
            }
            ?>
            <tr>
                <td><?php echo $row["name"] ?></td>
                <td><?php echo $row["name_room"] ?></td>
                <td><?php echo $row["title"] ?></td>
                <td><?php echo $row["date_screaning"] ?></td>
                <td><?php echo $row["nbr_place_rest"]." /".$row["nbr_places"] ?></td>
                <td><a href=<?php echo $url ?>><button <?php echo $disabled ?>>Réserver</button></a></td>
            </tr>
        <?php } ?> 
        </tbody>
    </table>
<?php } ?>

