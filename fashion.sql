-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 05, 2018 lúc 07:49 PM
-- Phiên bản máy phục vụ: 10.1.30-MariaDB
-- Phiên bản PHP: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `fashion`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attributes`
--

CREATE TABLE `attributes` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regular_price` double NOT NULL DEFAULT '0',
  `sale_price` double NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute_languages`
--

CREATE TABLE `attribute_languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `parent`, `image`, `alt`, `icon`, `priority`, `status`, `type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 0, NULL, NULL, NULL, 0, 'publish', 'default', NULL, NULL, NULL),
(2, 0, NULL, NULL, NULL, 1, 'publish', 'san-pham', NULL, '2018-06-29 17:26:08', '2018-06-29 17:26:08'),
(3, 0, NULL, NULL, NULL, 2, 'publish', 'san-pham', NULL, '2018-06-29 17:26:21', '2018-06-29 17:26:21'),
(4, 0, NULL, NULL, NULL, 3, 'publish', 'san-pham', NULL, '2018-06-29 17:28:09', '2018-06-29 17:28:09'),
(5, 0, NULL, NULL, NULL, 4, 'publish', 'san-pham', NULL, '2018-06-29 17:28:19', '2018-06-29 17:28:19'),
(6, 2, NULL, NULL, NULL, 1, 'publish,index', 'san-pham', NULL, '2018-06-29 18:03:16', '2018-06-29 18:03:21'),
(7, 0, NULL, NULL, NULL, 1, 'publish', 'tin-tuc', NULL, '2018-06-30 16:01:24', '2018-06-30 16:01:24'),
(8, 3, NULL, NULL, NULL, 1, 'index,publish', 'san-pham', NULL, '2018-07-05 17:06:22', '2018-07-05 17:06:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_languages`
--

CREATE TABLE `category_languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `contents` longtext COLLATE utf8mb4_unicode_ci,
  `meta_seo` text COLLATE utf8mb4_unicode_ci,
  `language` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category_languages`
--

