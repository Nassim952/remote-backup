--
-- Base de donnees :  `cinedata`
--

-- --------------------------------------------------------

--
-- Structure de la table `identity`
--

DROP DATABASE IF EXISTS cinedata;
CREATE DATABASE IF NOT EXISTS cinedata;

use cinedata;

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
    statut INT NOT NULL DEFAULT 0,
    allow INT NOT NULL,
    image_profile VARCHAR(255),
    token varchar(255) DEFAULT NULL,
    verified boolean DEFAULT 0
);

-- 
-- Chargement des donnees de la table user
-- 

INSERT INTO bape_user (lastname, firstname, email, password, statut, allow, image_profile, verified) VALUES
('DeSouza', 'Eyram', 'eyram@nearby.com', 'password', 1, 3, 'uchiha_sasuke_uchiha_clan-1661251-1594986945.jpg',1),
('Mbiya','Randy', 'randy@nearby.com','password', 1, 3, 'uchiha_sasuke_uchiha_clan-1661251-1594986945.jpg',1),
('Mmadi','Nassim','nassim@nearby.com','password', 1, 3, 'uchiha_sasuke_uchiha_clan-1661251-1594986945.jpg',1),
('Belatoui', 'Bilal','bilal@nearby.com','password', 1, 3, 'uchiha_sasuke_uchiha_clan-1661251-1594986945.jpg',1),
('Drizzy', 'Drake','drake@nearby.com','password', 1, 2, 'uchiha_sasuke_uchiha_clan-1661251-1594986945.jpg',1),
('Scott', 'Travis','scott@nearby.com','password', 1, 1, 'uchiha_sasuke_uchiha_clan-1661251-1594986945.jpg',1),
('Mondor', 'Andrew','andrew@nearby.com', 'password', 1, 3, 'uchiha_sasuke_uchiha_clan-1661251-1594986945.jpg',1);


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
-- Structure de la table `page`
--

DROP TABLE IF EXISTS bape_page;
CREATE TABLE IF NOT EXISTS bape_page(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title VARCHAR(100),
    gabarit INT NOT NULL,
    creation_date TIMESTAMP,
    theme VARCHAR(100),
    font VARCHAR(100),
    font_color VARCHAR(100)
);

INSERT INTO bape_page (title, gabarit, theme, font, font_color) VALUES
('home-template', 2, 'blue', 'Roboto', 'black'),
('carousel-template', 1, 'blue', 'Roboto', 'black');

-- 
-- Structure de la table 'Section'
-- 

DROP TABLE IF EXISTS bape_section;
CREATE TABLE IF NOT EXISTS bape_section(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    size INT,
    page_id INT,
    position INT,
    FOREIGN KEY (page_id) REFERENCES bape_page(id) ON DELETE CASCADE
);

INSERT INTO bape_section (size, page_id, position) VALUES
(2, 1, 1),
(1, 2, 2);


-- 
--  Structure de la table Component
-- 

DROP TABLE IF EXISTS bape_component;
CREATE TABLE IF NOT EXISTS bape_component(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title VARCHAR(100),
    categorie VARCHAR(100),
    position INT,
    section_id INT,
    FOREIGN KEY (section_id) REFERENCES bape_section(id)
);

INSERT INTO bape_component (title, categorie, position, section_id) VALUES
('carousel', 'carousel-billboard', 1, 1),
('carousel', 'carousel-full-arrow', 2, 1);


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
    image_poster VARCHAR(255),
    synopsis TEXT
);

-- 
-- Chargement des donnees de la table movie
-- 

INSERT INTO bape_movie (title, release_date, duration, kind, age_require, director, main_actor, nationality, movie_type, image_poster, synopsis) VALUES
('Spider-Man New Generation', '2021-01-06', '03:02', 'Action', 12, 'Sam Raimi', 'Miles Morales', 'American', 'Animation', 'spider-man_new-generation-1594989900.jpg', 'Spider-Man : New Generation suit les aventures de Miles Morales, un adolescent afro-americain et portoricain qui vit à Brooklyn et s’efforce de s’integrer dans son nouveau college à Manhattan.'),
('Bad Boys For Life', '2022-01-02', '02:04','Action', 16, 'Bilal Fallah','Will Smith','American','Long-metrage','bad_boys_for_life-1594989852.jpg', 'Si Mike Lowrey est un seducteur invetere, heritier dune fortune et policier par passion, son collegue et ami Marcus Burnett est un homme range, marie et pere de famille..'),
('Suicide Squad', '2020-01-02', '02:03','Action', 16, 'David Ayer','Will Smith','American','Long-metrage','suicide_squad-1594989912.jpg', 'Cest tellement jouissif dêtre un salopard ! Face à une menace aussi enigmatique quinvincible, lagent secret Amanda Waller reunit une armada de crapules de la pire espece.'),
('Fast and Furious 8', '2018-02-01', '02:03', 'Action', 12, 'Gary Gray','Paul Walker','American','Long-metrage','faf_8-1594989874.jpg', 'Maintenant que Dom et Letty sont en lune de miel, que Brian et Mia se sont ranges et que le reste de l’equipe a ete disculpe, la bande de globetrotteurs retrouve un semblant de vie normale.'),
('Je suis une legende', '2007-02-19', '01:40', 'Thriller', 18, 'Francis Lawrence','Will Smith','American','Long-metrage','je_suis_une_legende-1594989888.jpg', 'Robert Neville etait un savant de haut niveau et de reputation mondiale, mais il en aurait fallu plus pour stopper les ravages de cet incurable et terrifiant virus dorigine humaine.');

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

INSERT INTO bape_cinema (id, name, place, number_rooms, image_url) VALUES
(1, 'Gaumont P.', 'Paris 6eme', 11, 'gaumont-1594990395.jpg'),
(2, 'UGC', 'Enghien-les-Bains', 7, 'ugc-1594990410.jpg'),
(3, 'Paramount', 'Paris 13eme', 12, 'paramount_pictures-1594990401.jpg'),
(4, 'Universal', 'Sarcelles', 6, 'universal-1594990415.jpg'),
(5, 'Mega CGR', 'Epinay Villetaneuse', 11, 'cinemas-cgr-1594990366.jpg')

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