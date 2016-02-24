-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 24 2016 г., 01:22
-- Версия сервера: 5.6.20
-- Версия PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `advert`
--

-- --------------------------------------------------------

--
-- Структура таблицы `advert`
--

CREATE TABLE IF NOT EXISTS `advert` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `u_price` decimal(10,2) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `views` int(11) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Дамп данных таблицы `advert`
--

INSERT INTO `advert` (`id`, `user_id`, `region_id`, `city_id`, `category_id`, `subcategory_id`, `title`, `text`, `price`, `currency`, `u_price`, `created_at`, `updated_at`, `views`, `avatar`) VALUES
(1, 3, 1, 1, 1, 3, 'Fab friendly home in lively SE26!', 'I live in a lovely 5 bedroom Edwardian house situated in sunny Sydenham in a residential setting. 3 reception rooms and 2 bathrooms. Large garden and family kitchen. I work for a London University and live in the home with my 2 children aged 12 and 4. We are a warm welcoming family who have been hosting for over 6 years. We’ve made good friends with our students from across the globe with most still in contact!. A family home with lots of laughter. Twin guest room on the top floor of the house with views of the garden. Modern in design with floorboards and roller blinds.', '400.00', 'usd', '400.00', 1444729054, 1444939579, 0, NULL),
(6, 3, 1, 2, 1, 1, 'Wonderfull apartment on Manchester Street in the heart of Marylebone', 'The house is newly decorated with white walls and wooden flooring spreading throughout the ground floor. To the right is a good-sized living and dining area finished in minimal yet tasteful dĂŠcor including a wooden table with seating for up to six and some comfortable seating arranged facing a flat screen TV. At the back of the property is well kitted out kitchen with sleek white units and a wooden worktop. It has all modern facilities including a large fridge freezer, coffee maker, gas hob and microwave. There is a particularly lovely view from the kitchen, down to the mews lane below with its cobbled street, hanging flowers baskets and a pretty church. There is a convenient WC on the ground floor too. Up on the first floor are the 3 bedrooms and 1 bathroom. The master bedroom is finished in soft whites with a wall of integrated wardrobe space and large King-sized bed. The second bedroom is a lovely and light twin, with two single beds and more wardrobe space. Next to this is the final bedroom which is bright white with a single bed and an additional pull out (to create a double, 2 singles side by side rather than a double mattress). The bathroom has a large tub with a shower unit attached as well as a separate stand-alone shower... so whichever your preference for bath or shower, it will be met!\r\n\r\nAdditional amenities include: coffee maker, hob, normal TV, plates and cutlery, ironing board, glasses.', '24000.00', 'rur', '671.88', 1444771827, 1444771827, 0, NULL),
(7, 4, 3, 10, 1, 5, 'Golden Creek Apartments', 'Perfectly located in Sioux Falls, the Golden Creek Apartments offers one- and two-bedroom apartments of unparalleled quality. Airy, fully-equipped kitchens feature dishwashers and garbage disposal for convenient cleanup after cooking a great meal. Air conditioning helps you beat the heat on those summer days. Best of all, an around-the-clock emergency maintenance staff is there to field your every inquiry and issue. Whether you''re parking your car in the conveniently-located garage or lounging by the pool, you''ll appreciate the detail-oriented onsite amenities of Golden Creek. The landscaping is perfectly maintained, and Golden Creek is pet-friendly. Located near conveniences, such as shopping, dining and recreation, Golden Creek includes all you could want and more out of a home. An online resident life portal lets you pay your rent, submit service requests, renew your lease and get your account statements without leaving the comfort of your home.', '450000.00', 'usd', '450000.00', 1444820866, 1444820866, 1, NULL),
(8, 3, 1, 1, 1, 1, 'Spacious Three Bedroom Battersea/ Chelsea Apartment ', '\r\n\r\nSpacious and modern 3 bedroom apartment next to Battersea Park. The London Eye and London Bridge are a stroll away along the River Thames. Located within 15 mins walk of Sloane Square, King''s Road, and Knightsbridge. Easy access to public transport.\r\n\r\nA spacious, light and bright, three bedroom apartment in a luxury and modern building in Battersea/Chelsea. It is well laid out and offers a place of relaxation and pleasure to enjoy the best London has to offer.\r\n\r\nThe accommodation has two double bedrooms and a large third bedroom, which includes the master bedroom with en suite bathroom, shower and toilet. There is a UK King-size bed in the master bedroom as well as in the second bedroom, while the third bedroom contains three single beds. All three bedrooms have plenty of storage and hanging space. The apartment can sleep up to 10 people.\r\n\r\nThe main bathroom contains shower and toilet facilities.\r\n\r\nThe flat boasts a large lounge area with panoramic windows over-looking Battersea Park, and has everything you want including, a large widescreen TV with a multitude of digital/satellite channels. The whole apartment benefits from full WiFi coverage.\r\n\r\nThe kitchen is fully equipped, with fridge/freezer, oven, grill, microwave, and toaster.', '600.00', 'usd', '600.00', 1444820910, 1444820910, 0, NULL),
(26, 1, 3, 11, 2, 8, '2009 International 7400 Workstar Gravel Box - Edmonton', '\r\nStatus\r\nUsed\r\nMake\r\nInternational\r\nModel\r\n7400 Workstar\r\nKilometres\r\n279,782 km\r\nStyle/Trim\r\nGravel Box\r\nStock Number\r\n9J159963\r\nMfg Exterior Colour\r\nWhite\r\nEngine\r\nMaxxForce DT\r\nFront axle\r\n14\r\nRear axle\r\n40\r\nSuspension\r\nHAS-402-55\r\nWheelbase\r\n199.0\r\nEngine (HP)\r\n300\r\nTorque (Net HP)\r\n860\r\nTransmission\r\nAllison 3500 RDS\r\nExterior Colour\r\nWhite\r\n\r\nUsed Workstar Gravel Truck. Fresh oil change, greased, new windshield & wipers, new DPF, and comes with a box liner valued at $5000. Includes an electric tarp and is asphalt ready! For more information on this used truck please contact us.', '75000.00', 'eur', '98999.25', 1456270939, 1456270939, 0, '/img/page_26/fce320a7-fe3d-4057-b39a-a69c5fa52020.jpg'),
(27, 1, 2, 9, 2, 6, 'BMW X5 SPORT 3.0d AUTO GREY 2005 AWD (4X4)', 'Reluctant sale of a very clean stonking good motor. 77125 miles may change due to use. 160 kW ( 215BHP, 217PS). Fully loaded X5 Sport, auto gear box with sport mode and manual sequential gear change. Full service history, still has five green boxes on. One former keeper. Four recent General Grabber all season tyres less than 1000 miles ago. Panoramic electric sunroof, no leaks. Full black leather interior, heated front seats, powered front seats with driver memory that also operates mirrors and steering wheel. Fold flat power/heated door mirrors with auto tilt function on near side for reversing. Auto dim interior and door mirrors. Auto lights and wipers. Front and rear electric windows. Radio, multi change CD, TV, Sat Nav with 2015 update, phone prep. Self levelling rear air suspension. Front and rear parking aids. Cruise control. Multi function steering wheel. Global closure with key, closes windows and sunroof even if you are out of the car. Webasto pre heater so warm air from the heater within short time, can be pre set to come on. Dog/parcel guard. Service book and owners handbook all in original BMW case. HPI Clear. June last year gear box and steering rack replaced. Paperwork for all the work completed.', '9000.00', 'eur', '11879.91', 1456271337, 1456271337, 0, NULL),
(28, 5, 2, 7, 3, 10, 'Adopt a rescued cat', 'We have cats suitable for families, with dogs and for indoor homes. All cats are vaccinated, microchipped and spayed. We home nationwide and transport locally can be arranged. Adoption donation to help with costs', '100.00', 'uan', '7.32', 1456271595, 1456271595, 1, NULL),
(29, 1, 3, 12, 3, 12, 'Male and female peregrine X Saker For Sale', 'I have 3 falcons ready for a new home.\r\nMale and female peregrine X Saker x Gyr\r\nhunted, a little aggressive. Flying at 577grams.\r\nContact now if you need a good falcon and for more information', '300.00', 'eur', '396.00', 1456271826, 1456271826, 0, NULL),
(30, 4, 1, 3, 3, 11, 'STUNNING PROVEN STUD DOG', 'RIO IS A STUNNING POMERANIAN X CHIHUAHUA DOG FOR STUD DUTIES!!HE IS PROVEN BY BEING FATHER TO 28 GORGEOUS PUPPIES OF BOTH POM CHI AND CROSS TYPE..HE HAS A VERY GENTLE INTELLIGENT NATURE AND IS VERY ATTRACTIVE..AND KNOWS WHAT TO DO IN A VERY LOVING WAY...THE LADIES LOVE HIM!!HE WOULD SUIT  ANY SMALL BREED AND MAKE PRETTY FLUFFY PUPS..HE LIVES WITH OTHER MEMBERS OF HIS FAMILY SO OFFSPRING CAN BE SEEN AND CAN WORK FROM HOME OR TAKE OUT CALLS!!HE IS ABSOLUTLY NOT FOR SALE SO PLEASE DO NOT ASK!!!!', '1000.00', 'uan', '73.21', 1456272037, 1456272037, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `bookmark`
--

CREATE TABLE IF NOT EXISTS `bookmark` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `advert_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `bookmark`
--

INSERT INTO `bookmark` (`id`, `user_id`, `advert_id`) VALUES
(1, 3, 1),
(7, 1, 30),
(8, 1, 28);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Real Estate'),
(2, 'Transport'),
(3, 'Anymals');

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE IF NOT EXISTS `city` (
`id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`id`, `region_id`, `name`) VALUES
(1, 1, 'Kharkiv'),
(2, 1, 'Chuguiv'),
(3, 1, 'Lubotyn'),
(4, 1, 'Merefa'),
(5, 1, 'Bezludivka'),
(6, 2, 'Bila Tserkva'),
(7, 2, 'Fastiv'),
(8, 2, 'Obukhiv'),
(9, 2, 'Kiev'),
(10, 3, 'Lviv'),
(11, 3, 'Vynnyky'),
(12, 3, 'Drogobych');

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `date` int(11) NOT NULL,
  `usd` decimal(10,5) NOT NULL,
  `eur` decimal(10,5) NOT NULL,
  `rur` decimal(10,5) NOT NULL,
  `uan` decimal(10,5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `currency`
--

INSERT INTO `currency` (`date`, `usd`, `eur`, `rur`, `uan`) VALUES
(0, '1.00000', '1.31999', '0.02769', '0.07321'),
(1456272000, '26.85576', '29.79915', '0.35167', '1.00000'),
(1456358400, '27.01451', '29.78620', '0.35023', '1.00000');

-- --------------------------------------------------------

--
-- Структура таблицы `region`
--

CREATE TABLE IF NOT EXISTS `region` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `region`
--

INSERT INTO `region` (`id`, `name`) VALUES
(1, 'Kharkiv region'),
(2, 'Kyiv region'),
(3, 'Lviv region');

-- --------------------------------------------------------

--
-- Структура таблицы `subcategory`
--

CREATE TABLE IF NOT EXISTS `subcategory` (
`id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `subcategory`
--

INSERT INTO `subcategory` (`id`, `category_id`, `name`) VALUES
(1, 1, 'Apartments for rent'),
(2, 1, 'Rooms for rent'),
(3, 1, 'Houses for rent'),
(4, 1, 'Apartments for sale'),
(5, 1, 'Houses for sale'),
(6, 2, 'Automobiles'),
(7, 2, 'Moto'),
(8, 2, 'Trucks'),
(9, 2, 'Spares'),
(10, 3, 'Cats'),
(11, 3, 'Dogs'),
(12, 3, 'Birds'),
(13, 3, 'Reptiles');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `skype` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `auth_key` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) NOT NULL,
  `secret_key` varchar(64) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `password`, `email`, `skype`, `phone`, `auth_key`, `password_reset_token`, `secret_key`) VALUES
(1, 'Anastasia', 'Iskimzhi', '$2y$13$xtjObhJw1iYcrvA2cBjp7uy8p824j/IiK4HN0DXTN2BK41eXVggEm', 'my@mail.com', 'hellish_angel', '+380501112233', 'YRmL7Y_AoDmXxtZw-Yfs8zoFYIhycwOp', 's8KCRcNWYFZ2zwkeSkeBZxjARcAVhkiv_1444684248', '6FQZ1AjdVmiWsKK7NqzriS1uwmxwyTfS_1454795868'),
(3, 'Ivan', 'Ivanov', '$2y$13$HgIVuRZIrsD/2u9nDdOxdeMfYYcLV4q6WGBV7XZvDv22dc9jSfaJO', 'email@email.com', '', '', 'r5WRtqJyTBHxK_TomijmOSEgdRmHwJdn', 'cn01u8Jxtq4uaWZ6DjYQXgEzH3XQ_ef1_1444770591', ''),
(4, 'Vasya', 'Pupkin', '$2y$13$bH0Kk9k4nS/Pz2hD5PhGruOBEOXZnjhVogzBq1ZB3OD..B5tq8e1K', 'vasya@email.com', '', '', 'v-gZC6_yi371VzyXwFvJ2ybliNYFadAE', 'jxKvGKXTQnoAzoyLJJmp40iAVBWjN6mZ_1444899287', ''),
(5, 'Petr', 'Petrov', '$2y$13$MrSXbOSDwH.GK70JYyce2uRwvEp2cW8tLxm3i9LL/M4LAEWr5M6VC', 'aiskimzhi@mail.ru', 'hellish_angel12', '+380501112233', '22EebBqwBYxkRKGsF6xqE-3NbiFmr36E', 'aU9fAmJO9pe6YnJ23rYnTr9FGXRivsMe_1454775620', '');

-- --------------------------------------------------------

--
-- Структура таблицы `views`
--

CREATE TABLE IF NOT EXISTS `views` (
  `user_id` int(11) DEFAULT NULL,
  `advert_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `views`
--

INSERT INTO `views` (`user_id`, `advert_id`) VALUES
(3, 1),
(5, 1),
(1, 1),
(1, 30),
(1, 28),
(1, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advert`
--
ALTER TABLE `advert`
 ADD PRIMARY KEY (`id`), ADD KEY `advert_user` (`user_id`), ADD KEY `advert_region` (`region_id`), ADD KEY `advert_city` (`city_id`), ADD KEY `advert_category` (`category_id`), ADD KEY `advert_subcategory` (`subcategory_id`);

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
 ADD PRIMARY KEY (`id`), ADD KEY `bookmark_user` (`user_id`), ADD KEY `bookmark_advert` (`advert_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
 ADD PRIMARY KEY (`id`), ADD KEY `region_city` (`region_id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
 ADD UNIQUE KEY `date` (`date`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
 ADD PRIMARY KEY (`id`), ADD KEY `category_subcategory` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
 ADD KEY `views_user` (`user_id`), ADD KEY `views_advert` (`advert_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advert`
--
ALTER TABLE `advert`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `advert`
--
ALTER TABLE `advert`
ADD CONSTRAINT `advert_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `advert_city` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `advert_region` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `advert_subcategory` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `advert_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `bookmark`
--
ALTER TABLE `bookmark`
ADD CONSTRAINT `bookmark_advert` FOREIGN KEY (`advert_id`) REFERENCES `advert` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `bookmark_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `city`
--
ALTER TABLE `city`
ADD CONSTRAINT `region_city` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `subcategory`
--
ALTER TABLE `subcategory`
ADD CONSTRAINT `category_subcategory` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `views`
--
ALTER TABLE `views`
ADD CONSTRAINT `views_advert` FOREIGN KEY (`advert_id`) REFERENCES `advert` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `views_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
