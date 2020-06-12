--
-- Base de données :  `cinedata`
--

-- --------------------------------------------------------

--
-- Structure de la table `identity`
--

DROP DATABASE IF EXISTS cinedata;
CREATE DATABASE IF NOT EXISTS cinedata;

DROP TABLE IF EXISTS bape_identity;
CREATE TABLE IF NOT EXISTS bape_identity(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    lastname VARCHAR(100),
    firstname VARCHAR(100),
    birthdate DATE
);

-- 
-- Chargement des données de la table user
-- 

INSERT INTO bape_identity (id, lastname, firstname, birthdate) VALUES
(1, 'desouza', 'eyram', '2020-01-01'),
(2, 'mbiya', 'eyram', '2020-01-01'),
(3, 'mmadi','nassim','2020-01-01'),
(4, 'belatoui', 'bibal', '2020-01-01'),
(5, 'mondor', 'andrew', '2020-01-01');

--
-- Structure de la table user
--

DROP TABLE IF EXISTS bape_user;
CREATE TABLE IF NOT EXISTS bape_user(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    login VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    statut INT NOT NULL,
    allow VARCHAR(255) NOT NULL,
    identity_id INT,
    FOREIGN KEY (identity_id) REFERENCES bape_identity(id) ON DELETE CASCADE
);

-- 
-- Chargement des données de la table user
-- 

INSERT INTO bape_user (id, login, email, password, statut, allow, identity_id) VALUES
(1, 'eyram', 'eyram@nearby.com', 'password', 1, 'admin', 1),
(2, 'randy', 'randy@nearby.com','password', 1, 'admin', 2),
(3, 'nassim','nassim@nearby.com','password', 1, 'admin', 3),
(4, 'bilal','bilal@nearby.com','password', 1, 'admin', 4),
(5, 'andrew','andrew@nearby.com', 'password', 1, 'admin',5);


--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS bape_image;
CREATE TABLE IF NOT EXISTS bape_image(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title VARCHAR(255),
    REFERENCE VARCHAR (20),
    uploading_date TIMESTAMP
);

--
-- Structure de la table `component`
--

DROP TABLE IF EXISTS bape_component;
CREATE TABLE IF NOT EXISTS bape_component(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title VARCHAR(255),
    class VARCHAR(255),
    type_Componnent INT, 
    color INT
);

--
-- Structure de la table `page`
--

DROP TABLE IF EXISTS bape_page;
CREATE TABLE IF NOT EXISTS bape_page(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nom VARCHAR(100),
    gabarit INT NOT NULL,
    creation_date TIMESTAMP,
    theme INT,
    background_image INT,
    FOREIGN KEY (background_image) REFERENCES bape_image(id) ON DELETE CASCADE
);

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS bape_article;
CREATE TABLE IF NOT EXISTS bape_article(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    subtiltle VARCHAR(255),
    creation_date TIMESTAMP,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES bape_user(id) ON DELETE CASCADE
);

--
-- Structure de la table `article_image`
--

DROP TABLE IF EXISTS bape_article_image;
CREATE TABLE IF NOT EXISTS bape_article_image(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title VARCHAR(255),
    REFERENCE VARCHAR (2),
    uploading_date TIMESTAMP,
    article_id INT NOT NULL,
    image_id INT NOT NULL,
    FOREIGN KEY (article_id) REFERENCES bape_article(id) ON DELETE CASCADE,
    FOREIGN KEY (image_id) REFERENCES bape_image(id) ON DELETE CASCADE
);

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS bape_comment;
CREATE TABLE IF NOT EXISTS bape_comment(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    comment TEXT,
    post_date TIMESTAMP,
    user_id INT NOT NULL,
    target INT NOT NULL,
    target_type INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES bape_user(id) ON DELETE CASCADE
);

--
-- Structure de la table `component_page`
--

DROP TABLE IF EXISTS bape_component_page;
CREATE TABLE IF NOT EXISTS bape_component_page(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title VARCHAR(255),
    position INT,
    page_id INT NOT NULL,
    componnent_id INT NOT NULL,
    FOREIGN KEY (page_id) REFERENCES bape_page(id) ON DELETE CASCADE,
    FOREIGN KEY (componnent_id) REFERENCES bape_component(id) ON DELETE CASCADE
);

--
-- Structure de la table `movie`
--

DROP TABLE IF EXISTS bape_movie;
CREATE TABLE IF NOT EXISTS bape_movie(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title VARCHAR(255),
    release_date DATE,
    duration TIME,
    synopsis TEXT
)ENGINE=InnoDB AUTO_INCREMENT=504 DEFAULT CHARSET=latin1;;

