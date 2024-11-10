-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 10, 2024 at 09:36 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ureview`
--

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

DROP TABLE IF EXISTS `follow`;
CREATE TABLE IF NOT EXISTS `follow` (
  `follow_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `restaurant_id` int NOT NULL,
  PRIMARY KEY (`follow_id`,`user_id`,`restaurant_id`),
  KEY `user_id` (`user_id`),
  KEY `restaurant_id` (`restaurant_id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`follow_id`, `user_id`, `restaurant_id`) VALUES
(1, 32, 1),
(2, 32, 5),
(3, 32, 8),
(4, 33, 2),
(5, 33, 6),
(6, 33, 9),
(7, 34, 3),
(8, 34, 7),
(9, 34, 10),
(10, 35, 4),
(11, 35, 8),
(12, 35, 11),
(13, 36, 5),
(14, 36, 9),
(15, 36, 12),
(16, 37, 6),
(17, 37, 10),
(18, 37, 13),
(19, 38, 7),
(20, 38, 11),
(21, 38, 14),
(22, 39, 8),
(23, 39, 12),
(24, 39, 15),
(25, 40, 9),
(26, 40, 13),
(27, 40, 16),
(28, 41, 10),
(29, 41, 14),
(30, 41, 17),
(31, 42, 11),
(32, 42, 15),
(33, 42, 18),
(34, 43, 12),
(35, 43, 16),
(36, 43, 19),
(37, 44, 13),
(38, 44, 17),
(39, 44, 20),
(40, 45, 14),
(41, 45, 18),
(42, 45, 1),
(43, 46, 15),
(44, 46, 19),
(45, 46, 2),
(46, 47, 16),
(47, 47, 20),
(48, 47, 3),
(49, 48, 17),
(50, 48, 1),
(51, 48, 4),
(52, 49, 18),
(53, 49, 2),
(54, 49, 5),
(55, 50, 19),
(56, 50, 3),
(57, 50, 6),
(58, 51, 20),
(59, 51, 4),
(60, 51, 7),
(61, 52, 1),
(62, 52, 5),
(63, 52, 8),
(64, 53, 2),
(65, 53, 6),
(66, 53, 9),
(67, 54, 3),
(68, 54, 7),
(69, 54, 10),
(70, 55, 4),
(71, 55, 8),
(72, 55, 11),
(73, 56, 5),
(74, 56, 9),
(75, 56, 12),
(76, 57, 6),
(77, 57, 10),
(78, 57, 13),
(79, 58, 7),
(80, 58, 11),
(81, 58, 14),
(82, 59, 8),
(83, 59, 12),
(84, 59, 15),
(85, 60, 9),
(86, 60, 13),
(87, 60, 16),
(88, 61, 10),
(89, 61, 14),
(90, 61, 17);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
CREATE TABLE IF NOT EXISTS `food` (
  `food_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `description` varchar(120) NOT NULL,
  `type` varchar(30) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `restaurant_id` int NOT NULL,
  PRIMARY KEY (`food_id`),
  KEY `restaurant_id` (`restaurant_id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `name`, `description`, `type`, `price`, `restaurant_id`) VALUES
(1, 'Margherita Pizza', 'Fresh tomatoes, mozzarella, basil, olive oil', 'Main Course', '14.99', 1),
(2, 'Spaghetti Carbonara', 'Eggs, pecorino cheese, pancetta, black pepper', 'Main Course', '16.99', 1),
(3, 'Bruschetta', 'Toasted bread with tomatoes, garlic, basil', 'Appetizer', '8.99', 1),
(4, 'Tiramisu', 'Coffee-flavored Italian dessert', 'Dessert', '7.99', 1),
(5, 'Caprese Salad', 'Fresh mozzarella, tomatoes, basil', 'Appetizer', '10.99', 1),
(6, 'Kung Pao Chicken', 'Spicy diced chicken with peanuts', 'Main Course', '15.99', 2),
(7, 'Dim Sum Platter', 'Assorted steamed dumplings', 'Appetizer', '12.99', 2),
(8, 'Mapo Tofu', 'Spicy bean curd with minced pork', 'Main Course', '13.99', 2),
(9, 'Spring Rolls', 'Crispy rolls with vegetables', 'Appetizer', '6.99', 2),
(10, 'Beef Chow Mein', 'Stir-fried noodles with beef', 'Main Course', '14.99', 2),
(11, 'Paella Valenciana', 'Traditional Spanish rice with seafood', 'Main Course', '24.99', 3),
(12, 'Patatas Bravas', 'Spicy potatoes with aioli', 'Appetizer', '8.99', 3),
(13, 'Gambas al Ajillo', 'Garlic shrimp', 'Appetizer', '12.99', 3),
(14, 'Churros', 'Spanish fried dough with chocolate', 'Dessert', '6.99', 3),
(15, 'Tortilla Española', 'Spanish potato omelette', 'Main Course', '10.99', 3),
(16, 'Mixed Grill Platter', 'Assorted grilled meats', 'Main Course', '27.99', 4),
(17, 'Hummus', 'Chickpea dip with olive oil', 'Appetizer', '7.99', 4),
(18, 'Shawarma Wrap', 'Grilled meat in pita bread', 'Main Course', '13.99', 4),
(19, 'Tabbouleh', 'Parsley and bulgur salad', 'Appetizer', '8.99', 4),
(20, 'Baklava', 'Sweet pastry with nuts', 'Dessert', '5.99', 4),
(21, 'Truffle Risotto', 'Creamy rice with truffle', 'Main Course', '26.99', 5),
(22, 'Fusion Antipasto', 'Modern take on Italian appetizers', 'Appetizer', '16.99', 5),
(23, 'Squid Ink Pasta', 'Black pasta with seafood', 'Main Course', '24.99', 5),
(24, 'Lavender Panna Cotta', 'Italian cream dessert', 'Dessert', '9.99', 5),
(25, 'Duck Ragu', 'Slow-cooked duck pasta', 'Main Course', '25.99', 5),
(26, 'Bulgogi', 'Marinated beef BBQ', 'Main Course', '18.99', 6),
(27, 'Kimchi Pancake', 'Spicy fermented vegetable pancake', 'Appetizer', '10.99', 6),
(28, 'Bibimbap', 'Mixed rice with vegetables', 'Main Course', '16.99', 6),
(29, 'Korean Fried Chicken', 'Crispy glazed chicken', 'Main Course', '17.99', 6),
(30, 'Tteokbokki', 'Spicy rice cakes', 'Appetizer', '11.99', 6),
(31, 'Carne Asada', 'Grilled marinated steak', 'Main Course', '19.99', 7),
(32, 'Guacamole', 'Fresh avocado dip', 'Appetizer', '8.99', 7),
(33, 'Enchiladas', 'Rolled tortillas with sauce', 'Main Course', '15.99', 7),
(34, 'Tres Leches', 'Three milk cake', 'Dessert', '6.99', 7),
(35, 'Fish Tacos', 'Battered fish in corn tortillas', 'Main Course', '16.99', 7),
(36, 'Picanha', 'Prime cut Brazilian steak', 'Main Course', '29.99', 8),
(37, 'Pão de Queijo', 'Cheese bread', 'Appetizer', '7.99', 8),
(38, 'Feijoada', 'Black bean and pork stew', 'Main Course', '19.99', 8),
(39, 'Caipirinha Chicken', 'Lime-marinated grilled chicken', 'Main Course', '18.99', 8),
(40, 'Brazilian Rice', 'Traditional seasoned rice', 'Side Dish', '5.99', 8),
(41, 'Tonkotsu Ramen', 'Pork bone broth noodles', 'Main Course', '15.99', 9),
(42, 'Gyoza', 'Pan-fried dumplings', 'Appetizer', '7.99', 9),
(43, 'Miso Ramen', 'Fermented soybean broth noodles', 'Main Course', '14.99', 9),
(44, 'Karaage', 'Japanese fried chicken', 'Appetizer', '8.99', 9),
(45, 'Matcha Ice Cream', 'Green tea ice cream', 'Dessert', '5.99', 9),
(46, 'Coq au Vin', 'Wine-braised chicken', 'Main Course', '24.99', 10),
(47, 'French Onion Soup', 'Classic onion soup', 'Appetizer', '9.99', 10),
(48, 'Beef Bourguignon', 'Wine-braised beef stew', 'Main Course', '26.99', 10),
(49, 'Crème Brûlée', 'Caramelized custard', 'Dessert', '8.99', 10),
(50, 'Escargot', 'Garlic butter snails', 'Appetizer', '12.99', 10),
(51, 'Wiener Schnitzel', 'Breaded veal cutlet', 'Main Course', '22.99', 11),
(52, 'Pretzel', 'Traditional German pretzel', 'Appetizer', '6.99', 11),
(53, 'Bratwurst Plate', 'Grilled sausages', 'Main Course', '18.99', 11),
(54, 'Apple Strudel', 'Traditional pastry', 'Dessert', '7.99', 11),
(55, 'Potato Salad', 'German-style potato salad', 'Side Dish', '5.99', 11),
(56, 'Classic Pierogies', 'Potato and cheese dumplings', 'Main Course', '14.99', 12),
(57, 'Borscht', 'Beet soup', 'Appetizer', '7.99', 12),
(58, 'Kielbasa', 'Polish sausage plate', 'Main Course', '16.99', 12),
(59, 'Stuffed Cabbage', 'Rice and meat in cabbage', 'Main Course', '15.99', 12),
(60, 'Pączki', 'Polish donuts', 'Dessert', '4.99', 12),
(61, 'Butter Chicken', 'Creamy tomato chicken curry', 'Main Course', '17.99', 13),
(62, 'Samosas', 'Fried vegetable pastries', 'Appetizer', '6.99', 13),
(63, 'Biryani', 'Spiced rice with meat', 'Main Course', '18.99', 13),
(64, 'Naan Bread', 'Clay oven bread', 'Side Dish', '3.99', 13),
(65, 'Gulab Jamun', 'Sweet milk balls', 'Dessert', '5.99', 13),
(66, 'Sushi Burrito', 'Fusion sushi roll wrap', 'Main Course', '16.99', 14),
(67, 'Korean Tacos', 'Asian-Mexican fusion tacos', 'Main Course', '15.99', 14),
(68, 'Poke Bowl', 'Hawaiian raw fish bowl', 'Main Course', '17.99', 14),
(69, 'Thai Nachos', 'Spicy fusion appetizer', 'Appetizer', '11.99', 14),
(70, 'Green Tea Tiramisu', 'Asian-Italian fusion dessert', 'Dessert', '8.99', 14),
(71, 'Beef Stroganoff', 'Creamy beef with mushrooms', 'Main Course', '19.99', 15),
(72, 'Borscht', 'Traditional beet soup', 'Appetizer', '8.99', 15),
(73, 'Chicken Kiev', 'Stuffed chicken cutlet', 'Main Course', '18.99', 15),
(74, 'Pelmeni', 'Russian dumplings', 'Main Course', '15.99', 15),
(75, 'Napoleon Cake', 'Layered pastry cake', 'Dessert', '7.99', 15),
(76, 'Street Tacos', 'Authentic Mexican tacos', 'Main Course', '12.99', 16),
(77, 'Nachos Supreme', 'Loaded nachos', 'Appetizer', '10.99', 16),
(78, 'Burrito Grande', 'Large wrapped burrito', 'Main Course', '14.99', 16),
(79, 'Churros', 'Cinnamon sugar pastry', 'Dessert', '5.99', 16),
(80, 'Quesadilla', 'Grilled cheese tortilla', 'Main Course', '11.99', 16),
(81, 'Gravlax', 'Cured salmon', 'Appetizer', '13.99', 17),
(82, 'Swedish Meatballs', 'Traditional meatballs', 'Main Course', '17.99', 17),
(83, 'Smørrebrød', 'Open-faced sandwiches', 'Main Course', '15.99', 17),
(84, 'Lingonberry Cake', 'Berry-flavored dessert', 'Dessert', '7.99', 17),
(85, 'Herring Plate', 'Pickled herring', 'Appetizer', '12.99', 17),
(86, 'Moussaka', 'Eggplant casserole', 'Main Course', '16.99', 18),
(87, 'Greek Salad', 'Traditional veggie salad', 'Appetizer', '9.99', 18),
(88, 'Souvlaki', 'Grilled meat skewers', 'Main Course', '18.99', 18),
(89, 'Baklava', 'Honey nut pastry', 'Dessert', '6.99', 18),
(90, 'Spanakopita', 'Spinach pie', 'Appetizer', '8.99', 18),
(91, 'Mixed Mezze', 'Assorted appetizers', 'Appetizer', '16.99', 19),
(92, 'Lamb Tagine', 'Slow-cooked lamb stew', 'Main Course', '23.99', 19),
(93, 'Falafel Plate', 'Chickpea fritters', 'Main Course', '14.99', 19),
(94, 'Kunafa', 'Sweet cheese pastry', 'Dessert', '7.99', 19),
(95, 'Mansaf', 'Lamb and rice dish', 'Main Course', '25.99', 19),
(96, 'Fish and Chips', 'Battered cod with fries', 'Main Course', '16.99', 20),
(97, 'Irish Stew', 'Traditional lamb stew', 'Main Course', '18.99', 20),
(98, 'Shepherds Pie', 'Meat and potato pie', 'Main Course', '15.99', 20),
(99, 'Colcannon', 'Mashed potatoes and cabbage', 'Side Dish', '6.99', 20),
(100, 'Bread Pudding', 'Traditional dessert', 'Dessert', '7.99', 20);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
CREATE TABLE IF NOT EXISTS `restaurant` (
  `restaurant_id` int NOT NULL AUTO_INCREMENT,
  `restaurant_name` varchar(30) NOT NULL,
  `description` varchar(60) NOT NULL,
  `address` varchar(120) NOT NULL,
  `owner_name` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(60) NOT NULL,
  `type` varchar(60) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`restaurant_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`restaurant_id`, `restaurant_name`, `description`, `address`, `owner_name`, `phone`, `email`, `type`, `user_id`) VALUES
(1, 'Trattoria Mario', 'Authentic Italian cuisine', '123 Pasta Lane, Italian Quarter', 'Mario Rossi', '555-0001', 'tr@rest.com', 'Italian', 11),
(2, 'Wei\'s Wok', 'Traditional Chinese dishes', '456 Dragon Street, Chinatown', 'Chen Wei', '555-0002', 'ww@rest.com', 'Chinese', 12),
(3, 'Casa Sofia', 'Modern Spanish tapas', '789 Tapas Road, Spanish District', 'Sofia Garcia', '555-0003', 'cs@rest.com', 'Spanish', 13),
(4, 'Hassan\'s Grill', 'Middle Eastern BBQ', '321 Spice Avenue, Downtown', 'Ahmed Hassan', '555-0004', 'hg@rest.com', 'Middle Eastern', 14),
(5, 'Cucina Bianchi', 'Modern Italian fusion', '654 Olive Street, North End', 'Luca Bianchi', '555-0005', 'cb@rest.com', 'Italian Fusion', 15),
(6, 'Seoul Kitchen', 'Korean BBQ & more', '987 K-Street, Koreatown', 'Kim Min-ji', '555-0006', 'sk@rest.com', 'Korean', 16),
(7, 'El Jardin', 'Mexican specialties', '147 Salsa Boulevard, Latino Quarter', 'Juan Rodriguez', '555-0007', 'ej@rest.com', 'Mexican', 17),
(8, 'Silva\'s Grill', 'Brazilian steakhouse', '258 Carnival Road, South Side', 'Maria Silva', '555-0008', 'sg@rest.com', 'Brazilian', 18),
(9, 'Tanaka Ramen', 'Authentic Japanese ramen', '369 Noodle Lane, Japan Town', 'Yuki Tanaka', '555-0009', 'tr@rest.com', 'Japanese', 19),
(10, 'Le Petit Bistro', 'Classic French cuisine', '741 Bordeaux Street, French Quarter', 'Pierre Dubois', '555-0010', 'lb@rest.com', 'French', 20),
(11, 'Biergarten', 'Traditional German food', '852 Beer Street, Downtown', 'Hans Mueller', '555-0011', 'bg@rest.com', 'German', 21),
(12, 'Pierogi Palace', 'Polish comfort food', '963 Comfort Lane, East Side', 'Anna Kowalski', '555-0012', 'pp@rest.com', 'Polish', 22),
(13, 'Spice Route', 'Indian cuisine', '159 Curry Road, Indian District', 'Ali Patel', '555-0013', 'sr@rest.com', 'Indian', 23),
(14, 'Dragon Bowl', 'Modern Asian fusion', '357 Fusion Avenue, Asian Quarter', 'Leo Wong', '555-0014', 'db@rest.com', 'Asian Fusion', 24),
(15, 'Ruski House', 'Traditional Russian fare', '486 Snow Street, North Side', 'Nina Ivanova', '555-0015', 'rh@rest.com', 'Russian', 25),
(16, 'Taco Loco', 'Street-style Mexican', '159 Fiesta Road, West End', 'Carlos Mendoza', '555-0016', 'tl@rest.com', 'Mexican', 26),
(17, 'Nordic Nosh', 'Scandinavian delights', '753 Viking Avenue, Harbor District', 'Eva Andersson', '555-0017', 'nn@rest.com', 'Scandinavian', 27),
(18, 'Olive Grove', 'Greek Mediterranean', '951 Mediterranean Bay', 'George Papa', '555-0018', 'og@rest.com', 'Greek', 28),
(19, 'Arabian Nights', 'Middle Eastern cuisine', '357 Desert Road, East End', 'Fatima Al-Sayed', '555-0019', 'an@rest.com', 'Middle Eastern', 29),
(20, 'Irish Pub & Kitchen', 'Irish pub fare', '159 Shamrock Street, Pub District', 'Tom O\'Brien', '555-0020', 'ip@rest.com', 'Irish', 30);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `review_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `food_id` int NOT NULL,
  `rating` int NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`review_id`,`user_id`,`food_id`),
  KEY `user_id` (`user_id`),
  KEY `food_id` (`food_id`)
) ENGINE=MyISAM AUTO_INCREMENT=211 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `user_id`, `food_id`, `rating`, `date`) VALUES
(1, 32, 1, 4, '2024-11-01'),
(2, 33, 1, 5, '2024-11-02'),
(3, 34, 1, 4, '2024-11-03'),
(4, 35, 2, 5, '2024-11-01'),
(5, 36, 2, 4, '2024-11-02'),
(6, 37, 2, 5, '2024-11-03'),
(7, 38, 3, 3, '2024-11-01'),
(8, 39, 3, 4, '2024-11-02'),
(9, 40, 3, 5, '2024-11-03'),
(10, 41, 4, 5, '2024-11-01'),
(11, 42, 4, 4, '2024-11-02'),
(12, 43, 4, 4, '2024-11-03'),
(13, 44, 5, 4, '2024-11-01'),
(14, 45, 5, 5, '2024-11-02'),
(15, 46, 5, 3, '2024-11-03'),
(16, 47, 6, 5, '2024-11-01'),
(17, 48, 6, 4, '2024-11-02'),
(18, 49, 6, 4, '2024-11-03'),
(19, 50, 7, 4, '2024-11-01'),
(20, 51, 7, 5, '2024-11-02'),
(21, 52, 7, 3, '2024-11-03'),
(22, 53, 8, 5, '2024-11-01'),
(23, 54, 8, 4, '2024-11-02'),
(24, 55, 8, 4, '2024-11-03'),
(25, 56, 9, 3, '2024-11-01'),
(26, 57, 9, 5, '2024-11-02'),
(27, 58, 9, 4, '2024-11-03'),
(28, 59, 10, 4, '2024-11-01'),
(29, 60, 10, 5, '2024-11-02'),
(30, 61, 10, 4, '2024-11-03'),
(31, 32, 11, 5, '2024-11-01'),
(32, 33, 11, 4, '2024-11-02'),
(33, 34, 11, 5, '2024-11-03'),
(34, 35, 12, 4, '2024-11-01'),
(35, 36, 12, 5, '2024-11-02'),
(36, 37, 12, 4, '2024-11-03'),
(37, 38, 13, 5, '2024-11-01'),
(38, 39, 13, 4, '2024-11-02'),
(39, 40, 13, 5, '2024-11-03'),
(40, 41, 14, 4, '2024-11-01'),
(41, 42, 14, 5, '2024-11-02'),
(42, 43, 14, 4, '2024-11-03'),
(43, 44, 15, 5, '2024-11-01'),
(44, 45, 15, 4, '2024-11-02'),
(45, 46, 15, 5, '2024-11-03'),
(46, 47, 16, 4, '2024-11-01'),
(47, 48, 16, 5, '2024-11-02'),
(48, 49, 16, 4, '2024-11-03'),
(49, 50, 17, 5, '2024-11-01'),
(50, 51, 17, 4, '2024-11-02'),
(51, 52, 17, 5, '2024-11-03'),
(52, 53, 18, 4, '2024-11-01'),
(53, 54, 18, 5, '2024-11-02'),
(54, 55, 18, 4, '2024-11-03'),
(55, 56, 19, 5, '2024-11-01'),
(56, 57, 19, 4, '2024-11-02'),
(57, 58, 19, 5, '2024-11-03'),
(58, 59, 20, 4, '2024-11-01'),
(59, 60, 20, 5, '2024-11-02'),
(60, 61, 20, 4, '2024-11-03'),
(61, 32, 21, 4, '2024-11-01'),
(62, 33, 21, 5, '2024-11-02'),
(63, 34, 21, 4, '2024-11-03'),
(64, 35, 22, 5, '2024-11-01'),
(65, 36, 22, 4, '2024-11-02'),
(66, 37, 22, 5, '2024-11-03'),
(67, 38, 23, 4, '2024-11-01'),
(68, 39, 23, 5, '2024-11-02'),
(69, 40, 23, 4, '2024-11-03'),
(70, 41, 24, 5, '2024-11-01'),
(71, 42, 24, 4, '2024-11-02'),
(72, 43, 24, 5, '2024-11-03'),
(73, 44, 25, 4, '2024-11-01'),
(74, 45, 25, 5, '2024-11-02'),
(75, 46, 25, 4, '2024-11-03'),
(76, 47, 26, 5, '2024-11-01'),
(77, 48, 26, 4, '2024-11-02'),
(78, 49, 26, 5, '2024-11-03'),
(79, 50, 27, 4, '2024-11-01'),
(80, 51, 27, 5, '2024-11-02'),
(81, 52, 27, 4, '2024-11-03'),
(82, 53, 28, 5, '2024-11-01'),
(83, 54, 28, 4, '2024-11-02'),
(84, 55, 28, 5, '2024-11-03'),
(85, 56, 29, 4, '2024-11-01'),
(86, 57, 29, 5, '2024-11-02'),
(87, 58, 29, 4, '2024-11-03'),
(88, 59, 30, 5, '2024-11-01'),
(89, 60, 30, 4, '2024-11-02'),
(90, 61, 30, 5, '2024-11-03'),
(91, 32, 31, 5, '2024-11-01'),
(92, 33, 31, 4, '2024-11-02'),
(93, 34, 31, 5, '2024-11-03'),
(94, 35, 32, 4, '2024-11-01'),
(95, 36, 32, 5, '2024-11-02'),
(96, 37, 32, 4, '2024-11-03'),
(97, 38, 33, 5, '2024-11-01'),
(98, 39, 33, 4, '2024-11-02'),
(99, 40, 33, 5, '2024-11-03'),
(100, 41, 34, 4, '2024-11-01'),
(101, 42, 34, 5, '2024-11-02'),
(102, 43, 34, 4, '2024-11-03'),
(103, 44, 35, 5, '2024-11-01'),
(104, 45, 35, 4, '2024-11-02'),
(105, 46, 35, 5, '2024-11-03'),
(106, 47, 36, 4, '2024-11-01'),
(107, 48, 36, 5, '2024-11-02'),
(108, 49, 36, 4, '2024-11-03'),
(109, 50, 37, 5, '2024-11-01'),
(110, 51, 37, 4, '2024-11-02'),
(111, 52, 37, 5, '2024-11-03'),
(112, 53, 38, 4, '2024-11-01'),
(113, 54, 38, 5, '2024-11-02'),
(114, 55, 38, 4, '2024-11-03'),
(115, 56, 39, 5, '2024-11-01'),
(116, 57, 39, 4, '2024-11-02'),
(117, 58, 39, 5, '2024-11-03'),
(118, 59, 40, 4, '2024-11-01'),
(119, 60, 40, 5, '2024-11-02'),
(120, 61, 40, 4, '2024-11-03'),
(121, 32, 41, 4, '2024-11-01'),
(122, 33, 41, 5, '2024-11-02'),
(123, 34, 41, 4, '2024-11-03'),
(124, 35, 42, 5, '2024-11-01'),
(125, 36, 42, 4, '2024-11-02'),
(126, 37, 42, 5, '2024-11-03'),
(127, 38, 43, 4, '2024-11-01'),
(128, 39, 43, 5, '2024-11-02'),
(129, 40, 43, 4, '2024-11-03'),
(130, 41, 44, 5, '2024-11-01'),
(131, 42, 44, 4, '2024-11-02'),
(132, 43, 44, 5, '2024-11-03'),
(133, 44, 45, 4, '2024-11-01'),
(134, 45, 45, 5, '2024-11-02'),
(135, 46, 45, 4, '2024-11-03'),
(136, 47, 46, 5, '2024-11-01'),
(137, 48, 46, 4, '2024-11-02'),
(138, 49, 46, 5, '2024-11-03'),
(139, 50, 47, 4, '2024-11-01'),
(140, 51, 47, 5, '2024-11-02'),
(141, 52, 47, 4, '2024-11-03'),
(142, 53, 48, 5, '2024-11-01'),
(143, 54, 48, 4, '2024-11-02'),
(144, 55, 48, 5, '2024-11-03'),
(145, 56, 49, 4, '2024-11-01'),
(146, 57, 49, 5, '2024-11-02'),
(147, 58, 49, 4, '2024-11-03'),
(148, 59, 50, 5, '2024-11-01'),
(149, 60, 50, 4, '2024-11-02'),
(150, 61, 50, 5, '2024-11-03'),
(151, 32, 51, 5, '2024-11-01'),
(152, 33, 51, 4, '2024-11-02'),
(153, 34, 51, 5, '2024-11-03'),
(154, 35, 52, 4, '2024-11-01'),
(155, 36, 52, 5, '2024-11-02'),
(156, 37, 52, 4, '2024-11-03'),
(157, 38, 53, 5, '2024-11-01'),
(158, 39, 53, 4, '2024-11-02'),
(159, 40, 53, 5, '2024-11-03'),
(160, 41, 54, 4, '2024-11-01'),
(161, 42, 54, 5, '2024-11-02'),
(162, 43, 54, 4, '2024-11-03'),
(163, 44, 55, 5, '2024-11-01'),
(164, 45, 55, 4, '2024-11-02'),
(165, 46, 55, 5, '2024-11-03'),
(166, 47, 56, 4, '2024-11-01'),
(167, 48, 56, 5, '2024-11-02'),
(168, 49, 56, 4, '2024-11-03'),
(169, 50, 57, 5, '2024-11-01'),
(170, 51, 57, 4, '2024-11-02'),
(171, 52, 57, 5, '2024-11-03'),
(172, 53, 58, 4, '2024-11-01'),
(173, 54, 58, 5, '2024-11-02'),
(174, 55, 58, 4, '2024-11-03'),
(175, 56, 59, 5, '2024-11-01'),
(176, 57, 59, 4, '2024-11-02'),
(177, 58, 59, 5, '2024-11-03'),
(178, 59, 60, 4, '2024-11-01'),
(179, 60, 60, 5, '2024-11-02'),
(180, 61, 60, 4, '2024-11-03'),
(181, 32, 61, 4, '2024-11-01'),
(182, 33, 61, 5, '2024-11-02'),
(183, 34, 61, 4, '2024-11-03'),
(184, 35, 62, 5, '2024-11-01'),
(185, 36, 62, 4, '2024-11-02'),
(186, 37, 62, 5, '2024-11-03'),
(187, 38, 63, 4, '2024-11-01'),
(188, 39, 63, 5, '2024-11-02'),
(189, 40, 63, 4, '2024-11-03'),
(190, 41, 64, 5, '2024-11-01'),
(191, 42, 64, 4, '2024-11-02'),
(192, 43, 64, 5, '2024-11-03'),
(193, 44, 65, 4, '2024-11-01'),
(194, 45, 65, 5, '2024-11-02'),
(195, 46, 65, 4, '2024-11-03'),
(196, 47, 66, 5, '2024-11-01'),
(197, 48, 66, 4, '2024-11-02'),
(198, 49, 66, 5, '2024-11-03'),
(199, 50, 67, 4, '2024-11-01'),
(200, 51, 67, 5, '2024-11-02'),
(201, 52, 67, 4, '2024-11-03'),
(202, 53, 68, 5, '2024-11-01'),
(203, 54, 68, 4, '2024-11-02'),
(204, 55, 68, 5, '2024-11-03'),
(205, 56, 69, 4, '2024-11-01'),
(206, 57, 69, 5, '2024-11-02'),
(207, 58, 69, 4, '2024-11-03'),
(208, 59, 70, 5, '2024-11-01'),
(209, 60, 70, 4, '2024-11-02'),
(210, 61, 70, 5, '2024-11-03');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
CREATE TABLE IF NOT EXISTS `subscription` (
  `fee_id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `restaurant_id` int NOT NULL,
  PRIMARY KEY (`fee_id`),
  KEY `restaurant_id` (`restaurant_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`fee_id`, `date`, `amount`, `restaurant_id`) VALUES
(1, '2024-11-01', '99.99', 1),
(2, '2024-11-01', '59.99', 2),
(3, '2024-11-01', '19.99', 3),
(4, '2024-11-01', '99.99', 4),
(5, '2024-11-01', '59.99', 5),
(6, '2024-11-01', '19.99', 6),
(7, '2024-11-01', '99.99', 7),
(8, '2024-11-01', '59.99', 8),
(9, '2024-11-01', '19.99', 9),
(10, '2024-11-01', '99.99', 10),
(11, '2024-11-01', '59.99', 11),
(12, '2024-11-01', '19.99', 12),
(13, '2024-11-01', '99.99', 13),
(14, '2024-11-01', '59.99', 14),
(15, '2024-11-01', '19.99', 15),
(16, '2024-11-01', '99.99', 16),
(17, '2024-11-01', '59.99', 17),
(18, '2024-11-01', '19.99', 18),
(19, '2024-11-01', '99.99', 19),
(20, '2024-11-01', '59.99', 20);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(90) NOT NULL,
  `email` varchar(60) NOT NULL,
  `role` varchar(30) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `name`, `password`, `email`, `role`) VALUES
(61, 'owner20', 'Tom O\'Brien', '$2a$10$encrypted30', 'to20@rest.com', 'owner'),
(60, 'owner19', 'Fatima Al-Sayed', '$2a$10$encrypted29', 'fa19@rest.com', 'owner'),
(59, 'owner18', 'George Papa', '$2a$10$encrypted28', 'gp18@rest.com', 'owner'),
(58, 'owner17', 'Eva Andersson', '$2a$10$encrypted27', 'ea17@rest.com', 'owner'),
(57, 'owner16', 'Carlos Mendoza', '$2a$10$encrypted26', 'cm16@rest.com', 'owner'),
(56, 'owner15', 'Nina Ivanova', '$2a$10$encrypted25', 'ni15@rest.com', 'owner'),
(55, 'owner14', 'Leo Wong', '$2a$10$encrypted24', 'lw14@rest.com', 'owner'),
(54, 'owner13', 'Ali Patel', '$2a$10$encrypted23', 'ap13@rest.com', 'owner'),
(53, 'owner12', 'Anna Kowalski', '$2a$10$encrypted22', 'ak12@rest.com', 'owner'),
(52, 'owner11', 'Hans Mueller', '$2a$10$encrypted21', 'hm11@rest.com', 'owner'),
(51, 'owner10', 'Pierre Dubois', '$2a$10$encrypted20', 'pd10@rest.com', 'owner'),
(50, 'owner9', 'Yuki Tanaka', '$2a$10$encrypted19', 'yt9@rest.com', 'owner'),
(49, 'owner8', 'Maria Silva', '$2a$10$encrypted18', 'ms8@rest.com', 'owner'),
(48, 'owner7', 'Juan Rodriguez', '$2a$10$encrypted17', 'jr7@rest.com', 'owner'),
(47, 'owner6', 'Kim Min-ji', '$2a$10$encrypted16', 'km6@rest.com', 'owner'),
(46, 'owner5', 'Luca Bianchi', '$2a$10$encrypted15', 'lb5@rest.com', 'owner'),
(45, 'owner4', 'Ahmed Hassan', '$2a$10$encrypted14', 'ah4@rest.com', 'owner'),
(44, 'owner3', 'Sofia Garcia', '$2a$10$encrypted13', 'sg3@rest.com', 'owner'),
(43, 'owner2', 'Chen Wei', '$2a$10$encrypted12', 'cw2@rest.com', 'owner'),
(42, 'owner1', 'Mario Rossi', '$2a$10$encrypted11', 'mr1@rest.com', 'owner'),
(41, 'user10', 'Patricia Moore', '$2a$10$encrypted10', 'pm10@mail.com', 'user'),
(40, 'user9', 'Robert Wilson', '$2a$10$encrypted9', 'rw9@mail.com', 'user'),
(39, 'user8', 'Jennifer Taylor', '$2a$10$encrypted8', 'jt8@mail.com', 'user'),
(32, 'user1', 'John Smith', '$2a$10$encrypted1', 'js1@mail.com', 'user'),
(33, 'user2', 'Emma Wilson', '$2a$10$encrypted2', 'ew2@mail.com', 'user'),
(34, 'user3', 'Michael Brown', '$2a$10$encrypted3', 'mb3@mail.com', 'user'),
(35, 'user4', 'Sarah Davis', '$2a$10$encrypted4', 'sd4@mail.com', 'user'),
(36, 'user5', 'James Johnson', '$2a$10$encrypted5', 'jj5@mail.com', 'user'),
(37, 'user6', 'Lisa Anderson', '$2a$10$encrypted6', 'la6@mail.com', 'user'),
(38, 'user7', 'David Martinez', '$2a$10$encrypted7', 'dm7@mail.com', 'user'),
(31, 'root', 'root', '$2y$10$iI84GlAWerHq7S1fd2IcN.dOOLkoPB1Eloz1hzBs02wCxNql9CvOq', 'root@email.com', 'admin'),
(62, 'user', 'user', '$2y$10$asFpbyrlKuhsl1LeqGb23uGUyZK.hdyfmWxFUz.QLpTEX4h/TEs86', 'user@user.com', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
