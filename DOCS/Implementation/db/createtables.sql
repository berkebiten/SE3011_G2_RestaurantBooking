create schema rbsdb;
use rbsdb;

CREATE TABLE `user` (
  `uname` varchar(45) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `psw` varchar(45) NOT NULL,
  `recCode` varchar(45) NOT NULL,
  `isBanned` tinyint(4) DEFAULT 0,
  `warnCount` int(11) DEFAULT 0,
  PRIMARY KEY (`uname`)
);

CREATE TABLE `admin` (
  `uname` varchar(45) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `psw` varchar(45) NOT NULL,
  `recCode` varchar(45) NOT NULL,
  PRIMARY KEY (`uname`)
);

CREATE TABLE `restaurant_owner` (
  `uname` varchar(45) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `rest_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `psw` varchar(45) NOT NULL,
  `location` varchar(45) NOT NULL,
  `phoneNo` varchar(45) NOT NULL,
  `cap` int(11) NOT NULL,
  `description` longtext DEFAULT NULL,
  `payment` longtext DEFAULT NULL,
  `additional` longtext DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL,
  `stars` int(11) DEFAULT NULL,
  `cuisines` longtext DEFAULT NULL,
  `seating_options` longtext DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `isBanned` tinyint(4) DEFAULT NULL,
  `warnCount` int(11) DEFAULT NULL,
  `recCode` varchar(45) NOT NULL,
  `shutdown` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`uname`)
);

CREATE TABLE `bookings` (
  `bookingId` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_uname` varchar(45) NOT NULL ,
  `restaurant_uname` varchar(45) NOT NULL,
  `party` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phoneNo` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `is_suspended` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (bookingId),
  FOREIGN KEY (customer_uname) REFERENCES user(uname),
  FOREIGN KEY (restaurant_uname) REFERENCES restaurant_owner(uname)
);

CREATE TABLE rest_signup (
  signupId bigint(20) NOT NULL AUTO_INCREMENT,
  uname varchar(45) NOT NULL,
  fname varchar(45) NOT NULL,
  lname varchar(45) NOT NULL,
  rest_name varchar(45) NOT NULL,
  email varchar(45) NOT NULL,
  psw varchar(45) NOT NULL,
  location varchar(45) NOT NULL,
  phoneNo varchar(45) NOT NULL,
  address longtext NOT NULL,
  startTime time NOT NULL,
  endTime time NOT NULL,
  cap int(11) NOT NULL,
  PRIMARY KEY (signupId)
);

CREATE TABLE ticket (
  ticketId int(11) NOT NULL AUTO_INCREMENT,
  user_uname varchar(45) DEFAULT NULL,
  rest_uname varchar(45) DEFAULT NULL,
  category varchar(45) NOT NULL,
  description longtext NOT NULL,
  date date NOT NULL,
  isResponded tinyint(4) NOT NULL,
  respond longtext DEFAULT NULL,
  admin_uname varchar(45) DEFAULT NULL,
  PRIMARY KEY (ticketId),
  FOREIGN KEY (user_uname) REFERENCES user(uname),
  FOREIGN KEY (rest_uname) REFERENCES restaurant_owner(uname),
  FOREIGN KEY (admin_uname) REFERENCES admin(uname)
);


CREATE TABLE `ban_warn` (
  `bwId` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL,
  `admin_uname` varchar(45) NOT NULL,
  `user_uname` varchar(45) DEFAULT NULL,
  `rest_uname` varchar(45) DEFAULT NULL,
  `reason` longtext DEFAULT NULL,
  PRIMARY KEY (`bwId`),
  FOREIGN KEY (admin_uname) REFERENCES admin(uname),
  FOREIGN KEY (user_uname) REFERENCES user(uname),
  FOREIGN KEY (rest_uname) REFERENCES restaurant_owner(uname)
);


CREATE TABLE `image` (
  `imgId` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `rest_uname` varchar(45) NOT NULL,
  PRIMARY KEY (`imgId`),
  FOREIGN KEY (rest_uname) REFERENCES restaurant_owner(uname)
);

CREATE TABLE `review` (
  `reviewId` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_uname` varchar(45) NOT NULL,
  `rest_uname` varchar(45) NOT NULL,
  `text` longtext NOT NULL,
  `star` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `reply` longtext DEFAULT NULL,
  PRIMARY KEY (`reviewId`),
  FOREIGN KEY (customer_uname) REFERENCES user(uname),
  FOREIGN KEY (rest_uname) REFERENCES restaurant_owner(uname)
);

CREATE TABLE favorites (
favoritesId bigint(20) NOT NULL AUTO_INCREMENT,
customer_uname varchar(45) NOT NULL,
rest_uname varchar(45) NOT NULL,
PRIMARY KEY(favoritesId),
FOREIGN KEY (customer_uname) REFERENCES user(uname),
FOREIGN KEY (rest_uname) REFERENCES restaurant_owner(uname)
);

CREATE TABLE notification (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `toName` varchar(45) NOT NULL,
  `text` longtext DEFAULT NULL,
  `link` longtext DEFAULT NULL,
  `isRead` tinyint(4) DEFAULT NULL,
  `date_sent` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
);
