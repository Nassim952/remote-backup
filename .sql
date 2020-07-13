--
-- Base de donnees :  `cinedata`
--

-- --------------------------------------------------------

--
-- Structure de la table `identity`
--

DROP DATABASE IF EXISTS cinedata;
CREATE DATABASE IF NOT EXISTS cinedata;

DROP TABLE IF EXISTS bape_identity;
-- CREATE TABLE IF NOT EXISTS bape_identity(
--     id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
--     lastname VARCHAR(100),
--     firstname VARCHAR(100),
--     birthdate DATE
-- );

-- 
-- Chargement des donnees de la table user
-- 

-- INSERT INTO bape_identity (id, lastname, firstname, birthdate) VALUES
-- (1, 'desouza', 'eyram', '2020-01-01'),
-- (2, 'mbiya', 'eyram', '2020-01-01'),
-- (3, 'mmadi','nassim','2020-01-01'),
-- (4, 'belatoui', 'bibal', '2020-01-01'),
-- (5, 'mondor', 'andrew', '2020-01-01');

--
-- Structure de la table user
--

DROP TABLE IF EXISTS bape_user;
CREATE TABLE IF NOT EXISTS bape_user(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    lastname VARCHAR(100) NOT NULL,
    firstname VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    statut INT NOT NULL,
    allow VARCHAR(255) NOT NULL
);

-- 
-- Chargement des donnees de la table user
-- 

INSERT INTO bape_user (lastname, firstname, email, password, statut, allow) VALUES
('DeSouza', 'Eyram', 'eyram@nearby.com', 'password', 1, 'admin'),
('Mbiya','Randy', 'randy@nearby.com','password', 1, 'admin'),
('Mmadi','Nassim','nassim@nearby.com','password', 1, 'admin'),
('Belatoui', 'Bilal','bilal@nearby.com','password', 1, 'admin'),
('Mondor', 'Andrew','andrew@nearby.com', 'password', 1, 'admin');


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
    title VARCHAR(100),
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
    kind VARCHAR(255),
    age_require INT,
    director VARCHAR(255),
    main_actor VARCHAR(255),
    nationality VARCHAR(255),
    movie_type VARCHAR(255),
    release_date VARCHAR(255),
    duration TIME,
    image_url VARCHAR(255),
    synopsis TEXT
);

-- 
-- Chargement des donnees de la table movie
-- 

