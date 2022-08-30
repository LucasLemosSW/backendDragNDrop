CREATE TABLE users (
  id SERIAL NOT NULL PRIMARY KEY,
  username varchar(100) NOT NULL,
  name varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(255) NOT NULL,
  timestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP 
);

INSERT INTO users (id, username, name, email, timestamp,password) VALUES
(1, 'jiten', 'Jiten singh	', 'jiten93@gmail.com', '2018-11-16 05:02:35','123454958'),
(2, 'kuldeep', 'Kuldeep', 'kuldeep@gmail.com', '2018-11-16 05:02:52','78945613'),
(3, 'mayank', 'Mayank', 'mayank@yahoo.com', '2018-11-16 05:03:10','159753852'),
(4, 'yssyogesh', 'Yogesh singh', 'yogesh@makitweb.com', '2018-11-16 05:03:46','741258963'),
(5, 'vijay', 'Vijay', 'vijayec@gmai.com', '2018-11-16 05:45:23','123852456');