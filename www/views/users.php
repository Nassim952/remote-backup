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
                    <th>Statut</th>
                    <th><a href="#" class="fas fa-plus fa-lg"></a></th>
                    <th><a href="#" class="fas fa-trash-alt fa-lg"></a></th>
                </tr>
            </thead>

            <tbody>
                <!--<?php
                /**    $users = new user;
                    foreach($users->getUsers() as $key => $value): 
                **/
                ?>-->
                <tr>
                    <th>
                        <div class="pretty p-default p-curve p-bigger cb-fixer">
                            <input type="checkbox" id="userSelect" name="userSelect">
                            <div class="state p-danger">
                                <label></label>
                            </div>
                        </div>
                    </th>
                    <td scope="row">1</td>
                    <td>Kendrick</td>
                    <td>Lamar</td>
                    <td>kdot@gmail.com</td>
                    <td>Statut: 0</td>
                    <td><a href="#" class="fas fa-edit fa-lg"></a></td>
                    <td><a href="#" class="fas fa-trash-alt fa-lg"></a></td>
                </tr>
                <!--<?php /** endforeach **/; ?>-->

                <tr>
                    <th>
                        <div class="pretty p-default p-curve p-bigger cb-fixer">
                            <input type="checkbox" id="userSelect" name="userSelect">
                            <div class="state p-danger">
                                <label></label>
                            </div>
                        </div>
                    </th>
                    <td scope="row">2</td>
                    <td>Rihanna</td>
                    <td>Fenty</td>
                    <td>rfenty@gmail.com</td>
                    <td>Statut: 1</td>
                    <td><a href="#" class="fas fa-edit fa-lg"></a></td>
                    <td><a href="#" class="fas fa-trash-alt fa-lg"></a></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>