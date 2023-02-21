-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 21 fév. 2023 à 14:18
-- Version du serveur :  10.4.16-MariaDB
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO"; 
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bilemo`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `name`, `email`, `password`, `created_at`, `roles`) VALUES
(14, 'aliquid', 'martine.andre@cousin.net', '$2y$13$V1xEIh9SuWfvHECXSmP3wuFY/ql0kaKM88uxz.yu1kv/r2tvpLSTW', '2023-01-22 18:12:26', '[\"ROLE_USER\"]'),
(15, 'iusto', 'dominique.gallet@breton.fr', '$2y$13$cyXND68a4VcGFFB5CmBm4e64cth7EqD3YfE.Qg3wc0WEcRDMSpeT6', '2023-01-22 18:12:30', '[\"ROLE_USER\"]'),
(16, 'dignissimos', 'xgaillard@laposte.net', '$2y$13$nDk3HIQNvvWL1Wzrm/B6EOvzpdHWZULNAYifI9sGrQ/UGY7eIQimu', '2023-01-22 18:12:35', '[\"ROLE_USER\"]'),
(17, 'quis', 'pelletier.gregoire@pelletier.com', '$2y$13$4j6dzNZ/JoKiBZ9/CpSklu5vq4UX2yttDOV5WSJt9FwNwZeYk2hRW', '2023-01-22 18:12:40', '[\"ROLE_USER\"]'),
(18, 'voluptatum', 'eberger@levy.com', '$2y$13$I/BpsuEOUgW9Vjef.4LfDuMUHcAEd6NnNPj/yC91FdlYkLQlubWfW', '2023-01-22 18:12:44', '[\"ROLE_USER\"]');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20221118124834', '2022-11-18 13:49:41', 653),
('DoctrineMigrations\\Version20221121110526', '2022-11-21 12:06:13', 1332),
('DoctrineMigrations\\Version20221121145503', '2022-11-21 15:56:23', 1792),
('DoctrineMigrations\\Version20221121150642', '2022-11-21 16:07:05', 572),
('DoctrineMigrations\\Version20221121152522', '2022-11-21 18:24:29', 1108),
('DoctrineMigrations\\Version20221121172408', '2022-11-21 18:31:47', 399),
('DoctrineMigrations\\Version20221122112312', '2022-11-22 12:23:53', 1394),
('DoctrineMigrations\\Version20221122144238', '2022-11-22 15:43:24', 1199),
('DoctrineMigrations\\Version20221124221951', '2022-11-24 23:23:34', 3201),
('DoctrineMigrations\\Version20230105162123', '2023-01-05 17:22:14', 2680),
('DoctrineMigrations\\Version20230119151958', '2023-01-19 16:21:12', 4188),
('DoctrineMigrations\\Version20230119154338', '2023-01-19 16:43:49', 608);

-- --------------------------------------------------------

--
-- Structure de la table `phone`
--

CREATE TABLE `phone` (
  `id` int(11) NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `phone`
--

INSERT INTO `phone` (`id`, `model`, `reference`, `color`, `description`, `price`) VALUES
(867, 'non', 'qui dolorem rem', 'facilis', 'qui assumenda aut dignissimos placeat deserunt omnis eum autem nemo', 932),
(868, 'facere', 'autem commodi doloribus', 'totam', 'necessitatibus sit quia et harum et enim quo cupiditate nulla', 1403),
(869, 'beatae', 'error sapiente ipsam', 'aperiam', 'eum vel aut laudantium facilis similique earum quam quaerat explicabo', 1278),
(870, 'culpa', 'non aut sunt', 'fugit', 'maxime error et omnis nesciunt beatae dolorum sunt temporibus magnam', 1498),
(871, 'et', 'possimus eaque nemo', 'accusantium', 'consequatur quas aut soluta rerum in enim cumque sed at', 1489),
(872, 'aliquam', 'qui quia rerum', 'sequi', 'vero mollitia sit deserunt et ipsam dolorem maiores consequuntur voluptas', 1125),
(873, 'est', 'voluptatum quis debitis', 'porro', 'laboriosam praesentium praesentium sed rerum rerum dolor hic aliquid quis', 818),
(874, 'tempora', 'iure sed dicta', 'in', 'cupiditate harum labore et inventore placeat sapiente similique saepe sit', 1279),
(875, 'dolorem', 'est minima ut', 'iure', 'harum qui vitae consequuntur dolores in totam numquam modi accusamus', 1491),
(876, 'et', 'et hic et', 'aut', 'distinctio magnam tempora ut libero totam mollitia exercitationem corporis voluptatibus', 1305),
(877, 'ducimus', 'harum totam molestiae', 'dolor', 'tempora voluptate sit culpa velit ut autem quasi enim consequatur', 802),
(878, 'mollitia', 'doloremque fuga quas', 'facere', 'dolor aliquid minus commodi inventore sint reiciendis veritatis id doloribus', 1377),
(879, 'molestiae', 'accusantium voluptatem vero', 'dolor', 'accusantium expedita cupiditate aspernatur ex quia deserunt rerum excepturi sit', 1218),
(880, 'unde', 'dolores aut unde', 'sit', 'quia possimus earum atque nulla voluptatibus aperiam molestiae culpa soluta', 1407),
(881, 'atque', 'aperiam praesentium ad', 'mollitia', 'illo nam suscipit architecto maiores doloribus eveniet dolor autem consequuntur', 1116),
(882, 'mollitia', 'voluptatem quo nemo', 'modi', 'omnis maiores excepturi ut aperiam saepe maxime alias qui dolor', 982),
(883, 'iure', 'sapiente perspiciatis sequi', 'ut', 'reiciendis officia tenetur accusantium recusandae dolores autem perspiciatis sed sed', 1036),
(884, 'laborum', 'ut et omnis', 'in', 'esse dolores ut et dolores omnis id culpa qui eaque', 1154),
(885, 'et', 'iste cumque amet', 'qui', 'corporis ab magni harum est animi repellendus nihil vel expedita', 913),
(886, 'molestiae', 'quisquam eos quibusdam', 'vel', 'nobis aut vel aliquam quo aut minus officiis in facere', 1444),
(887, 'magnam', 'est doloribus suscipit', 'illo', 'autem aperiam corrupti ipsum placeat quis et quia eum debitis', 1377),
(888, 'aut', 'corporis ut ipsa', 'ut', 'nihil a necessitatibus eos optio ut perferendis omnis dolores quibusdam', 1243),
(889, 'itaque', 'nemo tempora nostrum', 'corporis', 'est sit ducimus odio dolore quia asperiores placeat ipsam blanditiis', 808),
(890, 'exercitationem', 'a hic saepe', 'amet', 'nam facere voluptas mollitia autem aliquid exercitationem qui est culpa', 1341),
(891, 'rem', 'ipsum quia illum', 'qui', 'consequatur doloremque ea ut sed consequatur minima impedit qui temporibus', 1008);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `created_at`, `client_id`) VALUES
(145, 'quos nemo', 'imbert.therese@bonnet.com', '$2y$13$FmcTFuhKtluXUm0JafALIuFpRI0QLOo7xLObQeI1dHUlgWWqMfwyi', '2023-01-22 18:12:26', 14),
(146, 'facilis officia', 'courtois.jeanne@noos.fr', '$2y$13$07Qte73vnYCHsv0EqzrjWOT4YY0p0xtJAdO/XT2PtTCjo.OZY3gyO', '2023-01-22 18:12:27', 14),
(147, 'reiciendis neque', 'roger.olivier@andre.net', '$2y$13$6IhD205EnaE2o2haqTLzv.Vu7ER8MAqCIs9AdgPz0DFT66UNX8/Jy', '2023-01-22 18:12:28', 14),
(148, 'repellat temporibus', 'celine39@leroux.com', '$2y$13$JhJa7Qg35l6eiNkZlZJV5uC9I4ghvqO.uZCJYuXTillPQJsIySf8a', '2023-01-22 18:12:29', 14),
(151, 'dicta illo', 'christiane.marty@clement.com', '$2y$13$VS2ubuJO2QWaZqsUhA5/PerK1U.tyvzQa6xCvuoU/D51AVawo5j3C', '2023-01-22 18:12:32', 15),
(152, 'ut officia', 'aime.barbe@joly.fr', '$2y$13$MiFLC5CaUhS951cdl688Iu.9Ufdmh69FT9oEx4C2Fbz36m16N0foW', '2023-01-22 18:12:33', 15),
(153, 'facere aliquid', 'rbesnard@tiscali.fr', '$2y$13$58.M5Yh.tAVjeo/VTb9C5.bt3iSGeFFkQVDxa4rvS18yT144GlNUe', '2023-01-22 18:12:33', 15),
(154, 'ullam repudiandae', 'lebon.alexandria@gilles.com', '$2y$13$IWRTuEntzUCrS6nH0pq0meQpzjNCa/3VtSMa/PeeaZDgVhqwHcA8G', '2023-01-22 18:12:34', 15),
(155, 'dolores natus', 'dominique.masse@pottier.com', '$2y$13$JMDI05/ymIdKdEwfXyFYB.vGPAVFzZE.pVu.4GVjiMzXNctg6Bdfu', '2023-01-22 18:12:36', 16),
(156, 'quo beatae', 'claude93@dumas.fr', '$2y$13$DJcza/pw28/eSDNut.0ehexHu2EUfzCuu32VfG4CPAezrcy1AK1ri', '2023-01-22 18:12:37', 16),
(157, 'cumque expedita', 'gbrunet@picard.org', '$2y$13$P6hCKJQkbGLof8jnGtVT6.fe8nOi8L8rMT.k/SSwptB/0ycJQJCqG', '2023-01-22 18:12:37', 16),
(158, 'doloribus vel', 'guy.rossi@bonnin.fr', '$2y$13$VEiRfRvz/M1n9VfHedS1BeBWAnVxh/7tWbSRLfqll3psnG23ENL7a', '2023-01-22 18:12:38', 16),
(159, 'neque dolores', 'remy80@voila.fr', '$2y$13$/UpTpxSqHDg4qzJauD0IyOrMEcj1giFf3xVRFHb7UAcSy1EYFzu3S', '2023-01-22 18:12:39', 16),
(160, 'molestiae perspiciatis', 'kdelahaye@ifrance.com', '$2y$13$r1VyOlhtkvcksfZVuGzRWO4Y1Lx2KCCFxjezKDjufWSUp4fb78HPy', '2023-01-22 18:12:40', 17),
(161, 'omnis culpa', 'vidal.margot@delmas.com', '$2y$13$8VPbtmqetwlva.0Rf3zzkuztvEsnYnlwg/t8BPMJRvipG9thBPUti', '2023-01-22 18:12:41', 17),
(162, 'qui perspiciatis', 'valentine.bazin@ifrance.com', '$2y$13$0tgHd2sFI6CS1MKxQE87z./1QiXXfnwNNRY9naN1YUwxt5WtOQWZi', '2023-01-22 18:12:42', 17),
(163, 'iste exercitationem', 'lacombe.christophe@club-internet.fr', '$2y$13$59WjiFQFBbIWCbYxX4kUtezB0fh2eV8QeBH2S7pTVTIdi/TjmkrrC', '2023-01-22 18:12:43', 17),
(164, 'ratione excepturi', 'anne43@alves.fr', '$2y$13$QRQMUXXoFovJdsE9.CUj9.I1/4..gmdI7WlTesCxGwskNcxaAN.c6', '2023-01-22 18:12:43', 17),
(165, 'odit dolorem', 'perrot.guillaume@samson.fr', '$2y$13$GF6KPVSB6zVswaJEK/7lzuqun4iIFiPdfTnAjTRDFQNjxnk0s4cZK', '2023-01-22 18:12:45', 18),
(166, 'autem eligendi', 'evrard.eugene@tiscali.fr', '$2y$13$MQcXefhBqZpvxW8TLE6rTubeVXIEr.Q.6H.Tyci6eb3Gnmk9Zpyj6', '2023-01-22 18:12:46', 18),
(168, 'tempora ad', 'vmathieu@lelievre.com', '$2y$13$8K9JGr20uWlDbPZwrcgd3OTUb5hP6pZkhU8/fL5jwN3YWp7WI2dMW', '2023-01-22 18:12:47', 18),
(169, 'itaque eligendi', 'zoe52@laposte.net', '$2y$13$MJnz8MUrUMnVy.QhMB3TUuas8gGfnUYLqRA0tIU4hu3ZUemjMbs1K', '2023-01-22 18:12:48', 18),
(192, 'PhoneMobile', 'phonemobil@api.com', '$2y$13$LKCaZLqZlFy69CFHGZQpcOisWf/0TiV6Rlu8ppP5i9FcmDsIlKvt.', '2023-01-24 17:32:20', 15),
(201, 'PhoneShop', 'phonestore@api.com', '$2y$13$EFVRd8g3OGZLCzdLePQZNuP5dbnxeanLSzceivmb9Rvo9mOGDSmgS', '2023-01-25 11:56:08', 15),
(203, 'ClaudiaPhone', 'claudia@api.com', '$2y$13$IN4dgZPLpAVoe89/.fUI7.uApEiQWoZ4r1AJrnbkDySoiAExP/2w6', '2023-02-08 12:45:57', 14),
(205, 'Phoesuccess', 'phone@api.net', '$2y$13$.gmWkd2AkacGca4kpWXmcu1XdXXRrtFzo5yi/QZTBoIRH3z9i4pxu', '2023-02-20 10:33:25', 14);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C7440455E7927C74` (`email`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD KEY `IDX_8D93D64919EB6921` (`client_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `phone`
--
ALTER TABLE `phone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=892;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D64919EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
