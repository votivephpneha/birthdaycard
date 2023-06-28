-- Adminer 4.8.1 MySQL 10.6.12-MariaDB-cll-lve dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(255) NOT NULL,
  `blog_image` varchar(255) NOT NULL,
  `blog_thumb_image` varchar(255) DEFAULT NULL,
  `blog_description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `cards`;
CREATE TABLE `cards` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `card_title` varchar(255) DEFAULT NULL,
  `card_image` varchar(255) DEFAULT NULL,
  `card_back_image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) DEFAULT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `sub_category_id` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `gift_card` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `card_editor_images`;
CREATE TABLE `card_editor_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `editor_image` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `card_gallery_images`;
CREATE TABLE `card_gallery_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `card_id` bigint(20) unsigned NOT NULL,
  `gall_images` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `card_gallery_images_card_id_foreign` (`card_id`),
  CONSTRAINT `card_gallery_images_card_id_foreign` FOREIGN KEY (`card_id`) REFERENCES `cards` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `card_sizes`;
CREATE TABLE `card_sizes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `card_type` varchar(255) NOT NULL,
  `card_size` varchar(255) NOT NULL,
  `card_id` int(11) DEFAULT NULL,
  `card_price` float(20,2) NOT NULL DEFAULT 0.00,
  `card_size_qty` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) DEFAULT NULL,
  `pid` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `cart_table`;
CREATE TABLE `cart_table` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `card_id` int(11) NOT NULL,
  `sizes` int(11) NOT NULL,
  `card_type` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float(10,2) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `video_id` int(11) DEFAULT NULL,
  `predesigned_text_id` text DEFAULT NULL,
  `qr_image_link` text DEFAULT NULL,
  `fname` text DEFAULT NULL,
  `lname` text DEFAULT NULL,
  `phone_no` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` text DEFAULT NULL,
  `postal_code` text DEFAULT NULL,
  `door_number` text DEFAULT NULL,
  `receiver_fname` text DEFAULT NULL,
  `receiver_lname` text DEFAULT NULL,
  `receiver_email` text DEFAULT NULL,
  `receiver_phone_no` text DEFAULT NULL,
  `receiver_address` text DEFAULT NULL,
  `receiver_city` text DEFAULT NULL,
  `receiver_postal_code` text DEFAULT NULL,
  `receiver_door_number` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_category_id_foreign` (`category_id`),
  CONSTRAINT `categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `state_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE `contact_us` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;


DROP TABLE IF EXISTS `custom_card_details`;
CREATE TABLE `custom_card_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `p1_image` varchar(255) NOT NULL,
  `p1_text` text DEFAULT NULL,
  `p1_text_size` int(11) DEFAULT NULL,
  `p1_text_font` varchar(255) DEFAULT NULL,
  `p1_text_color` varchar(255) DEFAULT NULL,
  `p1_text_align` varchar(255) DEFAULT NULL,
  `p2_text` varchar(255) DEFAULT NULL,
  `p2_text_size` varchar(255) DEFAULT NULL,
  `p2_text_font` varchar(255) DEFAULT NULL,
  `p2_text_color` varchar(255) DEFAULT NULL,
  `p2_text_align` varchar(255) DEFAULT NULL,
  `p3_1_text` varchar(255) DEFAULT NULL,
  `p3_1_size` int(11) DEFAULT NULL,
  `p3_1_font` varchar(255) DEFAULT NULL,
  `p3_1_color` varchar(255) DEFAULT NULL,
  `p3_1_align` varchar(255) DEFAULT NULL,
  `p3_2_text` varchar(255) DEFAULT NULL,
  `p3_2_size` int(11) DEFAULT NULL,
  `p3_2_font` varchar(255) DEFAULT NULL,
  `p3_2_color` varchar(255) DEFAULT NULL,
  `p3_2_align` varchar(255) DEFAULT NULL,
  `p3_3_text` varchar(255) DEFAULT NULL,
  `p3_3_size` int(11) DEFAULT NULL,
  `p3_3_font` varchar(255) DEFAULT NULL,
  `p3_3_color` varchar(255) DEFAULT NULL,
  `p3_3_align` varchar(255) DEFAULT NULL,
  `p4_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `favourite_cards`;
CREATE TABLE `favourite_cards` (
  `favourite_card_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`favourite_card_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `gift_gallery_images`;
CREATE TABLE `gift_gallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gift_id` int(11) NOT NULL,
  `gift_gall_images` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `home_first_slider`;
CREATE TABLE `home_first_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_name` varchar(255) DEFAULT NULL,
  `slider_first_heading` varchar(255) DEFAULT NULL,
  `slider_first_desc_1` varchar(255) DEFAULT NULL,
  `slider_first_desc_2` varchar(255) DEFAULT NULL,
  `slider_first_desc_3` varchar(255) DEFAULT NULL,
  `slider_first_desc_4` varchar(255) DEFAULT NULL,
  `slider_first_desc_5` varchar(255) DEFAULT NULL,
  `slide_status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `home_page`;
