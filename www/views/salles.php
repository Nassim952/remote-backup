<head>
    <title>Salles</title>
    <style>
    .div-container {
    margin: auto;
    padding: 15px;
    width: 75%;
    }
    .accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
    }

    .active, .accordion:hover {
    background-color: #ccc;
    }

    .accordion:after {
    content: '\002B';
    color: #777;
    font-weight: bold;
    float: right;
    margin-left: 5px;
    }

    .active:after {
    content: "\2212";
    }

    .panel {
    padding: 0 18px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
    }

    #salles {
    border-collapse: collapse;
    width: 100%;
    margin: 15px auto;
    }

    #salles td, #salles th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #salles tr:nth-child(even){background-color: #f2f2f2;}

    #salles tr:hover {background-color: #ddd;}

    #salles th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #cccccc;
    color: white;
    }
    </style>

    <script>
    window.addEventListener("load", function () {
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
            } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
            } 
        });
        }
    });
    </script>
</head>


<div class="site-content">
    <?php 
    if(isset($_GET['message']) && !empty($_GET['message'])) {
        echo '<p style="width: 100%; background-color: #5aab5a40; color: #07750a; padding: 10px; margin: auto; text-align:center">' . urldecode($_GET['message']) . '</p>';
    } 
    ?>

    <div id="head-title">
        <h2 style="font-size:32px;">Salles</h2>
        <div class="quick-tools" style="margin-top:0; margin-right:25px;">
            <div id="space-icons" >
                <a title="Ajouter une salle" href="<?= cms\core\Helpers::getUrl('Room','addRoom') ?>" class="fas fa-plus fa-lg"></a>
            </div>
        </div>
    </div>
    <div id="separation-bar"></div>

    <div class="div-container">
        <?php
            foreach($datas as $data):
        ?> 
            <button class="accordion"><?= $data['cinema_name'] ?></button>
            <div class="panel">  
            <table id="salles">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom de la salle</th>
                    <th>Nombre de place</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data['rooms'] as $room): 
                $urlDelete = cms\core\Helpers::getUrl('Room','deleteRoom').'/'.$room["id"].'-'.$data['cinema_id'];
                $urlEdit = cms\core\Helpers::getUrl('Room','editRoom').'/'.$room["id"].'-'.$data['cinema_id'];?>
                <tr>
                    <td><?php echo $room["id"] ?></td>
                    <td><?php echo $room["name_room"] ?></td>
                    <td><?php echo $room["nbr_places"] ?></td>
                    <td><a href='<?php echo $urlEdit ?>'><button >Modifier</button></a> <a href='<?php echo $urlDelete ?>'><button>Supprimer</button></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
            </div>
        <?php endforeach; ?>
    </div>
</div>