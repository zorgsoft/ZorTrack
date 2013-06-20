-- phpMyAdmin SQL Dump
-- version 2.8.2.4
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Авг 04 2010 г., 09:54
-- Версия сервера: 5.0.24
-- Версия PHP: 5.1.6
-- 
-- БД: `zortrack`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `in_out`
-- 

CREATE TABLE `in_out` (
  `in_out_id` int(11) NOT NULL auto_increment,
  `in_out_user_id` int(11) NOT NULL,
  `in_out_date` date NOT NULL,
  `in_out_time_in` time NOT NULL,
  `in_out_time_out` time NOT NULL,
  `in_out_lunch_in` time NOT NULL,
  `in_out_lunch_out` time NOT NULL,
  PRIMARY KEY  (`in_out_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

-- 
-- Структура таблицы `tasks`
-- 

CREATE TABLE `tasks` (
  `tasks_id` int(11) NOT NULL auto_increment,
  `tasks_master_uid` int(11) NOT NULL,
  `tasks_for_uid` int(11) NOT NULL,
  `tasks_title` varchar(256) NOT NULL,
  `tasks_description` text NOT NULL,
  `tasks_start_date` datetime NOT NULL,
  `tasks_end_date` datetime NOT NULL,
  `tasks_user_start_date` datetime default NULL,
  `tasks_closed_date` datetime default NULL,
  `tasks_user_comment` text,
  `tasks_closed` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`tasks_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

-- 
-- Структура таблицы `users`
-- 

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL auto_increment,
  `users_login` varchar(128) NOT NULL,
  `users_password` varchar(64) NOT NULL,
  `users_name` varchar(256) default NULL,
  `users_phone` varchar(28) default NULL,
  `users_comments` text,
  `users_isadmin` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;
