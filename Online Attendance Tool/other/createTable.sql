
create schema project;


use project;

create table courses(
   username varchar(50),
   course_name varchar(40),
   course_code varchar(10),
   semester varchar(10),
   week_number int,
   weekly_hour int,
   primary key (username, course_code)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS `picture` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(15) NOT NULL,
  `code` varchar(15) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1  ;

CREATE TABLE IF NOT EXISTS `image_tag` (
  `id` int(11) NOT NULL auto_increment,
  `pic_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pic_x` int(11) NOT NULL,
  `pic_y` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `pic_id` (`pic_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1  ;

CREATE TABLE `list` (
  `course_code` varchar(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `ID` varchar(10) DEFAULT NULL,
  `e_mail` varchar(50) NOT NULL,
  primary key (course_code, e_mail)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tags` (
  `idtags` int(11) NOT NULL AUTO_INCREMENT,
  `taggedStudent` varchar(45) DEFAULT NULL,
  `classCode` varchar(45) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `tagPosId` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtags`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
