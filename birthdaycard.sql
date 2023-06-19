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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
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
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `card_id` (`card_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`card_id`) REFERENCES `cards` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `order_details` (`id`, `order_id`, `user_id`, `card_id`, `card_size_id`, `video_id`, `predesigned_text_id`, `qty`, `card_price`, `created_at`, `updated_at`) VALUES
(153, 'ord-9963', 3,  2,  1,  NULL, NULL, 1,  33.00,  '2023-06-19 10:06:26',  '2023-06-19 10:06:26'),
(157, 'ord-9963', 3,  36, 0,  NULL, NULL, 1,  0.00, '2023-06-19 10:19:41',  '2023-06-19 10:19:41'),
(158, 'ord-9963', 3,  37, 0,  NULL, NULL, 1,  0.00, '2023-06-19 10:19:41',  '2023-06-19 10:19:41'),
(159, 'ord-9667', 3,  10, 27, NULL, NULL, 1,  4.00, '2023-06-19 10:26:21',  '2023-06-19 10:26:21'),
(160, 'ord-9667', 3,  36, 0,  NULL, NULL, 1,  0.00, '2023-06-19 10:26:29',  '2023-06-19 10:26:29'),
(161, 'ord-9667', 3,  37, 0,  NULL, NULL, 1,  0.00, '2023-06-19 10:26:29',  '2023-06-19 10:26:29'),
(162, 'ord-1969', 4,  2,  1,  NULL, NULL, 1,  33.00,  '2023-06-19 10:37:25',  '2023-06-19 10:37:25'),
(163, 'ord-1969', 4,  37, 0,  NULL, NULL, 1,  0.00, '2023-06-19 10:37:29',  '2023-06-19 10:37:29'),
(164, 'ord-5823', 4,  10, 27, NULL, NULL, 1,  4.00, '2023-06-19 10:40:58',  '2023-06-19 10:40:58'),
(165, 'ord-5823', 4,  37, 0,  NULL, NULL, 1,  0.00, '2023-06-19 10:41:39',  '2023-06-19 10:41:39'),
(166, 'ord-8965', 3,  2,  1,  197,  NULL, 1,  33.00,  '2023-06-19 10:49:47',  '2023-06-19 10:49:47'),
(167, 'ord-8965', 3,  36, 0,  NULL, NULL, 1,  0.00, '2023-06-19 10:49:51',  '2023-06-19 10:49:51'),
(168, 'ord-8965', 3,  37, 0,  NULL, NULL, 1,  0.00, '2023-06-19 10:49:51',  '2023-06-19 10:49:51'),
(169, 'ord-2959', 4,  2,  1,  NULL, NULL, 1,  33.00,  '2023-06-19 10:52:40',  '2023-06-19 10:52:40'),
(170, 'ord-2959', 4,  37, 0,  NULL, NULL, 1,  0.00, '2023-06-19 10:52:43',  '2023-06-19 10:52:43'),
(171, 'ord-4652', 4,  10, 27, NULL, NULL, 1,  4.00, '2023-06-19 10:54:42',  '2023-06-19 10:54:42'),
(172, 'ord-4652', 4,  37, 0,  NULL, NULL, 1,  0.00, '2023-06-19 10:54:45',  '2023-06-19 10:54:45'),
(173, 'ord-3638', 31, 1,  47, 198,  NULL, 1,  7.00, '2023-06-19 11:01:38',  '2023-06-19 11:01:38'),
(174, 'ord-3638', 31, 37, 0,  NULL, NULL, 1,  0.00, '2023-06-19 11:02:12',  '2023-06-19 11:02:12'),
(175, 'ord-6010', 31, 12, 32, 200,  NULL, 1,  78.00,  '2023-06-19 11:31:13',  '2023-06-19 11:31:13'),
(176, 'ord-6010', 31, 37, 0,  NULL, NULL, 1,  0.00, '2023-06-19 11:31:56',  '2023-06-19 11:31:56');

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


-- 2023-06-19 13:20:04