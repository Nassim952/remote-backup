
DROP DATABASE IF EXISTS cinedata;
CREATE DATABASE IF NOT EXISTS cinedata;

use cinedata;

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

INSERT INTO bape_user (lastname, firstname, email, password, statut, allow, image_profile, verified) VALUES
('DeSouza', 'Eyram', 'eyram@nearby.com', '$2y$10$H6VlPXykHKmYCHo.4M/OAeTIjtIa1dq1Sy/h2w5JYAfSjCxD1x83e', 1, 3, 'uchiha_sasuke_uchiha_clan-1661251-1594986945.jpg',1),
('Mbiya','Randy', 'randy@nearby.com','$2y$10$H6VlPXykHKmYCHo.4M/OAeTIjtIa1dq1Sy/h2w5JYAfSjCxD1x83e', 1, 3, 'uchiha_sasuke_uchiha_clan-1661251-1594986945.jpg',1),
('Mmadi','Nassim','nassim@nearby.com','$2y$10$H6VlPXykHKmYCHo.4M/OAeTIjtIa1dq1Sy/h2w5JYAfSjCxD1x83e', 1, 3, 'uchiha_sasuke_uchiha_clan-1661251-1594986945.jpg',1),
('Belatoui', 'Bilal','bilal@nearby.com','$2y$10$H6VlPXykHKmYCHo.4M/OAeTIjtIa1dq1Sy/h2w5JYAfSjCxD1x83e', 1, 3, 'uchiha_sasuke_uchiha_clan-1661251-1594986945.jpg',1),
('Drizzy', 'Drake','drake@nearby.com','$2y$10$H6VlPXykHKmYCHo.4M/OAeTIjtIa1dq1Sy/h2w5JYAfSjCxD1x83e', 1, 2, 'uchiha_sasuke_uchiha_clan-1661251-1594986945.jpg',1),
('Scott', 'Travis','scott@nearby.com','$2y$10$H6VlPXykHKmYCHo.4M/OAeTIjtIa1dq1Sy/h2w5JYAfSjCxD1x83e', 1, 1, 'uchiha_sasuke_uchiha_clan-1661251-1594986945.jpg',1),
('Mondor', 'Andrew','andrew@nearby.com', '$2y$10$H6VlPXykHKmYCHo.4M/OAeTIjtIa1dq1Sy/h2w5JYAfSjCxD1x83e', 1, 3, 'uchiha_sasuke_uchiha_clan-1661251-1594986945.jpg',1);

DROP TABLE IF EXISTS bape_image;
CREATE TABLE IF NOT EXISTS bape_image(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title VARCHAR(255),
    REFERENCE VARCHAR (20),
    uploading_date TIMESTAMP
);

DROP TABLE IF EXISTS bape_page;
CREATE TABLE IF NOT EXISTS bape_page(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title VARCHAR(100),
    gabarit INT NOT NULL,
    creation_date TIMESTAMP
);

INSERT INTO bape_page (title, gabarit) VALUES
('home-template', 2),
('carousel-template', 1);



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




DROP TABLE IF EXISTS bape_component;
CREATE TABLE IF NOT EXISTS bape_component(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    categorie VARCHAR(100),
    position INT,
    section_id INT,
    FOREIGN KEY (section_id) REFERENCES bape_section(id)
);

INSERT INTO bape_component (categorie, position, section_id) VALUES
('carousel-billboard', 1, 1),
('carousel-full-arrow', 2, 1);


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

INSERT INTO bape_movie (title, release_date, duration, kind, age_require, director, main_actor, nationality, movie_type, image_poster, synopsis) VALUES
('Spider-Man New Generation', '2021-01-06', '03:02', 'Action', 12, 'Sam Raimi', 'Miles Morales', 'American', 'Animation', 'spider-man_new-generation-1594989900.jpg', 'Spider-Man : New Generation suit les aventures de Miles Morales, un adolescent afro-americain et portoricain qui vit à Brooklyn et s’efforce de s’integrer dans son nouveau college à Manhattan.'),
('Bad Boys For Life', '2022-01-02', '02:04','Action', 16, 'Bilal Fallah','Will Smith','American','Long-metrage','bad_boys_for_life-1594989852.jpg', 'Si Mike Lowrey est un seducteur invetere, heritier dune fortune et policier par passion, son collegue et ami Marcus Burnett est un homme range, marie et pere de famille..'),
('Suicide Squad', '2020-01-02', '02:03','Action', 16, 'David Ayer','Will Smith','American','Long-metrage','suicide_squad-1594989912.jpg', 'Cest tellement jouissif dêtre un salopard ! Face à une menace aussi enigmatique quinvincible, lagent secret Amanda Waller reunit une armada de crapules de la pire espece.'),
('Fast and Furious 8', '2018-02-01', '02:03', 'Action', 12, 'Gary Gray','Paul Walker','American','Long-metrage','faf_8-1594989874.jpg', 'Maintenant que Dom et Letty sont en lune de miel, que Brian et Mia se sont ranges et que le reste de l’equipe a ete disculpe, la bande de globetrotteurs retrouve un semblant de vie normale.'),
('Je suis une legende', '2007-02-19', '01:40', 'Thriller', 18, 'Francis Lawrence','Will Smith','American','Long-metrage','je_suis_une_legende-1594989888.jpg', 'Robert Neville etait un savant de haut niveau et de reputation mondiale, mais il en aurait fallu plus pour stopper les ravages de cet incurable et terrifiant virus dorigine humaine.');


