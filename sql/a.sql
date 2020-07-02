DROP DATABASE IF EXISTS devuger;

CREATE DATABASE devuger;

use devuger;

CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(60) UNIQUE,
    pass VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    descp TEXT,
    color VARCHAR(20),
    creationDate DATE,
    uRank INT
);

CREATE TABLE subforum(
    id INT PRIMARY KEY AUTO_INCREMENT,
    sname VARCHAR(30) UNIQUE,
    descp TEXT,
    subscribers INT,
    color VARCHAR(20),
    numPosts INT,
    creationDate DATE
);

CREATE TABLE posts(
    id INT PRIMARY KEY AUTO_INCREMENT,
    userId INT,
    subforumId INT,
    title VARCHAR(100),
    content LONGTEXT,
    uploadDate DATE,
    numComments INT,
    FOREIGN KEY (userId) REFERENCES users(id),
    FOREIGN KEY (subforumId) REFERENCES subforum(id)
);

CREATE TABLE subscriptions(
    userId INT NOT NULL,
    subId INT NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(id),
    FOREIGN KEY (subId) REFERENCES subforum(id)
);

CREATE TABLE comments(
    id INT PRIMARY KEY AUTO_INCREMENT,
    userId INT NOT NULL,
    postID INT NOT NULL,
    comment LONGTEXT NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(id),
    FOREIGN KEY (postID) REFERENCES posts(id)
);

/*INSERTS*/

/*Users*/
INSERT INTO users (username, pass, email, descp, color, creationDate, uRank) VALUES ('test', '123', 'test@test.com', 'This is the description of this user', '#71db71',NOW(),0);
INSERT INTO users (username, pass, email, descp, color, creationDate, uRank) VALUES ('test2', '123', 'test2@test.com', 'This is the description of this user', '#bdbdbd',NOW(),0);
INSERT INTO users (username, pass, email, descp, color, creationDate, uRank) VALUES ('test3', '123', 'test3@test.com', 'This is the description of this user', '#717171',NOW(),0);

/*Subforum*/
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate) VALUES ('Sub 1', 'This is the description of this subforum',2,'#eb4034',2,NOW());
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate) VALUES ('Sub 2', 'This is the description of this subforum',3,'#eb4034',1,NOW());
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate) VALUES ('Sub 3', 'This is the description of this subforum',1,'#eb4034',0,NOW());

/*Posts*/
INSERT INTO posts (userId, subforumId, title, content, uploadDate, numComments) VALUES (1, 1, 'Post 1', 'This is the content of post 1',NOW(), 0);
INSERT INTO posts (userId, subforumId, title, content, uploadDate, numComments) VALUES (3, 1, 'Post 1', 'This is the content of post 1',NOW(), 0);
INSERT INTO posts (userId, subforumId, title, content, uploadDate, numComments) VALUES (2, 2, 'Post 1', 'This is the content of post 1',NOW(), 0);

/*Subscriptions*/
INSERT INTO subscriptions (userId, subId) VALUES (1,1);
INSERT INTO subscriptions (userId, subId) VALUES (3,1);
INSERT INTO subscriptions (userId, subId) VALUES (1,2);
INSERT INTO subscriptions (userId, subId) VALUES (2,2);
INSERT INTO subscriptions (userId, subId) VALUES (3,2);
INSERT INTO subscriptions (userId, subId) VALUES (3,3);