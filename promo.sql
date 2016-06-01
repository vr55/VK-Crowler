-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 01 2016 г., 19:47
-- Версия сервера: 5.5.49-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `promo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `activations`
--

CREATE TABLE IF NOT EXISTS `activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `activations`
--

INSERT INTO `activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'RnzsEezUyD43yilGVlIw7OsHMVvRty2F', 1, '2016-05-26 19:24:12', '2016-05-26 19:24:12', '2016-05-26 19:24:12');

-- --------------------------------------------------------

--
-- Структура таблицы `mcComunities`
--

CREATE TABLE IF NOT EXISTS `mcComunities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `efficiency` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Дамп данных таблицы `mcComunities`
--

INSERT INTO `mcComunities` (`id`, `active`, `efficiency`, `name`, `url`, `created_at`, `updated_at`) VALUES
(13, 0, 1, 'JOBROOM работа кастинги  вакансии съемки модели', 'https://vk.com/jobroom_group', '2016-05-22 14:08:10', '2016-05-27 20:17:16'),
(14, 0, 0, 'ВШОУБИЗЕ.РФ Кастинги Съемки Работа в шоу-бизнесе', 'https://vk.com/v_showbize', '2016-05-22 14:08:35', '2016-05-26 08:16:59'),
(15, 0, 0, 'РАБОТА в EVENTe вакансии для творческих людей!', 'https://vk.com/v.evente', '2016-05-22 14:08:49', '2016-05-22 14:08:49'),
(16, 0, 1, 'Event Work. Поиск работы в event и шоу-бизнесе.', 'https://vk.com/work_event', '2016-05-22 14:09:07', '2016-05-30 20:27:36'),
(17, 0, 0, 'Event Jobs', 'https://vk.com/myeventjobs', '2016-05-22 14:09:22', '2016-05-22 14:09:22'),
(18, 0, 0, 'public65657819', 'https://vk.com/public65657819', '2016-05-22 14:09:37', '2016-05-22 14:09:37'),
(19, 0, 2, 'EVENT''S  WORK', 'https://vk.com/telefon9060575807', '2016-05-22 14:09:54', '2016-05-27 20:17:16'),
(21, 0, 4, 'EventHunt LOW COST - предложения, TFP.', 'https://vk.com/myeventhuntbeginners', '2016-05-22 14:10:24', '2016-06-01 07:56:41'),
(22, 0, 0, 'Работа Для Творческих Людей (Москва)', 'https://vk.com/artworkpeople', '2016-05-24 17:47:20', '2016-05-24 17:47:20'),
(23, 0, 0, 'Вся творческая работа 77 (вакансии) Москва', 'https://vk.com/mskeventjob', '2016-05-24 19:51:27', '2016-05-24 19:51:27'),
(24, 0, 4, 'Event Hunt - поиск подрядчиков для мероприятий', 'https://vk.com/myeventhunt', '2016-05-24 19:52:41', '2016-06-01 08:39:03'),
(25, 0, 0, 'Event Hunt - Доска нужных объявлений', 'https://vk.com/hunttoevent', '2016-05-24 19:56:26', '2016-05-25 08:54:25'),
(26, 0, 0, 'public11294216', 'https://vk.com/public11294216', '2016-05-24 19:58:35', '2016-05-24 19:58:35'),
(27, 0, 54, 'Ищу фотографа, видеографа: агрегатор объявлений', 'https://vk.com/shikari_photo', '2016-05-26 08:19:37', '2016-06-01 08:39:03'),
(28, 0, 0, 'КИОСК РАБОТЫ РОССИЯ', 'https://vk.com/club121389875', '2016-06-01 08:17:13', '2016-06-01 08:17:13');

-- --------------------------------------------------------

--
-- Структура таблицы `mcKeywords`
--