INSERT INTO bape_movie (title, release_date, duration, kind, age_require, director, main_actor, nationality, movie_type, image_url, synopsis) VALUES
('Spider-Man New Generation', '2021-01-06', '03:02', 'Action', 12, 'Sam Raimi', 'Miles Morales', 'American', 'Animation', 'https://fr.web.img6.acsta.net/pictures/18/11/13/11/42/1696141.jpg', 'Spider-Man : New Generation suit les aventures de Miles Morales, un adolescent afro-americain et portoricain qui vit à Brooklyn et s’efforce de s’integrer dans son nouveau college à Manhattan. Mais la vie de Miles se complique quand il se fait mordre par une araignee radioactive et se decouvre des super-pouvoirs : il est desormais capable d’empoisonner ses adversaires, de se camoufler, de coller litteralement aux murs et aux plafonds ; son ouïe est demultipliee... Dans le même temps, le plus redoutable cerveau criminel de la ville, le Caïd, a mis au point un accelerateur de particules nucleaires capable d’ouvrir un portail sur d’autres univers. Son invention va provoquer l’arrivee de plusieurs autres versions de Spider-Man dans le monde de Miles, dont un Peter Parker plus âge, Spider-Gwen, Spider-Man Noir, Spider-Cochon et Peni Parker, venue d’un dessin anime japonais'),
('Bad Boys For Life', '2022-01-02', '02:04','Action', 16, 'Bilal Fallah','Will Smith','American','Long-metrage','https://fr.web.img6.acsta.net/pictures/19/11/22/09/44/3027567.jpg', 'Si Mike Lowrey est un seducteur invetere, heritier dune fortune et policier par passion, son collegue et ami Marcus Burnett est un homme range, marie et pere de famille. Leur amitie ne les empêche pas davoir des methodes parfaitement differentes. Mais la disparition de cent kilos dheroine, derobes dans les locaux mêmes de la brigade des stups, va leur faire oublier leur concept sur la façon dexercer leur metier, pour se lancer a la poursuite des voleurs.'),
('Suicide Squad', '2020-01-02', '02:03','Action', 16, 'David Ayer','Will Smith','American','Long-metrage','https://images-na.ssl-images-amazon.com/images/I/A1gFCETVqVL._AC_SL1500_.jpg', 'Cest tellement jouissif dêtre un salopard ! Face à une menace aussi enigmatique quinvincible, lagent secret Amanda Waller reunit une armada de crapules de la pire espece. Armes jusquaux dents par le gouvernement, ces Super-Mechants sembarquent alors pour une mission-suicide. Jusquau moment où ils comprennent quils ont ete sacrifies. Vont-ils accepter leur sort ou se rebeller ?'),
('Fast and Furious 8', '2018-02-01', '02:03', 'Action', 12, 'Gary Gray','Paul Walker','American','Long-metrage','https://fr.web.img3.acsta.net/pictures/17/03/03/17/27/305158.jpg', 'Maintenant que Dom et Letty sont en lune de miel, que Brian et Mia se sont ranges et que le reste de l’equipe a ete disculpe, la bande de globetrotteurs retrouve un semblant de vie normale. Mais quand une mysterieuse femme entraîne Dom dans le monde de la criminalite, ce dernier ne pourra eviter de trahir ses proches qui vont faire face à des epreuves qu’ils n’avaient jamais rencontrees jusqualors. Des rivages de Cuba au rues de New York en passant par les plaines gelees de la mer arctique de Barrents, notre equipe va sillonner le globe pour tenter dempêcher une anarchiste de dechaîner un chaos mondial et de ramener à la maison l’homme qui a fait d’eux une famille.'),
('Je suis une legende', '2007-02-19', '01:40', 'Thriller', 18, 'Francis Lawrence','Will Smith','American','Long-metrage','https://fr.web.img3.acsta.net/medias/nmedia/18/63/18/01/18866172.jpg', 'Robert Neville etait un savant de haut niveau et de reputation mondiale, mais il en aurait fallu plus pour stopper les ravages de cet incurable et terrifiant virus dorigine humaine. Mysterieusement immunise contre le mal, Neville est aujourdhui le dernier homme à hanter les ruines de New York. Peut-être le dernier homme sur Terre... Depuis trois ans, il diffuse chaque jour des messages radio dans le fol espoir de trouver dautres survivants. Nul na encore repondu. Mais Neville nest pas seul. Des mutants, victimes de cette peste moderne - on les appelle les "Infectes" - rôdent dans les tenebres... observent ses moindres gestes, guettent sa premiere erreur. Devenu lultime espoir de lhumanite, Neville se consacre tout entier à sa mission : venir à bout du virus, en annuler les terribles effets en se servant de son propre sang.
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

--
-- Structure de la table `cinema`
--

DROP TABLE IF EXISTS bape_cinema;
CREATE TABLE IF NOT EXISTS bape_cinema(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    place VARCHAR(255),
    number_rooms INT,
    image_url VARCHAR(255),
    cinema_movie_id INT,
    cinema_room_id INT,
    FOREIGN KEY (cinema_movie_id) REFERENCES bape_movie(id) ON DELETE CASCADE,
    FOREIGN KEY (cinema_room_id) REFERENCES bape_room(id) ON DELETE CASCADE
);

INSERT INTO bape_cinema (id, name, place, number_rooms) VALUES
(1, 'Gaumont P.', 'Paris 6eme', 11),
(2, 'UGC', 'Enghien-les-Bains', 7),
(3, 'Paramount', 'Paris 13eme', 12),
(4, 'Universal', 'Sarcelles', 6),
(5, 'Mega CGR', 'Epinay Villetaneuse', 11)

--
-- Structure de la table `salles`
--

-- DROP TABLE IF EXISTS bape_salle;
-- CREATE TABLE IF NOT EXISTS bape_salle(
--     id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
--     id_cinema INT,
--     cinema_movie_id INT,
--     FOREIGN KEY (cinema_movie_id) REFERENCES bape_movie(id) ON DELETE CASCADE,
--     FOREIGN KEY (id_cinema) REFERENCES bape_cinema(id) ON DELETE CASCADE
-- );

-- INSERT INTO bape_salle (id, place) VALUES
-- (1, 'Gaumont Pathe', 'Paris 6eme'),
-- (2, 'UGC', 'Enghien-les-Bains'),
-- (3, 'Paramount', 'Paris 13eme'),
-- (4, 'Universal', 'Sarcelles'),
-- (5, 'Mega CGR', 'Epinay Villetaneuse')