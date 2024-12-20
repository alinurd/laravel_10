-- Adminer 4.8.1 MySQL 8.0.30 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `client_products`;
CREATE TABLE `client_products` (
  `id` bigint unsigned NOT NULL ,
  `pt_id` bigint unsigned NOT NULL,
  `pic_id` bigint unsigned NOT NULL,
  `hp` bigint unsigned DEFAULT NULL,
  `direktur` varchar(150)  NOT NULL,
  `product` varchar(150)  NOT NULL,
  `jenis` varchar(100)  NOT NULL,
  `spesifikasi` text ,
  `sut` varchar(100)  DEFAULT NULL,
  `merk` varchar(100)  DEFAULT NULL,
  `code_hs` varchar(50)  DEFAULT NULL,
  `status` varchar(50)  NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `client_products` (`id`, `pt_id`, `pic_id`, `hp`, `direktur`, `product`, `jenis`, `spesifikasi`, `sut`, `merk`, `code_hs`, `status`, `created_at`, `updated_at`) VALUES
(1,	2,	2,	786767,	'refdr',	'drd',	'rd',	'rd',	'rd',	'rdr',	'r',	'1',	'2024-12-02 21:05:45',	'2024-12-04 02:53:30'),
(2,	1,	3,	978989,	'tes direkturq',	'prodact nama',	'jenis',	'sjdhj',	'uhu',	'ere',	'e',	'1',	'2024-12-04 02:52:57',	'2024-12-04 02:52:57');

DROP TABLE IF EXISTS `combos`;
CREATE TABLE `combos` (
  `id` bigint unsigned NOT NULL ,
  `pid` varchar(255) CHARACTER SET utf8mb4  DEFAULT NULL,
  `categori` varchar(255) CHARACTER SET utf8mb4  DEFAULT NULL,
  `data` varchar(255)  NOT NULL,
  `status` enum('active','inactive','show') CHARACTER SET utf8mb4  NOT NULL,
  `key1` varchar(255) CHARACTER SET utf8mb4  DEFAULT NULL,
  `key2` varchar(255) CHARACTER SET utf8mb4  DEFAULT NULL,
  `key3` varchar(255) CHARACTER SET utf8mb4  DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `combos` (`id`, `pid`, `categori`, `data`, `status`, `key1`, `key2`, `key3`, `created_at`, `updated_at`) VALUES
(1,	'pid',	'categori',	'dataas',	'active',	NULL,	NULL,	NULL,	'2024-11-09 20:44:28',	'2024-11-09 20:56:37'),
(2,	'ygy',	'gygygy',	'data',	'active',	NULL,	NULL,	NULL,	'2024-11-09 20:52:14',	'2024-11-09 20:54:34'),
(4,	'er',	'ewr',	'wer',	'active',	'2',	'contoh key ssssssssss',	NULL,	'2024-11-11 04:58:10',	'2024-11-11 04:58:10'),
(5,	'asd',	'asd',	'asdas',	'active',	'12',	'2',	NULL,	'2024-11-11 05:00:00',	'2024-11-11 05:00:00'),
(6,	'wd',	'wd',	'wd',	'active',	NULL,	'1',	NULL,	'2024-11-11 05:02:55',	'2024-11-11 05:02:55'),
(7,	'dqw',	'wqd',	'wqd',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:04:14',	'2024-11-11 05:04:14'),
(8,	'efr',	'werwe',	'rwerwe',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:06:49',	'2024-11-11 05:06:49'),
(9,	'er',	'ewr',	'wer',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:07:27',	'2024-11-11 05:07:27'),
(10,	'asd',	'asdasd',	'asdasd',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:08:09',	'2024-11-11 05:08:09'),
(11,	'adf',	'ewf',	'wef',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:09:06',	'2024-11-11 05:09:06'),
(12,	'df',	'rwet',	'ert',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:11:27',	'2024-11-11 05:11:27'),
(13,	'sdef',	'rg',	'reg',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:12:49',	'2024-11-11 05:12:49'),
(14,	'sdefsdf',	'rg',	'reg',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:13:06',	'2024-11-11 05:13:06'),
(15,	'sdefsdfeaf',	'rg',	'reg',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:13:26',	'2024-11-11 05:13:26'),
(16,	'sad',	'wde',	'weqe',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:15:43',	'2024-11-11 05:15:43'),
(17,	'asd',	'asd',	'asd',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:16:12',	'2024-11-11 05:16:12'),
(18,	'asd',	'wq',	'wq',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:16:50',	'2024-11-11 05:16:50'),
(19,	'weqrwe',	'rwerwer',	'werwe',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:17:07',	'2024-11-11 05:17:07'),
(20,	'eq',	'wqe',	'qwe',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:18:53',	'2024-11-11 05:18:53'),
(21,	'ea',	'ewr',	'wer',	'active',	'11',	'0',	NULL,	'2024-11-11 05:19:27',	'2024-11-11 05:19:27'),
(22,	'sdf',	'ewr',	'wer',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:20:33',	'2024-11-11 05:20:33'),
(23,	'qer',	'34',	'qewqe',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:21:00',	'2024-11-11 05:21:00'),
(24,	'wqe',	'wqe',	'wqe',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:23:25',	'2024-11-11 05:23:25'),
(25,	'wqe',	'wqe',	'wqe',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:23:33',	'2024-11-11 05:23:33'),
(26,	'adsf',	'ewfwe',	'fewf',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:25:26',	'2024-11-11 05:25:26'),
(27,	'dfewfewf',	'wefewf',	'wefewf',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:26:25',	'2024-11-11 05:26:25'),
(28,	'dfewfewf',	'wefewf',	'wefewf',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:28:58',	'2024-11-11 05:28:58'),
(29,	'er',	'rew',	'ewr',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:36:09',	'2024-11-11 05:36:09'),
(30,	'asd',	'dsadasd',	'adsad',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:37:59',	'2024-11-11 05:37:59'),
(31,	'wq',	'qe',	'qeqe',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:38:59',	'2024-11-11 05:38:59'),
(32,	'ser',	'rewr',	'wer',	'active',	NULL,	'0',	NULL,	'2024-11-11 05:39:53',	'2024-11-11 05:39:53'),
(33,	NULL,	NULL,	'wdwd',	'active',	NULL,	NULL,	NULL,	'2024-12-04 03:17:38',	'2024-12-04 03:17:38'),
(34,	NULL,	NULL,	'docferify',	'active',	NULL,	NULL,	NULL,	'2024-12-04 03:18:06',	'2024-12-04 03:18:06'),
(35,	NULL,	'docferify',	'Legal',	'active',	'A',	NULL,	NULL,	'2024-12-04 03:18:52',	'2024-12-04 03:36:23'),
(36,	NULL,	'docferify',	'Adminstrasi',	'active',	'B',	NULL,	NULL,	'2024-12-04 03:35:16',	'2024-12-04 03:35:16'),
(37,	NULL,	'docferify',	'Teknis',	'active',	'C',	NULL,	NULL,	'2024-12-04 03:36:08',	'2024-12-04 03:36:08');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL ,
  `uuid` varchar(255)  NOT NULL,
  `connection` text  NOT NULL,
  `queue` text  NOT NULL,
  `payload` longtext  NOT NULL,
  `exception` longtext  NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;


DROP TABLE IF EXISTS `group_permissions`;
CREATE TABLE `group_permissions` (
  `id` char(36) NOT NULL,
  `group_id` char(36) NOT NULL,
  `permission_type` enum('manage','create','update','delete','view','store','destroy','edit') CHARACTER SET utf8mb4  NOT NULL,
  `menu_item_id` char(36) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `group_permissions` (`id`, `group_id`, `permission_type`, `menu_item_id`) VALUES
('0041279d-5382-4a63-b92d-feec457d272b',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'update',	'13'),
('0118b1a7-49ed-4272-9629-53f5e414d676',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'destroy',	'21'),
('0118b1a7-49ed-4272-9629-s',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'destroy',	'22'),
('0118b1a7-49ed-4272-s-s',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'destroy',	'24'),
('01b19a31-ef26-4adf-8bcf-d93f306a90c8',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'store',	'18'),
('04fbc42f-9675-4225-bde8-1ed8e19130e8',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'view',	'25'),
('095050a4-a57e-42bd-bc2f-da2a1fe33938',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'update',	'19'),
('0c123ee8-510f-4ff4-a369-7506b5122e02',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'delete',	'14'),
('0d3f2a1c-e7de-4e9b-bb4e-24595e120bbd',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'view',	'16'),
('0fbe19f8-4331-4eab-9b48-2ce82bfec425',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'edit',	'16'),
('105387ae-7110-4e86-8bbe-fc99d2e54c56',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'manage',	'13'),
('10db7a6c-1f7d-46ee-9f65-fb0e29bd9b6c',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'update',	'14'),
('18461021-1f09-446a-935e-201b5173eed6',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'manage',	'12'),
('189a1897-939f-43ee-8c35-6fd2b79fc74d',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'view',	'21'),
('18f1a5b3-27da-4b5b-b8f8-742d2dbf8dd6',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'delete',	'83d90384-d553-40fb-a453-ebac91bf29c7'),
('18f1a5b3-27da-4b5b-b8f8-x',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'delete',	'b62dd49a-b3a5-4e5e-9442-27dc654cc0c4'),
('190e414f-02df-4ab4-bf72-a90826523907',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'create',	'23'),
('196dc9c2-406f-4d12-acea-d415bd338ec5',	'ca13dba5-4791-4bd2-bd0c-a120296afdcf',	'manage',	'0'),
('19f1e4da-1e23-4be7-9acd-4cc3ac8471fb',	'2753715f-967e-4ab9-bae5-9ff59dc62030',	'create',	'33d9527f-b55f-40fc-aeb9-7c2913a02c7b'),
('1aff02dd-6ac7-4672-b68a-a41a95d0252d',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'view',	'20'),
('1baea541-aef1-4368-8f9b-f8aba0a7b64b',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'edit',	'201798a9-f56a-4b80-88a9-cafdb3b4c228'),
('1de994c1-66ee-4515-9a6a-d810bc6316e6',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'update',	'18'),
('1fd93c3e-6e4a-42dc-9421-082a9c5c69fe',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'edit',	'bda240f0-d68b-4873-b639-392778e5ea05'),
('2036e619-e78a-4901-a16d-134e71b0b5fa',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'destroy',	'21'),
('21c0271a-864f-4a36-8d96-42a48036df38',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'create',	'25'),
('22a1f1dd-995f-4a98-9be5-6cee8203872a',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'destroy',	'bda240f0-d68b-4873-b639-392778e5ea05'),
('238df166-ff3d-4693-b3ac-8d7236f9c393',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'destroy',	'20'),
('23a37470-0d79-43b4-b0e7-8d3b871034af',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'delete',	'25'),
('2480de12-d2a5-4b8d-a3b5-4d81d2afbbc0',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'create',	'21'),
('24a42331-9c9b-4d28-92c6-e05b357b3477',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'edit',	'20'),
('26506ed8-f423-4b7a-aa26-f97e3d63b836',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'delete',	'16'),
('2697a790-c6e5-4195-9e1e-0a10870cb1ba',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'update',	'bda240f0-d68b-4873-b639-392778e5ea05'),
('2780761f-9c59-4513-83ca-dff602a9554d',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'store',	'8259c658-6c0b-4ecc-ad7f-8df608f338eb'),
('278641b8-f816-4260-a58e-69902433fc16',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'view',	'201798a9-f56a-4b80-88a9-cafdb3b4c228'),
('279beced-86c8-451a-8fe4-a4e3ac75b00c',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'store',	'16'),
('280937a1-3759-4f4a-a386-3046a96da761',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'store',	'27'),
('28f47f54-1bd9-4c6c-9471-9a54925f4958',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'destroy',	'18'),
('2911140c-0844-407d-97cf-54de10d5ee2a',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'update',	'12'),
('2d824fee-1e00-47b4-ba8a-f247619505ee',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'delete',	'8259c658-6c0b-4ecc-ad7f-8df608f338eb'),
('2da8983d-4a72-4821-aed9-502da051a2be',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'store',	'20'),
('2de5fa25-ef74-42a4-9944-49a52894fbfb',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'update',	'23'),
('2ee849df-cd01-4ab9-8eab-fbea167345b4',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'destroy',	'18'),
('2f0e6373-a3e4-46c3-b0af-d724de4501d4',	'2753715f-967e-4ab9-bae5-9ff59dc62030',	'delete',	'7ae0ef19-dbc9-437e-afda-d3320668f30b'),
('2fcab4da-aada-456b-878a-f589df2bda96',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'view',	'16'),
('3061332b-11b3-49c4-8281-b07047651ad1',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'create',	'23'),
('30d0169b-dc6a-4ba7-be22-fb0d829aa643',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'destroy',	'16'),
('30d1dde9-a9e1-478e-be30-095d3fbf90e7',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'store',	'21'),
('326d6938-8efb-4016-9a6c-5a4e5125b6fb',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'edit',	'8259c658-6c0b-4ecc-ad7f-8df608f338eb'),
('33b67936-9619-4988-8771-d16042a1d011',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'manage',	'0'),
('342f6d93-f343-425e-913d-a96b414423e3',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'store',	'19'),
('34d700de-f4db-4255-abab-e09769e27a56',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'create',	'13'),
('35102680-6a44-4f31-a99e-e05d6df8fddb',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'create',	'14'),
('367b224d-1a51-4e0e-9f00-a3cb240646e7',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'manage',	'16'),
('3711935d-1b61-452e-97ac-858bd834208d',	'0cafa224-4d46-4faa-a5f6-22ddbe8c7756',	'store',	'201798a9-f56a-4b80-88a9-cafdb3b4c228'),
('37b617a4-ff2e-47ea-83a3-8e8acff840f8',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'destroy',	'201798a9-f56a-4b80-88a9-cafdb3b4c228'),
('39fad286-a63a-4765-9feb-d322abc131f3',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'edit',	'13'),
('3a08c6a1-efae-4142-8c88-0e83ae8b4e6f',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'store',	'23'),
('3a3eb81b-01f9-4e3c-8949-765d03468a6e',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'delete',	'13'),
('3a4fb407-a684-4013-8bf7-79191055277b',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'create',	'24'),
('3a9d9f27-c2c0-4ec9-b50b-fa5a50168899',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'update',	'68572336-59a6-4a9f-be59-acc13f56be45'),
('3b9dc489-c611-412b-b665-55999dff36e5',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'delete',	'12'),
('3dd7ccae-2a97-4f36-97d4-a4fbac51af0b',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'update',	'20'),
('3e77fb3f-8296-4486-b8ec-fbe5b24c29c3',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'store',	'13'),
('3ed66e6c-d386-4b76-8cb3-f61e4ff340a6',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'store',	'14'),
('3eef558e-271f-42d9-9429-1849babae5da',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'manage',	'68572336-59a6-4a9f-be59-acc13f56be45'),
('3ff1b63c-8465-4a01-9ffe-db966e7bbb12',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'view',	'26'),
('4000f18e-d3c3-44c6-94a3-d5ea89867318',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'edit',	'8ef00cf3-a058-4332-af85-23ee7bf6008c'),
('4156d400-9941-4556-8e11-dda7862771f1',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'manage',	'0'),
('418b48a6-78c1-461d-b3f0-91a5c26134c0',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'delete',	'bda240f0-d68b-4873-b639-392778e5ea05'),
('41dc8c59-546f-459a-aedb-1f73dfbe0f3b',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'store',	'68572336-59a6-4a9f-be59-acc13f56be45'),
('421188ae-b0d9-4c4e-8eab-6a7ab9860fbd',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'view',	'13'),
('43db45b2-3bfa-4fc0-aae0-884873ed63af',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'view',	'19'),
('4655ba2e-e1ee-4edf-936d-53e4ded84a8d',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'create',	'18'),
('478e360e-6dee-48de-9c47-93f412f58ef3',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'manage',	'0'),
('47ece59f-1231-4721-a6c6-5b4e6ad63c2e',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'update',	'18'),
('49b9b9c1-a864-4694-a4de-388bc5ded048',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'edit',	'27'),
('4a3c167a-d0a1-47b4-b9d1-2b2996ebc384',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'view',	'18'),
('4ace496c-0ef2-4acf-97ca-fb8b3b8a4baa',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'delete',	'8ef00cf3-a058-4332-af85-23ee7bf6008c'),
('4b376e4e-ae9f-49ff-bff0-169ca223f0a5',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'create',	'16'),
('4b3decfd-93b5-4346-b75e-175b7985a723',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'delete',	'201798a9-f56a-4b80-88a9-cafdb3b4c228'),
('4b5fa23c-ea4f-4313-ab69-1a0d1265a2ae',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'destroy',	'16'),
('4b89e81c-e31a-4754-bfc4-6ade4ebd0070',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'update',	'8259c658-6c0b-4ecc-ad7f-8df608f338eb'),
('4cae1648-99f9-4cf0-9715-2b73e9b9fe21',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'edit',	'16'),
('4dc58ef6-9e7f-4abd-a811-dabbf2ff993b',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'manage',	'26'),
('4f3fe193-e9d7-4d69-a787-0949dd78c668',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'update',	'25'),
('5016a3a5-f545-4942-8960-57a26e0e13cb',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'delete',	'23'),
('50e96507-4aa0-4b09-a65d-a2b97c070a08',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'edit',	'18'),
('52a03e76-aae7-4f83-a345-e4694e8b5564',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'manage',	'16'),
('547b6daa-e743-4712-883b-b53e3c53c59b',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'destroy',	'16'),
('54d5da8d-5662-4103-a123-9afa6542873f',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'store',	'25'),
('569d00c2-751f-42f4-bdc4-f0258ac497e1',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'manage',	'0'),
('57270846-b182-46a4-ac19-df9aab621556',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'destroy',	'23'),
('588297db-7e23-4318-925a-6311742e24eb',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'view',	'23'),
('592093ca-436a-4de2-ac30-ce6a20b51278',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'manage',	'21'),
('592093ca-436a-4de2-ac30-s',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'manage',	'22'),
('592093ca-436a-4de2-asc30-s',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'manage',	'24'),
('5a28fd6b-1144-4b05-aaf1-5c524931e862',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'destroy',	'19'),
('5a40499b-de44-4722-b78a-76d819cb9490',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'manage',	'0'),
('5a846593-1821-407a-8001-412006ce2d71',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'manage',	'0'),
('5ad61911-a770-439d-b9be-ac5895909431',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'update',	'16'),
('5c0da8ac-2ee5-4404-bb57-e5986a67118f',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'manage',	'0'),
('5ca964b9-b6d4-4244-bb0b-3a98d636b8fe',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'create',	'201798a9-f56a-4b80-88a9-cafdb3b4c228'),
('5e114d09-4e09-462e-b456-7246b3c167e2',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'manage',	'0'),
('5fa3d54d-1108-46f7-9cba-1ca11780d8c8',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'delete',	'97d9e4f8-16a0-40a6-9081-5d09ca0bf690'),
('5fd82ff7-890a-42a1-aae8-98127f85af82',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'delete',	'16'),
('608668c2-51df-4db3-ba83-451e6dfdcceb',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'destroy',	'25'),
('60b6ba4a-c943-495f-8a5f-15cb045d3750',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'delete',	'13'),
('64a258e9-65eb-462c-b400-781329c6b877',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'update',	'24'),
('693ab63b-2b1b-44b8-a335-57853f31ba7b',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'delete',	'18'),
('6c20a867-89fb-4f78-8099-eeefef2e1e85',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'update',	'8ef00cf3-a058-4332-af85-23ee7bf6008c'),
('6d60e04d-3037-4d2e-bb0a-eca78dd70417',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'destroy',	'19'),
('6e62f87b-d900-44ac-9d06-7b862f8bd366',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'delete',	'14'),
('6e7efcf5-18dd-4f28-8a6d-282dd184917f',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'manage',	'19'),
('6ea0afe3-a4f4-4508-bba8-084ab6b8308d',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'edit',	'21'),
('6ea0afe3-a4f4-4508-bba8-s',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'edit',	'22'),
('6ea0afe3-a4f4-4508-s-s',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'edit',	'24'),
('6f85ed7d-7792-4dc5-ab9d-6524a16e88f0',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'destroy',	'21'),
('6f8e8e28-9803-41f3-9ef3-dda53e60f5a9',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'manage',	'21'),
('701c9785-9e9b-4822-8b46-26ff93bc3456',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'update',	'16'),
('70f0651d-f71f-49a6-b889-1ae6a3b41796',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'manage',	'20'),
('7109fc30-9863-4eaa-87ab-b8b39ef43a9e',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'view',	'21'),
('7268d677-01be-4126-81d0-26b21a418b76',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'manage',	'18'),
('7277dd8e-e184-4e17-bfd9-e163a8d13e64',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'edit',	'12'),
('729bf8ce-6c03-4602-84eb-c9e5a0ebf2fb',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'create',	'20'),
('7374d934-d98a-42a9-9277-07d8407b7887',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'manage',	'0'),
('7422e3c3-2ae1-4a35-a571-700f1f12cdc2',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'store',	'26'),
('759ac0aa-c2fb-4f0e-b6e3-2251dff01d20',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'delete',	'20'),
('75e4a5e9-ec43-435e-9025-09243e8c70ca',	'ca13dba5-4791-4bd2-bd0c-a120296afdcf',	'store',	'18'),
('76aafebc-bbd7-4b32-a52d-28418cf072ba',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'update',	'19'),
('77e8113a-365b-4066-8d87-ec7640cecbab',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'manage',	'24'),
('797d46a2-d564-4a17-b420-b22807d1d560',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'update',	'12'),
('7a3107cf-8dec-4061-b897-af18430aa27c',	'ca13dba5-4791-4bd2-bd0c-a120296afdcf',	'manage',	'16'),
('7ac9a77c-7baa-4d54-938f-5f0a44c38625',	'ca13dba5-4791-4bd2-bd0c-a120296afdcf',	'destroy',	'16'),
('7b3bdb96-73ce-4de5-9889-da3150242fc2',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'view',	'18'),
('7c2c2335-589c-4a49-adeb-02fabb321f22',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'manage',	'8ef00cf3-a058-4332-af85-23ee7bf6008c'),
('7e8ecad7-a988-4809-a665-9c617bfa60af',	'2753715f-967e-4ab9-bae5-9ff59dc62030',	'create',	'67a85c98-7409-466e-ac29-123f6f42e601'),
('7f817337-3e44-425a-8098-71facd2b3838',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'update',	'26'),
('8140d848-d6e8-4bf6-932c-7e2de57ce5ec',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'view',	'8ef00cf3-a058-4332-af85-23ee7bf6008c'),
('8249e19d-72b4-4d21-8522-85e2cf149f55',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'view',	'27'),
('8402780a-3b50-401c-b02b-c1e84565f9ac',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'manage',	'20'),
('843d83c8-c914-40c3-bc9b-1b78f65bb384',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'view',	'18'),
('8565c9fd-d338-41dc-ad9c-ac1e7a5253fc',	'2753715f-967e-4ab9-bae5-9ff59dc62030',	'manage',	'33d9527f-b55f-40fc-aeb9-7c2913a02c7b'),
('85866e91-d985-4a1a-802b-378fe7443347',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'destroy',	'13'),
('86ba7fe6-b2cd-4c66-b49f-eb31849ddbfd',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'manage',	'0'),
('89c91542-f6b1-499d-8b15-9b0cb9650407',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'manage',	'23'),
('8a3e65ea-3c43-40f1-9bca-303c2b5782fa',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'store',	'18'),
('8a6c00f3-6f7e-4801-b8ae-a38d453ae1f2',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'destroy',	'97d9e4f8-16a0-40a6-9081-5d09ca0bf690'),
('8a80f551-481a-4bd8-ad3d-3b649cb1396a',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'delete',	'19'),
('8af33321-a18e-4460-bb4b-29273ae12b3d',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'store',	'21'),
('8af33322-a18e-4460-bb4b-d',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'store',	'22'),
('8af33324-a18e-4460-sss-d',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'store',	'24'),
('8b8087f8-824f-4f9b-948b-4851c950103e',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'store',	'12'),
('8c79dc2d-bcb8-4b45-8ea1-b0f6835271c5',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'store',	'bda240f0-d68b-4873-b639-392778e5ea05'),
('8d210207-be36-4ded-874e-6cf510b1a323',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'update',	'18'),
('8d3d310b-ec6f-44fc-9165-f690ba7ec119',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'destroy',	'8259c658-6c0b-4ecc-ad7f-8df608f338eb'),
('8d993501-c0d8-4436-bdc6-9b7a44832ae7',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'destroy',	'14'),
('9000ecac-dae1-4916-ba62-d87312a688fd',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'manage',	'0'),
('90395946-cee1-4f9f-81d1-8a9ea440293c',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'create',	'83d90384-d553-40fb-a453-ebac91bf29c7'),
('90395946-cee1-4f9f-81d1-x',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'create',	'b62dd49a-b3a5-4e5e-9442-27dc654cc0c4'),
('92a3e81a-07ae-4049-bab7-e4d5f8d001ad',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'store',	'83d90384-d553-40fb-a453-ebac91bf29c7'),
('92a3e81a-07ae-4049-bab7-x',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'store',	'b62dd49a-b3a5-4e5e-9442-27dc654cc0c4'),
('94ccde9a-633d-4f5d-9881-cdbbf2ecdc99',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'create',	'12'),
('9502d906-34be-4b94-9193-869784ee3981',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'edit',	'14'),
('95ef6c23-33de-4835-b852-20e468698fd8',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'view',	'13'),
('966eb87c-8fa1-4248-ae8c-eab15e477062',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'manage',	'0'),
('9693ace5-ff33-4be7-8ba3-76bb90578314',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'edit',	'68572336-59a6-4a9f-be59-acc13f56be45'),
('96e07630-e0a8-4cf9-9ac4-fc18e8493196',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'edit',	'24'),
('971e1184-414a-454b-918e-9575f500cfb6',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'manage',	'16'),
('984a71b0-2f9a-4ae1-8e48-b6ebfd3e87c9',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'update',	'23'),
('9a8278ef-aa30-4fc6-ae2f-fd0fa474d0cb',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'manage',	'25'),
('9b6c6d54-3381-4d22-b797-ebc493528c68',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'manage',	'14'),
('9bd71a22-406f-4252-999e-59754a1cc29a',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'edit',	'14'),
('9beed581-6335-455e-a0ea-be0124eeaea8',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'destroy',	'27'),
('9c2717e3-f7cf-462f-9d45-4f5753d7e84e',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'delete',	'24'),
('9c46c440-4e7d-4502-937f-ed9d94e67c62',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'destroy',	'26'),
('9c50de0c-a7ca-482b-a7db-baaade819c4d',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'manage',	'21'),
('9cc34b0f-8526-4aa4-913a-5f02d3a54067',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'destroy',	'8ef00cf3-a058-4332-af85-23ee7bf6008c'),
('9e39dab2-0240-41b4-b4d5-8210a567eb68',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'update',	'21'),
('9ecfba1b-467f-455a-a3ec-cd14a6593df0',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'create',	'97d9e4f8-16a0-40a6-9081-5d09ca0bf690'),
('a0bc9819-5090-47f6-8302-a8df4dddd35c',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'update',	'14'),
('a14621a9-0a59-4138-bd5f-0028c39c3cb8',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'store',	'18'),
('a14b1c22-0e72-4d3b-818d-f84512a67fbf',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'edit',	'16'),
('a2cd8ef6-82c0-45a1-94e0-979bc8768ef3',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'view',	'12'),
('a3a66726-67cb-47b0-b7e4-b507860139bc',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'store',	'8ef00cf3-a058-4332-af85-23ee7bf6008c'),
('a5aae876-6fa1-4eb2-8883-835ec6767e60',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'view',	'14'),
('a6908f33-cb4d-4f1f-b277-866cda3c2bee',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'view',	'23'),
('a75a4577-c974-4349-b12e-1782c7617d54',	'1ecb6dea-c45c-4fec-83d4-7191b622be79',	'manage',	'0'),
('a8395258-4060-4503-ab85-21345b9532e0',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'manage',	'12'),
('a87fbb2f-d261-4fb2-b965-d4e2d03eeeba',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'store',	'12'),
('a89edf16-7dfa-41da-9ae7-7d8c0ece2571',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'delete',	'19'),
('a98f2f25-b452-4f25-a138-c7b9652ef7f3',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'store',	'24'),
('aa094a0b-b41d-474f-9c38-e850f973c1d2',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'edit',	'23'),
('aa38e26f-e30c-48a0-9460-dfcc731f8c49',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'destroy',	'23'),
('aad35b6c-ed06-4093-b498-fc7e75cf41eb',	'2753715f-967e-4ab9-bae5-9ff59dc62030',	'view',	'67a85c98-7409-466e-ac29-123f6f42e601'),
('ab3454d9-1a55-4c78-90bd-d6dd08546a29',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'store',	'97d9e4f8-16a0-40a6-9081-5d09ca0bf690'),
('ab82a54f-e72e-4bd8-b4c3-d0994c3b6811',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'edit',	'25'),
('ab9d5fd4-246d-4edf-8ffd-c08bffeb9dce',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'edit',	'18'),
('acfb9214-4d6f-41a8-9042-0774d423c963',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'manage',	'13'),
('ade9d791-a4cb-4d0b-984e-c88add17b255',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'create',	'26'),
('b19bb2c1-68a6-4dbc-849b-aa68233449a7',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'edit',	'20'),
('b28f0e3b-7803-417b-bc58-6e703867f364',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'view',	'20'),
('b38ba846-b198-4913-b3a5-709e2f0a7239',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'manage',	'bda240f0-d68b-4873-b639-392778e5ea05'),
('b42cce82-8a7a-4a58-a474-1971aa280a52',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'create',	'12'),
('b586ef6f-3681-4d17-83ba-d7cc31772438',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'view',	'24'),
('b66f6373-238f-42f1-b3be-09d4d1573208',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'create',	'bda240f0-d68b-4873-b639-392778e5ea05'),
('b714af84-036e-46e0-9982-23e641db8a9a',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'edit',	'19'),
('b7d0fe2b-0506-48d2-a0a9-d79fb0e9dacf',	'1ecb6dea-c45c-4fec-83d4-7191b622be79',	'create',	'201798a9-f56a-4b80-88a9-cafdb3b4c228'),
('b8fbaa75-5d79-448f-90f1-ad6097c0d03d',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'delete',	'18'),
('b91a1a0d-5547-424c-8d2e-1a5f6254b3e4',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'edit',	'12'),
('b934dac3-f867-458f-a064-5a39ac160bbf',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'edit',	'21'),
('babdf409-442f-4aff-9067-1f3d17dd1622',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'view',	'8259c658-6c0b-4ecc-ad7f-8df608f338eb'),
('bd59b2d5-5e5d-4501-a59b-8d5691792d72',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'manage',	'19'),
('be69041e-2713-4262-9d68-8e427226030f',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'store',	'14'),
('bf85fa0d-ddaa-4ad6-8bb0-3f06e610de90',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'destroy',	'12'),
('c2725cb7-ef1b-499d-b308-af886b666c53',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'update',	'21'),
('c3d31a4c-ed36-425e-87ef-859eed1c4026',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'delete',	'21'),
('c4490af1-898b-42d6-9a9d-ce28536f336e',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'create',	'20'),
('c4b955b4-42e6-4f48-8739-7aa1efca6ae8',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'update',	'20'),
('c536f23b-a4a7-420a-836c-9eb29935bab6',	'2753715f-967e-4ab9-bae5-9ff59dc62030',	'delete',	'201798a9-f56a-4b80-88a9-cafdb3b4c228'),
('c6c863d9-81ff-4c82-a399-8b435def3c16',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'destroy',	'12'),
('c86d506f-f91b-4824-8071-9667d8f3ae08',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'edit',	'21'),
('c988848f-5972-468f-b386-68f9b8520a7c',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'create',	'19'),
('ca0dd6f2-f75c-4447-9e6c-198232af7dcb',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'manage',	'18'),
('cb0f6fc4-cd17-4c42-8ea4-e191624b766f',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'create',	'18'),
('ccd56943-04ad-4ad3-8da4-93a4b3391eec',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'create',	'16'),
('cd466c63-8fe8-427b-992d-5afc096ce821',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'store',	'16'),
('cd99c66a-29e2-4019-96e5-d38344d38bff',	'2753715f-967e-4ab9-bae5-9ff59dc62030',	'update',	'7ae0ef19-dbc9-437e-afda-d3320668f30b'),
('cdbf9595-648e-4e9c-a761-fca4ddca0227',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'view',	'19'),
('ce48e428-1396-4163-a5f7-11892a1d8575',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'view',	'14'),
('ceeb2b8d-2ec4-4a9a-ab9c-7903056f32db',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'manage',	'23'),
('cf88a8f0-2724-4bde-91d4-6400ea81ec97',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'manage',	'97d9e4f8-16a0-40a6-9081-5d09ca0bf690'),
('cfdea710-b0de-43f3-b056-5a1ccf97e039',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'manage',	'0'),
('d047c004-aed8-4661-85a6-196411716919',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'delete',	'21'),
('d0cb6035-c9f1-48a9-8591-6cd553c1227e',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'create',	'16'),
('d0dd4d19-7f55-4705-b85c-22dd6fb80254',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'delete',	'21'),
('d0dd4d19-7f55-4705-b85c-d',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'delete',	'22'),
('d0dd4d19-7f55-4705-ss-d',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'delete',	'24'),
('d116f5dd-5731-4fe2-88d2-c3ffcec6704a',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'create',	'18'),
('d1811fcc-72e6-47dd-9f86-c1f6aceba49f',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'manage',	'0'),
('d20949f9-bf46-4ff6-89b8-d6e9e369c2fa',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'delete',	'27'),
('d4018d1a-4052-4f46-a26c-77c220a9eb17',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'destroy',	'18'),
('d4d821c0-88a8-48a9-9694-a08a07d49c61',	'2753715f-967e-4ab9-bae5-9ff59dc62030',	'manage',	'201798a9-f56a-4b80-88a9-cafdb3b4c228'),
('d5bde22f-6133-4a36-a2b3-1a157bd32641',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'store',	'19'),
('d5d871fd-fc68-45e8-b4b4-1ae7da608488',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'update',	'97d9e4f8-16a0-40a6-9081-5d09ca0bf690'),
('d64f8414-cf7b-454a-8935-8e3da8f75da8',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'destroy',	'24'),
('d66604f8-7d33-4f0a-86ad-55e11887cf28',	'ca13dba5-4791-4bd2-bd0c-a120296afdcf',	'create',	'18'),
('d7267473-1fe2-45e3-b379-198729b8123d',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'manage',	'14'),
('d7b9e352-eb95-4f83-8a7b-93dc5e1fa9d5',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'store',	'16'),
('d9eaf92b-a2d1-4aa9-a1da-cd244af5b326',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'edit',	'26'),
('daf51bf2-9541-4d92-b6d7-8f73fc7d2c8e',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'delete',	'20'),
('daf78c32-419b-4d04-adbd-ef16b3af0ee6',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'edit',	'97d9e4f8-16a0-40a6-9081-5d09ca0bf690'),
('df183543-c671-47f4-8cd7-fbf7d855acea',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'manage',	'0'),
('df5dcbba-d74e-4b54-8dfb-15fbae39ea8e',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'delete',	'26'),
('e1279678-aabe-4320-8da3-84bcc41c6520',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'destroy',	'83d90384-d553-40fb-a453-ebac91bf29c7'),
('e1279678-aabe-4320-8da3-x',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'destroy',	'b62dd49a-b3a5-4e5e-9442-27dc654cc0c4'),
('e1563fba-7526-432c-a54d-a25a2e8ed3be',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'manage',	'201798a9-f56a-4b80-88a9-cafdb3b4c228'),
('e1eca792-6185-48c6-a90d-8e2250c41926',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'edit',	'23'),
('e2b05a99-0087-407c-a748-8657a9550655',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'store',	'21'),
('e2c2960e-6024-45b6-8735-5ba049a70ebd',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'store',	'23'),
('e38148a8-0723-493d-ac3b-2e87066e2cf4',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'update',	'16'),
('e3cb747d-9276-4bb2-bf76-b56f65d69a56',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'manage',	'83d90384-d553-40fb-a453-ebac91bf29c7'),
('e3cb747d-9276-4bb2-bf76-x',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'manage',	'b62dd49a-b3a5-4e5e-9442-27dc654cc0c4'),
('e3f3ba49-a289-47d9-9123-95cb30480597',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'view',	'16'),
('e4df877e-a28d-4585-9d26-deb726de187b',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'create',	'8259c658-6c0b-4ecc-ad7f-8df608f338eb'),
('e5e54ff4-fe0d-42d8-9aa5-de3e27fb36c9',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'edit',	'18'),
('e63d281f-250b-4d45-b3ca-b20b0a0b1a95',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'create',	'14'),
('e6462898-e09a-4c8c-88d9-730de722182e',	'ca13dba5-4791-4bd2-bd0c-a120296afdcf',	'view',	'18'),
('e73b675e-f55a-49ea-b77b-137a1fc9eea9',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'delete',	'12'),
('e75a93f5-4068-4054-a95d-29f11f4025ef',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'create',	'27'),
('e816ebfb-d3b7-4e92-87db-cceec6e7b2e4',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'edit',	'13'),
('e8c91de8-c676-478c-affb-7d1353e88a63',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'view',	'12'),
('e9185f7e-6d17-4577-b35f-fa9537184f4e',	'0cafa224-4d46-4faa-a5f6-22ddbe8c7756',	'create',	'201798a9-f56a-4b80-88a9-cafdb3b4c228'),
('e934b46e-4922-46db-b65a-39edc218b3ea',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'create',	'13'),
('e98a908d-a968-4b09-91a1-ed794553e19f',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'delete',	'23'),
('ea3a3d73-bbfa-458c-9793-0b812ccb4a3e',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'update',	'27'),
('ea7b7d28-649f-44df-8577-f',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'create',	'22'),
('ea7b7d28-649f-44df-8577-fcdee6112b66',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'create',	'21'),
('ea7b7d28-649f-44df-ss-f',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'create',	'24'),
('eabf3314-7a51-4819-8168-d8271346a9f8',	'1ecb6dea-c45c-4fec-83d4-7191b622be79',	'manage',	'201798a9-f56a-4b80-88a9-cafdb3b4c228'),
('ed5e0b8d-e052-4ee6-8aab-71603bb84c6b',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'destroy',	'20'),
('ed602075-e709-4997-8435-1773f053a5fc',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'create',	'21'),
('edbd8916-4c6b-491e-8332-77f90627325e',	'1ecb6dea-c45c-4fec-83d4-7191b622be79',	'store',	'201798a9-f56a-4b80-88a9-cafdb3b4c228'),
('ee4e57e7-abe7-4aa2-b8d8-5deedbe92b9b',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'view',	'21'),
('ee4e57e7-abe7-4aa2-b8d8-c',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'view',	'22'),
('ee4e57e7-abe7-4aa2-s-c',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'view',	'24'),
('ee83f6fa-966d-4002-bb43-0d532de55729',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'view',	'97d9e4f8-16a0-40a6-9081-5d09ca0bf690'),
('ef6812d9-0e0c-4c7d-a5ce-d42989ed3fcc',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'update',	'201798a9-f56a-4b80-88a9-cafdb3b4c228'),
('f12cf286-435f-4927-af0c-3d1eab23faab',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'create',	'19'),
('f2da32f9-f2e6-434f-9d60-2352a76965fa',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'create',	'68572336-59a6-4a9f-be59-acc13f56be45'),
('f3571618-f9bb-4131-8e64-b2e2487e0781',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'delete',	'18'),
('f3754000-a258-4707-9a7f-270d17602070',	'1ecb6dea-c45c-4fec-83d4-7191b622be79',	'destroy',	'201798a9-f56a-4b80-88a9-cafdb3b4c228'),
('f3b3d4f0-90e1-4551-bc70-89147a503ca6',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'destroy',	'13'),
('f5665809-0339-4b4e-b665-d7dce0290685',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'view',	'83d90384-d553-40fb-a453-ebac91bf29c7'),
('f5665809-0339-4b4e-b665-x',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'view',	'b62dd49a-b3a5-4e5e-9442-27dc654cc0c4'),
('f581de0c-c016-4bff-8702-935c240b9c13',	'ca13dba5-4791-4bd2-bd0c-a120296afdcf',	'delete',	'16'),
('f7b82370-e366-421f-b743-ec0857808d83',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'destroy',	'14'),
('f7be5f29-37f4-4d31-8178-636f1155d4f2',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'delete',	'16'),
('f87b31f9-605e-4cea-a53c-57e36631e06f',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'create',	'8ef00cf3-a058-4332-af85-23ee7bf6008c'),
('f92d01a4-396a-4b76-9900-cdb48d152d16',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'view',	'bda240f0-d68b-4873-b639-392778e5ea05'),
('f92dce77-559b-4add-87f8-5f301b3fe518',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'manage',	'27'),
('fa4f24e6-74d5-4222-8f70-a2886f7b0fcb',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'edit',	'19'),
('fa538c49-9d8d-4301-ac87-e04f01942694',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'manage',	'18'),
('fb56cdc7-cd37-4de1-b640-ac639e7730ae',	'1ecb6dea-c45c-4fec-83d4-7191b622be79',	'delete',	'201798a9-f56a-4b80-88a9-cafdb3b4c228'),
('fc42256d-029b-4fff-896e-bd64416802d6',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'store',	'201798a9-f56a-4b80-88a9-cafdb3b4c228'),
('fd10ffaa-ed2e-40f7-8a79-c08e584a65f6',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'store',	'13'),
('fd20a244-7290-4fcb-9b73-8c7971db82e9',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'store',	'20'),
('fd847c5f-67fb-417f-98e5-6f0f8d95b90c',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'update',	'13'),
('fdb55f94-ea15-496e-b80a-4a69e9f24bce',	'149e82ac-ca7b-4f67-be71-28008b0dd15d',	'manage',	'8259c658-6c0b-4ecc-ad7f-8df608f338eb'),
('fe558336-15e5-42be-8e69-b5ee143730c2',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'update',	'21'),
('fe558336-15e5-42be-8e69-d',	'0ae7e66e-14ad-4366-b9e3-6862f800b123',	'update',	'22'),
('fe558336-15e5-42be-s-d',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'update',	'24');

DROP TABLE IF EXISTS `group_users`;
CREATE TABLE `group_users` (
  `id` bigint unsigned NOT NULL ,
  `user_id` char(36) CHARACTER SET utf8mb4  NOT NULL,
  `group_id` char(36) CHARACTER SET utf8mb4  NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `group_users` (`id`, `user_id`, `group_id`, `created_at`, `updated_at`) VALUES
(9,	'5ba94cf8-3d6e-4171-a885-5fefa3c61248',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'2024-12-03 23:05:53',	'2024-12-04 02:02:57'),
(11,	'e58033c9-8122-4701-b8c5-bb7c943847b8',	'1085ccbd-5eec-4c63-96f7-8bee61a45960',	'2024-12-03 23:56:25',	'2024-12-03 23:56:25'),
(13,	'627b1cc8-45ee-43f5-99e7-20e15cddbfe1',	'e6959d54-477e-4a05-b971-eb315cb95f49',	'2024-12-04 00:18:18',	'2024-12-04 00:18:18');

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` char(36) NOT NULL,
  `guard_name` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `groups` (`id`, `guard_name`, `name`, `status`, `description`) VALUES
('1085ccbd-5eec-4c63-96f7-8bee61a45960',	'web',	'Administrator',	1,	NULL),
('e6959d54-477e-4a05-b971-eb315cb95f49',	'web',	'admin',	1,	NULL);

DROP TABLE IF EXISTS `icons`;
CREATE TABLE `icons` (
  `id` bigint unsigned NOT NULL ,
  `nama` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `data` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `icons` (`id`, `nama`, `data`, `status`, `created_at`, `updated_at`) VALUES
(3,	'Folder Open-edit',	'ri-folder-open-line',	1,	'2024-11-11 07:55:10',	'2024-11-11 09:33:18'),
(4,	'exchange',	'ri-exchange-2-fill',	1,	'2024-11-11 08:01:04',	'2024-11-11 08:01:04'),
(5,	'Folder cssssssssssssssssssss',	'ri-folder-open-line',	1,	'2024-11-11 09:19:40',	'2024-11-11 09:50:29'),
(10,	'hjhj',	'hjhj',	0,	'2024-11-11 10:13:08',	'2024-11-11 10:13:08'),
(11,	'asa',	'ok edit',	1,	'2024-11-11 10:13:27',	'2024-11-11 10:39:48');

DROP TABLE IF EXISTS `menu_groups`;
CREATE TABLE `menu_groups` (
  `id` char(36) CHARACTER SET utf8mb4  NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `permission_name` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `posision` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `menu_groups` (`id`, `name`, `status`, `permission_name`, `posision`, `created_at`, `updated_at`) VALUES
('144bb3e5-1fbb-4ab0-929b-96915bda9adf',	'Main',	1,	'general',	7,	'2024-11-27 06:45:29',	'2024-11-27 06:45:29'),
('1e48cf98-43b2-48cc-bf75-4148e902865e',	'System',	1,	'general',	2,	'2024-11-11 16:34:00',	'2024-11-11 16:34:00'),
('5a92d5cd-f7bf-402e-8a3d-447014334d5b',	'General',	1,	'general',	1,	'2024-11-09 08:21:35',	'2024-11-09 08:21:35'),
('856b17cc-2ed0-497a-b0b3-e18a532fd844',	'TESTING',	1,	'general',	3,	'2024-11-09 08:26:09',	'2024-11-09 08:26:09'),
('9beff1d6-53bb-4821-8162-14f271b02a0e',	'Setting',	1,	'setting',	4,	'2024-11-09 08:21:35',	'2024-11-09 08:21:35'),
('ec818121-97f5-4a29-8554-d58a1e5573d5',	'tes group',	1,	'general',	6,	'2024-11-15 17:25:29',	'2024-11-15 17:25:29');

DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE `menu_items` (
  `id` char(36) CHARACTER SET utf8mb4  NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `modul` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `route` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `permission_name` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `menu_group_id` char(36) CHARACTER SET utf8mb4  NOT NULL,
  `posision` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `menu_items` (`id`, `name`, `modul`, `icon`, `route`, `status`, `permission_name`, `menu_group_id`, `posision`, `created_at`, `updated_at`) VALUES
('201798a9-f56a-4b80-88a9-cafdb3b4c228',	'Role Management',	'role',	'ri-shield-user-line',	'role.index',	1,	'general',	'1e48cf98-43b2-48cc-bf75-4148e902865e',	5,	'2024-11-09 08:21:35',	'2024-11-09 08:21:35'),
('2a829a8f-066f-41f7-a6c9-d81add686a20',	'General Setting',	'setting',	'ri-settings-2-line',	'setting.index',	1,	'general',	'9beff1d6-53bb-4821-8162-14f271b02a0e',	1,	'2024-11-09 08:21:35',	'2024-11-09 08:21:35'),
('33d9527f-b55f-40fc-aeb9-7c2913a02c7b',	'Dashboard',	'dashborad',	'ri-dashboard-2-line',	'dashboard.index',	1,	'general',	'5a92d5cd-f7bf-402e-8a3d-447014334d5b',	1,	'2024-11-09 08:21:35',	'2024-11-09 08:21:35'),
('67a85c98-7409-466e-ac29-123f6f42e601',	'Permission Management',	'permission',	'ri-shield-star-line',	'permission.index',	1,	'general',	'1e48cf98-43b2-48cc-bf75-4148e902865e',	6,	'2024-11-09 08:21:35',	'2024-11-09 08:21:35'),
('68572336-59a6-4a9f-be59-acc13f56be45',	'data combo',	'combo',	'ri-folder-open-line',	'combo.index',	1,	'general',	'9beff1d6-53bb-4821-8162-14f271b02a0e',	8,	'2024-11-09 15:18:54',	'2024-11-12 03:26:29'),
('6fb4ecbd-f03c-46d5-86c4-b320a044942e',	'icon',	'icon',	'ri-exchange-2',	'icon.index',	1,	'general',	'9beff1d6-53bb-4821-8162-14f271b02a0e',	7,	'2024-11-09 09:08:40',	'2024-11-09 09:09:01'),
('7ae0ef19-dbc9-437e-afda-d3320668f30b',	'Route Management',	'route',	'ri-link',	'route.index',	1,	'general',	'1e48cf98-43b2-48cc-bf75-4148e902865e',	4,	'2024-11-09 08:21:35',	'2024-11-09 08:21:35'),
('8259c658-6c0b-4ecc-ad7f-8df608f338eb',	'PIC',	'pic',	'',	'pic.index',	1,	'general',	'144bb3e5-1fbb-4ab0-929b-96915bda9adf',	1,	'2024-11-27 06:46:43',	'2024-11-27 06:46:43'),
('97d9e4f8-16a0-40a6-9081-5d09ca0bf690',	'Menu Management',	'menu',	'ri-menu-line',	'menu.index',	1,	'general',	'9beff1d6-53bb-4821-8162-14f271b02a0e',	3,	'2024-11-09 08:21:35',	'2024-11-09 08:21:35'),
('b62dd49a-b3a5-4e5e-9442-27dc654cc0c4',	'Client & Product',	'clientandproduct',	'',	'clientandproduct.index',	1,	'general',	'5a92d5cd-f7bf-402e-8a3d-447014334d5b',	2,	'2024-12-01 19:26:50',	'2024-12-01 19:26:50'),
('bda240f0-d68b-4873-b639-392778e5ea05',	'group',	'group',	'ri-hime-line',	'group.index',	1,	'general',	'856b17cc-2ed0-497a-b0b3-e18a532fd844',	1,	'2024-11-12 15:41:29',	'2024-11-12 15:41:29'),
('e7c30320-8c77-43d5-8c25-004e59f947ce',	'User Management',	'user',	'ri-file-user-line',	'user.index',	1,	'general',	'9beff1d6-53bb-4821-8162-14f271b02a0e',	2,	'2024-11-09 08:21:35',	'2024-11-09 08:21:35');

DROP TABLE IF EXISTS `menu_settings`;
CREATE TABLE `menu_settings` (
  `id` int unsigned NOT NULL ,
  `menu_id` int DEFAULT NULL,
  `depth` varchar(255)  NOT NULL DEFAULT '5',
  `apply_child_as_parent` tinyint(1) NOT NULL DEFAULT '0',
  `levels` text ,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;


DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` bigint unsigned NOT NULL ,
  `name` varchar(255)  NOT NULL,
  `url` varchar(255)  DEFAULT NULL,
  `icon` varchar(255)  DEFAULT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `status` int unsigned DEFAULT '0',
  `is_active` int unsigned DEFAULT '1',
  `position` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_parent_id_index` (`parent_id`),
  CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `menus` (`id`, `name`, `url`, `icon`, `parent_id`, `status`, `is_active`, `position`, `created_at`, `updated_at`) VALUES
(11,	'System',	'#',	NULL,	NULL,	0,	1,	3,	'2024-12-03 12:23:13',	'2024-12-04 02:30:42'),
(12,	'Permission Management',	'permission.index',	'ri-shield-star-line',	11,	0,	1,	1,	'2024-12-03 12:23:44',	'2024-12-03 12:23:44'),
(13,	'Route Management',	'route.index',	NULL,	11,	0,	1,	2,	'2024-12-03 12:24:15',	'2024-12-03 12:24:15'),
(14,	'General Setting',	'setting.index',	NULL,	11,	0,	1,	3,	'2024-12-03 12:24:35',	'2024-12-03 12:24:35'),
(15,	'General',	'#',	NULL,	NULL,	0,	1,	0,	'2024-12-03 12:25:10',	'2024-12-04 02:31:56'),
(16,	'Client & Product',	'clientandproduct.index',	NULL,	15,	0,	1,	0,	'2024-12-03 12:25:37',	'2024-12-04 02:31:11'),
(17,	'Parameter',	'#',	NULL,	NULL,	0,	1,	2,	'2024-12-03 12:25:54',	'2024-12-04 02:32:08'),
(18,	'PIC',	'pic.index',	NULL,	17,	0,	1,	1,	'2024-12-03 12:26:22',	'2024-12-03 12:26:22'),
(19,	'icon',	'icon.index',	NULL,	11,	0,	1,	2,	'2024-12-03 12:26:45',	'2024-12-03 12:26:45'),
(20,	'Group',	'group.index',	NULL,	11,	0,	1,	4,	'2024-12-03 12:27:11',	'2024-12-03 12:27:11'),
(21,	'Users',	'user.index',	'e',	17,	0,	1,	0,	'2024-12-03 13:17:25',	'2024-12-03 21:13:56'),
(22,	'wdhgwy',	'combo.index',	'g',	NULL,	0,	0,	0,	'2024-12-03 18:21:09',	'2024-12-04 02:31:40'),
(23,	'Menu Management',	'menus.index',	NULL,	11,	0,	1,	0,	'2024-12-03 18:25:52',	'2024-12-03 19:07:06'),
(24,	'DOCUMENT VERIFY',	'documenctferify.index',	NULL,	15,	0,	1,	0,	'2024-12-04 02:12:38',	'2024-12-04 02:31:15'),
(25,	'REVIEW DOCUMENT VERIFY',	'combo.index',	NULL,	15,	0,	1,	0,	'2024-12-04 02:12:58',	'2024-12-04 02:31:19'),
(26,	'Reporting',	'#',	NULL,	15,	0,	1,	0,	'2024-12-04 02:13:20',	'2024-12-04 02:31:23'),
(27,	'Docferify',	'docferify.index',	NULL,	17,	0,	1,	3,	'2024-12-04 03:05:05',	'2024-12-04 03:05:05');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL ,
  `migration` varchar(255)  NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_reset_tokens_table',	1),
(3,	'2014_10_12_200000_add_two_factor_columns_to_users_table',	1),
(4,	'2019_08_19_000000_create_failed_jobs_table',	1),
(5,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(6,	'2023_08_19_092704_create_permission_tables',	1),
(7,	'2023_08_19_094825_create_routes_table',	1),
(8,	'2023_08_20_084236_create_settings_table',	1),
(9,	'2023_09_03_130926_create_menu_groups_table',	1),
(10,	'2023_10_03_130908_create_menu_items_table',	1),
(11,	'2024_11_10_021206_create_combo_table',	2),
(12,	'2024_11_10_032117_create_students_table',	3),
(13,	'2024_11_27_205919_create_p_i_c_s_table',	4),
(14,	'2024_12_03_035223_create_client_products_table',	5),
(15,	'2024_12_03_095301_create_menus_table',	6),
(16,	'2019_08_22_221932_create_menus_table',	7),
(17,	'2019_08_27_165403_create_menu_items_table',	7),
(18,	'2019_08_27_165403_create_menu_settings_table',	7),
(19,	'2024_12_03_110628_create_menus_table',	8);

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255)  NOT NULL,
  `model_id` char(36)  NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;


DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255)  NOT NULL,
  `model_id` char(36)  NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2,	'App\\Models\\User',	'464fed84-143b-477a-8798-6a9ede86134f'),
(1,	'App\\Models\\User',	'a165e7e4-a637-48ad-bff2-8e8cb6b38b74');

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255)  NOT NULL,
  `token` varchar(255)  NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;


DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL ,
  `name` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 ,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `description`, `created_at`, `updated_at`) VALUES
(1,	'permission_index',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(2,	'permission_store',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(3,	'permission_update',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(4,	'permission_destroy',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(5,	'general',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(6,	'setting',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(7,	'dashboard_index',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(8,	'setting_index',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(9,	'setting_update',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(10,	'user_index',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(11,	'user_store',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(12,	'user_update',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(13,	'user_destroy',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(14,	'profile_index',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(15,	'menu_index',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(16,	'menu_store',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(17,	'menu_update',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(18,	'menu_destroy',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(19,	'menu_item_index',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(20,	'menu_item_store',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(21,	'menu_item_update',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(22,	'menu_item_destroy',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(23,	'route_index',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(24,	'route_store',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(25,	'route_update',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(26,	'route_destroy',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(27,	'role_index',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(28,	'role_store',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(29,	'role_update',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(30,	'role_destroy',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(31,	'icon_index',	'web',	'icon_index',	'2024-11-09 15:29:01',	'2024-11-09 16:07:50'),
(32,	'combo_index',	'web',	'permision combos',	'2024-11-12 10:24:23',	'2024-11-12 11:10:04'),
(33,	'combo_create',	'web',	'ijsdis',	'2024-11-12 10:41:05',	'2024-11-12 10:41:05');

DROP TABLE IF EXISTS `permissions_old`;
CREATE TABLE `permissions_old` (
  `id` bigint unsigned NOT NULL ,
  `name` varchar(255)  NOT NULL,
  `guard_name` varchar(255)  NOT NULL,
  `description` longtext ,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `permissions_old` (`id`, `name`, `guard_name`, `description`, `created_at`, `updated_at`) VALUES
(1,	'general',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(2,	'setting',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(3,	'dashboard_index',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(4,	'setting_index',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(5,	'setting_update',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(6,	'user_index',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(7,	'user_store',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(8,	'user_update',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(9,	'user_destroy',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(10,	'profile_index',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(11,	'menu_index',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(12,	'menu_store',	'web',	NULL,	'2024-11-09 15:21:34',	'2024-11-09 15:21:34'),
(13,	'menu_update',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(14,	'menu_destroy',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(15,	'menu_item_index',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(16,	'menu_item_store',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(17,	'menu_item_update',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(18,	'menu_item_destroy',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(19,	'route_index',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(20,	'route_store',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(21,	'route_update',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(22,	'route_destroy',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(23,	'role_index',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(24,	'role_store',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(25,	'role_update',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(26,	'role_destroy',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(27,	'permission_index',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(28,	'permission_store',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(29,	'permission_update',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(30,	'permission_destroy',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(31,	'icon_index',	'web',	'icon_index',	'2024-11-09 15:29:01',	'2024-11-09 16:07:50');

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL ,
  `tokenable_type` varchar(255)  NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255)  NOT NULL,
  `token` varchar(64)  NOT NULL,
  `abilities` text ,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;


DROP TABLE IF EXISTS `pics`;
CREATE TABLE `pics` (
  `id` bigint unsigned NOT NULL ,
  `nama` varchar(255)  NOT NULL,
  `product` varchar(255)  NOT NULL,
  `nilai_project` decimal(15,2) NOT NULL,
  `status` varchar(255)  NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `pics` (`id`, `nama`, `product`, `nilai_project`, `status`, `created_at`, `updated_at`) VALUES
(2,	'nama penyedia',	'jenis produc',	187867.00,	'1',	'2024-11-27 14:07:39',	'2024-11-27 14:07:39'),
(3,	'penyedia 2',	'jenis 2',	2121.00,	'1',	'2024-11-27 14:08:58',	'2024-11-27 14:08:58'),
(4,	'penyedia 3',	'jenis 3',	2121.00,	'1',	'2024-11-27 14:08:58',	'2024-11-27 14:08:58');

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1,	1),
(2,	1),
(3,	1),
(4,	1),
(5,	1),
(6,	1),
(7,	1),
(8,	1),
(9,	1),
(10,	1),
(11,	1),
(12,	1),
(13,	1),
(14,	1),
(15,	1),
(16,	1),
(17,	1),
(18,	1),
(19,	1),
(20,	1),
(21,	1),
(22,	1),
(23,	1),
(24,	1),
(25,	1),
(26,	1),
(27,	1),
(28,	1),
(29,	1),
(30,	1),
(31,	1),
(32,	1),
(5,	2),
(6,	2),
(7,	2),
(32,	2),
(33,	2);

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL ,
  `name` varchar(255)  NOT NULL,
  `guard_name` varchar(255)  NOT NULL,
  `description` longtext ,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `description`, `created_at`, `updated_at`) VALUES
(1,	'Super Admin',	'web',	NULL,	'2024-11-09 15:21:35',	'2024-11-09 15:21:35'),
(2,	'User',	'web',	'tes',	'2024-11-09 15:21:35',	'2024-11-12 10:25:12'),
(3,	'role dkd',	'web',	'cek',	'2024-11-11 14:39:25',	'2024-11-11 14:39:25');

DROP TABLE IF EXISTS `routes`;
CREATE TABLE `routes` (
  `id` bigint unsigned NOT NULL ,
  `route` varchar(255)  NOT NULL,
  `permission_name` varchar(255)  NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `description` longtext ,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `routes` (`id`, `route`, `permission_name`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1,	'dashboard.index',	'dashboard_index',	1,	NULL,	NULL,	NULL),
(2,	'setting.index',	'setting_index',	1,	NULL,	NULL,	NULL),
(3,	'setting.update',	'setting_update',	1,	NULL,	NULL,	NULL),
(4,	'user.index',	'user_index',	1,	NULL,	NULL,	NULL),
(5,	'user.store',	'user_store',	1,	NULL,	NULL,	NULL),
(6,	'user.update',	'user_update',	1,	NULL,	NULL,	NULL),
(7,	'user.destroy',	'user_destroy',	1,	NULL,	NULL,	NULL),
(8,	'profile.index',	'profile_index',	1,	NULL,	NULL,	NULL),
(9,	'menu.index',	'menu_index',	1,	NULL,	NULL,	NULL),
(10,	'menu.store',	'menu_store',	1,	NULL,	NULL,	NULL),
(11,	'menu.update',	'menu_update',	1,	NULL,	NULL,	NULL),
(12,	'menu.destroy',	'menu_destroy',	1,	NULL,	NULL,	NULL),
(13,	'menu.item.index',	'menu_item_index',	1,	NULL,	NULL,	NULL),
(14,	'menu.item.store',	'menu_item_store',	1,	NULL,	NULL,	NULL),
(15,	'menu.item.update',	'menu_item_update',	1,	NULL,	NULL,	NULL),
(16,	'menu.item.destroy',	'menu_item_destroy',	1,	NULL,	NULL,	NULL),
(17,	'route.index',	'route_index',	1,	NULL,	NULL,	NULL),
(18,	'route.store',	'route_store',	1,	NULL,	NULL,	NULL),
(19,	'route.update',	'route_update',	1,	NULL,	NULL,	NULL),
(20,	'route.destroy',	'route_destroy',	1,	NULL,	NULL,	NULL),
(21,	'role.index',	'role_index',	1,	NULL,	NULL,	NULL),
(22,	'role.store',	'role_store',	1,	NULL,	NULL,	NULL),
(23,	'role.update',	'role_update',	1,	NULL,	NULL,	NULL),
(24,	'role.destroy',	'role_destroy',	1,	NULL,	NULL,	NULL),
(25,	'permission.index',	'permission_index',	1,	NULL,	NULL,	NULL),
(26,	'permission.store',	'permission_store',	1,	NULL,	NULL,	NULL),
(27,	'permission.update',	'permission_update',	1,	NULL,	NULL,	NULL),
(28,	'permission.destroy',	'permission_destroy',	1,	NULL,	NULL,	NULL),
(29,	'tes.index',	'tes.index',	1,	NULL,	NULL,	NULL),
(30,	'combo.create',	'icon_index',	1,	'add combo create',	'2024-11-11 03:13:47',	'2024-11-11 03:13:47');

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` char(36)  NOT NULL,
  `name` varchar(255)  NOT NULL,
  `data` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `settings` (`id`, `name`, `data`, `created_at`, `updated_at`) VALUES
('f06bcfd1-63a5-4a77-b1f9-3ffdd0e6b8cf',	'General',	'{\"logo\": \"{\\\"sm\\\":\\\"logo-sm.png\\\",\\\"dark\\\":\\\"logo-dark.png\\\",\\\"light\\\":\\\"logo-light.png\\\"}\", \"role\": \"User\"}',	'2024-11-09 15:21:35',	'2024-11-09 15:21:35');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` char(36)  NOT NULL,
  `name` varchar(255)  NOT NULL,
  `email` varchar(255)  NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255)  NOT NULL,
  `two_factor_secret` text ,
  `two_factor_recovery_codes` text ,
  `remember_token` varchar(100)  DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`) VALUES
('5ba94cf8-3d6e-4171-a885-5fefa3c61248',	'admin',	'admin@gmail.com',	'2024-12-04 02:02:57',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'jKbhxBvV9p8t6Hgw0sRo3ft2LEOphYyNDsgDyfP1KKaz4zlOiMHF6sEAevQ6',	'2024-11-09 15:21:34',	'2024-12-04 02:02:57'),
('e58033c9-8122-4701-b8c5-bb7c943847b8',	'USER ROOT',	'root@gmail.com',	'2024-12-04 02:02:39',	'$2y$10$YVa7gksBAW2emNXOX2oFt.NtclOdsQsNB4QKugIxKKBBWGQxoGZrO',	NULL,	NULL,	NULL,	'2024-12-03 23:04:57',	'2024-12-04 02:02:39');

DROP VIEW IF EXISTS `view_group_permissions`;

DROP VIEW IF EXISTS `view_group_permissions_old`;
CREATE TABLE `view_group_permissions_old` (`id` char(36), `menu_group_id` char(36), `menu_item_id` char(36), `group_name` varchar(255), `group_description` text, `permission_type` enum('manage','create','update','delete','view','store','destroy','edit'), `menu_item_name` varchar(255), `menu_item_route` varchar(255), `menu_parent` varchar(255), `menu_item_icon` varchar(255));


DROP TABLE IF EXISTS `view_group_permissions`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_group_permissions` AS select `g`.`id` AS `id`,`mi`.`id` AS `menu_item_id`,`g`.`name` AS `group_name`,`g`.`description` AS `group_description`,`gp`.`permission_type` AS `permission_type`,`mi`.`name` AS `menu_item_name`,`mi`.`url` AS `menu_item_route`,`mi`.`icon` AS `menu_item_icon`,`mi`.`parent_id` AS `parent_id` from ((`groups` `g` join `group_permissions` `gp` on((`g`.`id` = (`gp`.`group_id` )))) join `menus` `mi` on((`gp`.`menu_item_id` = (`mi`.`id` ))));

DROP TABLE IF EXISTS `view_group_permissions_old`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_group_permissions_old` AS select `g`.`id` AS `id`,`mg`.`id` AS `menu_group_id`,`mi`.`id` AS `menu_item_id`,`g`.`name` AS `group_name`,`g`.`description` AS `group_description`,`gp`.`permission_type` AS `permission_type`,`mi`.`name` AS `menu_item_name`,`mi`.`route` AS `menu_item_route`,`mg`.`name` AS `menu_parent`,`mi`.`icon` AS `menu_item_icon` from (((`groups` `g` join `group_permissions` `gp` on((`g`.`id` = (`gp`.`group_id` )))) join `menu_items` `mi` on((`gp`.`menu_item_id` = (`mi`.`id` )))) join `menu_groups` `mg` on((`mi`.`menu_group_id` = (`mg`.`id` ))));

-- 2024-12-04 14:28:25
