-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 18. Dez 2024 um 16:00
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `meal_planner_group3`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `allergens`
--

CREATE TABLE `allergens` (
  `id` int(11) NOT NULL,
  `allergen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `day`
--

CREATE TABLE `day` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `breakfast_id` int(11) DEFAULT NULL,
  `lunch_id` int(11) DEFAULT NULL,
  `dinner_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `day`
--

INSERT INTO `day` (`id`, `user_id`, `breakfast_id`, `lunch_id`, `dinner_id`) VALUES
(1, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `ingredient`
--

INSERT INTO `ingredient` (`id`, `recipe_id`, `info`) VALUES
(1, 1, 'Bacon: 100 g'),
(2, 1, 'Spaghetti: 200 g'),
(3, 1, 'Eggs: 2'),
(4, 1, 'Parmesan cheese: 50 g'),
(5, 2, 'Romaine lettuce: 1 head'),
(6, 2, 'Croutons: 50 g'),
(7, 2, 'Parmesan cheese: 30 g'),
(8, 2, 'Caesar dressing: 50 ml'),
(9, 3, 'Quinoa: 100 g'),
(10, 3, 'Avocado: 1'),
(11, 3, 'Carrots: 2'),
(12, 3, 'Spinach: 50 g'),
(13, 3, 'Tahini dressing: 30 ml'),
(14, 4, 'Salmon fillets: 200 g'),
(15, 4, 'Teriyaki sauce: 50 ml'),
(16, 4, 'Rice: 150 g'),
(17, 4, 'Green onions: 20 g'),
(18, 5, 'Chicken breast: 200 g'),
(19, 5, 'Coconut milk: 200 ml'),
(20, 5, 'Curry paste: 2 tbsp'),
(21, 5, 'Rice: 150 g'),
(22, 6, 'Whole grain bread: 2 slices'),
(23, 6, 'Avocado: 1'),
(24, 6, 'Lemon juice: 1 tsp'),
(25, 6, 'Salt and pepper: 1/2 tsp'),
(26, 7, 'Flour: 200 g'),
(27, 7, 'Sugar: 150 g'),
(28, 7, 'Cocoa powder: 50 g'),
(29, 7, 'Eggs: 3'),
(30, 7, 'Butter: 100 g'),
(31, 8, 'Quinoa: 100 g'),
(32, 8, 'Tomatoes: 2'),
(33, 8, 'Cucumber: 1'),
(34, 8, 'Onion: 1'),
(35, 8, 'Olive oil: 2 tbsp'),
(36, 9, 'Spaghetti: 200 g'),
(37, 9, 'Shrimp: 150 g'),
(38, 9, 'Garlic: 2 cloves'),
(39, 9, 'Olive oil: 2 tbsp'),
(40, 9, 'Parsley: 20 g'),
(41, 10, 'Eggs: 3'),
(42, 10, 'Cheese: 50 g'),
(43, 10, 'Ham: 50 g'),
(44, 10, 'Salt and pepper: to taste'),
(45, 11, 'Pizza dough: 1'),
(46, 11, 'Tomato sauce: 100 ml'),
(47, 11, 'Mozzarella: 100 g'),
(48, 11, 'Basil: 10 g'),
(49, 12, 'Tomatoes: 2'),
(50, 12, 'Cucumber: 1'),
(51, 12, 'Red onion: 1'),
(52, 12, 'Olives: 50 g'),
(53, 12, 'Feta cheese: 50 g'),
(54, 12, 'Olive oil: 2 tbsp'),
(55, 12, 'Lemon juice: 1 tbsp'),
(56, 13, 'Chicken breast: 200 g'),
(57, 13, 'Bell peppers: 2'),
(58, 13, 'Onion: 1'),
(59, 13, 'Fajita seasoning: 1 tbsp'),
(60, 13, 'Tortillas: 4');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `ingredient` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `meals`
--

CREATE TABLE `meals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `day` varchar(20) NOT NULL,
  `time` time NOT NULL,
  `week_n` int(11) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `modified_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `modified_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `id_user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `allergen_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `instructions` longtext DEFAULT NULL,
  `time_minutes` int(11) DEFAULT NULL,
  `calories_cat` varchar(20) DEFAULT NULL,
  `difficulty` varchar(20) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `modified_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `recipes`
--

INSERT INTO `recipes` (`id`, `id_user_id`, `category_id`, `type_id`, `allergen_id`, `title`, `image`, `description`, `instructions`, `time_minutes`, `calories_cat`, `difficulty`, `rating`, `status`, `created_at`, `modified_at`) VALUES
(1, 2, NULL, NULL, NULL, 'Spaghetti Carbonara', 'OIP-6762d51d7e166.jpg', 'A creamy Italian pasta dish made with eggs, Parmesan cheese, and crispy bacon.', 'Cook the spaghetti according to the package instructions until al dente.\r\n\r\nFry the diced bacon in a pan until crispy.\r\n\r\nIn a bowl, whisk together eggs and grated Parmesan.\r\n\r\nDrain the spaghetti and immediately add it to the pan with bacon.\r\n\r\nRemove from heat, quickly pour in the egg mixture, and toss to coat the pasta.\r\n\r\nSeason with salt and pepper, and serve.', 20, 'High', 'Medium', 8, 'Approved', NULL, NULL),
(2, 2, NULL, NULL, NULL, 'Caesar Salad', 'th-6762d68161397.jpg', 'Crisp Romaine lettuce with croutons, Parmesan cheese, and Caesar dressing.', 'Wash and chop the Romaine lettuce.\r\n\r\nIn a bowl, combine lettuce, croutons, and Parmesan.\r\n\r\nDrizzle with Caesar dressing and toss to coat evenly.\r\n\r\nServe immediately.', 15, 'Medium', 'Medium', 7, 'Refused', NULL, NULL),
(3, 2, NULL, NULL, NULL, 'Vegan Buddha Bowl', 'OIP-1-6762d7b87cd7e.jpg', 'A nutritious bowl with quinoa, avocado, carrots, spinach, and tahini dressing.', 'Cook quinoa. Slice vegetables. Combine in a bowl with dressing.', 25, 'Medium', 'Low', 3, 'Approved', NULL, NULL),
(4, 2, NULL, NULL, NULL, 'Salmon Teriyaki', 'Download-6762d96ec940d.jpg', 'Salmon fillets glazed with sweet and savory teriyaki sauce over rice.', 'Heat a pan over medium heat and cook the salmon fillets until they are golden brown on both sides.\r\n\r\nIn a small bowl, mix the teriyaki sauce ingredients and pour over the salmon in the pan.\r\n\r\nLet the sauce reduce and thicken for a few minutes.\r\n\r\nServe the salmon over steamed rice and garnish with chopped green onions.', 30, 'High', 'Medium', 10, 'Refused', NULL, NULL),
(5, 2, NULL, NULL, NULL, 'Chicken Curry', 'OIP-2-6762da4a5e75e.jpg', 'Tender chicken simmered in a rich curry sauce served with rice.', 'Dice the chicken breast into bite-sized pieces.\r\n\r\nIn a pot, heat some oil and cook the chicken until browned.\r\n\r\nAdd the curry paste and coconut milk to the pot, stirring to combine.\r\n\r\nLet the curry simmer for about 15-20 minutes.\r\n\r\nServe the chicken curry over cooked rice.', 40, 'High', 'Medium', 10, 'Approved', NULL, NULL),
(6, 2, NULL, NULL, NULL, 'Avocado Toast', 'OIP-3-6762db5f2600c.jpg', 'Toasted whole grain bread topped with mashed avocado, lemon juice, salt, and pepper.', 'Toast the slices of whole grain bread until golden brown.\r\n\r\nIn a bowl, mash the avocado with lemon juice, salt, and pepper.\r\n\r\nSpread the mashed avocado on the toasted bread slices.\r\n\r\nServe immediately.', 10, 'Low', 'Low', 5, 'Refused', NULL, NULL),
(7, 2, NULL, NULL, NULL, 'Chocolate cake', 'OIP-4-6762dcf6bef2e.jpg', 'A moist chocolate cake topped with a rich chocolate glaze.', 'Preheat the oven to 180°C (350°F).\r\n\r\nIn a large bowl, mix together the flour, sugar, and cocoa powder.\r\n\r\nAdd the eggs and melted butter, stirring until smooth.\r\n\r\nPour the batter into a greased baking pan and bake for 30-35 minutes.\r\n\r\nLet the cake cool before serving.', 60, 'High', 'Medium', 10, 'Approved', NULL, NULL),
(8, 2, NULL, NULL, NULL, 'Quinoa Salad', 'th-1-6762ddb9156ff.jpg', 'Cook the quinoa according to the package instructions.\r\n\r\nChop the tomatoes, cucumber, and onion.\r\n\r\nIn a large bowl, combine the cooked quinoa and chopped vegetables.\r\n\r\nDrizzle with olive oil and toss to combine.\r\n\r\nServe chilled or at room temperature.', 'Light salad with cooked quinoa, tomatoes, cucumber, and onions in olive oil dressing.', 20, 'Medium', 'Low', 4, 'Approved', NULL, NULL),
(9, 2, NULL, NULL, NULL, 'Shrimp Pasta', 'shrimp-6762dee5230df.jpg', 'paghetti with shrimp sautéed in garlic and olive oil, garnished with parsley.', 'Cook spaghetti according to package instructions.\r\n\r\nSauté shrimp and garlic in olive oil until shrimp are pink.\r\n\r\nToss shrimp with cooked spaghetti and parsley.\r\n\r\nServe immediately.', 30, 'Medium', 'Medium', 8, 'Refused', NULL, NULL),
(10, 2, NULL, NULL, NULL, 'Omelette', 'th-6762dfe852dfe.jpg', 'Fluffy omelette with cheese and ham.', 'Beat eggs in a bowl.\r\n\r\nPour eggs into a heated pan and cook until set.\r\n\r\nAdd cheese and ham, fold, and cook for another minute.\r\n\r\nServe hot.', 10, 'Medium', 'Low', 7, 'Approved', NULL, NULL),
(11, 2, NULL, NULL, NULL, 'Margherita Pizza', 'Download-6762e09bc6d01.jpg', 'Pizza topped with tomato sauce, fresh mozzarella, and basil', 'Roll out pizza dough and spread with tomato sauce.\r\n\r\nTop with mozzarella and basil.\r\n\r\nBake at 220°C (430°F) for 12-15 minutes.', 25, 'Medium', 'Medium', 9, 'Approved', NULL, NULL),
(12, 2, NULL, NULL, NULL, 'Greek Salad', 'OIP-6762e1624010f.jpg', 'Salad with tomatoes, cucumber, red onion, olives, and feta cheese, dressed with olive oil and lemon juice.', 'Chop tomatoes, cucumber, and onion.\r\n\r\nMix with olives and feta cheese.\r\n\r\nDrizzle with olive oil and lemon juice.', 15, 'Medium', 'Low', 10, 'Approved', NULL, NULL),
(13, 2, NULL, NULL, NULL, 'Chicken Fajitas', 'Download-1-6762e2384eae7.jpg', 'Sizzling chicken with bell peppers and onions in tortillas.', 'Slice chicken and vegetables.\r\n\r\nCook chicken and vegetables with fajita seasoning.\r\n\r\nServe in tortillas with toppings.', 25, 'High', 'Medium', 4, 'Approved', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `recipe_ingredients`
--

CREATE TABLE `recipe_ingredients` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `ingredient_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shopping_list`
--

CREATE TABLE `shopping_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `ingredient_name` varchar(255) NOT NULL,
  `quantity` double NOT NULL,
  `unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `modified_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `username`, `first_name`, `last_name`, `image`, `created_at`, `modified_at`) VALUES
(1, 'elias.zechmeister.EZ@gmail.com', '[]', '$2y$13$8umGIqN2JH1NqYmClpntBONsKNphyMTldidc40ZVf5E9kaR9UFN6y', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'elias.zechmeister@gmail.com', '[]', '$2y$13$.EWq1pbB5SlMGPLAhj.s.ON5BUpkfUqN2WCj5K6YBOnZgTnLKVExW', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `allergens`
--
ALTER TABLE `allergens`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `day`
--
ALTER TABLE `day`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E5A02990A76ED395` (`user_id`),
  ADD KEY `IDX_E5A02990442D22` (`breakfast_id`),
  ADD KEY `IDX_E5A02990D7C83568` (`lunch_id`),
  ADD KEY `IDX_E5A02990C8B1AA0C` (`dinner_id`);

--
-- Indizes für die Tabelle `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6BAF787059D8A214` (`recipe_id`);

--
-- Indizes für die Tabelle `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E229E6EAA76ED395` (`user_id`),
  ADD KEY `IDX_E229E6EA59D8A214` (`recipe_id`);

--
-- Indizes für die Tabelle `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indizes für die Tabelle `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D889262259D8A214` (`recipe_id`),
  ADD KEY `IDX_D8892622A76ED395` (`user_id`);

--
-- Indizes für die Tabelle `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A369E2B579F37AE5` (`id_user_id`),
  ADD KEY `IDX_A369E2B512469DE2` (`category_id`),
  ADD KEY `IDX_A369E2B5C54C8C93` (`type_id`),
  ADD KEY `IDX_A369E2B56E775A4A` (`allergen_id`);

--
-- Indizes für die Tabelle `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9F925F2B59D8A214` (`recipe_id`),
  ADD KEY `IDX_9F925F2B933FE08C` (`ingredient_id`);

--
-- Indizes für die Tabelle `shopping_list`
--
ALTER TABLE `shopping_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3DC1A459A76ED395` (`user_id`),
  ADD KEY `IDX_3DC1A459933FE08C` (`ingredient_id`);

--
-- Indizes für die Tabelle `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `allergens`
--
ALTER TABLE `allergens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `day`
--
ALTER TABLE `day`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT für Tabelle `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `meals`
--
ALTER TABLE `meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `shopping_list`
--
ALTER TABLE `shopping_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `day`
--
ALTER TABLE `day`
  ADD CONSTRAINT `FK_E5A02990442D22` FOREIGN KEY (`breakfast_id`) REFERENCES `recipes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_E5A02990A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_E5A02990C8B1AA0C` FOREIGN KEY (`dinner_id`) REFERENCES `recipes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_E5A02990D7C83568` FOREIGN KEY (`lunch_id`) REFERENCES `recipes` (`id`) ON DELETE SET NULL;

--
-- Constraints der Tabelle `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `FK_6BAF787059D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`);

--
-- Constraints der Tabelle `meals`
--
ALTER TABLE `meals`
  ADD CONSTRAINT `FK_E229E6EA59D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`),
  ADD CONSTRAINT `FK_E229E6EAA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `FK_D889262259D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`),
  ADD CONSTRAINT `FK_D8892622A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `FK_A369E2B512469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_A369E2B56E775A4A` FOREIGN KEY (`allergen_id`) REFERENCES `allergens` (`id`),
  ADD CONSTRAINT `FK_A369E2B579F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_A369E2B5C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);

--
-- Constraints der Tabelle `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD CONSTRAINT `FK_9F925F2B59D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`),
  ADD CONSTRAINT `FK_9F925F2B933FE08C` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`);

--
-- Constraints der Tabelle `shopping_list`
--
ALTER TABLE `shopping_list`
  ADD CONSTRAINT `FK_3DC1A459933FE08C` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`),
  ADD CONSTRAINT `FK_3DC1A459A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