CREATE TABLE `home_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_name` varchar(255) DEFAULT NULL,
  `section_1_heading` varchar(255) DEFAULT NULL,
  `section_1_title` varchar(255) DEFAULT NULL,
  `section_1_desc` text DEFAULT NULL,
  `section_1_banner_img` varchar(255) DEFAULT NULL,
  `section_1_btn_text1` varchar(255) DEFAULT NULL,
  `section_1_btn_text2` varchar(255) DEFAULT NULL,
  `section_2_image_1` varchar(255) DEFAULT NULL,
  `section_2_image_2` varchar(255) DEFAULT NULL,
  `section_2_image_3` varchar(255) DEFAULT NULL,
  `section_2_image_4` varchar(255) DEFAULT NULL,
  `section_3_heading` varchar(255) DEFAULT NULL,
  `section_3_image` varchar(255) DEFAULT NULL,
  `section_3_video` varchar(255) DEFAULT NULL,
  `section_3_btn_text` varchar(255) DEFAULT NULL,
  `section_3_desc` text DEFAULT NULL,
  `sec_status` int(11) NOT NULL,
  `section_4_heading_1` varchar(255) DEFAULT NULL,
  `section_4_desc_1` text DEFAULT NULL,
  `section_4_heading_2` varchar(255) DEFAULT NULL,
  `section_4_desc_2` text DEFAULT NULL,
  `section_4_heading_3` varchar(255) DEFAULT NULL,
  `section_4_desc_3` text DEFAULT NULL,
  `section_4_heading_4` varchar(255) DEFAULT NULL,
  `section_4_desc_4` text DEFAULT NULL,
  `section_4_image_1` varchar(255) DEFAULT NULL,
  `section_4_image_2` varchar(255) DEFAULT NULL,
  `section_4_image_3` varchar(255) DEFAULT NULL,
  `section_4_image_4` varchar(255) DEFAULT NULL,
  `section_5_heading` varchar(255) DEFAULT NULL,
  `section_5_desc_1` text DEFAULT NULL,
  `section_5_image_1` varchar(255) DEFAULT NULL,
  `section_5_image_2` varchar(255) DEFAULT NULL,
  `section_5_btntext` varchar(255) DEFAULT NULL,
  `section_8_image_1` varchar(255) DEFAULT NULL,
  `section_8_image_2` varchar(255) DEFAULT NULL,
  `section_8_image_3` varchar(255) DEFAULT NULL,
  `section_8_image_4` varchar(255) DEFAULT NULL,
  `section_8_heading_1` varchar(255) DEFAULT NULL,
  `section_8_heading_2` varchar(255) DEFAULT NULL,
  `section_8_heading_3` varchar(255) DEFAULT NULL,
  `section_8_heading_4` varchar(255) DEFAULT NULL,
  `section_8_desc_1` text DEFAULT NULL,
  `section_8_desc_2` text DEFAULT NULL,
  `section_8_desc_3` text DEFAULT NULL,
  `section_8_desc_4` text DEFAULT NULL,
  `footer_social_image_1` varchar(255) DEFAULT NULL,
  `footer_social_image_2` varchar(255) DEFAULT NULL,
  `footer_social_image_3` varchar(255) DEFAULT NULL,
  `footer_social_image_4` varchar(255) DEFAULT NULL,
  `footer_pcard_image_1` varchar(255) DEFAULT NULL,
  `footer_pcard_image_2` varchar(255) DEFAULT NULL,
  `footer_pcard_image_3` varchar(255) DEFAULT NULL,
  `footer_pcard_image_4` varchar(255) DEFAULT NULL,
  `footer_pcard_image_5` varchar(255) DEFAULT NULL,
  `footer_pcard_image_6` varchar(255) DEFAULT NULL,
  `footer_pcard_image_7` varchar(255) DEFAULT NULL,
  `footer_pcard_image_8` varchar(255) DEFAULT NULL,
  `footer_contimage_1` varchar(255) DEFAULT NULL,
  `footer_contimage_2` varchar(255) DEFAULT NULL,
  `footer_contimage_3` varchar(255) DEFAULT NULL,
  `footer_conttext_1` varchar(255) DEFAULT NULL,
  `footer_conttext_2` varchar(255) DEFAULT NULL,
  `footer_conttext_3` varchar(255) DEFAULT NULL,
  `section_6_heading` varchar(255) DEFAULT NULL,
  `section_6_desc` varchar(255) DEFAULT NULL,
  `section_7_heading` varchar(255) DEFAULT NULL,
  `section_7_desc` varchar(255) DEFAULT NULL,
  `section_7_btntext` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `home_sec_slider`;
