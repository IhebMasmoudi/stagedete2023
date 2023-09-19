-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 19 sep. 2023 à 16:41
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `etap`
--

-- --------------------------------------------------------

--
-- Structure de la table `counters`
--

CREATE TABLE `counters` (
  `CounterReferenceid` int(10) UNSIGNED NOT NULL,
  `CounterReference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LocalCode` int(10) UNSIGNED NOT NULL,
  `CounterTypeCode` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `counters`
--

INSERT INTO `counters` (`CounterReferenceid`, `CounterReference`, `LocalCode`, `CounterTypeCode`, `created_at`, `updated_at`) VALUES
(1, 'REF-01', 1, 1, '2023-09-18 17:04:16', '2023-09-18 17:04:16'),
(2, 'REF-02', 2, 1, '2023-09-18 17:04:26', '2023-09-18 17:04:26'),
(3, 'REF-03', 2, 2, '2023-09-18 17:04:36', '2023-09-18 17:04:36'),
(4, 'REF-04', 1, 3, '2023-09-18 17:04:43', '2023-09-18 17:04:43');

-- --------------------------------------------------------

--
-- Structure de la table `counter_types`
--

CREATE TABLE `counter_types` (
  `CounterTypeCode` int(10) UNSIGNED NOT NULL,
  `CounterType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `counter_types`
--

INSERT INTO `counter_types` (`CounterTypeCode`, `CounterType`, `created_at`, `updated_at`) VALUES
(1, 'Water', '2023-09-18 17:03:35', '2023-09-18 17:03:35'),
(2, 'Gaz', '2023-09-18 17:03:40', '2023-09-18 17:03:40'),
(3, 'Electricity', '2023-09-18 17:03:44', '2023-09-18 17:03:44');

-- --------------------------------------------------------

--
-- Structure de la table `districts`
--

CREATE TABLE `districts` (
  `id` int(10) UNSIGNED NOT NULL,
  `district_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `districts`
--

INSERT INTO `districts` (`id`, `district_name`, `description`, `Created_by`, `created_at`, `updated_at`) VALUES
(1, 'district 1', 'desc district', 'iheb', '2023-09-18 17:00:50', '2023-09-18 17:00:50'),
(2, 'district 2', 'des district2', 'iheb', '2023-09-18 17:01:00', '2023-09-18 17:01:00');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `invoices`
--

CREATE TABLE `invoices` (
  `idinvoice` int(10) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_Date` date NOT NULL,
  `due_date` date NOT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate_vat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value_vat` decimal(8,2) NOT NULL,
  `Total` decimal(8,2) NOT NULL,
  `Status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value_Status` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pathImage` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CounterReferenceid` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `invoices`
--

INSERT INTO `invoices` (`idinvoice`, `invoice_number`, `invoice_Date`, `due_date`, `discount`, `rate_vat`, `value_vat`, `Total`, `Status`, `value_Status`, `note`, `pathImage`, `Created_by`, `CounterReferenceid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '01', '2023-09-11', '2023-11-05', '5', '7', '4500.00', '4810.00', 'Paid', 1, 'noyr', 'invoices/toJFkcDVIPZ3VVlz4s95qFPk1if0E2viZ4ACxqY5.pdf', 'iheb', 1, NULL, '2023-09-18 17:05:22', '2023-09-18 17:07:40'),
(2, '2', '2023-08-05', '2023-10-08', '2', '10', '7000.00', '7698.00', 'Unpaid', 2, 'note', 'invoices/i5psQ5f8Hqz4EVr6hbIjbTeZmJrmolOwwnmCV84N.pdf', 'iheb', 2, NULL, '2023-09-18 17:06:01', '2023-09-18 17:06:01'),
(3, '3', '2023-06-02', '2023-09-24', '4', '7', '5000.00', '5346.00', 'Unpaid', 2, 'note', 'invoices/My5Jx8uTd285vNeka5r6DeMOz9nZj2PbCqdlJ1TK.pdf', 'iheb', 3, NULL, '2023-09-18 17:06:25', '2023-09-18 17:06:25');

-- --------------------------------------------------------

--
-- Structure de la table `locality_families`
--

CREATE TABLE `locality_families` (
  `FamilyCode` int(10) UNSIGNED NOT NULL,
  `LocalFamily` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `locations`
--

CREATE TABLE `locations` (
  `LocalCode` int(10) UNSIGNED NOT NULL,
  `LocalLabel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LocalAddress` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `DistrictCode` int(10) UNSIGNED NOT NULL,
  `SubFamilyCode` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `locations`
--

INSERT INTO `locations` (`LocalCode`, `LocalLabel`, `LocalAddress`, `DistrictCode`, `SubFamilyCode`, `created_at`, `updated_at`) VALUES
(1, 'Tunis', 'Tunis,tunis', 1, 1, '2023-09-18 17:03:55', '2023-09-18 17:03:55'),
(2, 'Ariana', 'Ariana', 2, 2, '2023-09-18 17:04:04', '2023-09-18 17:04:04');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2023_06_18_144933_create_districts_table', 1),
(5, '2023_06_22_132822_create_locality_families_table', 1),
(6, '2023_06_23_133156_create_sub_familys_table', 1),
(7, '2023_06_24_133100_create_counter_types_table', 1),
(8, '2023_06_25_133518_create_locations_table', 1),
(9, '2023_06_26_133559_create_counters_table', 1),
(10, '2023_06_27_133656_create_invoices_table', 1),
(11, '2023_06_29_151527_create_permission_tables', 1),
(12, '2023_07_02_100635_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('69106578-4354-4b02-a485-fd7f57ccd320', 'App\\Notifications\\Add_invoice', 'App\\User', 1, '{\"id\":null,\"title\":\"   invoice Added By  :\",\"user\":\"iheb\"}', NULL, '2023-09-18 17:06:25', '2023-09-18 17:06:25'),
('dfbfaf27-722c-42b1-8ce5-516e286c44a9', 'App\\Notifications\\Add_invoice', 'App\\User', 1, '{\"id\":null,\"title\":\"   invoice Added By  :\",\"user\":\"iheb\"}', NULL, '2023-09-18 17:06:01', '2023-09-18 17:06:01'),
('e4ec4339-6f49-4721-9a56-4024e37e382e', 'App\\Notifications\\Add_invoice', 'App\\User', 1, '{\"id\":null,\"title\":\"   invoice Added By  :\",\"user\":\"iheb\"}', NULL, '2023-09-18 17:05:22', '2023-09-18 17:05:22');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2023-09-18 16:59:02', '2023-09-18 16:59:02'),
(2, 'role-create', 'web', '2023-09-18 16:59:02', '2023-09-18 16:59:02'),
(3, 'role-edit', 'web', '2023-09-18 16:59:02', '2023-09-18 16:59:02'),
(4, 'role-delete', 'web', '2023-09-18 16:59:02', '2023-09-18 16:59:02'),
(5, 'Add', 'web', '2023-09-18 16:59:02', '2023-09-18 16:59:02'),
(6, 'Edit', 'web', '2023-09-18 16:59:02', '2023-09-18 16:59:02'),
(7, 'Read', 'web', '2023-09-18 16:59:02', '2023-09-18 16:59:02'),
(8, 'Delete', 'web', '2023-09-18 16:59:02', '2023-09-18 16:59:02');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'owner', 'web', '2023-09-18 16:59:10', '2023-09-18 16:59:10'),
(2, 'user', 'web', '2023-09-18 17:03:00', '2023-09-18 17:03:00');

-- --------------------------------------------------------

--
-- Structure de la table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(7, 2),
(8, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sub_families`
--

CREATE TABLE `sub_families` (
  `SubFamilyCode` int(10) UNSIGNED NOT NULL,
  `SubFamily` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LocalFamily` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sub_families`
--

INSERT INTO `sub_families` (`SubFamilyCode`, `SubFamily`, `LocalFamily`, `created_at`, `updated_at`) VALUES
(1, 'SUb Locla Fam1', 'Local Family 1', '2023-09-18 17:01:10', '2023-09-18 17:01:10'),
(2, 'SUb Locla Fam2', 'Local Family 2', '2023-09-18 17:01:27', '2023-09-18 17:01:27');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `roles_name`, `Status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'iheb', 'admin@gmail.com', NULL, '$2y$10$dfP5JITLMr7V.pIKm9ePce31RJRNTdDymxwfJ0BQHUkSZPNmxzCmC', '[\"owner\"]', 'Active', NULL, '2023-09-18 16:59:10', '2023-09-18 16:59:10'),
(2, 'user', 'user@gmail.com', NULL, '$2y$10$KRGwyG.KdejJq5Dpf2mhyu18M6VB3G66NZNMD34JvT.MPWTWG4fA2', '[\"owner\"]', 'Active', NULL, '2023-09-18 17:02:15', '2023-09-18 20:02:34');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `counters`
--
ALTER TABLE `counters`
  ADD PRIMARY KEY (`CounterReferenceid`),
  ADD KEY `counters_localcode_foreign` (`LocalCode`),
  ADD KEY `counters_countertypecode_foreign` (`CounterTypeCode`);

--
-- Index pour la table `counter_types`
--
ALTER TABLE `counter_types`
  ADD PRIMARY KEY (`CounterTypeCode`);

--
-- Index pour la table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`idinvoice`),
  ADD KEY `invoices_counterreferenceid_foreign` (`CounterReferenceid`);

--
-- Index pour la table `locality_families`
--
ALTER TABLE `locality_families`
  ADD PRIMARY KEY (`FamilyCode`);

--
-- Index pour la table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`LocalCode`),
  ADD KEY `locations_districtcode_foreign` (`DistrictCode`),
  ADD KEY `locations_subfamilycode_foreign` (`SubFamilyCode`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Index pour la table `sub_families`
--
ALTER TABLE `sub_families`
  ADD PRIMARY KEY (`SubFamilyCode`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `counters`
--
ALTER TABLE `counters`
  MODIFY `CounterReferenceid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `counter_types`
--
ALTER TABLE `counter_types`
  MODIFY `CounterTypeCode` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `idinvoice` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `locality_families`
--
ALTER TABLE `locality_families`
  MODIFY `FamilyCode` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `locations`
--
ALTER TABLE `locations`
  MODIFY `LocalCode` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `sub_families`
--
ALTER TABLE `sub_families`
  MODIFY `SubFamilyCode` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `counters`
--
ALTER TABLE `counters`
  ADD CONSTRAINT `counters_countertypecode_foreign` FOREIGN KEY (`CounterTypeCode`) REFERENCES `counter_types` (`CounterTypeCode`),
  ADD CONSTRAINT `counters_localcode_foreign` FOREIGN KEY (`LocalCode`) REFERENCES `locations` (`LocalCode`);

--
-- Contraintes pour la table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_counterreferenceid_foreign` FOREIGN KEY (`CounterReferenceid`) REFERENCES `counters` (`CounterReferenceid`);

--
-- Contraintes pour la table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_districtcode_foreign` FOREIGN KEY (`DistrictCode`) REFERENCES `districts` (`id`),
  ADD CONSTRAINT `locations_subfamilycode_foreign` FOREIGN KEY (`SubFamilyCode`) REFERENCES `sub_families` (`SubFamilyCode`);

--
-- Contraintes pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