-- 
-- Chargement des données de la table movie
-- 

INSERT INTO bape_movie (id, title, release_date, duration, synopsis) VALUES
(1, 'Spider-Man New Generation', '2021-01-06', '03:02', 'Spider-Man : New Generation suit les aventures de Miles Morales, un adolescent afro-américain et portoricain qui vit à Brooklyn et s’efforce de s’intégrer dans son nouveau collège à Manhattan. Mais la vie de Miles se complique quand il se fait mordre par une araignée radioactive et se découvre des super-pouvoirs : il est désormais capable d’empoisonner ses adversaires, de se camoufler, de coller littéralement aux murs et aux plafonds ; son ouïe est démultipliée... Dans le même temps, le plus redoutable cerveau criminel de la ville, le Caïd, a mis au point un accélérateur de particules nucléaires capable d’ouvrir un portail sur d’autres univers. Son invention va provoquer l’arrivée de plusieurs autres versions de Spider-Man dans le monde de Miles, dont un Peter Parker plus âgé, Spider-Gwen, Spider-Man Noir, Spider-Cochon et Peni Parker, venue d’un dessin animé japonais'),
(2, 'Bad Boys For Life', '2022-01-02', '02:04', 'Si Mike Lowrey est un séducteur invéteré, héritier dune fortune et policier par passion, son collègue et ami Marcus Burnett est un homme rangé, marié et père de famille. Leur amitié ne les empêche pas davoir des méthodes parfaitement différentes. Mais la disparition de cent kilos dhéroine, dérobés dans les locaux mêmes de la brigade des stups, va leur faire oublier leur concept sur la façon dexercer leur métier, pour se lancer a la poursuite des voleurs.'),
(3, 'Suicide Squad', '2020-01-02', '02:03', 'Cest tellement jouissif dêtre un salopard ! Face à une menace aussi énigmatique quinvincible, lagent secret Amanda Waller réunit une armada de crapules de la pire espèce. Armés jusquaux dents par le gouvernement, ces Super-Méchants sembarquent alors pour une mission-suicide. Jusquau moment où ils comprennent quils ont été sacrifiés. Vont-ils accepter leur sort ou se rebeller ?'),
(4, 'Fast and Furious 8', '2018-02-01', '02:03', 'Maintenant que Dom et Letty sont en lune de miel, que Brian et Mia se sont rangés et que le reste de l’équipe a été disculpé, la bande de globetrotteurs retrouve un semblant de vie normale. Mais quand une mystérieuse femme entraîne Dom dans le monde de la criminalité, ce dernier ne pourra éviter de trahir ses proches qui vont faire face à des épreuves qu’ils n’avaient jamais rencontrées jusqualors. Des rivages de Cuba au rues de New York en passant par les plaines gelées de la mer arctique de Barrents, notre équipe va sillonner le globe pour tenter dempêcher une anarchiste de déchaîner un chaos mondial et de ramener à la maison l’homme qui a fait d’eux une famille.'),
(5,'Je suis une légende', '2007-02-19', '01:40', 'Robert Neville était un savant de haut niveau et de réputation mondiale, mais il en aurait fallu plus pour stopper les ravages de cet incurable et terrifiant virus dorigine humaine. Mystérieusement immunisé contre le mal, Neville est aujourdhui le dernier homme à hanter les ruines de New York. Peut-être le dernier homme sur Terre... Depuis trois ans, il diffuse chaque jour des messages radio dans le fol espoir de trouver dautres survivants. Nul na encore répondu. Mais Neville nest pas seul. Des mutants, victimes de cette peste moderne - on les appelle les "Infectés" - rôdent dans les ténèbres... observent ses moindres gestes, guettent sa première erreur. Devenu lultime espoir de lhumanité, Neville se consacre tout entier à sa mission : venir à bout du virus, en annuler les terribles effets en se servant de son propre sang.
Ses innombrables ennemis lui en laisseront-ils le temps ? Le compte à rebours touche à sa fin...');

--
-- Structure de la table `room`
--

DROP TABLE IF EXISTS bape_room;
CREATE TABLE IF NOT EXISTS bape_room(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    section CHAR(1)
);

--
-- Structure de la table `movie_session`
--

DROP TABLE IF EXISTS bape_movie_session;
CREATE TABLE IF NOT EXISTS bape_movie_session(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    date_screaning DATE,
    schedule TIME,
    movie_id INT,
    room_id INT,
    FOREIGN KEY (movie_id) REFERENCES bape_movie(id) ON DELETE CASCADE,
    FOREIGN KEY (room_id) REFERENCES bape_room(id) ON DELETE CASCADE
);