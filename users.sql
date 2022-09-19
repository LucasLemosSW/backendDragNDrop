CREATE TABLE users (
  id SERIAL NOT NULL PRIMARY KEY,
  username varchar(100) NOT NULL,
  name varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(255) NOT NULL,
  verificacao BOOLEAN NOT NULL,
  timestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP 
);

-- COMANDOS UTEIS

INSERT INTO users (id, username, name, email, timestamp,password) VALUES
(1, 'jiten', 'Jiten singh	', 'jiten93@gmail.com', '2018-11-16 05:02:35','123454958'),
(2, 'kuldeep', 'Kuldeep', 'kuldeep@gmail.com', '2018-11-16 05:02:52','78945613'),
(3, 'mayank', 'Mayank', 'mayank@yahoo.com', '2018-11-16 05:03:10','159753852'),
(4, 'yssyogesh', 'Yogesh singh', 'yogesh@makitweb.com', '2018-11-16 05:03:46','741258963'),
(5, 'vijay', 'Vijay', 'vijayec@gmai.com', '2018-11-16 05:45:23','123852456');
(6, 'Lucas', 'Lucas', 'lemos@gmai.com', '2014-02-16 07:45:23','1512386');
(7, 'Pedro', 'Pedro', 'alves@gmai.com', '2012-11-15 05:35:55','12384518');
(8, 'Joaquim', 'Joaquim', 'silva@gmai.com', '1992-05-16 06:45:00','95123287');

SELECT * FROM users;

INSERT INTO users VALUES('6','Lucas Lemos','Lucas','lemos.lucas@gmail.com','85412','2018/02/10');

DELETE FROM users WHERE id = '7';

ALTER TABLE Users ADD verificacao BOOLEAN;

INSERT INTO users (username,name,email,password,timestamp) VALUES('Lucas Lemos','Lucas','lemos.lucas@gmail.com','85412','2018/02/10');

CREATE TABLE progress (
  id_progress INT NOT NULL,
  name varchar(100) NOT NULL,
  money int NOT NULL,
  stars int NOT NULL,
  life int NOT NULL,
  fase_1 int NOT NULL,
  fase_2 int NOT NULL,
  fase_3 int NOT NULL,
  fase_4 int NOT NULL,
  fase_5 int NOT NULL,
  fase_6 int NOT NULL,
  fase_7 int NOT NULL,
  fase_8 int NOT NULL,
  fase_9 int NOT NULL,
  CONSTRAINT PK_id_progress PRIMARY KEY (id_progress),
  CONSTRAINT FK_id_users FOREIGN KEY (id_progress) REFERENCES users (id) ON DELETE CASCADE
);

INSERT INTO progress (id_progress, nome,money, stars, life, fase_1, fase_2, fase_3, fase_4, fase_5, fase_6, fase_7, fase_8, fase_9) VALUES
(1,'Jiten',100,  0, 5, 0,0,0,0,0,0,0,0,0),
(2,'Kuldeep',200,  2, 5, 0,0,0,0,0,0,0,0,0),
(3,'Mayank',400,  1, 5, 0,0,0,0,0,0,0,0,0),
(4,'Yogesh',0,    0, 5, 0,0,0,0,0,0,0,0,0),
(5,'vijay',100,  0, 5, 0,0,0,0,0,0,0,0,0),
(3,'Lucas',400,  1, 5, 0,0,0,0,0,0,0,0,0);

CREATE TABLE Scores (
  id_user INT NOT NULL,
  score int NOT NULL,
  timestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT FK_id_users FOREIGN KEY (id_user) REFERENCES users (id) ON DELETE CASCADE
);

INSERT INTO Scores (id_user, score, timestamp) VALUES
(20, 500, '2018/02/10 07:34:25');
(20, 700, '2018/02/10 07:47:15');
(20, 200, '2018/02/10 07:49:28');
(20, 1000,'2018/02/10 07:53:26');