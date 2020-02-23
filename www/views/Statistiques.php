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
                <div class="dashboard-menu">
                    <div class="sidebar-sub-headers">
                        <div class="fas fa-film fa-lg"></div>
                        <div id="submenu-wrapper">
                            <a href="<?= helpers::getUrl("User","dashboard") ?>" id="text-white"><span>Films</span></a>
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
                <div class="dashboard-menu active">
                    <div class="sidebar-sub-headers">
                        <div class="fas fa-users fa-lg"></div>
                        <div id="submenu-wrapper">
                        <a href="#" id="text-white"><span>Statistiques</span></a>
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
                <h2 style="font-size:32px;">Statistiques</h2>
            </div>
            <div id="separation-bar"></div>
            <div class="graph-container">
                <canvas id="graph1"></canvas>
                <script>datachart();</script>
            </div>
        </div>
    </div>
</body>