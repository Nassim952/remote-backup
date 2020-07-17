
DROP DATABASE IF EXISTS cinedata;

CREATE DATABASE IF NOT EXISTS cinedata;

USE cinedata;

DROP TABLE IF EXISTS bape_identity;


DROP TABLE IF EXISTS bape_user;
CREATE TABLE IF NOT EXISTS bape_user(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    lastname VARCHAR(100) NOT NULL,
    firstname VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    statut INT NOT NULL DEFAULT 0,
    allow VARCHAR(255) NOT NULL,
    token varchar(255) DEFAULT NULL,
    verified boolean DEFAULT 0
);

INSERT INTO bape_user (lastname, firstname, email, password, statut, allow, verified) VALUES
('DeSouza', 'Eyram', 'eyram@nearby.com', 'password', 1, 'admin',1),
('Mbiya','Randy', 'randy@nearby.com','password', 1, 'admin',1),
('Mmadi','Nassim','nassim@nearby.com','password', 1, 'admin',1),
('Belatoui', 'Bilal','bilal@nearby.com','password', 1, 'admin',1),
('Mondor', 'Andrew','andrew@nearby.com', 'password', 1, 'admin',1);


DROP TABLE IF EXISTS bape_image;
CREATE TABLE IF NOT EXISTS bape_image(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title VARCHAR(255),
    REFERENCE VARCHAR (20),
    uploading_date TIMESTAMP
);

DROP TABLE IF EXISTS bape_component;
CREATE TABLE IF NOT EXISTS bape_component(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title VARCHAR(255),
    class VARCHAR(255),
    type_Componnent INT, 
    color INT
);

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

DROP TABLE IF EXISTS bape_article;
CREATE TABLE IF NOT EXISTS bape_article(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    subtiltle VARCHAR(255),
    creation_date TIMESTAMP,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES bape_user(id) ON DELETE CASCADE
);

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
('Spider-Man New Generation', '2021-01-06', '03:02', 'Action', 12, 'Sam Raimi', 'Miles Morales', 'American', 'Animation', 'https://fr.web.img6.acsta.net/pictures/18/11/13/11/42/1696141.jpg', 'Spider-Man : New Generation suit les aventures de Miles Morales, un adolescent afro-americain et portoricain qui vit à Brooklyn et s’efforce de s’integrer dans son nouveau college à Manhattan.'),
('Bad Boys For Life', '2022-01-02', '02:04','Action', 16, 'Bilal Fallah','Will Smith','American','Long-metrage','https://fr.web.img6.acsta.net/pictures/19/11/22/09/44/3027567.jpg', 'Si Mike Lowrey est un seducteur invetere, heritier dune fortune et policier par passion, son collegue et ami Marcus Burnett est un homme range, marie et pere de famille..'),
('Suicide Squad', '2020-01-02', '02:03','Action', 16, 'David Ayer','Will Smith','American','Long-metrage','https://images-na.ssl-images-amazon.com/images/I/A1gFCETVqVL._AC_SL1500_.jpg', 'Cest tellement jouissif dêtre un salopard ! Face à une menace aussi enigmatique quinvincible, lagent secret Amanda Waller reunit une armada de crapules de la pire espece.'),
('Fast and Furious 8', '2018-02-01', '02:03', 'Action', 12, 'Gary Gray','Paul Walker','American','Long-metrage','https://fr.web.img3.acsta.net/pictures/17/03/03/17/27/305158.jpg', 'Maintenant que Dom et Letty sont en lune de miel, que Brian et Mia se sont ranges et que le reste de l’equipe a ete disculpe, la bande de globetrotteurs retrouve un semblant de vie normale.'),
('Je suis une legende', '2007-02-19', '01:40', 'Thriller', 18, 'Francis Lawrence','Will Smith','American','Long-metrage','https://fr.web.img3.acsta.net/medias/nmedia/18/63/18/01/18866172.jpg', 'Robert Neville etait un savant de haut niveau et de reputation mondiale, mais il en aurait fallu plus pour stopper les ravages de cet incurable et terrifiant virus dorigine humaine.');


DROP TABLE IF EXISTS bape_room;
CREATE TABLE IF NOT EXISTS bape_room(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    section CHAR(1)
);


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