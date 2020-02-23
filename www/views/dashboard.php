<head>
    <title>Dashboard</title>
</head>

<body>
    <div class="flex-container">
        <div class="sidebar">
            <div class="title-container">
                <div>
                    <h1>NEAR BY</h1>
                </div>
                <div id="subtitle-fixer">
                    <h3 id="text-white" style="font-size:20px;">Dashboard</h3>
                </div>
            </div>
            <div class="name-container">
                <span id="dot"></span>
                <p>John Doe</p>
            </div>
            <div class="nav-content">
                <h2 id="text-submenu-fixer">Cinestar</h2>
                <div class="dashboard-menu active">
                    <div class="sidebar-sub-headers">
                        <div class="fas fa-film fa-lg"></div>
                        <div id="submenu-wrapper">
                            <a href="#" id="text-white"><span>Films</span></a>
                        </div>
                    </div>
                </div>
                <h2 id="text-submenu-fixer">Diffusion</h2>
                <div class="dashboard-menu">
                    <div class="sidebar-sub-headers">
                        <div class="fas fa-clock fa-lg"></div>
                        <div id="submenu-wrapper">
                            <span>Horaires</span>
                        </div>
                    </div>
                </div>
                <div class="dashboard-menu">
                    <div class="sidebar-sub-headers">
                        <div class="fas fa-sliders-h fa-lg"></div>
                        <div id="submenu-wrapper">
                            <span>Salles</span>
                        </div>
                    </div>
                </div>
                <div class="dashboard-menu">
                    <div class="sidebar-sub-headers">
                        <div class="fas fa-video fa-lg"></div>
                        <div id="submenu-wrapper">
                            <span>Cinema</span>
                        </div>
                    </div>
                </div>
                <h2 id="text-submenu-fixer">KPI</h2>
                <div class="dashboard-menu">
                    <div class="sidebar-sub-headers">
                        <div class="fas fa-users fa-lg"></div>
                        <div id="submenu-wrapper">
                        <a href="<?= Helpers::getUrl("User","stat") ?>" id="text-white"><span>Statistiques</span></a>
                        </div>
                    </div>
                </div>
                <h2 id="text-submenu-fixer">Gestion</h2>
                <div class="dashboard-menu">
                    <div class="sidebar-sub-headers">
                        <div class="fas fa-users fa-lg"></div>
                        <div id="submenu-wrapper">
                            <span>Utilisateurs</span>
                        </div>
                    </div>
                </div>
                <div class="dashboard-menu">
                    <div class="sidebar-sub-headers">
                        <div class="fas fa-user-shield fa-lg"></div>
                        <div id="submenu-wrapper">
                            <span>Administrateur</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="site-content">
            <div id="head-title">
                <h2 style="font-size:32px;">Films</h2>
            </div>
            <div id="separation-bar"></div>
            <div class="quick-tools">
                <div id="space-icons">
                    <a href="#" class="fas fa-plus fa-lg"></a>
                    <a href="#" class="fas fa-trash-alt fa-lg"></a>
                </div>
            </div>
            <div class="lists-film">
                <table class="table-wrapper">
                    <tr class="tr-container">
                        <td class="td-dashboard-wrapper">
                            <div class="pretty p-default p-curve p-bigger cb-fixer">
                                <input type="checkbox">
                                <div class="state p-danger">
                                    <label></label>
                                </div>
                            </div>
                            <p id="text-wrappe">Bad boys For Life</p>
                            |
                            <p id="hour-wrappe">1h34</p>
                            <div class="icons-wrapper">
                                <a href="#" class="fas fa-edit fa-lg"></a>
                                <a href="#" class="fas fa-trash-alt fa-lg"></a>
                            </div>
                        </td>
                        <td class="td-dashboard-wrapper">
                            <div class="pretty p-default p-curve p-bigger cb-fixer">
                                <input type="checkbox">
                                <div class="state p-danger">
                                    <label></label>
                                </div>
                            </div>
                            <p id="text-wrappe">Avengers</p>
                            |
                            <p id="hour-wrappe">1h34</p>
                            <div class="icons-wrapper">
                                <a href="#" class="fas fa-edit fa-lg"></a>
                                <a href="#" class="fas fa-trash-alt fa-lg"></a>
                            </div>
                        </td>
                        <td class="td-dashboard-wrapper">
                            <div class="pretty p-default p-curve p-bigger cb-fixer">
                                <input type="checkbox">
                                <div class="state p-danger">
                                    <label></label>
                                </div>
                            </div>
                            <p id="text-wrappe">Breaking Bad</p>
                            |
                            <p id="hour-wrappe">1h34</p>
                            <div class="icons-wrapper">
                                <a href="#" class="fas fa-edit fa-lg"></a>
                                <a href="#" class="fas fa-trash-alt fa-lg"></a>
                            </div>
                        </td>
                        <td class="td-dashboard-wrapper">
                            <div class="pretty p-default p-curve p-bigger cb-fixer">
                                <input type="checkbox">
                                <div class="state p-danger">
                                    <label></label>
                                </div>
                            </div>
                            <p id="text-wrappe">Tortues Ninja</p>
                            |
                            <p id="hour-wrappe">1h34</p>
                            <div class="icons-wrapper">
                                <a href="#" class="fas fa-edit fa-lg"></a>
                                <a href="#" class="fas fa-trash-alt fa-lg"></a>
                            </div>
                        </td>
                        <td class="td-dashboard-wrapper">
                            <div class="pretty p-default p-curve p-bigger cb-fixer">
                                <input type="checkbox">
                                <div class="state p-danger">
                                    <label></label>
                                </div>
                            </div>
                            <p id="text-wrappe">Spider Man 3</p>
                            |
                            <p id="hour-wrappe">1h34</p>
                            <div class="icons-wrapper">
                                <a href="#" class="fas fa-edit fa-lg"></a>
                                <a href="#" class="fas fa-trash-alt fa-lg"></a>
                            </div>
                        </td>
                        <td class="td-dashboard-wrapper">
                            <div class="pretty p-default p-curve p-bigger cb-fixer">
                                <input type="checkbox">
                                <div class="state p-danger">
                                    <label></label>
                                </div>
                            </div>
                            <p id="text-wrappe">Charlie Chaplin</p>
                            |
                            <p id="hour-wrappe">1h34</p>
                            <div class="icons-wrapper">
                                <a href="#" class="fas fa-edit fa-lg"></a>
                                <a href="#" class="fas fa-trash-alt fa-lg"></a>
                            </div>
                        </td>
                        <td class="td-dashboard-wrapper">
                            <div class="pretty p-default p-curve p-bigger cb-fixer">
                                <input type="checkbox">
                                <div class="state p-danger">
                                    <label></label>
                                </div>
                            </div>
                            <p id="text-wrappe">James Bond 007</p>
                            |
                            <p id="hour-wrappe">1h34</p>
                            <div class="icons-wrapper">
                                <a href="#" class="fas fa-edit fa-lg"></a>
                                <a href="#" class="fas fa-trash-alt fa-lg"></a>
                            </div>
                        </td>
                        <td class="td-dashboard-wrapper">
                            <div class="pretty p-default p-curve p-bigger cb-fixer">
                                <input type="checkbox">
                                <div class="state p-danger">
                                    <label></label>
                                </div>
                            </div>
                            <p id="text-wrappe">Fast & Furious 8</p>
                            |
                            <p id="hour-wrappe">1h34</p>
                            <div class="icons-wrapper">
                                <a href="#" class="fas fa-edit fa-lg"></a>
                                <a href="#" class="fas fa-trash-alt fa-lg"></a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>