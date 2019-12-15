CREATE TABLE `admin` (
  `uname` varchar(45) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `psw` varchar(45) NOT NULL,
  `recCode` varchar(45) NOT NULL,
  PRIMARY KEY (`uname`)
)

CREATE TABLE `ban_warn` (
  `bwId` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL,
  `admin_uname` varchar(45) NOT NULL,
  `user_uname` varchar(45) DEFAULT NULL,
  `rest_uname` varchar(45) DEFAULT NULL,
  `reason` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`bwId`)
)
CREATE TABLE `bookings` (
  `bookingId` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_uname` varchar(45) NOT NULL,
  `restaurant_uname` varchar(45) NOT NULL,
  `party` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phoneNo` varchar(45) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`bookingId`)
) 

CREATE TABLE `image` (
  `imgId` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `rest_uname` varchar(45) NOT NULL,
  PRIMARY KEY (`imgId`)
)

CREATE TABLE `rest_signup` (
  `signupId` bigint(20) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `rest_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `psw` varchar(45) NOT NULL,
  `location` varchar(45) NOT NULL,
  `phoneNo` varchar(45) NOT NULL,
  `address` longtext NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  PRIMARY KEY (`signupId`)
)

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
  `description` varchar(45) DEFAULT NULL,
  `payment` varchar(45) DEFAULT NULL,
  `additional` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `startTime` varchar(45) DEFAULT NULL,
  `endTime` varchar(45) DEFAULT NULL,
  `stars` varchar(45) DEFAULT NULL,
  `cuisines` varchar(45) DEFAULT NULL,
  `seating_options` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `isBanned` varchar(45) DEFAULT NULL,
  `warnCount` varchar(45) DEFAULT NULL,
  `recCode` varchar(45) NOT NULL,
  PRIMARY KEY (`uname`)
)

CREATE TABLE `review` (
  `reviewId` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_uname` varchar(45) NOT NULL,
  `rest_uname` varchar(45) NOT NULL,
  `text` longtext NOT NULL,
  `star` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `reply` longtext DEFAULT NULL,
  PRIMARY KEY (`reviewId`)
)
CREATE TABLE `ticket` (
  `ticketId` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_uname` varchar(45) DEFAULT NULL,
  `rest_uname` varchar(45) DEFAULT NULL,
  `admin_uname` varchar(45) DEFAULT NULL,
  `category` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `date` varchar(45) NOT NULL,
  `isResponded` varchar(45) NOT NULL,
  `respond` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ticketId`)
)

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
)