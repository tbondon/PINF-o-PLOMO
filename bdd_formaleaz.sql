-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2017 at 08:03 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vdm2i`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id_cat` int(11) NOT NULL,
  `nom_cat` char(50) DEFAULT NULL,
  `selectionnable` int(11) NOT NULL DEFAULT '0',
  `spe_admin` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `nom_cat`, `selectionnable`, `spe_admin`) VALUES
(1, 'Mon profil', 0, 0),
(4, 'Mes vdm2i', 0, 0),
(5, 'Tops', 0, 0),
(6, 'Amour', 1, 0),
(10, 'Travail', 1, 0),
(8, 'Vacances', 1, 0),
(2, 'modérer vdm2i', 0, 1),
(3, 'Modérer utilisateur', 0, 1),
(9, 'Enfants', 1, 0),
(7, 'Geek', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id_like` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_vdm2i` int(11) NOT NULL,
  `iflike` int(11) NOT NULL DEFAULT '-1',
  `ifdislike` int(11) NOT NULL DEFAULT '-1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id_like`, `id_user`, `id_vdm2i`, `iflike`, `ifdislike`) VALUES
(56, 46, 151, 1, -1),
(55, 46, 154, 1, -1),
(54, 46, 153, -1, 1),
(53, 46, 152, -1, 1),
(52, 46, 146, 1, -1),
(51, 46, 143, 1, -1),
(50, 46, 144, 1, -1),
(49, 46, 145, 1, -1),
(48, 46, 141, 1, -1),
(47, 46, 142, 1, -1),
(46, 46, 139, 1, -1),
(45, 46, 135, 1, -1),
(44, 52, 133, -1, 1),
(43, 52, 135, -1, 1),
(42, 46, 134, 1, -1),
(41, 46, 133, 1, -1),
(57, 46, 147, -1, 1),
(58, 46, 150, 1, -1),
(59, 46, 149, 1, -1),
(60, 46, 148, 1, -1),
(61, 48, 151, 1, -1),
(62, 48, 142, -1, 1),
(63, 48, 141, 1, -1),
(64, 48, 152, 1, -1),
(65, 48, 153, 1, -1),
(66, 48, 145, 1, -1),
(67, 48, 154, -1, 1),
(68, 48, 144, -1, 1),
(69, 48, 150, 1, -1),
(70, 48, 143, -1, 1),
(71, 48, 147, 1, -1),
(72, 48, 148, 1, -1),
(73, 48, 149, 1, -1),
(74, 53, 151, 1, -1),
(75, 53, 142, 1, -1),
(76, 53, 141, 1, -1),
(77, 53, 152, 1, -1),
(78, 53, 153, 1, -1),
(79, 53, 145, 1, -1),
(80, 53, 154, 1, -1),
(81, 53, 143, 1, -1),
(82, 53, 150, -1, 1),
(83, 53, 147, 1, -1),
(84, 53, 148, -1, 1),
(85, 53, 149, -1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` char(50) DEFAULT NULL,
  `pseudo` char(50) DEFAULT NULL,
  `mdp` char(50) DEFAULT NULL,
  `date_ins` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin` int(11) NOT NULL DEFAULT '0',
  `blacklist` int(11) NOT NULL DEFAULT '0',
  `nb_like` int(11) NOT NULL DEFAULT '0',
  `nb_dislike` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `email`, `pseudo`, `mdp`, `date_ins`, `admin`, `blacklist`, `nb_like`, `nb_dislike`) VALUES
(48, 'theolh@hotmail.fr', 'theo', '0ba387a1c5ef290d44ef1e6dcdb141fd', '2017-05-27 05:01:56', 0, 0, 9, 4),
(46, 'mailvdm2i@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2017-05-27 05:01:56', 1, 0, 15, 3),
(52, 'ous@sf.de', 'oayman', '882baf28143fb700b388a87ef561a6e5', '2017-05-29 08:47:57', 0, 1, 0, 2),
(53, 'user@user', 'user', '7dc715960b177f323db34eacd63048f7', '2017-06-02 21:57:42', 0, 0, 9, 3);

-- --------------------------------------------------------

--
-- Table structure for table `vdm2i`
--

CREATE TABLE `vdm2i` (
  `id_vdm2i` int(11) NOT NULL,
  `pseudo` char(255) NOT NULL,
  `categorie` char(255) NOT NULL,
  `vdm2i` varchar(300) DEFAULT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT '0',
  `moderation` tinyint(1) NOT NULL,
  `nb_like_2` int(11) NOT NULL DEFAULT '0',
  `nb_dislike_2` int(11) NOT NULL DEFAULT '0',
  `date_vdm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vdm2i`
--

INSERT INTO `vdm2i` (`id_vdm2i`, `pseudo`, `categorie`, `vdm2i`, `valid`, `moderation`, `nb_like_2`, `nb_dislike_2`, `date_vdm`) VALUES
(141, 'admin', 'cat6', 'Aujourd\'hui, après avoir changé de boulot, de logement, de garde robe et de copines sans résultat, ma femme en est arrivée à la conclusion que j\'étais la seule variable d\'ajustement qui l\'empêchait d\'accéder au bonheur. VDM2i', 1, 0, 3, 0, '2017-06-02 01:54:43'),
(142, 'admin', 'cat6', 'Aujourd\'hui, j\'avais offert avec mes économies un voyage à 2 en outre-mer à ma copine, au soleil. Malheureusement, là où nous logeons il y a un chiot handicapé. Ma copine préfère passer tout son temps avec ce chiot qu\'avec moi. VDM2i', 1, 0, 2, 1, '2017-06-02 01:55:14'),
(143, 'admin', 'cat9', 'Aujourd\'hui, mon fils de 6 ans me demande : &quot;Maman, tu es sure que t\'es pas ma mamie ? Parce que tu fait plus vielle que les mamans de mes copains.&quot; J\'ai 37 ans. VDM2i', 1, 0, 2, 1, '2017-06-02 01:55:55'),
(144, 'admin', 'cat8', 'Aujourd\'hui, je rentre d\'Istanbul où j\'ai acheté une poupée la &quot;Reine des neiges&quot; pour la nièce de mon homme, qui en est super-fan. C\'est seulement en rentrant, que j\'ai remarqué qu\'elle chantait &quot;Libérée, délivrée&quot;... en turc. VDM2i', 1, 0, 1, 1, '2017-06-02 01:56:19'),
(145, 'admin', 'cat7', 'Aujourd\'hui, ma grand-mère, ayant un problème avec la souris de son ordinateur, m\'a appelée en panique, pensant qu\'elle venait d\'être touchée par la cyberattaque mondiale. VDM2i', 1, 0, 3, 0, '2017-06-02 01:56:43'),
(147, 'theo', 'cat10', 'Aujourd\'hui, contrôle de physique décisif pour la suite de ma scolarité. J\'ai oublié une formule fondamentale, ce qui me fait louper tout un exercice. Au moment précis où je rends la copie, la formule me revient. VDM', 1, 0, 2, 1, '2017-06-02 21:55:09'),
(148, 'theo', 'cat10', 'Aujourd\'hui, premier jour de travail, j\'assiste à un florilège de vannes douteuses, mêlant racisme, sexisme et homophobie, à la pause déjeuner. Je fais partie d\'une de ces minorités. VDM', 1, 0, 2, 1, '2017-06-02 21:55:28'),
(149, 'theo', 'cat10', 'Aujourd\'hui, et comme à son habitude, mon patron hurle sur ses employées pour tout et n\'importe quoi. Aujourd\'hui c\'est donc la première fois de ma vie où je me suis fait engueuler pour avoir effectué les tâches pour lesquelles j\'ai été embauchée et formée en interne. VDM', 1, 0, 2, 1, '2017-06-02 21:55:52'),
(150, 'theo', 'cat9', 'Aujourd\'hui, j\'annonce à mon fils de 6 ans que sa grand-mère est morte. Il me répond : &quot;Oh non ! J\'aurais plus de cadeaux !&quot; Puis il va dans sa chambre comme si de ne rien n\'était. VDM2i', 1, 0, 2, 1, '2017-06-02 21:56:27'),
(151, 'theo', 'cat6', 'Aujourd\'hui, je rencontre pour la première fois un joli garçon avec qui je discute par SMS depuis un petit moment. À la fin de la rencontre, je lui envoie un SMS pour lui dire qu\'il est mieux en vrai qu\'en photo. Lui : &quot;J\'aurais aimé pouvoir te retourner le compliment.&quot; VDM2i\r\n', 1, 0, 3, 0, '2017-06-02 21:57:11'),
(152, 'user', 'cat7', 'Aujourd\'hui, en descendant du train, la musique que j\'écoutais s\'est soudainement arrêtée lorsque les portes se sont fermées. Après tout, c\'est normal que le bluetooth ne fonctionne plus entre mon casque et mon téléphone, quand celui-ci continue le voyage sans moi. VDM', 1, 0, 2, 1, '2017-06-02 21:58:09'),
(153, 'user', 'cat7', 'Aujourd\'hui, j\'ai préféré télécharger une application scanner payante sur mon téléphone portable, plutôt que de monter 15 marches et allumer mon imprimante située à l\'étage. VDM2i', 1, 0, 2, 1, '2017-06-02 21:58:23'),
(154, 'user', 'cat8', 'Aujourd\'hui, après plus de 3 semaines en Australie et sans nouvelle de ma famille, premier message de ma mère : &quot;Christian a été éliminé aux 12 coups de midi.&quot; Merci pour l\'information, maman. VDM2i', 1, 0, 2, 1, '2017-06-02 21:58:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `fk_likes_user` (`id_user`),
  ADD KEY `fk_likes_vdm2i` (`id_vdm2i`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `vdm2i`
--
ALTER TABLE `vdm2i`
  ADD PRIMARY KEY (`id_vdm2i`),
  ADD KEY `fk_pseudo` (`pseudo`),
  ADD KEY `fk_categorie` (`categorie`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `vdm2i`
--
ALTER TABLE `vdm2i`
  MODIFY `id_vdm2i` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