INSERT INTO `category_languages` (`id`, `title`, `slug`, `description`, `contents`, `meta_seo`, `language`, `category_id`) VALUES
(1, 'Uncategorized', 'uncategorized', NULL, NULL, NULL, 'vi', 1),
(2, 'Uncategorized', 'uncategorized', NULL, NULL, NULL, 'en', 1),
(3, 'Thời trang nam', 'thoi-trang-nam', NULL, NULL, '{\"title\":null,\"keywords\":null,\"description\":null}', 'vi', 2),
(4, 'Thời trang nữ', 'thoi-trang-nu', NULL, NULL, '{\"title\":null,\"keywords\":null,\"description\":null}', 'vi', 3),
(5, 'Couple', 'couple', NULL, NULL, '{\"title\":null,\"keywords\":null,\"description\":null}', 'vi', 4),
(6, 'Phụ kiện', 'phu-kien', NULL, NULL, '{\"title\":null,\"keywords\":null,\"description\":null}', 'vi', 5),
(7, 'Áo thun nam', 'ao-thun-nam', NULL, NULL, '{\"title\":null,\"keywords\":null,\"description\":null}', 'vi', 6),
(8, 'Danh mục tin tức 1', 'danh-muc-tin-tuc-1', NULL, NULL, '{\"title\":null,\"keywords\":null,\"description\":null}', 'vi', 7),
(9, 'Áo thun nữ', 'ao-thun-nu', NULL, NULL, '{\"title\":null,\"keywords\":null,\"description\":null}', 'vi', 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `contents` longtext COLLATE utf8mb4_unicode_ci,
  `rating` tinyint(4) NOT NULL DEFAULT '1',
  `like` int(11) NOT NULL DEFAULT '0',
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `post_id` int(10) UNSIGNED DEFAULT NULL,
  `member_id` int(10) UNSIGNED DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `coupon_amount` double NOT NULL DEFAULT '0',
  `number_of_uses` int(11) NOT NULL DEFAULT '0',
  `min_restriction_amount` double NOT NULL DEFAULT '0',
  `max_restriction_amount` double NOT NULL DEFAULT '0',
  `change_conditions_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `begin_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `used` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_permission` text COLLATE utf8mb4_unicode_ci,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `links`
--

CREATE TABLE `links` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `links`
--

INSERT INTO `links` (`id`, `email`, `phone`, `facebook`, `skype`, `youtube`, `icon`, `link`, `image`, `alt`, `priority`, `status`, `type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, '<i class=\"fa fa-facebook\"></i>', NULL, NULL, NULL, 1, 'publish', 'social', NULL, '2018-06-30 17:14:40', '2018-06-30 17:14:40'),
(2, NULL, NULL, NULL, NULL, NULL, '<i class=\"fa fa-twitter\"></i>', NULL, NULL, NULL, 2, 'publish', 'social', NULL, '2018-06-30 17:16:48', '2018-06-30 17:16:48'),
(3, NULL, NULL, NULL, NULL, NULL, '<i class=\"fa fa-google-plus\"></i>', NULL, NULL, NULL, 3, 'publish', 'social', NULL, '2018-06-30 17:17:13', '2018-06-30 17:17:13'),
(4, NULL, NULL, NULL, NULL, NULL, '<i class=\"fa fa-skype\"></i>', NULL, NULL, NULL, 4, 'publish', 'social', NULL, '2018-06-30 17:17:48', '2018-06-30 17:17:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `link_languages`
--

CREATE TABLE `link_languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `language` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `link_languages`
--

INSERT INTO `link_languages` (`id`, `title`, `description`, `language`, `link_id`) VALUES
(1, 'Facebook', NULL, 'vi', 1),
(2, 'Twitter', NULL, 'vi', 2),
(3, 'Google plus', NULL, 'vi', 3),
(4, 'Skype', NULL, 'vi', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `media_libraries`
--

CREATE TABLE `media_libraries` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` int(11) NOT NULL DEFAULT '0',
  `editor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `mime_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oauth_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oauth_provider` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `member_password_resets`
--

CREATE TABLE `member_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_03_16_000000_create_members_table', 1),
(4, '2017_03_16_030417_create_member_password_resets_table', 1),
(5, '2017_06_22_030237_create_categories_table', 1),
(6, '2017_06_22_041225_create_category_languages_table', 1),
(7, '2017_06_28_030237_create_suppliers_table', 1),
(8, '2017_07_12_074145_create_products_table', 1),
(9, '2017_07_13_022922_create_product_languages_table', 1),
(10, '2017_07_19_022148_create_attributes_table', 1),
(11, '2017_07_19_043215_create_attribute_languages_table', 1),
(12, '2017_08_05_022238_create_product_attribute_relation_table', 1),
(13, '2017_10_02_032249_create_media_libraries_table', 1),
(14, '2017_12_22_064219_create_posts_table', 1),
(15, '2017_12_22_064418_create_post_languages_table', 1),
(16, '2017_12_22_064447_create_post_attribute_table', 1),
(17, '2017_12_23_184911_create_pages_table', 1),
(18, '2017_12_23_185000_create_page_languages_table', 1),
(19, '2017_12_25_154609_create_photos_table', 1),
(20, '2017_12_25_154624_create_photo_languages_table', 1),
(21, '2017_12_26_092247_create_settings_table', 1),
(22, '2018_01_02_044342_entrust_setup_tables', 1),
(23, '2018_01_09_154609_create_links_table', 1),
(24, '2018_01_09_154624_create_link_languages_table', 1),
(25, '2018_01_10_165341_create_registers_table', 1),
(26, '2018_01_14_160014_create_comments_table', 1),
(27, '2018_02_05_045759_create_coupons_table', 1),
(28, '2018_02_09_082208_create_orders_table', 1),
(29, '2018_02_22_074012_create_wms_stores_table', 1),
(30, '2018_02_23_024649_create_wms_imports_table', 1),
(31, '2018_03_01_061244_create_wms_exports_table', 1),
(32, '2018_03_07_014847_create_groups_table', 1),
(33, '2018_03_08_013630_create_user_group_relation_table', 1),
(34, '2018_03_16_014803_create_jobs_table', 1),
(35, '2018_06_19_205106_create_wms_import_details_table', 1),
(36, '2018_06_19_211210_create_wms_export_details_table', 1),
(37, '2018_06_19_211448_create_order_details_table', 1),
(38, '2018_06_23_224521_create_seos_table', 1),
(39, '2018_06_23_224741_create_seo_languages_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_amount` int(11) NOT NULL DEFAULT '0',
  `shipping` int(11) NOT NULL DEFAULT '0',
  `subtotal` double NOT NULL DEFAULT '0',
  `order_qty` int(11) NOT NULL DEFAULT '0',
  `order_price` double NOT NULL DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `district_id` int(11) NOT NULL DEFAULT '0',
  `province_id` int(11) NOT NULL DEFAULT '0',
  `payment_id` int(11) NOT NULL DEFAULT '0',
  `member_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_qty` int(11) NOT NULL DEFAULT '0',
  `product_price` double NOT NULL DEFAULT '0',
  `size_id` int(11) NOT NULL DEFAULT '0',
  `size_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_id` int(11) NOT NULL DEFAULT '0',
  `color_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viewed` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `pages`
--

INSERT INTO `pages` (`id`, `link`, `image`, `alt`, `priority`, `status`, `type`, `viewed`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, 1, 'publish', 'gioi-thieu', 0, NULL, NULL, NULL),
(2, NULL, NULL, NULL, 1, 'publish', 'tuyen-dung', 0, NULL, NULL, NULL),
(3, NULL, NULL, NULL, 1, 'publish', 'lien-he', 0, NULL, NULL, NULL),
(4, NULL, NULL, NULL, 1, 'publish', 'footer', 0, NULL, NULL, '2018-07-01 06:20:02'),
(5, NULL, '2018-07/single-img.jpg', NULL, 1, 'publish', 'san-pham-moi', 0, NULL, '2018-07-02 15:26:29', '2018-07-02 15:37:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `page_languages`
--

CREATE TABLE `page_languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `contents` longtext COLLATE utf8mb4_unicode_ci,
  `meta_seo` text COLLATE utf8mb4_unicode_ci,
  `language` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `page_languages`
--

INSERT INTO `page_languages` (`id`, `title`, `slug`, `description`, `contents`, `meta_seo`, `language`, `page_id`) VALUES
(1, 'Giới thiệu', 'gioi-thieu', NULL, NULL, NULL, 'vi', 1),
(2, 'Giới thiệu', 'gioi-thieu', NULL, NULL, NULL, 'en', 1),
(3, 'Tuyển dụng', 'tuyen-dung', NULL, NULL, NULL, 'vi', 2),
(4, 'Tuyển dụng', 'tuyen-dung', NULL, NULL, NULL, 'en', 2),
(5, 'Liên hệ', 'lien-he', NULL, NULL, NULL, 'vi', 3),
(6, 'Liên hệ', 'lien-he', NULL, NULL, NULL, 'en', 3),
(7, 'Footer', 'footer', NULL, '<p>We are a creative company that specializes in strategy & design. We like to create things with like - minded people who are serious about their passions.</p>', NULL, 'vi', 4),
(8, 'Footer', 'footer', NULL, NULL, NULL, 'en', 4),
(9, 'Sản phẩm mới', 'san-pham-moi', 'Lorem ipsum dolor sit amet, consectetur adipisc elit Nam mattis sapien a ipsum dapibus Ut nec massadui maecenas vel justo ipsum tincidunt tempor.', NULL, '{\"title\":null,\"keywords\":null,\"description\":null}', 'vi', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `photos`
--

CREATE TABLE `photos` (
  `id` int(10) UNSIGNED NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `photos`
--

INSERT INTO `photos` (`id`, `link`, `image`, `alt`, `priority`, `status`, `type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'https://google.com.vn', '2018-07/slider-1.jpg', NULL, 1, 'publish', 'slideshow', NULL, '2018-07-01 05:39:18', '2018-07-03 15:13:34'),
(2, NULL, '2018-07/slider-2.jpg', NULL, 2, 'publish', 'slideshow', NULL, '2018-07-01 05:40:34', '2018-07-01 05:40:34'),
(3, NULL, '2018-07/banner1.jpg', 'Label banner 1', 1, 'publish', 'banner', NULL, '2018-07-05 17:27:04', '2018-07-05 17:41:55'),
(4, NULL, '2018-07/banner2.jpg', 'Label banner 2', 2, 'publish', 'banner', NULL, '2018-07-05 17:27:16', '2018-07-05 17:42:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `photo_languages`
--

CREATE TABLE `photo_languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `language` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `photo_languages`
--

INSERT INTO `photo_languages` (`id`, `title`, `description`, `language`, `photo_id`) VALUES
(1, 'Fashion store', 'Lorem ipsum dolor sit amet, consectetur adipisc elit', 'vi', 1),
(2, NULL, NULL, 'vi', 2),
(3, 'Banner 1', NULL, 'vi', 3),
(4, 'Banner 2', NULL, 'vi', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachments` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `category_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viewed` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `link`, `image`, `alt`, `attachments`, `priority`, `status`, `category_id`, `user_id`, `type`, `viewed`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(2, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(3, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(4, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(5, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(6, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(7, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(8, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(9, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(10, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(11, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(12, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(13, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(14, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(15, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(16, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(17, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(18, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(19, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(20, NULL, NULL, NULL, NULL, 1, 'publish', 1, 1, 'tin-tuc', 0, NULL, '2018-06-29 15:43:53', '2018-06-29 15:43:53'),
(21, NULL, '2018-07/portfolio1.jpg', NULL, '', 1, 'publish', 1, 1, 'bo-suu-tap', 0, NULL, '2018-07-05 15:22:12', '2018-07-05 15:33:54'),
(22, NULL, '2018-07/portfolio2.jpg', NULL, NULL, 1, 'publish', 1, 1, 'bo-suu-tap', 0, NULL, '2018-07-05 15:34:13', '2018-07-05 15:34:13'),
(23, NULL, '2018-07/portfolio3.jpg', NULL, NULL, 1, 'publish', 1, 1, 'bo-suu-tap', 0, NULL, '2018-07-05 15:34:27', '2018-07-05 15:34:27'),
(24, NULL, '2018-07/portfolio4.jpg', NULL, NULL, 1, 'publish', 1, 1, 'bo-suu-tap', 0, NULL, '2018-07-05 15:34:38', '2018-07-05 15:34:38'),
(25, NULL, '2018-07/portfolio5.jpg', NULL, NULL, 1, 'publish', 1, 1, 'bo-suu-tap', 0, NULL, '2018-07-05 15:34:48', '2018-07-05 15:34:48'),
(26, NULL, '2018-07/portfolio6-400x800.jpg', NULL, '', 1, 'publish', 1, 1, 'bo-suu-tap', 0, NULL, '2018-07-05 15:34:59', '2018-07-05 16:24:03'),
(27, NULL, '2018-07/portfolio7.jpg', NULL, NULL, 1, 'publish', 1, 1, 'bo-suu-tap', 0, NULL, '2018-07-05 15:35:11', '2018-07-05 15:35:11'),
(28, NULL, '2018-07/portfolio8.jpg', NULL, NULL, 1, 'publish', 1, 1, 'bo-suu-tap', 0, NULL, '2018-07-05 15:35:22', '2018-07-05 15:35:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_attribute`
--

CREATE TABLE `post_attribute` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL,
  `option` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_languages`
--

CREATE TABLE `post_languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `contents` longtext COLLATE utf8mb4_unicode_ci,
  `attributes` text COLLATE utf8mb4_unicode_ci,
  `meta_seo` text COLLATE utf8mb4_unicode_ci,
  `language` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post_languages`
--

INSERT INTO `post_languages` (`id`, `title`, `slug`, `description`, `contents`, `attributes`, `meta_seo`, `language`, `post_id`) VALUES
(1, 'Seth Effertz PhD', 'seth-effertz-phd', 'Vero exercitationem adipisci ipsum molestiae. Ut aspernatur voluptatem ea voluptate ut. Quae totam est cupiditate officiis quo nulla. Magnam excepturi nemo tempora sed.', 'Voluptates consequatur voluptate vitae voluptas sed deserunt. Sed soluta eligendi iste sequi dignissimos veniam placeat. Sunt iste expedita minima. Omnis autem labore qui placeat non et autem.', NULL, '{\"title\":\"Seth Effertz PhD\",\"keywords\":\"Seth Effertz PhD\",\"description\":\"Seth Effertz PhD\"}', 'vi', 1),
(2, 'Arlene Simonis Jr.', 'arlene-simonis-jr', 'Quisquam quidem repudiandae suscipit aut sit. Nihil accusantium nulla magni nostrum sunt cupiditate. Quam neque quidem laboriosam illo pariatur. Sit cupiditate est voluptatem.', 'Fugit ipsum accusamus vero libero et sequi quibusdam ullam. Et enim enim voluptate similique.', NULL, '{\"title\":\"Arlene Simonis Jr.\",\"keywords\":\"Arlene Simonis Jr.\",\"description\":\"Arlene Simonis Jr.\"}', 'en', 1),
(3, 'Ms. Gisselle Dietrich Sr.', 'ms-gisselle-dietrich-sr', 'Cupiditate consequatur vel aut inventore voluptas enim. Et facilis neque veniam est. Sunt ut aut officia iusto.', 'Hic assumenda quia aut dolorum expedita omnis. Qui id hic tempora voluptatum blanditiis sit. Dolor et laborum consequatur veniam non. Sint amet ut in natus voluptas sed commodi rerum.', NULL, '{\"title\":\"Ms. Gisselle Dietrich Sr.\",\"keywords\":\"Ms. Gisselle Dietrich Sr.\",\"description\":\"Ms. Gisselle Dietrich Sr.\"}', 'vi', 2),
(4, 'Gabrielle Runolfsdottir', 'gabrielle-runolfsdottir', 'Possimus nulla illo unde rerum. Dignissimos qui error fugit iusto. Consectetur et cupiditate aspernatur dolorem ea asperiores.', 'Excepturi omnis a rerum nesciunt expedita. Minima aut hic aut excepturi at aliquam. Quasi quia atque animi voluptate voluptatem necessitatibus. Nostrum iure sit delectus quae.', NULL, '{\"title\":\"Gabrielle Runolfsdottir\",\"keywords\":\"Gabrielle Runolfsdottir\",\"description\":\"Gabrielle Runolfsdottir\"}', 'en', 2),
(5, 'Ms. Fleta Medhurst', 'ms-fleta-medhurst', 'Veritatis similique tempore ipsa officiis. Qui voluptatem dignissimos consequuntur debitis officiis. Accusantium sit saepe commodi illum pariatur magnam est.', 'Dolor quia ea et dolorem est. Quo delectus perferendis praesentium qui consequatur vel. Eum nemo aut eveniet ut doloribus tenetur ut. Voluptatem harum soluta nesciunt explicabo alias.', NULL, '{\"title\":\"Ms. Fleta Medhurst\",\"keywords\":\"Ms. Fleta Medhurst\",\"description\":\"Ms. Fleta Medhurst\"}', 'vi', 3),
(6, 'Aliyah Franecki', 'aliyah-franecki', 'Doloribus consequatur error sit officia sed. Impedit dicta quaerat numquam rem harum pariatur cum autem. Quo sed magni libero deserunt consequatur exercitationem quia.', 'Ad non quis ipsa omnis. Ad impedit unde cum fugiat numquam. Consequatur id ut ea sint doloremque qui.', NULL, '{\"title\":\"Aliyah Franecki\",\"keywords\":\"Aliyah Franecki\",\"description\":\"Aliyah Franecki\"}', 'en', 3),
(7, 'Casper Brown', 'casper-brown', 'Accusantium vel ducimus quas sint quia. Laboriosam provident rerum et cumque nam pariatur ipsam. Impedit ut delectus nihil vel illo ut.', 'Quam animi enim illum sequi iusto. In consequatur omnis adipisci. Dolore numquam est alias provident alias corrupti sint.', NULL, '{\"title\":\"Casper Brown\",\"keywords\":\"Casper Brown\",\"description\":\"Casper Brown\"}', 'vi', 4),
(8, 'Darlene Feest', 'darlene-feest', 'Et eos saepe sapiente nesciunt nihil ut explicabo. At laboriosam sequi consequatur corporis perspiciatis numquam. Quia tempore omnis quis eos et id harum. Iure magni est saepe incidunt.', 'Dolores ut ab quibusdam consequatur. Consequuntur temporibus quod iure. Nobis soluta officiis modi consequuntur ratione maxime.', NULL, '{\"title\":\"Darlene Feest\",\"keywords\":\"Darlene Feest\",\"description\":\"Darlene Feest\"}', 'en', 4),
(9, 'Willie Daniel PhD', 'willie-daniel-phd', 'Et libero rem eos explicabo culpa ullam consequatur molestiae. Reiciendis omnis rerum voluptatem dolores dolor. Voluptatem saepe est deleniti porro error atque et. Voluptas praesentium ut vero ut.', 'Nesciunt cupiditate aut nesciunt blanditiis autem autem. In sint ab optio quia iusto sint ipsum quis. Quae recusandae commodi nesciunt quaerat voluptatibus libero optio.', NULL, '{\"title\":\"Willie Daniel PhD\",\"keywords\":\"Willie Daniel PhD\",\"description\":\"Willie Daniel PhD\"}', 'vi', 5),
(10, 'Dr. Bernhard Ritchie', 'dr-bernhard-ritchie', 'Aut praesentium cum id et nihil quod consectetur. Debitis omnis porro nihil vero ipsa. Beatae qui quia at nam asperiores et.', 'Ab sed veritatis numquam. Error minima autem aut atque commodi. Atque voluptatibus ipsa adipisci aut vitae et. Non ratione perferendis tenetur laudantium quisquam dolorem.', NULL, '{\"title\":\"Dr. Bernhard Ritchie\",\"keywords\":\"Dr. Bernhard Ritchie\",\"description\":\"Dr. Bernhard Ritchie\"}', 'en', 5),
(11, 'Henry Ebert', 'henry-ebert', 'Qui quae voluptas inventore in dolor aut. Odit at ut ut voluptatem dolorem illum ratione. Eaque recusandae autem ipsum. Amet nemo facilis ad aspernatur dolorem quaerat.', 'Eligendi adipisci libero dolore et quod quis numquam natus. Autem et impedit eum eos. Harum culpa maxime consequuntur nesciunt quia. Eaque animi aut qui temporibus. Delectus consequatur et sunt repellendus consequatur sed dolorum.', NULL, '{\"title\":\"Henry Ebert\",\"keywords\":\"Henry Ebert\",\"description\":\"Henry Ebert\"}', 'vi', 6),
(12, 'Marley Smitham', 'marley-smitham', 'Sint voluptatem excepturi qui quis maxime. Placeat in est sed officiis aspernatur. Ut in doloremque perferendis quos error.', 'Odit eius facilis distinctio. Quas officiis est unde et incidunt. Dolores at illo nam qui et.', NULL, '{\"title\":\"Marley Smitham\",\"keywords\":\"Marley Smitham\",\"description\":\"Marley Smitham\"}', 'en', 6),
(13, 'Muhammad Goldner', 'muhammad-goldner', 'Nam tempora a et praesentium qui. Aut cumque omnis nulla officia excepturi voluptates et.', 'Deleniti natus quis dignissimos saepe sequi quia odio. Officiis ipsa voluptatem non doloribus animi ducimus cum rerum. Odit quis qui qui odit aut veritatis. Numquam unde repudiandae occaecati veniam architecto. Aut soluta officiis eum.', NULL, '{\"title\":\"Muhammad Goldner\",\"keywords\":\"Muhammad Goldner\",\"description\":\"Muhammad Goldner\"}', 'vi', 7),
(14, 'Jeffery Casper', 'jeffery-casper', 'Officiis dolorum harum provident. Sed exercitationem non pariatur eum. Magnam voluptatem doloremque reiciendis nobis aliquid incidunt animi. Corrupti dicta et non aspernatur cum aut non.', 'Sint aut pariatur voluptas quaerat error exercitationem. Ipsum vel corporis eos est nihil voluptatem illum. Vel neque porro placeat quam quod cumque. Velit totam expedita voluptates tempora sunt aut.', NULL, '{\"title\":\"Jeffery Casper\",\"keywords\":\"Jeffery Casper\",\"description\":\"Jeffery Casper\"}', 'en', 7),
(15, 'Lilly Berge', 'lilly-berge', 'Nemo laborum ut eveniet veritatis ut et. Magnam veniam voluptatem velit accusamus. Unde qui corporis eaque quis quisquam est perspiciatis. Dolorem et voluptatum autem.', 'Nihil ipsa ex soluta enim voluptatem sit accusamus molestiae. Voluptate aut architecto aut cum rerum.', NULL, '{\"title\":\"Lilly Berge\",\"keywords\":\"Lilly Berge\",\"description\":\"Lilly Berge\"}', 'vi', 8),
(16, 'Braden Reichel', 'braden-reichel', 'Adipisci debitis et libero qui et. Sed qui ea reprehenderit vel qui. Expedita non ipsa eum aut. Consequatur facere et nobis. Ut assumenda repudiandae aut vel aliquid commodi fuga.', 'Odio praesentium exercitationem inventore rerum. Modi quis quam facere occaecati eum. Quia ut quis adipisci sunt ea mollitia.', NULL, '{\"title\":\"Braden Reichel\",\"keywords\":\"Braden Reichel\",\"description\":\"Braden Reichel\"}', 'en', 8),
(17, 'Mortimer Koss', 'mortimer-koss', 'Dolore modi consequatur doloribus sed consequatur voluptas eum. Est illum deserunt commodi sequi assumenda. Vel nam alias asperiores debitis.', 'Sapiente eius veniam rerum modi quod sit quod. Doloremque nostrum voluptas at sed. Delectus at tempore illum corporis illo beatae fuga.', NULL, '{\"title\":\"Mortimer Koss\",\"keywords\":\"Mortimer Koss\",\"description\":\"Mortimer Koss\"}', 'vi', 9),
(18, 'Prof. Kendrick Jacobi IV', 'prof-kendrick-jacobi-iv', 'Temporibus itaque iure possimus. Atque id nemo dolores iste enim. Numquam inventore officiis quas corporis autem aut.', 'Non autem facilis perferendis id consectetur. Voluptatum expedita dolor ut atque. Distinctio quia laboriosam placeat. Fuga hic voluptatem nobis sed accusantium.', NULL, '{\"title\":\"Prof. Kendrick Jacobi IV\",\"keywords\":\"Prof. Kendrick Jacobi IV\",\"description\":\"Prof. Kendrick Jacobi IV\"}', 'en', 9),
(19, 'Leila Erdman', 'leila-erdman', 'Maiores cupiditate doloribus asperiores magni ipsam. Consequatur nam libero eaque rerum. Consequatur necessitatibus rerum id vero velit dolore iure iste.', 'Consequuntur unde ut adipisci perspiciatis veritatis unde cumque. Sapiente ex expedita laboriosam. Itaque excepturi vel maiores enim non cum.', NULL, '{\"title\":\"Leila Erdman\",\"keywords\":\"Leila Erdman\",\"description\":\"Leila Erdman\"}', 'vi', 10),
(20, 'Estrella Goyette Jr.', 'estrella-goyette-jr', 'Recusandae facilis corporis quo aspernatur sequi. Earum architecto sit omnis. Sed sunt ea rerum vel molestiae impedit. Et ut impedit cupiditate explicabo tenetur id omnis voluptas.', 'Suscipit ullam earum sint dignissimos. Velit id consequatur voluptatem voluptas sed recusandae repellendus veritatis. Tempora quisquam quam laboriosam sed occaecati eum qui.', NULL, '{\"title\":\"Estrella Goyette Jr.\",\"keywords\":\"Estrella Goyette Jr.\",\"description\":\"Estrella Goyette Jr.\"}', 'en', 10),
(21, 'Prof. Rosalind Nitzsche II', 'prof-rosalind-nitzsche-ii', 'Animi deleniti maxime consequatur distinctio unde ut. Recusandae aliquid asperiores voluptatum at. Minus nobis animi laudantium minima earum soluta autem rem.', 'Voluptatem occaecati inventore occaecati aut et fugiat ea. Quisquam dolor quibusdam temporibus vitae aut provident aut. Impedit voluptas aperiam quo est. Recusandae aut ut saepe id ut.', NULL, '{\"title\":\"Prof. Rosalind Nitzsche II\",\"keywords\":\"Prof. Rosalind Nitzsche II\",\"description\":\"Prof. Rosalind Nitzsche II\"}', 'vi', 11),
(22, 'Mrs. Jazlyn O\'Conner', 'mrs-jazlyn-oconner', 'Voluptates et eligendi ut et sed excepturi commodi. Rem harum earum libero quis. Qui consequatur quo quae velit quidem consequatur accusamus. Esse vel sed ducimus ab.', 'Unde rerum sit esse optio dolores odio ratione. Sit laudantium aperiam tempora. Exercitationem officia est iste ipsum est corporis. Soluta magni occaecati consequatur nam nesciunt.', NULL, '{\"title\":\"Mrs. Jazlyn O\'Conner\",\"keywords\":\"Mrs. Jazlyn O\'Conner\",\"description\":\"Mrs. Jazlyn O\'Conner\"}', 'en', 11),
(23, 'Casimir Purdy', 'casimir-purdy', 'Consectetur unde ex quas est. Autem quaerat eius non ut possimus. Incidunt dolores amet impedit et. Exercitationem neque explicabo dolorem eveniet.', 'Provident velit explicabo beatae iure fugiat quia. Earum tempore dolores est a.', NULL, '{\"title\":\"Casimir Purdy\",\"keywords\":\"Casimir Purdy\",\"description\":\"Casimir Purdy\"}', 'vi', 12),
(24, 'Dortha Altenwerth', 'dortha-altenwerth', 'Est numquam explicabo qui quos corrupti in officiis sed. Et dolor eligendi ut ullam. Alias vel sapiente tempore. Architecto optio voluptas qui eos odit.', 'Sit enim ducimus qui. Dolorem sint vero ut. Nihil sunt inventore aut est et.', NULL, '{\"title\":\"Dortha Altenwerth\",\"keywords\":\"Dortha Altenwerth\",\"description\":\"Dortha Altenwerth\"}', 'en', 12),
(25, 'Gideon Jacobs MD', 'gideon-jacobs-md', 'Quo dignissimos qui perferendis consectetur omnis quos. Reprehenderit sed asperiores velit consequatur inventore. Unde rem id voluptate occaecati mollitia odit quasi.', 'Rem quia beatae ad. Eligendi libero enim omnis. Vero pariatur corporis magni rerum enim pariatur. Aliquid ducimus voluptatem pariatur ea totam veritatis minus.', NULL, '{\"title\":\"Gideon Jacobs MD\",\"keywords\":\"Gideon Jacobs MD\",\"description\":\"Gideon Jacobs MD\"}', 'vi', 13),
(26, 'Nadia Tillman', 'nadia-tillman', 'Mollitia reprehenderit molestiae nihil qui voluptatem. Sit facere vel necessitatibus odio. Quo culpa ut temporibus enim.', 'Voluptas labore facere dolores dolores minus. Odio porro dolores aut corporis aspernatur qui excepturi quis. Mollitia sint veniam consequatur aut aut non. Corrupti rerum architecto est unde in debitis sit. Quia incidunt libero minus ipsum.', NULL, '{\"title\":\"Nadia Tillman\",\"keywords\":\"Nadia Tillman\",\"description\":\"Nadia Tillman\"}', 'en', 13),
(27, 'Angie Smith', 'angie-smith', 'Reiciendis enim aut nam iusto sunt ut qui veritatis. Tempore numquam praesentium dolorem qui possimus accusantium. Nostrum asperiores assumenda inventore reiciendis.', 'Praesentium numquam non pariatur nihil. Dolorem vel est nisi ullam architecto quaerat. Culpa vero ex quos exercitationem numquam hic.', NULL, '{\"title\":\"Angie Smith\",\"keywords\":\"Angie Smith\",\"description\":\"Angie Smith\"}', 'vi', 14),
(28, 'Prof. Carson DuBuque', 'prof-carson-dubuque', 'Enim mollitia ut magnam ex voluptas voluptatem. Rerum non omnis quia iusto voluptates. Aliquid quasi corporis quos ipsam veniam aliquid eos. Esse quod commodi ad ut neque aliquam et reiciendis.', 'Cum temporibus veniam placeat nam quasi ipsa. Nemo similique minima sed temporibus et asperiores. Laboriosam aut consequuntur et. Possimus deserunt nihil qui molestias perferendis quia.', NULL, '{\"title\":\"Prof. Carson DuBuque\",\"keywords\":\"Prof. Carson DuBuque\",\"description\":\"Prof. Carson DuBuque\"}', 'en', 14),
(29, 'Avery Hintz', 'avery-hintz', 'Harum est quisquam nulla laborum quisquam. Commodi et amet aut sed. Nulla et omnis tenetur possimus ratione placeat non labore.', 'Aut ea nobis placeat et eos ipsa distinctio. Quasi quibusdam tempore autem tempore cumque dolores. Atque expedita quis sit delectus. Quae earum fugiat quasi fuga quia.', NULL, '{\"title\":\"Avery Hintz\",\"keywords\":\"Avery Hintz\",\"description\":\"Avery Hintz\"}', 'vi', 15),
(30, 'Missouri Ferry DDS', 'missouri-ferry-dds', 'Labore architecto quae qui dolor qui sit sint. Ea itaque quo quasi natus earum in iusto. Aut laudantium impedit voluptates id incidunt error. Ea voluptas maxime qui ut et.', 'Distinctio quasi labore autem et id. Voluptas eos blanditiis quod. Omnis harum velit qui. Quas atque ea suscipit quidem iusto.', NULL, '{\"title\":\"Missouri Ferry DDS\",\"keywords\":\"Missouri Ferry DDS\",\"description\":\"Missouri Ferry DDS\"}', 'en', 15),
(31, 'Amalia Goyette', 'amalia-goyette', 'Voluptatibus atque ad aut ad ut. Mollitia quae nesciunt reiciendis aliquam fuga. Cumque et eligendi nulla sint facilis deleniti ea.', 'Et earum ipsam aut repellat inventore facere non. Eum rerum adipisci eum. Rerum inventore sint odio quia sit. Quis eos aut ea labore optio et ipsa.', NULL, '{\"title\":\"Amalia Goyette\",\"keywords\":\"Amalia Goyette\",\"description\":\"Amalia Goyette\"}', 'vi', 16),
(32, 'Prof. Kenna Powlowski', 'prof-kenna-powlowski', 'Beatae iusto sint ipsa voluptate illum. Vel et minima et voluptas ea. Aut eum voluptates et excepturi et laudantium iste. Numquam beatae qui maiores amet dicta placeat rerum itaque.', 'Magni necessitatibus fugit ipsum consequatur. Eaque distinctio eum odit eos et. Tenetur dolor ut sint id numquam repellendus molestiae. Eum aut voluptatibus adipisci ipsam.', NULL, '{\"title\":\"Prof. Kenna Powlowski\",\"keywords\":\"Prof. Kenna Powlowski\",\"description\":\"Prof. Kenna Powlowski\"}', 'en', 16),
(33, 'Imani Terry', 'imani-terry', 'Ipsum natus veniam autem quam autem. Ut molestiae excepturi quia nostrum. Numquam odit ipsam quasi necessitatibus qui cupiditate.', 'Ab quia voluptatibus qui aut et. Amet et porro repellendus ad.', NULL, '{\"title\":\"Imani Terry\",\"keywords\":\"Imani Terry\",\"description\":\"Imani Terry\"}', 'vi', 17),
(34, 'Arvilla Jerde', 'arvilla-jerde', 'Incidunt aut mollitia voluptas incidunt eius magni officia facilis. Ut temporibus blanditiis quis nihil voluptatem. Dolorum quod maxime dolores consequatur. Est sint rerum officiis vitae.', 'Ea ut ad debitis veritatis aut. Tempore voluptatibus consequatur sint.', NULL, '{\"title\":\"Arvilla Jerde\",\"keywords\":\"Arvilla Jerde\",\"description\":\"Arvilla Jerde\"}', 'en', 17),
(35, 'Mateo Hegmann', 'mateo-hegmann', 'Ex numquam nihil accusamus laborum consequuntur esse illo. Dolorem iusto commodi numquam. Occaecati id mollitia itaque quas quasi. Eveniet aut ut quia nesciunt officiis.', 'Et voluptatem iusto iusto labore. Asperiores qui amet sint eius distinctio voluptatem. Ut perspiciatis placeat incidunt magnam.', NULL, '{\"title\":\"Mateo Hegmann\",\"keywords\":\"Mateo Hegmann\",\"description\":\"Mateo Hegmann\"}', 'vi', 18),
(36, 'Haylie Lesch', 'haylie-lesch', 'Quaerat nobis dolor consequatur et laborum id. Rerum consequuntur est enim quam. Voluptas voluptates vel porro suscipit voluptatem. Facere non maiores accusamus impedit ut nam.', 'Saepe aliquid itaque laboriosam sed fugiat qui dolor. Ad explicabo quod consequatur maxime eum rerum ducimus.', NULL, '{\"title\":\"Haylie Lesch\",\"keywords\":\"Haylie Lesch\",\"description\":\"Haylie Lesch\"}', 'en', 18),
(37, 'Alda O\'Kon', 'alda-okon', 'Et voluptas nisi ratione omnis. Cum fuga repellendus quia. Voluptatem quos itaque ullam doloremque nesciunt non quaerat.', 'Totam voluptate dolorem quasi facilis fugit. Aut ullam dolorem eveniet labore voluptatem quod illo. Fugit magni ut aut ipsum fugiat ut quo unde. Aut quos ut omnis perspiciatis.', NULL, '{\"title\":\"Alda O\'Kon\",\"keywords\":\"Alda O\'Kon\",\"description\":\"Alda O\'Kon\"}', 'vi', 19),
(38, 'Kenneth Fahey', 'kenneth-fahey', 'Modi sed quae quasi dicta consequuntur in doloremque et. Aut ipsa voluptatem officiis in laborum velit. Adipisci labore sed et veniam dolorem. Laboriosam reiciendis nisi alias sit.', 'Modi sed corporis dolores dolore et. Earum nulla perferendis voluptatibus numquam est libero commodi. Maiores consequatur in cum quas. Atque qui corporis libero praesentium. Est repudiandae iste corrupti esse est.', NULL, '{\"title\":\"Kenneth Fahey\",\"keywords\":\"Kenneth Fahey\",\"description\":\"Kenneth Fahey\"}', 'en', 19),
(39, 'Ms. Kitty Kunde', 'ms-kitty-kunde', 'Tempora vitae aut voluptatem. Fuga ab fuga aperiam facilis at voluptas est. Placeat perspiciatis id tempore ut esse. Autem rem excepturi quam repellendus ipsam illo molestias.', 'Recusandae doloremque quod ipsam quia reiciendis qui blanditiis. Eligendi cupiditate quas ut hic ut animi. Quos sit consectetur et neque aliquid. Reprehenderit minima nisi similique corporis non harum.', NULL, '{\"title\":\"Ms. Kitty Kunde\",\"keywords\":\"Ms. Kitty Kunde\",\"description\":\"Ms. Kitty Kunde\"}', 'vi', 20),
(40, 'Malinda Wintheiser', 'malinda-wintheiser', 'Fugiat porro mollitia doloremque rerum. Ut sit eos reiciendis eligendi amet distinctio. Sunt et at exercitationem dolorem ut sed.', 'Enim totam eum tempore facere ipsam quis. Deleniti distinctio eius omnis dolores quia reprehenderit. Et veritatis incidunt est culpa et.', NULL, '{\"title\":\"Malinda Wintheiser\",\"keywords\":\"Malinda Wintheiser\",\"description\":\"Malinda Wintheiser\"}', 'en', 20),
(41, 'Bộ sưu tập 01', 'bo-suu-tap-01', NULL, NULL, NULL, '{\"title\":null,\"keywords\":null,\"description\":null}', 'vi', 21),
(42, 'Bộ sưu tập 02', 'bo-suu-tap-02', NULL, NULL, NULL, '{\"title\":null,\"keywords\":null,\"description\":null}', 'vi', 22),
(43, 'Bộ sưu tập 03', 'bo-suu-tap-03', NULL, NULL, NULL, '{\"title\":null,\"keywords\":null,\"description\":null}', 'vi', 23),
(44, 'Bộ sưu tập 04', 'bo-suu-tap-04', NULL, NULL, NULL, '{\"title\":null,\"keywords\":null,\"description\":null}', 'vi', 24),
(45, 'Bộ sưu tập 05', 'bo-suu-tap-05', NULL, NULL, NULL, '{\"title\":null,\"keywords\":null,\"description\":null}', 'vi', 25),
(46, 'Bộ sưu tập 06', 'bo-suu-tap-06', NULL, NULL, NULL, '{\"title\":null,\"keywords\":null,\"description\":null}', 'vi', 26),
(47, 'Bộ sưu tập 07', 'bo-suu-tap-07', NULL, NULL, NULL, '{\"title\":null,\"keywords\":null,\"description\":null}', 'vi', 27),
(48, 'Bộ sưu tập 08', 'bo-suu-tap-08', NULL, NULL, NULL, '{\"title\":null,\"keywords\":null,\"description\":null}', 'vi', 28);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regular_price` double NOT NULL DEFAULT '0',
  `sale_price` double NOT NULL DEFAULT '0',
  `original_price` double NOT NULL DEFAULT '0',
  `weight` int(11) NOT NULL DEFAULT '0',
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachments` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `supplier_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viewed` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `code`, `regular_price`, `sale_price`, `original_price`, `weight`, `link`, `image`, `alt`, `attachments`, `priority`, `status`, `supplier_id`, `category_id`, `user_id`, `type`, `viewed`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '299548421', 290000, 200000, 50000, 500, NULL, NULL, NULL, NULL, 1, 'publish', NULL, 1, 1, 'san-pham', 0, NULL, '2018-06-29 15:43:52', '2018-06-29 15:43:52'),
(2, '217', 290000, 200000, 50000, 500, NULL, NULL, NULL, NULL, 1, 'publish', NULL, 1, 1, 'san-pham', 0, NULL, '2018-06-29 15:43:52', '2018-06-29 15:43:52'),
(3, '8425074', 290000, 200000, 50000, 500, NULL, NULL, NULL, NULL, 1, 'publish', NULL, 1, 1, 'san-pham', 0, NULL, '2018-06-29 15:43:52', '2018-06-29 15:43:52'),
(4, '8665', 290000, 200000, 50000, 500, NULL, NULL, NULL, NULL, 1, 'publish', NULL, 1, 1, 'san-pham', 0, NULL, '2018-06-29 15:43:52', '2018-06-29 15:43:52'),
(5, '555879722', 290000, 200000, 50000, 500, NULL, NULL, NULL, NULL, 1, 'publish', NULL, 1, 1, 'san-pham', 0, NULL, '2018-06-29 15:43:52', '2018-06-29 15:43:52'),
(6, '1', 290000, 200000, 50000, 500, NULL, '2018-07/product5.jpg', NULL, '', 1, 'publish,new', NULL, 1, 1, 'san-pham', 0, NULL, '2018-06-29 15:43:52', '2018-07-01 15:46:01'),
(7, '5252', 290000, 200000, 50000, 500, NULL, '2018-07/product4.jpg', NULL, '', 1, 'publish,new', NULL, 1, 1, 'san-pham', 0, NULL, '2018-06-29 15:43:52', '2018-07-01 15:45:39'),
(8, '4', 290000, 200000, 50000, 500, NULL, '2018-07/product3.jpg', NULL, '', 1, 'publish,new', NULL, 1, 1, 'san-pham', 0, NULL, '2018-06-29 15:43:52', '2018-07-01 15:45:13'),
(9, '26855', 290000, 200000, 50000, 500, NULL, '2018-07/product2.jpg', NULL, '', 1, 'publish,new', NULL, 1, 1, 'san-pham', 0, NULL, '2018-06-29 15:43:52', '2018-07-01 15:45:00'),
(10, '77443553', 290000, 200000, 50000, 500, NULL, '2018-07/product1.jpg', NULL, '', 1, 'publish,new', NULL, 1, 1, 'san-pham', 0, NULL, '2018-06-29 15:43:52', '2018-07-01 15:44:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_attribute`
--

CREATE TABLE `product_attribute` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL,
  `option` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_languages`
--

CREATE TABLE `product_languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `contents` longtext COLLATE utf8mb4_unicode_ci,
  `attributes` text COLLATE utf8mb4_unicode_ci,
  `meta_seo` text COLLATE utf8mb4_unicode_ci,
  `language` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_languages`
--

INSERT INTO `product_languages` (`id`, `title`, `slug`, `description`, `contents`, `attributes`, `meta_seo`, `language`, `product_id`) VALUES
(1, 'Loraine Goyette I', 'loraine-goyette-i', 'Praesentium ad et accusantium et asperiores cupiditate. Itaque tenetur perspiciatis voluptas. Eligendi soluta ad ipsam aspernatur consequatur. Repellat voluptate pariatur est in ducimus neque quis.', 'Facere deserunt ut a aut occaecati. Quas accusantium non corrupti officia occaecati. Non voluptatum omnis ut similique.', NULL, '{\"title\":\"Loraine Goyette I\",\"keywords\":\"Loraine Goyette I\",\"description\":\"Loraine Goyette I\"}', 'vi', 1),
(2, 'Prof. Antone Koch DDS', 'prof-antone-koch-dds', 'Sint consequuntur iusto ducimus sed. Ipsam id praesentium aut et expedita repudiandae. Dignissimos rem nisi ratione necessitatibus deleniti.', 'Omnis omnis eius natus labore pariatur. Dolor eveniet dignissimos sequi culpa quos qui. Ut culpa quam quidem et. Inventore consequatur dolores voluptas cumque voluptatem velit.', NULL, '{\"title\":\"Prof. Antone Koch DDS\",\"keywords\":\"Prof. Antone Koch DDS\",\"description\":\"Prof. Antone Koch DDS\"}', 'en', 1),
(3, 'Antonio Bednar', 'antonio-bednar', 'Illum suscipit provident iste hic eum. Eum quisquam est eum illo et. Commodi iste similique sapiente deserunt.', 'Earum blanditiis nemo quasi doloribus veritatis. Adipisci eum sit quidem animi voluptas error voluptatibus. Cumque eum dicta suscipit eum. Repellat nihil quos voluptas nihil dolor quo quia.', NULL, '{\"title\":\"Antonio Bednar\",\"keywords\":\"Antonio Bednar\",\"description\":\"Antonio Bednar\"}', 'vi', 2),
(4, 'Bradley Ritchie', 'bradley-ritchie', 'Vero commodi voluptas soluta eos. Ipsa voluptas quod et consequatur dolor sequi eum. Voluptate cumque ipsa dolorem facere occaecati. At natus magnam doloremque harum dolorum doloremque.', 'Quasi in rem fugiat placeat molestias. Amet dolorem quaerat consectetur deserunt. Placeat aliquid et amet qui facilis qui. Velit consequatur rerum magnam debitis sed hic.', NULL, '{\"title\":\"Bradley Ritchie\",\"keywords\":\"Bradley Ritchie\",\"description\":\"Bradley Ritchie\"}', 'en', 2),
(5, 'Elnora Renner', 'elnora-renner', 'Est consequatur sint sit quo quae distinctio veritatis quo. Repellat quae sed rerum.', 'Minima quia excepturi sint est deserunt dolorem. Aut saepe soluta est numquam sunt. Facere quos ipsum provident nemo alias velit consequatur.', NULL, '{\"title\":\"Elnora Renner\",\"keywords\":\"Elnora Renner\",\"description\":\"Elnora Renner\"}', 'vi', 3),
(6, 'Dr. Aric Upton', 'dr-aric-upton', 'Veritatis neque reprehenderit doloremque. Explicabo harum qui omnis ab voluptatum suscipit quia ipsam. Voluptas accusantium illo omnis quia voluptatem molestiae. Quis voluptatem eum sed nam.', 'Ex et ut quia non doloribus omnis. Laudantium at occaecati iusto laborum. Iure quia ipsam ratione exercitationem incidunt et ut. Iusto eum est repellat ducimus expedita praesentium. Veritatis reprehenderit est aut rem repellat qui.', NULL, '{\"title\":\"Dr. Aric Upton\",\"keywords\":\"Dr. Aric Upton\",\"description\":\"Dr. Aric Upton\"}', 'en', 3),
(7, 'Raphaelle Hansen', 'raphaelle-hansen', 'Commodi ex molestias tempore quasi. Nemo voluptates in aliquid magnam. Alias ut itaque est. Consequatur voluptas est quod optio omnis impedit dolorem. Neque nam animi laborum et ab quia sunt.', 'Corporis est vel harum vero. Quas explicabo ut et tempora laboriosam. Commodi quas debitis sapiente veritatis dignissimos. Accusantium sapiente qui voluptatem quis sit.', NULL, '{\"title\":\"Raphaelle Hansen\",\"keywords\":\"Raphaelle Hansen\",\"description\":\"Raphaelle Hansen\"}', 'vi', 4),
(8, 'Maximo Considine', 'maximo-considine', 'Fuga ut est dolor consequatur pariatur. Sapiente enim eligendi molestiae. Excepturi ut quia eos vel possimus.', 'Repudiandae molestiae saepe aut quia. Temporibus voluptatem dolor non repellendus provident corrupti corrupti. Quidem sunt atque corrupti. Doloribus quas autem sed deserunt sit.', NULL, '{\"title\":\"Maximo Considine\",\"keywords\":\"Maximo Considine\",\"description\":\"Maximo Considine\"}', 'en', 4),
(9, 'Mr. Willy Larson', 'mr-willy-larson', 'Dolor nihil excepturi facilis dignissimos quis. Non eos doloribus tenetur. Est eius ipsa ut blanditiis laboriosam aperiam nesciunt consequatur.', 'Est quibusdam ut molestiae laudantium aut nesciunt consequuntur. Repellendus adipisci rerum quis non dolore voluptatibus ut.', NULL, '{\"title\":\"Mr. Willy Larson\",\"keywords\":\"Mr. Willy Larson\",\"description\":\"Mr. Willy Larson\"}', 'vi', 5),
(10, 'Dr. Dannie Schmidt MD', 'dr-dannie-schmidt-md', 'Repellendus consequatur ab rem soluta. Recusandae perspiciatis tempora maiores et. Ut dolor perspiciatis sequi rerum minima. Est aliquam ut et aut eos expedita quibusdam.', 'Quas qui cumque occaecati iusto distinctio. Nesciunt et a quia est. Neque quis error explicabo non dolorum culpa iusto quod. Corrupti harum ipsam et odio.', NULL, '{\"title\":\"Dr. Dannie Schmidt MD\",\"keywords\":\"Dr. Dannie Schmidt MD\",\"description\":\"Dr. Dannie Schmidt MD\"}', 'en', 5),
(11, 'Tên sản phẩm 5', 'ten-san-pham-5', 'Necessitatibus sed amet libero nam possimus est atque. Et suscipit nemo qui aut. Non et neque ut odio excepturi.', '<p>Esse rerum sint sit iusto placeat. Nulla tempora est deleniti sit blanditiis error ducimus.</p>', '[{\"name\":null,\"value\":null}]', '{\"title\":\"Mr. Tyler Lockman\",\"keywords\":\"Mr. Tyler Lockman\",\"description\":\"Mr. Tyler Lockman\"}', 'vi', 6),
(12, 'Mckenna Hudson', 'mckenna-hudson', 'Magnam natus aspernatur qui aut. Sit enim et quia est quia rem. Explicabo aliquam beatae magnam quaerat tempora. Facere libero cum ut sed dolorem.', 'Officia id vitae praesentium. Odit iste ut error porro et. Aut maxime voluptatem error tenetur illum.', NULL, '{\"title\":\"Mckenna Hudson\",\"keywords\":\"Mckenna Hudson\",\"description\":\"Mckenna Hudson\"}', 'en', 6),
(13, 'Tên sản phẩm 4', 'ten-san-pham-4', 'Quia velit omnis voluptas saepe hic impedit placeat. Et aliquam consequuntur dolorum. Veritatis ut sit ducimus officia saepe ut.', '<p>Quo explicabo eos nulla voluptatibus amet expedita. Quis itaque mollitia eius cum quaerat enim saepe. Sed nihil non omnis asperiores. Numquam aut ullam consectetur.</p>', '[{\"name\":null,\"value\":null}]', '{\"title\":\"Alessia Blanda\",\"keywords\":\"Alessia Blanda\",\"description\":\"Alessia Blanda\"}', 'vi', 7),
(14, 'Tavares Altenwerth', 'tavares-altenwerth', 'Saepe mollitia velit placeat rerum cumque architecto. Magnam est voluptatum vitae ut earum dolore illo qui.', 'Mollitia et nihil possimus at modi et. Necessitatibus sed et quia eligendi temporibus quo. Sapiente atque accusamus aut quia qui nihil quis. Deleniti necessitatibus nostrum maiores quas esse voluptates dolor. Voluptas quas illo qui occaecati.', NULL, '{\"title\":\"Tavares Altenwerth\",\"keywords\":\"Tavares Altenwerth\",\"description\":\"Tavares Altenwerth\"}', 'en', 7),
(15, 'Tên sản phẩm 3', 'ten-san-pham-3', 'Autem hic mollitia natus maiores est sed quo iste. Ea quis enim ut repudiandae. Quod voluptatem ut ipsam.', '<p>Temporibus ut aspernatur consequatur vel est voluptate necessitatibus. Omnis quia hic quibusdam fugiat aspernatur cumque. Non non nulla illo soluta.</p>', '[{\"name\":null,\"value\":null}]', '{\"title\":\"Gwendolyn Abshire\",\"keywords\":\"Gwendolyn Abshire\",\"description\":\"Gwendolyn Abshire\"}', 'vi', 8),
(16, 'Anjali Kessler', 'anjali-kessler', 'Repellat quae consequatur qui rem sed sapiente. Quia dignissimos sint maxime molestiae sunt qui ipsum provident. Doloribus consequatur dignissimos illum corrupti alias.', 'Nihil pariatur architecto sit quas. Et excepturi et alias est dolor tempora cum inventore. Est ea vero incidunt ut. Molestias culpa voluptatum error repudiandae id.', NULL, '{\"title\":\"Anjali Kessler\",\"keywords\":\"Anjali Kessler\",\"description\":\"Anjali Kessler\"}', 'en', 8),
(17, 'Tên sản phẩm 2', 'ten-san-pham-2', 'Sed consequatur et reiciendis cumque maiores. Natus inventore vitae in quia voluptate. Veniam commodi aut doloribus dolorem. Suscipit rerum adipisci perspiciatis sapiente. Aliquid et delectus dicta.', '<p>Est quia in accusamus aut qui quia fugiat. Similique nulla maxime odit odio. Id mollitia animi similique fuga ut iste qui. Fugit quibusdam porro optio ut molestiae inventore sed aut.</p>', '[{\"name\":null,\"value\":null}]', '{\"title\":\"Jade Huel\",\"keywords\":\"Jade Huel\",\"description\":\"Jade Huel\"}', 'vi', 9),
(18, 'Alexie Lang DDS', 'alexie-lang-dds', 'Sunt quasi velit sed. Beatae ut assumenda saepe nisi ut modi. Harum rerum ipsum cupiditate in facilis ut.', 'Officiis consequatur dolorem et delectus enim unde. Aliquam in accusantium sed quo et saepe. Id voluptas rem quod qui ut qui. Dolore odit molestias nulla maxime sapiente eveniet provident.', NULL, '{\"title\":\"Alexie Lang DDS\",\"keywords\":\"Alexie Lang DDS\",\"description\":\"Alexie Lang DDS\"}', 'en', 9),
(19, 'Tên sản phẩm 1', 'ten-san-pham-1', 'Totam eum nobis velit consequatur veritatis at. Ducimus autem autem et facilis. Et corrupti culpa veritatis rem. Sit dolore similique itaque omnis voluptatem voluptatem.', '<p>Voluptas sit laboriosam in ut eos in. Omnis voluptatem eveniet ipsa eius. Consequatur neque ad sit consequuntur temporibus incidunt. Ex et ut reprehenderit optio eum et doloribus.</p>', '[{\"name\":null,\"value\":null}]', '{\"title\":\"Prof. Casey Terry PhD\",\"keywords\":\"Prof. Casey Terry PhD\",\"description\":\"Prof. Casey Terry PhD\"}', 'vi', 10),
(20, 'Mr. Chelsey Kshlerin DVM', 'mr-chelsey-kshlerin-dvm', 'Dolorem et nihil exercitationem cum qui. A et velit deleniti delectus voluptas vitae debitis. Culpa vitae quasi tempore maiores. Et consequatur beatae doloremque.', 'Temporibus sed ipsa et quia. Dolor numquam aut magni officia ut nam. Dolor et unde atque veritatis inventore consequatur quibusdam.', NULL, '{\"title\":\"Mr. Chelsey Kshlerin DVM\",\"keywords\":\"Mr. Chelsey Kshlerin DVM\",\"description\":\"Mr. Chelsey Kshlerin DVM\"}', 'en', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `registers`
--

CREATE TABLE `registers` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `contents` longtext COLLATE utf8mb4_unicode_ci,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `priority`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', NULL, 1, 'publish', '2018-06-29 15:43:51', '2018-06-29 15:43:51'),
(2, 'san-pham', 'Sản phẩm', NULL, 1, 'publish', '2018-06-29 15:43:51', '2018-06-29 15:43:51'),
(3, 'sales', 'Bán hàng', NULL, 1, 'publish', '2018-06-29 15:43:51', '2018-06-29 15:43:51'),
(4, 'wms', 'Kho hàng', NULL, 1, 'publish', '2018-06-29 15:43:51', '2018-06-29 15:43:51'),
(5, 'tin-tuc', 'Tin tức', NULL, 1, 'publish', '2018-06-29 15:43:51', '2018-06-29 15:43:51'),
(6, 'dich-vu', 'Dịch vụ', NULL, 1, 'publish', '2018-06-29 15:43:51', '2018-06-29 15:43:51'),
(7, 'pages', 'Trang tĩnh', NULL, 1, 'publish', '2018-06-29 15:43:51', '2018-06-29 15:43:51'),
(8, 'photos', 'Hình ảnh', NULL, 1, 'publish', '2018-06-29 15:43:51', '2018-06-29 15:43:51'),
(9, 'links', 'Liên kết', NULL, 1, 'publish', '2018-06-29 15:43:51', '2018-06-29 15:43:51'),
(10, 'registers', 'Đăng ký', NULL, 1, 'publish', '2018-06-29 15:43:51', '2018-06-29 15:43:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `seos`
--

CREATE TABLE `seos` (
  `id` int(10) UNSIGNED NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `seos`
--

INSERT INTO `seos` (`id`, `link`, `priority`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'http://localhost/laravel/begreen', 0, 'publish', NULL, NULL, '2018-06-29 17:22:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `seo_languages`
--

CREATE TABLE `seo_languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_seo` text COLLATE utf8mb4_unicode_ci,
  `language` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `seo_languages`
--

INSERT INTO `seo_languages` (`id`, `title`, `slug`, `meta_seo`, `language`, `seo_id`) VALUES
(1, 'Trang chủ', 'trang-chu', '{\"title\":\"Fashion\",\"keywords\":null,\"description\":null}', 'vi', 1),
(2, 'Trang chủ', 'trang-chu', NULL, 'en', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'maintenance', 'off'),
(2, 'language', 'vi'),
(3, 'date_custom_format', NULL),
(4, 'product_per_page', '12'),
(5, 'thumbs', '{\"product\":{\"_small\":{\"width\":\"400\",\"height\":\"400\"},\"_medium\":{\"width\":\"600\",\"height\":\"600\"},\"_large\":{\"width\":\"1000\",\"height\":\"1000\"}}}'),
(6, 'post_per_page', '0'),
(7, 'site_name', 'Fashion'),
(8, 'site_slogan', NULL),
(9, 'site_address', NULL),
(10, 'site_email', 'example@gmail.com'),
(11, 'site_phone', '0123456789'),
(12, 'site_fax', NULL),
(13, 'site_hotline', '0123456789'),
(14, 'site_url', NULL),
(15, 'site_copyright', 'KHOWEBONLINE @ 2018 COPYRIGHT'),
(16, 'fanpage', NULL),
(17, 'google_coordinates', NULL),
(18, 'email_host', NULL),
(19, 'email_port', NULL),
(20, 'email_smtpsecure', NULL),
(21, 'email_username', 'voquochai'),
(22, 'email_password', '12345678'),
(23, 'email_to', NULL),
(24, 'email_cc', NULL),
(25, 'email_bcc', NULL),
(26, 'script_head', NULL),
(27, 'script_body', NULL),
(28, 'google_recaptcha_key', NULL),
(29, 'google_recaptcha_secret', NULL),
(30, 'date_format', 'd/m/Y'),
(31, 'logo', '2018-06/logo_1530291143.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `phone`, `email`, `address`, `image`, `priority`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '', '$2y$10$/h.lqJQZ/aHaqIenJd.5ZONfTTVFsxprU741QALocKu7tzmgkaapa', 'Kho web online', NULL, 'khowebonline@gmail.com', NULL, NULL, 1, 'publish', 'O5is7lbGeL', '2018-06-29 15:43:51', '2018-06-29 15:43:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_group`
--

CREATE TABLE `user_group` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wms_exports`
--

CREATE TABLE `wms_exports` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `export_qty` int(11) NOT NULL DEFAULT '0',
  `export_price` double NOT NULL DEFAULT '0',
  `note_cancel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wms_export_details`
--

CREATE TABLE `wms_export_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_qty` int(11) NOT NULL DEFAULT '0',
  `product_price` double NOT NULL DEFAULT '0',
  `size_id` int(11) NOT NULL DEFAULT '0',
  `size_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_id` int(11) NOT NULL DEFAULT '0',
  `color_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `export_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wms_imports`
--

CREATE TABLE `wms_imports` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `import_qty` int(11) NOT NULL DEFAULT '0',
  `import_price` double NOT NULL DEFAULT '0',
  `note_cancel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wms_import_details`
--

CREATE TABLE `wms_import_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_qty` int(11) NOT NULL DEFAULT '0',
  `product_price` double NOT NULL DEFAULT '0',
  `size_id` int(11) NOT NULL DEFAULT '0',
  `size_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_id` int(11) NOT NULL DEFAULT '0',
  `color_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `import_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wms_stores`
--

CREATE TABLE `wms_stores` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `priority` int(11) NOT NULL DEFAULT '1',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `attribute_languages`
--
ALTER TABLE `attribute_languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attribute_languages_attribute_id_language_unique` (`attribute_id`,`language`),
  ADD KEY `attribute_languages_language_index` (`language`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_languages`
--
ALTER TABLE `category_languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_languages_category_id_language_unique` (`category_id`,`language`),
  ADD KEY `category_languages_language_index` (`language`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_product_id_foreign` (`product_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_member_id_foreign` (`member_id`);

--
-- Chỉ mục cho bảng `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Chỉ mục cho bảng `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `groups_name_unique` (`name`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_at_index` (`queue`,`reserved_at`);

--
-- Chỉ mục cho bảng `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `link_languages`
--
ALTER TABLE `link_languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `link_languages_link_id_language_unique` (`link_id`,`language`),
  ADD KEY `link_languages_language_index` (`language`);

--
-- Chỉ mục cho bảng `media_libraries`
--
ALTER TABLE `media_libraries`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_username_unique` (`username`),
  ADD UNIQUE KEY `members_email_unique` (`email`);

--
-- Chỉ mục cho bảng `member_password_resets`
--
ALTER TABLE `member_password_resets`
  ADD KEY `member_password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_code_unique` (`code`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`);

--
-- Chỉ mục cho bảng `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `page_languages`
--
ALTER TABLE `page_languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_languages_page_id_language_unique` (`page_id`,`language`),
  ADD KEY `page_languages_language_index` (`language`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Chỉ mục cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `photo_languages`
--
ALTER TABLE `photo_languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `photo_languages_photo_id_language_unique` (`photo_id`,`language`),
  ADD KEY `photo_languages_language_index` (`language`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `post_attribute`
--
ALTER TABLE `post_attribute`
  ADD KEY `post_attribute_post_id_foreign` (`post_id`),
  ADD KEY `post_attribute_attribute_id_foreign` (`attribute_id`);

--
-- Chỉ mục cho bảng `post_languages`
--
ALTER TABLE `post_languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_languages_post_id_language_unique` (`post_id`,`language`),
  ADD KEY `post_languages_language_index` (`language`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`),
  ADD KEY `products_supplier_id_foreign` (`supplier_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD KEY `product_attribute_product_id_foreign` (`product_id`),
  ADD KEY `product_attribute_attribute_id_foreign` (`attribute_id`);

--
-- Chỉ mục cho bảng `product_languages`
--
ALTER TABLE `product_languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_languages_product_id_language_unique` (`product_id`,`language`),
  ADD KEY `product_languages_language_index` (`language`);

--
-- Chỉ mục cho bảng `registers`
--
ALTER TABLE `registers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Chỉ mục cho bảng `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `seos`
--
ALTER TABLE `seos`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `seo_languages`
--
ALTER TABLE `seo_languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seo_languages_seo_id_language_unique` (`seo_id`,`language`),
  ADD KEY `seo_languages_language_index` (`language`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_code_unique` (`code`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `user_group`
--
ALTER TABLE `user_group`
  ADD KEY `user_group_user_id_foreign` (`user_id`),
  ADD KEY `user_group_group_id_foreign` (`group_id`);

--
-- Chỉ mục cho bảng `wms_exports`
--
ALTER TABLE `wms_exports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wms_exports_code_unique` (`code`);

--
-- Chỉ mục cho bảng `wms_export_details`
--
ALTER TABLE `wms_export_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wms_export_details_export_id_foreign` (`export_id`);

--
-- Chỉ mục cho bảng `wms_imports`
--
ALTER TABLE `wms_imports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wms_imports_code_unique` (`code`);

--
-- Chỉ mục cho bảng `wms_import_details`
--
ALTER TABLE `wms_import_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wms_import_details_import_id_foreign` (`import_id`);

--
-- Chỉ mục cho bảng `wms_stores`
--
ALTER TABLE `wms_stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wms_stores_code_unique` (`code`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `attribute_languages`
--
ALTER TABLE `attribute_languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `category_languages`
--
ALTER TABLE `category_languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `links`
--
ALTER TABLE `links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `link_languages`
--
ALTER TABLE `link_languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `media_libraries`
--
ALTER TABLE `media_libraries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `page_languages`
--
ALTER TABLE `page_languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `photo_languages`
--
ALTER TABLE `photo_languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `post_languages`
--
ALTER TABLE `post_languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `product_languages`
--
ALTER TABLE `product_languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `registers`
--
ALTER TABLE `registers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `seos`
--
ALTER TABLE `seos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `seo_languages`
--
ALTER TABLE `seo_languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `wms_exports`
--
ALTER TABLE `wms_exports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `wms_export_details`
--
ALTER TABLE `wms_export_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `wms_imports`
--
ALTER TABLE `wms_imports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `wms_import_details`
--
ALTER TABLE `wms_import_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `wms_stores`
--
ALTER TABLE `wms_stores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `attribute_languages`
--
ALTER TABLE `attribute_languages`
  ADD CONSTRAINT `attribute_languages_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `category_languages`
--
ALTER TABLE `category_languages`
  ADD CONSTRAINT `category_languages_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `link_languages`
--
ALTER TABLE `link_languages`
  ADD CONSTRAINT `link_languages_link_id_foreign` FOREIGN KEY (`link_id`) REFERENCES `links` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `page_languages`
--
ALTER TABLE `page_languages`
  ADD CONSTRAINT `page_languages_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `photo_languages`
--
ALTER TABLE `photo_languages`
  ADD CONSTRAINT `photo_languages_photo_id_foreign` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `post_attribute`
--
ALTER TABLE `post_attribute`
  ADD CONSTRAINT `post_attribute_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_attribute_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `post_languages`
--
ALTER TABLE `post_languages`
  ADD CONSTRAINT `post_languages_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD CONSTRAINT `product_attribute_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attribute_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product_languages`
--
ALTER TABLE `product_languages`
  ADD CONSTRAINT `product_languages_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `seo_languages`
--
ALTER TABLE `seo_languages`
  ADD CONSTRAINT `seo_languages_seo_id_foreign` FOREIGN KEY (`seo_id`) REFERENCES `seos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `user_group`
--
ALTER TABLE `user_group`
  ADD CONSTRAINT `user_group_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_group_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `wms_export_details`
--
ALTER TABLE `wms_export_details`
  ADD CONSTRAINT `wms_export_details_export_id_foreign` FOREIGN KEY (`export_id`) REFERENCES `wms_exports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `wms_import_details`
--
ALTER TABLE `wms_import_details`
  ADD CONSTRAINT `wms_import_details_import_id_foreign` FOREIGN KEY (`import_id`) REFERENCES `wms_imports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
