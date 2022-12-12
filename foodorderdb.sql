CREATE TABLE `users` (
    `ID` int(10) AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(32) NOT NULL,
    `email` varchar(32) NOT NULL,
    `password` varchar(100) NOT NULL,
    `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`name`, `email`,`password`, `type`) VALUES
('Drew Woll', 'woll.andrew@gmail.com','Arya3052!', 'admin'),
('John Doe','abc@gmail.com','Arya3052!', 'user');

CREATE TABLE `restaurants` (
    `ID` int(10) AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(32) NOT NULL,
    `user_id` int(10) NOT NULL,
    `categ` varchar(32) NOT NULL,
    `descript` text DEFAULT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `restaurants` (`name`, `user_id`, `categ`, `descript`) VALUES
('Papa Johns',1,'Italian','Pizza is good!'),
('MickyDs',1,'American','Fast food is good!');

CREATE TABLE `meals` (
    `ID` int(10) AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(32) NOT NULL,
    `rest_id` int(10) NOT NULL,
    `descript` text DEFAULT NULL,
    FOREIGN KEY (`rest_id`) REFERENCES `restaurants`(`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `meals` (`name`,`rest_id`, `descript`) VALUES
('Chicken Sandwich', 2, "Cockadoodledoo!"),
('BBQ Pizza', 1,"Cooked out back!");

CREATE TABLE `orders` (
    `ID` int(10) AUTO_INCREMENT PRIMARY KEY,
    `email` varchar(100) NOT NULL,
    `rest_id` int(10) NOT NULL,
    `meal_id` int(10) NOT NULL,
    `address` text DEFAULT NULL,
    `time` varchar(100) NOT NULL,
    `status` varchar(100) NOT NULL,
    FOREIGN KEY (`meal_id`) REFERENCES `meals`(`ID`),
    FOREIGN KEY (`rest_id`) REFERENCES `restaurants`(`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `orders` (`email`,`rest_id`, `meal_id`,`address`, `time`, `status`) VALUES
('johndoe@gmail.com', 1, 1, 'some place', '9:00AM', 'ordered'),
('woll.andrew@gmail.com', 2, 2,'another place', '10:00AM', 'delivering');
