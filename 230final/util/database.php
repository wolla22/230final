<?php

$pdo = new PDO('mysql:host=localhost;dbname=foodorderdb', 'root', 'Arya3052!');


$pdo->query('CREATE TABLE `restaurants` (
    `ID` int(10) AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(32) NOT NULL,
    `user_id` int(10) UNSIGNED NOT NULL,
    `categ` varchar(32) NOT NULL,
    `descript` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$pdo->query("INSERT INTO `restaurants` (`name`, `user_id`, `categ`, `descript`) VALUES
('Papa Johns',1,'Italian','Pizza is good!'),
('MickyDs',1,'American','Fast food is good!');");

$pdo->query('CREATE TABLE `meals` (
    `ID` int(10) AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(32) NOT NULL,
    `rest_id` int(10) UNSIGNED NOT NULL,
    `descript` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$pdo->query("INSERT INTO `meals` (`name`,`rest_id`, `descript`) VALUES
('Chicken Sandwich', 1, "Cockadoodledoo!"),
('BBQ Pizza', 0,"Cooked out back!");");

$pdo->query('CREATE TABLE `users` (
    `ID` int(10) AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(32) NOT NULL,
    `email` varchar(32) NOT NULL,
    `password` varchar(100) NOT NULL,
    `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$pdo->query("INSERT INTO `users` (`name`, `email`,`password`, `type`) VALUES
('Drew Woll', 'woll.andrew@gmail.com','Arya3052!', 'admin'),
('John Doe','abc@gmail.com','1234', 'user');");

$pdo->query('CREATE TABLE `orders` (
    `ID` int(10) AUTO_INCREMENT PRIMARY KEY,
    `email` varchar(100) NOT NULL,
    `rest_id` int(10) UNSIGNED NOT NULL,
    `meal_id` int(10) UNSIGNED NOT NULL,
    `address` text DEFAULT NULL,
    `time` varchar(100) NOT NULL,
    `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$pdo->query("INSERT INTO `orders` (`email`,`rest_id`, `meal_id`,`address`, `time`, `status`) VALUES
('johndoe@gmail.com', 0, 1, 'some place', '9:00AM', 'ordered'),
('woll.andrew@gmail.com', 1, 2,'another place', '10:00AM', 'delivering');");