CREATE TABLE IF NOT EXISTS `mcKeywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(100) NOT NULL,
  `efficiency` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Дамп данных таблицы `mcKeywords`
--

INSERT INTO `mcKeywords` (`id`, `keyword`, `efficiency`, `created_at`, `updated_at`) VALUES
(1, '#нуженвидеограф', 0, NULL, '2016-05-26 21:09:07'),
(2, '#нуженвидеооператор', 0, '2016-05-21 17:48:25', '2016-05-21 17:48:25'),
(3, '#ищувидеооператора', 0, '2016-05-21 17:48:45', '2016-05-21 17:48:45'),
(4, '#нужновидео', 0, '2016-05-21 17:49:03', '2016-05-21 17:49:03'),
(5, '#нужновидеонасвадьбу', 0, '2016-05-21 17:49:28', '2016-05-21 17:49:28'),
(6, '#скороженимся', 0, '2016-05-21 17:49:58', '2016-05-21 17:49:58'),
(7, '#мыпомолвлены', 0, '2016-05-21 17:50:14', '2016-05-21 17:50:14'),
(8, '#скоросвадьба', 0, '2016-05-21 17:50:24', '2016-05-21 17:50:24'),
(9, '#ясделалпредложение', 0, '2016-05-21 17:50:38', '2016-05-21 17:50:38'),
(10, '#онасказалада', 0, '2016-05-21 17:50:48', '2016-05-21 17:50:48'),
(11, '#мояневеста', 0, '2016-05-21 17:51:01', '2016-05-21 17:51:01'),
(13, '#подализаявлениевзагс', 0, '2016-05-21 17:54:24', '2016-05-21 17:54:24'),
(14, '#заявлениевзагс', 0, '2016-05-21 17:54:39', '2016-05-21 17:54:39'),
(15, '#делаюпредложение', 0, '2016-05-21 17:54:50', '2016-05-21 17:54:50'),
(16, '#нуженфотограф', 57, '2016-05-21 17:55:00', '2016-06-01 08:39:03'),
(17, '#нужнофото', 0, '2016-05-21 17:55:13', '2016-05-21 17:55:13'),
(18, '#нужнофотонасвадьбу', 0, '2016-05-21 17:55:28', '2016-05-21 17:55:28'),
(19, '#мойжених', 0, '2016-05-21 17:55:41', '2016-05-21 17:55:41'),
(20, '#женихмой', 0, '2016-05-21 17:55:53', '2016-05-21 17:55:53'),
(21, '#женихиневеста', 0, '2016-05-21 17:56:07', '2016-05-21 17:56:07'),
(22, '#жених', 0, '2016-05-21 17:56:20', '2016-05-21 17:56:20'),
(23, 'оператор', 0, '2016-05-21 18:45:36', '2016-05-26 21:09:08'),
(24, 'фотографа', 3, '2016-05-21 18:45:51', '2016-05-30 20:27:36'),
(25, 'фотограф', 13, '2016-05-21 18:45:55', '2016-06-01 08:39:03'),
(26, 'видео-оператор', 0, '2016-05-21 18:46:26', '2016-05-21 18:46:26'),
(27, 'видеооператор', 2, '2016-05-21 18:46:33', '2016-05-29 17:41:42'),
(28, 'фотографы', 0, '2016-05-30 20:28:47', '2016-05-30 20:28:47');

-- --------------------------------------------------------

--
-- Структура таблицы `mcPosts`
--

CREATE TABLE IF NOT EXISTS `mcPosts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vk_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `owner_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `from_id` int(11) NOT NULL,
  `signer_id` int(11) NOT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vk_id` (`vk_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;

-- --------------------------------------------------------

--
-- Структура таблицы `mcProposals`
--

CREATE TABLE IF NOT EXISTS `mcProposals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `mcProposals`
--

INSERT INTO `mcProposals` (`id`, `text`, `created_at`, `updated_at`) VALUES
(1, 'Тест', '2016-05-31 21:06:33', '2016-05-31 21:06:33');

-- --------------------------------------------------------

--
-- Структура таблицы `mcSettings`
--

CREATE TABLE IF NOT EXISTS `mcSettings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `secret_key` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `access_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `send_proposal` tinyint(1) NOT NULL DEFAULT '0',
  `scan_depth` int(3) NOT NULL DEFAULT '5',
  `register_deny` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `mcSettings`
--

INSERT INTO `mcSettings` (`id`, `client_id`, `secret_key`, `access_token`, `admin_email`, `send_proposal`, `scan_depth`, `register_deny`, `created_at`, `updated_at`) VALUES
(1, 5472275, 'EETXFY9FhnT2vrscS8PQ', 'de40360d2a49cb6721b858bcedbab580dc5bb02184951dc96edb433d08aebd556809d5c670f074d5291bf', 'vr5@bk.ru', 0, 5, 0, '2016-05-22 19:11:08', '2016-05-30 19:52:58');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_05_20_154525_mcPromo', 1),
('2014_07_02_230147_migration_cartalyst_sentinel', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `persistences`
--

CREATE TABLE IF NOT EXISTS `persistences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `persistences_code_unique` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `persistences`
--

INSERT INTO `persistences` (`id`, `user_id`, `code`, `created_at`, `updated_at`) VALUES
(4, 1, 'vvxX5ubNd0a0CvsxOwjVO80bMOZzvjNS', '2016-05-30 14:28:11', '2016-05-30 14:28:11');

-- --------------------------------------------------------

--
-- Структура таблицы `reminders`
--

CREATE TABLE IF NOT EXISTS `reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `slug`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'administrators', 'Administrators', '{"user.create":true,"user.delete":true,"user.view":true,"user.update":true}', '2016-05-25 19:07:34', '2016-05-25 19:07:34'),
(2, 'users', 'Users', '{"user.create":false,"user.delete":false,"user.view":true,"user.update":false}', '2016-05-25 19:07:34', '2016-05-25 19:07:34');

-- --------------------------------------------------------

--
-- Структура таблицы `role_users`
--

CREATE TABLE IF NOT EXISTS `role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `role_users`
--

INSERT INTO `role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2016-05-26 19:36:35', '2016-05-26 19:36:35'),
(1, 2, '2016-05-26 19:24:13', '2016-05-26 19:24:13');

-- --------------------------------------------------------

--
-- Структура таблицы `throttle`
--

CREATE TABLE IF NOT EXISTS `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `type`, `ip`, `created_at`, `updated_at`) VALUES
(1, NULL, 'global', NULL, '2016-05-25 19:30:57', '2016-05-25 19:30:57'),
(2, NULL, 'ip', '127.0.0.1', '2016-05-25 19:30:57', '2016-05-25 19:30:57'),
(3, NULL, 'global', NULL, '2016-05-25 19:31:31', '2016-05-25 19:31:31'),
(4, NULL, 'ip', '127.0.0.1', '2016-05-25 19:31:31', '2016-05-25 19:31:31'),
(5, NULL, 'global', NULL, '2016-05-25 19:31:33', '2016-05-25 19:31:33'),
(6, NULL, 'ip', '127.0.0.1', '2016-05-25 19:31:33', '2016-05-25 19:31:33'),
(7, NULL, 'global', NULL, '2016-05-25 19:31:34', '2016-05-25 19:31:34'),
(8, NULL, 'ip', '127.0.0.1', '2016-05-25 19:31:34', '2016-05-25 19:31:34'),
(9, NULL, 'global', NULL, '2016-05-25 19:31:53', '2016-05-25 19:31:53'),
(10, NULL, 'ip', '127.0.0.1', '2016-05-25 19:31:53', '2016-05-25 19:31:53');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `last_login`, `first_name`, `last_name`, `created_at`, `updated_at`) VALUES
(1, 'vr5@bk.ru', '$2y$10$XUd8nd2g7/WrY/jrmqgwLucGe5.VujlhIwa5sFKgjcTKmRaxIZN86', NULL, '2016-05-30 14:28:11', NULL, NULL, '2016-05-26 19:24:12', '2016-05-30 14:28:11');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
