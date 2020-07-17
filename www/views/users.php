<body>
    <head>
        <title>Utilisateurs</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    </head>


    <div class="site-content">
        <div id="head-title">
            <h2 style="font-size:32px;">Gestion des utilisateurs</h2>
        </div>
        <div id="separation-bar"></div>
        <table class="usersTable">
            <thead>
                <tr>
                    <th>
                        <div class="pretty p-default p-curve p-bigger cb-fixer">
                            <input type="checkbox" id="select-all" name="select-all">
                            <div class="state p-danger">
                                <label></label>
                            </div>
                        </div>

                        <script type="text/javascript">
                            // Listen for click on toggle checkbox
                            $('#select-all').click(function(event) {   
                                if(this.checked) {
                                    // Iterate each checkbox
                                    $(':checkbox').each(function() {
                                        this.checked = true;                        
                                    });
                                } else {
                                    $(':checkbox').each(function() {
                                        this.checked = false;                       
                                    });
                                }
                            });
                        </script>
                    </th>  
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Permission</th>
                    <th>Statut</th>
                </tr>
            </thead>

            <tbody>
                <?php
                use cms\core\Helpers;
                    foreach($users as $user):
                ?> 
                <tr>
                    <th>
                        <div class="pretty p-default p-curve p-bigger cb-fixer">
                            <input type="checkbox" id="userSelect" name="userSelect">
                            <div class="state p-danger">
                                <label></label>
                            </div>
                        </div>
                    </th>
                    <td scope="row"><?= $user->getId(); ?></td>
                    <td><?= $user->getLastname(); ?></td>
                    <td><?= $user->getFirstname(); ?></td>
                    <td><?= $user->getEmail(); ?></td>
                    <td><?= Helpers::getPermission($user->getAllow()) ?></td>
                    <td><?= $user->getStatut(); ?></td>
                    <?php if(reset($current_user)->getAllow() >= 2): ?>
                        <td><a href="<?= Helpers::getUrl('User', 'editUser').'/'.$user->getId() ?>" class="fas fa-edit fa-lg"></a></td>
                        <td><a href="<?= Helpers::getUrl('User', 'deleteUser').'/'.$user->getId() ?>" class="fas fa-trash-alt fa-lg"></a></td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>