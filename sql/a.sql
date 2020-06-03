DROP DATABASE IF EXISTS r_reddit;

CREATE DATABASE r_reddit;

use r_reddit;

CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(60) UNIQUE,
    pass VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    descp TEXT,
    color VARCHAR(20),
    creationDate DATE
);

CREATE TABLE subreddit(
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
    subredditId INT,
    title VARCHAR(100),
    content LONGTEXT,
    uploadDate DATE,
    numComments INT,
    FOREIGN KEY (userId) REFERENCES users(id),
    FOREIGN KEY (subredditId) REFERENCES subreddit(id)
);

CREATE TABLE subscriptions(
    userId INT NOT NULL,
    subId INT NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(id),
    FOREIGN KEY (subId) REFERENCES subreddit(id)
);

CREATE TABLE comments(
    id INT PRIMARY KEY AUTO_INCREMENT,
    userId INT NOT NULL,
    postID INT NOT NULL,
    comment LONGTEXT NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(id),
    FOREIGN KEY (postID) REFERENCES posts(id)
);