DROP TABLE IF EXISTS bape_comment;
CREATE TABLE IF NOT EXISTS bape_comment(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    comment TEXT,
    post_date TIMESTAMP,
    user_id INT NOT NULL,
    target INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES bape_user(id) ON DELETE CASCADE,
    FOREIGN KEY (target) REFERENCES bape_movie(id) ON DELETE CASCADE
);

INSERT INTO bape_comment (id, comment, post_date, user_id, target) VALUES
(null,"Spiderman respecte parfaitement bien la BD. Les acteurs sont bien choisis et incarnent à merveille leurs rôles. Avec des personnages sont attachants en particulier Peter Parker qui bien qu'ayant de super pouvoirs reste dominer par son côté humain.","2020-07-16 14:40:34",5,3),
(null,"Eh bien voilà, 17 ans d'attente, et le retour de nos Bad Boys favoris ! Ce qui marque avant tout c'est que l'alchimie entre Will Smith et Martin Lawrence n'a pas pris une seule ride. Leurs interactions sont toujours savoureuses.","2020-06-15 17:30:22",4,2),
(null,"'Suicide Squad' de David Ayer, après quelques déceptions récentes, fait cette fois figure d'une bonne surprise, enfin très drôle et vue sous un angle nouveau et différent ! DC Comics nous prouve que l'humour a ici sa place et c'est là le gros point fort... Et oui, surtout ne pas se prendre au sérieux comme l'était le suffisant 'Batman v Superman'...","2019-02-20 16:40:34",3,1),
(null,"Un excellent divertissement ! Le scénario, qui ressemble à celui de Point Break, tient bien la route. Les courses poursuites sont très bien filmées et le casting est parfait, la présence de Paul Walker et Vin Diesel apporte beaucoup a ce superbe film d'action.","2019-05-18 10:20:22",2,4);

DROP TABLE IF EXISTS bape_cinema;
CREATE TABLE IF NOT EXISTS bape_cinema(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    place VARCHAR(255),
    number_rooms INT,
    image_url VARCHAR(255),
    cinema_movie_id INT,
    cinema_room_id INT
);

INSERT INTO bape_cinema (id, name, place, number_rooms, image_url) VALUES
(1, 'Gaumont P.', 'Paris 6eme', 11, 'gaumont-1594990395.jpg'),
(2, 'UGC', 'Enghien-les-Bains', 7, 'ugc-1594990410.jpg'),
(3, 'Paramount', 'Paris 13eme', 12, 'paramount_pictures-1594990401.jpg'),
(4, 'Universal', 'Sarcelles', 6, 'universal-1594990415.jpg'),
(5, 'Mega CGR', 'Epinay Villetaneuse', 11, 'cinemas-cgr-1594990366.jpg');

DROP TABLE IF EXISTS bape_room;
CREATE TABLE IF NOT EXISTS bape_room(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    cinema_id INT,
    name_room VARCHAR(255),
    nbr_places INT,
    section CHAR(1)
);

INSERT INTO `bape_room` (`id`, `cinema_id`, `name_room`, `nbr_places`, `section`) VALUES
(1, 1, 'salle 01', 80, NULL),
(2, 1, 'salle 02', 90, NULL),
(3, 1, 'salle 03', 70, NULL),
(4, 1, 'salle 04', 130, NULL),
(5, 2, 'salle 01', 80, NULL),
(6, 2, 'salle 02', 90, NULL),
(7, 2, 'salle 03', 70, NULL),
(8, 2, 'salle 04', 130, NULL);


DROP TABLE IF EXISTS bape_movie_session;
CREATE TABLE IF NOT EXISTS bape_movie_session(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    date_screaning DATETIME,
    movie_id INT,
    room_id INT,
    nbr_place_rest INT NOT NULL,
    FOREIGN KEY (movie_id) REFERENCES bape_movie(id) ON DELETE CASCADE,
    FOREIGN KEY (room_id) REFERENCES bape_room(id) ON DELETE CASCADE
);

INSERT INTO `bape_movie_session` (`id`, `date_screaning`, `movie_id`, `room_id`, `nbr_place_rest`) VALUES
(1, '2020-08-03 08:00:00', 1, 1, 80),
(2, '2020-08-03 11:00:00', 1, 1, 80),
(3, '2020-08-03 08:00:00', 2, 5, 90),
(4, '2020-08-03 11:00:00', 2, 5, 90);

DROP TABLE IF EXISTS bape_movie_reservation;
CREATE TABLE IF NOT EXISTS bape_movie_reservation(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    movie_session_id INT,
    user_email VARCHAR(255) NOT NULL,
    nbr_places INT NOT NULL,
    FOREIGN KEY (movie_session_id) REFERENCES bape_movie_session(id) ON DELETE CASCADE
);