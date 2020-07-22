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
    creationDate DATE,
    createdBy INT,
    rules TEXT,
    FOREIGN KEY (createdBy) REFERENCES users(id)
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
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Sub 1', 'This is the description of this subforum',2,'#eb4034',2,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Sub 2', 'This is the description of this subforum',3,'#eb4034',1,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Sub 3', 'This is the description of this subforum',1,'#eb4034',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');

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



/*Subs*/

/*Programming Lang*/
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('C', 'This sub-forum is destined to questions regarding the C programming language',0,'#a3b3c6',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Cpp', 'This sub-forum is destined to questions regarding the C++ programming language',0,'#005697',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('C-sharp', 'This sub-forum is destined to questions regarding the C# programming language',0,'#39008a',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('R', 'This sub-forum is destined to questions regarding the R programming language',0,'#2367b9',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Python', 'This sub-forum is destined to questions regarding the Python programming language',0,'#f7d34c',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Perl', 'This sub-forum is destined to questions regarding the Perl programming language',0,'#003e62',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('PHP', 'This sub-forum is destined to questions regarding the PHP programming language',0,'#7477ad',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Java', 'This sub-forum is destined to questions regarding the Java programming language',0,'#e06c00',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Javascript', 'This sub-forum is destined to questions regarding the Javascript programming language',0,'#e06c00',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Objective-C', 'This sub-forum is destined to questions regarding the Objective-C programming language',0,'#02c3f7',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Assembly', 'This sub-forum is destined to questions regarding the Assembly programming language',0,'#006300',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Lua', 'This sub-forum is destined to questions regarding the Lua programming language',0,'#2d007f',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('TypeScript', 'This sub-forum is destined to questions regarding the TypeScript programming language',0,'#0076c6',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Ruby', 'This sub-forum is destined to questions regarding the Ruby programming language',0,'#e80e12',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Shell', 'This sub-forum is destined to questions regarding the Shell programming language',0,'#f7ca37',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Go', 'This sub-forum is destined to questions regarding the Go programming language',0,'#67d2de',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Swift', 'This sub-forum is destined to questions regarding the Swift programming language',0,'#f34929',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Kotlin', 'This sub-forum is destined to questions regarding the Kotlin programming language',0,'#e7792e',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Rust', 'This sub-forum is destined to questions regarding the Rust programming language',0,'#f04a00',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Dart', 'This sub-forum is destined to questions regarding the Dart programming language',0,'#2ab1ee',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');

/*General*/
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Web Development', 'This sub-forum is destined to questions regarding Web Development',0,'#6bbecf',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Software Development', 'This sub-forum is destined to questions regarding Software Development',0,'#37ae5d',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Computer Science', 'This sub-forum is destined to questions regarding Computer Science',0,'#4f070a',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Software Engineering', 'This sub-forum is destined to questions regarding Software Engineering',0,'#60a4de',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Git', 'This sub-forum is destined to questions regarding Git',0,'#e94e31',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy, rules) VALUES ('Testing', 'This sub-forum is destined to questions regarding Testing',0,'#f7d422',0,NOW(), 1, 'Don\'t be rude to others, we all have our questions, we all started without knowing things.<br/>Follow the sub-forum topic.<br/>Most important of all, enjoy the community, we all have the same passion.');

/* Admin */

INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy) VALUES ('Admins Testing', 'This sub-forum is for admins / developers to inform users about the new updates', 0, '#000', 0, NOW(), 1);
INSERT INTO subforum (sname, descp, subscribers, color, numPosts, creationDate, createdBy) VALUES ('User\'s Opinion', 'This sub-forum is for you to inform us of bugs and your opinion in general.<br/>Help us improve!', 0, '#000', 0, NOW(), 1);