CREATE TABLE `home_sec_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_name` varchar(255) DEFAULT NULL,
  `slider_sec_heading` varchar(255) DEFAULT NULL,
  `slider_sec_desc` varchar(255) DEFAULT NULL,
  `slider_sec_img_1` varchar(255) DEFAULT NULL,
  `slider_sec_img_2` varchar(255) DEFAULT NULL,
  `slider_sec_img_3` varchar(255) DEFAULT NULL,
  `slider_sec_img_4` varchar(255) DEFAULT NULL,
  `slider_sec_btntext` varchar(255) DEFAULT NULL,
  `slider_status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `text_message` text NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `card_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `card_id` bigint(20) unsigned DEFAULT NULL,
  `card_size` text DEFAULT NULL,
  `card_qty` int(11) DEFAULT NULL,
  `card_detail` text DEFAULT NULL,
  `order_status` int(11) NOT NULL COMMENT 'Ordered = 0 ,In Progress=1, Cancelled=2,Order ready=3,In transit = 4,Out for delivery=5, Delivered=6',
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `phone_no` text NOT NULL,
  `email` text NOT NULL,
  `country` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` text NOT NULL,
  `postal_code` text NOT NULL,
  `door_number` varchar(255) DEFAULT NULL,
  `receiver_fname` varchar(255) NOT NULL,
  `receiver_lname` varchar(255) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `receiver_phone_no` varchar(255) NOT NULL,
  `receiver_country` varchar(255) NOT NULL,
  `receiver_address` varchar(255) NOT NULL,
  `receiver_state` varchar(255) NOT NULL,
  `receiver_city` varchar(255) NOT NULL,
  `receiver_postal_code` varchar(255) NOT NULL,
  `receiver_door_number` varchar(255) DEFAULT NULL,
  `postage_costs` float(20,2) DEFAULT NULL,
  `total` float(20,2) NOT NULL,
  `sub_total` float(20,2) NOT NULL,
  `order_notes` text DEFAULT NULL,
  `payment_method` longtext NOT NULL,
  `cancel_reason` text DEFAULT NULL,
  `pay_status` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `card_id` (`card_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `card_id` bigint(20) unsigned NOT NULL,
  `card_size_id` int(11) NOT NULL,
  `video_id` int(11) DEFAULT NULL,
  `predesigned_text_id` text DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `card_price` float(20,2) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `door_number` varchar(255) DEFAULT NULL,
  `receiver_fname` varchar(255) DEFAULT NULL,
  `receiver_lname` varchar(255) DEFAULT NULL,
  `receiver_email` varchar(255) DEFAULT NULL,
  `receiver_phone_no` varchar(255) DEFAULT NULL,
  `receiver_country` varchar(255) DEFAULT NULL,
  `receiver_address` varchar(255) DEFAULT NULL,
  `receiver_state` varchar(255) DEFAULT NULL,
  `receiver_city` varchar(255) DEFAULT NULL,
  `receiver_postal_code` varchar(255) DEFAULT NULL,
  `receiver_door_number` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `card_id` (`card_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`card_id`) REFERENCES `cards` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `order_details` (`id`, `order_id`, `user_id`, `card_id`, `card_size_id`, `video_id`, `predesigned_text_id`, `qty`, `card_price`, `fname`, `lname`, `phone_no`, `email`, `country`, `address`, `state`, `city`, `postal_code`, `door_number`, `receiver_fname`, `receiver_lname`, `receiver_email`, `receiver_phone_no`, `receiver_country`, `receiver_address`, `receiver_state`, `receiver_city`, `receiver_postal_code`, `receiver_door_number`, `created_at`, `updated_at`) VALUES
(153, 'ord-9963', 3,  2,  1,  NULL, NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 10:06:26',  '2023-06-19 10:06:26'),
(157, 'ord-9963', 3,  36, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 10:19:41',  '2023-06-19 10:19:41'),
(158, 'ord-9963', 3,  37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 10:19:41',  '2023-06-19 10:19:41'),
(159, 'ord-9667', 3,  10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 10:26:21',  '2023-06-19 10:26:21'),
(160, 'ord-9667', 3,  36, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 10:26:29',  '2023-06-19 10:26:29'),
(161, 'ord-9667', 3,  37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 10:26:29',  '2023-06-19 10:26:29'),
(162, 'ord-1969', 4,  2,  1,  NULL, NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 10:37:25',  '2023-06-19 10:37:25'),
(163, 'ord-1969', 4,  37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 10:37:29',  '2023-06-19 10:37:29'),
(164, 'ord-5823', 4,  10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 10:40:58',  '2023-06-19 10:40:58'),
(165, 'ord-5823', 4,  37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 10:41:39',  '2023-06-19 10:41:39'),
(166, 'ord-8965', 3,  2,  1,  197,  NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 10:49:47',  '2023-06-19 10:49:47'),
(167, 'ord-8965', 3,  36, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 10:49:51',  '2023-06-19 10:49:51'),
(168, 'ord-8965', 3,  37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 10:49:51',  '2023-06-19 10:49:51'),
(169, 'ord-2959', 4,  2,  1,  NULL, NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 10:52:40',  '2023-06-19 10:52:40'),
(170, 'ord-2959', 4,  37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 10:52:43',  '2023-06-19 10:52:43'),
(171, 'ord-4652', 4,  10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 10:54:42',  '2023-06-19 10:54:42'),
(172, 'ord-4652', 4,  37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 10:54:45',  '2023-06-19 10:54:45'),
(173, 'ord-3638', 31, 1,  47, 198,  NULL, 1,  7.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 11:01:38',  '2023-06-19 11:01:38'),
(174, 'ord-3638', 31, 37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 11:02:12',  '2023-06-19 11:02:12'),
(175, 'ord-6010', 31, 12, 32, 200,  NULL, 1,  78.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 11:31:13',  '2023-06-19 11:31:13'),
(176, 'ord-6010', 31, 37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 11:31:56',  '2023-06-19 11:31:56'),
(177, 'ord-1742', 14, 10, 27, 201,  NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 13:37:06',  '2023-06-19 13:37:06'),
(178, 'ord-1742', 14, 10, 30, NULL, NULL, 3,  9.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 13:37:06',  '2023-06-19 13:37:06'),
(179, 'ord-1742', 14, 36, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 13:37:48',  '2023-06-19 13:37:48'),
(180, 'ord-8965', 3,  36, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 13:44:52',  '2023-06-19 13:44:52'),
(181, 'ord-8965', 3,  36, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 13:46:15',  '2023-06-19 13:46:15'),
(182, 'ord-8965', 3,  37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-19 13:46:15',  '2023-06-19 13:46:15'),
(183, 'ord-5825', 10, 1,  47, NULL, '209,210',  1,  7.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 04:59:10',  '2023-06-20 04:59:10'),
(184, 'ord-5825', 10, 36, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 04:59:16',  '2023-06-20 04:59:16'),
(185, 'ord-5825', 10, 37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 04:59:16',  '2023-06-20 04:59:16'),
(186, 'ord-6381', 3,  10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 05:07:57',  '2023-06-20 05:07:57'),
(187, 'ord-6381', 3,  10, 30, NULL, NULL, 1,  3.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 05:07:57',  '2023-06-20 05:07:57'),
(188, 'ord-6381', 3,  1,  47, NULL, NULL, 1,  7.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 05:07:57',  '2023-06-20 05:07:57'),
(189, 'ord-6381', 3,  12, 32, NULL, NULL, 1,  78.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 05:07:57',  '2023-06-20 05:07:57'),
(190, 'ord-6381', 3,  37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 05:08:02',  '2023-06-20 05:08:02'),
(191, 'ord-2504', 3,  12, 32, 203,  NULL, 2,  156.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 05:16:19',  '2023-06-20 05:16:19'),
(192, 'ord-2504', 3,  36, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 05:16:23',  '2023-06-20 05:16:23'),
(193, 'ord-2504', 3,  37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 05:16:23',  '2023-06-20 05:16:23'),
(194, 'ord-3198', 3,  12, 32, 208,  '211,212',  1,  78.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 06:03:40',  '2023-06-20 06:03:40'),
(195, 'ord-3198', 3,  1,  52, 209,  NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 06:03:40',  '2023-06-20 06:03:40'),
(196, 'ord-3198', 3,  36, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 06:03:45',  '2023-06-20 06:03:45'),
(197, 'ord-3198', 3,  37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 06:03:45',  '2023-06-20 06:03:45'),
(198, 'ord-7144', 24, 1,  47, 215,  NULL, 1,  7.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 09:13:23',  '2023-06-20 09:13:23'),
(199, 'ord-2619', 24, 2,  1,  220,  NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 09:23:53',  '2023-06-20 09:23:53'),
(200, 'ord-8110', 4,  10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 09:43:56',  '2023-06-20 09:43:56'),
(201, 'ord-9588', 3,  10, 27, 216,  NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 10:10:28',  '2023-06-20 10:10:28'),
(202, 'ord-1058', 24, 2,  1,  229,  NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 10:42:31',  '2023-06-20 10:42:31'),
(203, 'ord-6118', 24, 2,  20, NULL, NULL, 1,  12.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 10:47:03',  '2023-06-20 10:47:03'),
(204, 'ord-6118', 24, 37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 10:47:13',  '2023-06-20 10:47:13'),
(205, 'ord-3165', 4,  10, 27, 234,  NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-21 05:38:18',  '2023-06-21 05:38:18'),
(206, 'ord-3165', 4,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-21 05:38:18',  '2023-06-21 05:38:18'),
(207, 'ord-3165', 4,  10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-21 05:38:18',  '2023-06-21 05:38:18'),
(208, 'ord-3165', 4,  10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-21 05:38:18',  '2023-06-21 05:38:18'),
(209, 'ord-9464', 4,  10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-21 05:58:33',  '2023-06-21 05:58:33'),
(210, 'ord-9464', 4,  37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-21 05:58:40',  '2023-06-21 05:58:40'),
(211, 'ord-9042', 3,  10, 27, 233,  NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-21 06:58:46',  '2023-06-21 06:58:46'),
(212, 'ord-8086', 4,  10, 27, 236,  '215,216',  1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-21 07:14:33',  '2023-06-21 07:14:33'),
(213, 'ord-8086', 4,  10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-21 07:14:33',  '2023-06-21 07:14:33'),
(214, 'ord-8086', 4,  37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-21 07:14:52',  '2023-06-21 07:14:52'),
(215, 'ord-1702', 4,  10, 27, 212,  NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-21 07:16:47',  '2023-06-21 07:16:47'),
(216, 'ord-9986', 3,  10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-21 08:49:37',  '2023-06-21 08:49:37'),
(217, 'ord-9986', 3,  37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-21 08:49:43',  '2023-06-21 08:49:43'),
(218, 'ord-9986', 3,  37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-21 10:48:43',  '2023-06-21 10:48:43'),
(219, 'ord-6683', 10, 2,  1,  214,  NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-21 12:32:38',  '2023-06-21 12:32:38'),
(220, 'ord-6683', 10, 2,  1,  NULL, '223,224',  1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-21 12:32:38',  '2023-06-21 12:32:38'),
(221, 'ord-5695', 3,  2,  1,  240,  NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-21 13:11:55',  '2023-06-21 13:11:55'),
(222, 'ord-5695', 3,  37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-21 13:16:27',  '2023-06-21 13:16:27'),
(223, 'ord-4852', 14, 10, 27, 242,  NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-21 13:28:19',  '2023-06-21 13:28:19'),
(224, 'ord-4115', 31, 1,  47, NULL, NULL, 1,  7.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 06:09:17',  '2023-06-22 06:09:17'),
(225, 'ord-4115', 31, 37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 06:10:19',  '2023-06-22 06:10:19'),
(226, 'ord-4115', 31, 37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 06:10:25',  '2023-06-22 06:10:25'),
(227, 'ord-7578', 4,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 06:15:06',  '2023-06-22 06:15:06'),
(228, 'ord-7578', 4,  10, 27, 239,  NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 06:15:06',  '2023-06-22 06:15:06'),
(229, 'ord-2311', 3,  10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 06:40:32',  '2023-06-22 06:40:32'),
(230, 'ord-2311', 3,  36, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 06:47:19',  '2023-06-22 06:47:19'),
(231, 'ord-2311', 3,  37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 06:47:19',  '2023-06-22 06:47:19'),
(232, 'ord-2311', 3,  36, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 06:57:42',  '2023-06-22 06:57:42'),
(233, 'ord-2311', 3,  68, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 06:57:42',  '2023-06-22 06:57:42'),
(234, 'ord-2311', 3,  36, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 07:04:26',  '2023-06-22 07:04:26'),
(235, 'ord-2311', 3,  37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 07:04:26',  '2023-06-22 07:04:26'),
(236, 'ord-3099', 31, 1,  47, NULL, NULL, 1,  7.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 08:30:40',  '2023-06-22 08:30:40'),
(237, 'ord-3099', 31, 36, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 09:06:03',  '2023-06-22 09:06:03'),
(238, 'ord-3099', 31, 37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 09:06:03',  '2023-06-22 09:06:03'),
(239, 'ord-3099', 31, 68, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 09:06:03',  '2023-06-22 09:06:03'),
(240, 'ord-3398', 4,  10, 27, NULL, NULL, 2,  8.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 09:25:27',  '2023-06-22 09:25:27'),
(241, 'ord-3398', 4,  36, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 09:33:22',  '2023-06-22 09:33:22'),
(242, 'ord-5159', 4,  2,  1,  NULL, NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 09:41:58',  '2023-06-22 09:41:58'),
(243, 'ord-2259', 34, 2,  1,  NULL, NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 10:17:28',  '2023-06-22 10:17:28'),
(244, 'ord-2259', 34, 2,  1,  NULL, NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 10:17:28',  '2023-06-22 10:17:28'),
(245, 'ord-9182', 35, 10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 10:19:16',  '2023-06-22 10:19:16'),
(246, 'ord-9182', 35, 10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 10:19:16',  '2023-06-22 10:19:16'),
(247, 'ord-5654', 3,  10, 27, NULL, NULL, 2,  8.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 10:31:51',  '2023-06-22 10:31:51'),
(248, 'ord-5654', 3,  2,  1,  243,  NULL, 12, 396.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 10:31:51',  '2023-06-22 10:31:51'),
(249, 'ord-5654', 3,  12, 32, NULL, NULL, 1,  78.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 10:31:51',  '2023-06-22 10:31:51'),
(250, 'ord-5654', 3,  36, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 10:32:47',  '2023-06-22 10:32:47'),
(251, 'ord-5654', 3,  37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 10:32:47',  '2023-06-22 10:32:47'),
(252, 'ord-7442', 3,  12, 32, NULL, NULL, 1,  78.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 10:47:16',  '2023-06-22 10:47:16'),
(253, 'ord-1388', 36, 31, 43, NULL, NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 12:22:42',  '2023-06-22 12:22:42'),
(254, 'ord-1388', 36, 37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 12:26:17',  '2023-06-22 12:26:17'),
(255, 'ord-3165', 31, 1,  47, NULL, NULL, 1,  7.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 12:30:15',  '2023-06-22 12:30:15'),
(256, 'ord-3165', 31, 1,  47, NULL, NULL, 1,  7.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 12:30:15',  '2023-06-22 12:30:15'),
(257, 'ord-3165', 31, 10, 30, NULL, NULL, 1,  3.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 12:30:15',  '2023-06-22 12:30:15'),
(258, 'ord-3165', 31, 36, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 12:31:29',  '2023-06-22 12:31:29'),
(259, 'ord-3165', 31, 36, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 12:31:36',  '2023-06-22 12:31:36'),
(260, 'ord-3165', 31, 36, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 12:31:51',  '2023-06-22 12:31:51'),
(261, 'ord-9075', 31, 2,  20, NULL, NULL, 1,  12.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 12:33:45',  '2023-06-22 12:33:45'),
(262, 'ord-9182', 35, 68, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 12:38:49',  '2023-06-22 12:38:49'),
(263, 'ord-1947', 37, 1,  47, NULL, NULL, 1,  7.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 13:53:42',  '2023-06-22 13:53:42'),
(264, 'ord-1947', 37, 37, 0,  NULL, NULL, 1,  0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-22 13:53:59',  '2023-06-22 13:53:59'),
(265, 'ord-1477', 38, 10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-23 06:20:20',  '2023-06-23 06:20:20'),
(266, 'ord-1588', 3,  12, 32, NULL, NULL, 1,  78.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-23 08:32:00',  '2023-06-23 08:32:00'),
(267, 'ord-4323', 3,  12, 32, NULL, NULL, 1,  78.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-23 11:37:32',  '2023-06-23 11:37:32'),
(268, 'ord-4323', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-23 11:37:32',  '2023-06-23 11:37:32'),
(269, 'ord-4323', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-23 11:37:32',  '2023-06-23 11:37:32'),
(270, 'ord-8545', 3,  68, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-23 12:18:29',  '2023-06-23 12:18:29'),
(271, 'ord-8545', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-23 12:18:29',  '2023-06-23 12:18:29'),
(272, 'ord-8545', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-23 12:18:29',  '2023-06-23 12:18:29'),
(273, 'ord-8545', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-23 12:18:29',  '2023-06-23 12:18:29'),
(274, 'ord-8545', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-23 12:18:29',  '2023-06-23 12:18:29'),
(275, 'ord-6261', 3,  1,  47, NULL, NULL, 3,  21.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 08:47:27',  '2023-06-26 08:47:27'),
(276, 'ord-6261', 3,  2,  1,  NULL, NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 08:47:27',  '2023-06-26 08:47:27'),
(277, 'ord-6261', 3,  10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 08:47:27',  '2023-06-26 08:47:27'),
(278, 'ord-6261', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 08:47:27',  '2023-06-26 08:47:27'),
(279, 'ord-6261', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 08:47:27',  '2023-06-26 08:47:27'),
(280, 'ord-2119', 3,  12, 32, NULL, NULL, 1,  78.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 10:03:21',  '2023-06-26 10:03:21'),
(281, 'ord-4063', 3,  10, 27, NULL, NULL, 2,  8.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 11:38:36',  '2023-06-26 11:38:36'),
(282, 'ord-4063', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 11:38:36',  '2023-06-26 11:38:36'),
(283, 'ord-6811', 3,  31, 43, NULL, NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 11:40:24',  '2023-06-26 11:40:24'),
(284, 'ord-6811', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 11:40:24',  '2023-06-26 11:40:24'),
(285, 'ord-3874', 3,  2,  1,  NULL, NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 11:51:43',  '2023-06-26 11:51:43'),
(286, 'ord-3874', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 11:51:43',  '2023-06-26 11:51:43'),
(287, 'ord-3874', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 11:51:43',  '2023-06-26 11:51:43'),
(288, 'ord-6238', 3,  2,  1,  NULL, NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 11:53:19',  '2023-06-26 11:53:19'),
(289, 'ord-6238', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 11:53:19',  '2023-06-26 11:53:19'),
(290, 'ord-6238', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 11:53:19',  '2023-06-26 11:53:19'),
(291, 'ord-8885', 41, 2,  1,  NULL, NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 12:05:46',  '2023-06-26 12:05:46'),
(292, 'ord-8885', 41, 37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 12:05:46',  '2023-06-26 12:05:46'),
(293, 'ord-3540', 3,  10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 12:18:27',  '2023-06-26 12:18:27'),
(294, 'ord-3540', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 12:18:27',  '2023-06-26 12:18:27'),
(295, 'ord-3540', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 12:18:27',  '2023-06-26 12:18:27'),
(296, 'ord-6955', 3,  2,  1,  NULL, NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 12:49:04',  '2023-06-26 12:49:04'),
(297, 'ord-6955', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 12:49:04',  '2023-06-26 12:49:04'),
(298, 'ord-6955', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 12:49:04',  '2023-06-26 12:49:04'),
(299, 'ord-6955', 3,  68, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 12:49:04',  '2023-06-26 12:49:04'),
(300, 'ord-8169', 3,  2,  1,  NULL, NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 12:59:04',  '2023-06-26 12:59:04'),
(301, 'ord-8169', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 12:59:04',  '2023-06-26 12:59:04'),
(302, 'ord-9925', 3,  10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 04:58:59',  '2023-06-27 04:58:59'),
(303, 'ord-9925', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 04:58:59',  '2023-06-27 04:58:59'),
(304, 'ord-9925', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 04:58:59',  '2023-06-27 04:58:59'),
(305, 'ord-2753', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 06:30:19',  '2023-06-27 06:30:19'),
(306, 'ord-3476', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 06:33:42',  '2023-06-27 06:33:42'),
(307, 'ord-3476', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 06:33:42',  '2023-06-27 06:33:42'),
(308, 'ord-8089', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 06:34:49',  '2023-06-27 06:34:49'),
(309, 'ord-8089', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 06:34:49',  '2023-06-27 06:34:49'),
(310, 'ord-8089', 3,  68, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 06:34:49',  '2023-06-27 06:34:49'),
(311, 'ord-1591', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 06:39:13',  '2023-06-27 06:39:13'),
(312, 'ord-1591', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 06:39:13',  '2023-06-27 06:39:13'),
(313, 'ord-3666', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 06:41:15',  '2023-06-27 06:41:15'),
(314, 'ord-3666', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 06:41:15',  '2023-06-27 06:41:15'),
(315, 'ord-8175', 10, 1,  47, 253,  '231,232',  2,  14.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 06:43:18',  '2023-06-27 06:43:18'),
(316, 'ord-8175', 10, 36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 06:43:18',  '2023-06-27 06:43:18'),
(317, 'ord-2970', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 07:01:20',  '2023-06-27 07:01:20'),
(318, 'ord-2970', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 07:01:20',  '2023-06-27 07:01:20'),
(319, 'ord-8125', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 07:15:31',  '2023-06-27 07:15:31'),
(320, 'ord-8125', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 07:15:31',  '2023-06-27 07:15:31'),
(321, 'ord-9831', 3,  10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 12:31:33',  '2023-06-27 12:31:33'),
(322, 'ord-9831', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 12:31:33',  '2023-06-27 12:31:33'),
(323, 'ord-9831', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 12:31:33',  '2023-06-27 12:31:33'),
(324, 'ord-2771', 3,  12, 32, NULL, NULL, 1,  78.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 12:38:01',  '2023-06-27 12:38:01'),
(325, 'ord-2771', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 12:38:01',  '2023-06-27 12:38:01'),
(326, 'ord-2771', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 12:38:01',  '2023-06-27 12:38:01'),
(327, 'ord-9537', 3,  10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 12:47:08',  '2023-06-27 12:47:08'),
(328, 'ord-9537', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 12:47:08',  '2023-06-27 12:47:08'),
(329, 'ord-4629', 3,  10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 13:11:28',  '2023-06-27 13:11:28'),
(330, 'ord-4629', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 13:11:28',  '2023-06-27 13:11:28'),
(331, 'ord-4629', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 13:11:28',  '2023-06-27 13:11:28'),
(332, 'ord-9389', 43, 12, 32, NULL, NULL, 1,  78.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 13:38:21',  '2023-06-27 13:38:21'),
(333, 'ord-9389', 43, 36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 13:38:21',  '2023-06-27 13:38:21'),
(334, 'ord-9389', 43, 37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-27 13:38:21',  '2023-06-27 13:38:21'),
(335, 'ord-5576', 3,  10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-28 05:25:32',  '2023-06-28 05:25:32'),
(336, 'ord-5576', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-28 05:25:32',  '2023-06-28 05:25:32'),
(337, 'ord-5576', 3,  68, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-28 05:25:32',  '2023-06-28 05:25:32'),
(338, 'ord-8727', 3,  2,  1,  NULL, NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-28 05:27:04',  '2023-06-28 05:27:04'),
(339, 'ord-8727', 3,  68, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-28 05:27:04',  '2023-06-28 05:27:04'),
(340, 'ord-8727', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-28 05:27:04',  '2023-06-28 05:27:04'),
(341, 'ord-6527', 3,  2,  1,  NULL, NULL, 1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-28 05:28:51',  '2023-06-28 05:28:51'),
(342, 'ord-6527', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-28 05:28:51',  '2023-06-28 05:28:51'),
(343, 'ord-6527', 3,  68, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-28 05:28:51',  '2023-06-28 05:28:51'),
(344, 'ord-6476', 3,  2,  1,  NULL, '233,234',  1,  33.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-28 05:35:35',  '2023-06-28 05:35:35'),
(345, 'ord-6476', 3,  36, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-28 05:35:35',  '2023-06-28 05:35:35'),
(346, 'ord-6476', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-28 05:35:35',  '2023-06-28 05:35:35'),
(347, 'ord-2311', 3,  10, 27, NULL, NULL, 1,  4.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-28 12:05:09',  '2023-06-28 12:05:09'),
(348, 'ord-2311', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-28 12:05:09',  '2023-06-28 12:05:09'),
(349, 'ord-2311', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-28 12:05:09',  '2023-06-28 12:05:09'),
(350, 'ord-1241', 3,  1,  47, NULL, NULL, 1,  7.00, 'dfdsf',  '3e4rer', '01234567890',  'votivephp.neha@gmail.com', NULL, 'dsd',  NULL, 'Resistencia',  '452001', '4',  'dfdsf',  '3e4rer', 'votivephp.neha@gmail.com', '01234567890',  NULL, 'dsd',  NULL, 'Resistencia',  '452001', '7',  '2023-06-28 12:12:11',  '2023-06-28 12:12:11'),
(351, 'ord-1241', 3,  37, 0,  NULL, NULL, 1,  10.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-28 12:12:11',  '2023-06-28 12:12:11'),
(352, 'ord-1241', 3,  68, 0,  NULL, NULL, 1,  11.00,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-28 12:12:11',  '2023-06-28 12:12:11');

DROP TABLE IF EXISTS `order_old`;
CREATE TABLE `order_old` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `card_id` bigint(20) unsigned DEFAULT NULL,
  `card_size` text DEFAULT NULL,
  `card_qty` int(11) DEFAULT NULL,
  `card_detail` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `card_id` (`card_id`),
  CONSTRAINT `order_old_ibfk_1` FOREIGN KEY (`card_id`) REFERENCES `cards` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_url` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `page_small_content` text DEFAULT NULL,
  `page_meta_desc` varchar(255) DEFAULT NULL,
  `sub_title` varchar(255) NOT NULL,
  `page_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `payment_transactions`;
CREATE TABLE `payment_transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_number` int(11) DEFAULT NULL,
  `order_id` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `txn_time` varchar(255) DEFAULT NULL,
  `sub_total` double(20,2) DEFAULT 0.00,
  `postage_costs` float(20,2) NOT NULL DEFAULT 0.00,
  `currency_code` varchar(255) DEFAULT NULL,
  `card_number_txn` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `order_time` varchar(255) DEFAULT NULL,
  `total_amount` double(20,2) DEFAULT 0.00,
  `discount_fee` double(20,2) DEFAULT 0.00,
  `payment_status` varchar(255) DEFAULT NULL,
  `pending_reason` varchar(255) DEFAULT NULL,
  `reason_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `predesigned_text`;
CREATE TABLE `predesigned_text` (
  `text_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `txt_id` int(11) NOT NULL,
  `Text` text NOT NULL,
  `size` text DEFAULT NULL,
  `color` text DEFAULT NULL,
  `font` text DEFAULT NULL,
  `horizontal_alignment` text DEFAULT NULL,
  `vertical_alignment` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`text_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `states`;
CREATE TABLE `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE `sub_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_categories_category_id_foreign` (`category_id`),
  CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `text_colors`;
CREATE TABLE `text_colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color_name` varchar(255) NOT NULL,
  `color_value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `text_fonts`;
CREATE TABLE `text_fonts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `font_name` varchar(255) NOT NULL,
  `font_value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `text_sizes`;
CREATE TABLE `text_sizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text_size` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `temp_password` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `card_size_id` int(11) NOT NULL,
  `video_name` text NOT NULL,
  `qr_image_link` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `voucher_codes`;
CREATE TABLE `voucher_codes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `voucher` varchar(255) NOT NULL,
  `discount` tinyint(4) NOT NULL COMMENT 'flat=0,percentage=1',
  `amount` int(11) NOT NULL,
  `apply_min_amount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `valid_till` date NOT NULL,
  `per_user` int(11) NOT NULL,
  `uses_limit` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2023-06-28 13:17:33