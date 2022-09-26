-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2020 at 07:23 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `date_updated`) VALUES
(1, 'Sample', 'Sample Only', '2020-10-16 14:56:25'),
(2, 'Programming', 'Sample category 2', '2020-10-16 14:57:13'),
(3, 'Others', 'Sed porta nisi quis nunc gravida, ut ornare velit vulputate. Aenean dictum mauris suscipit ante imperdiet tincidunt. Nulla accumsan mauris eu libero semper, eget faucibus mi vulputate. In hac habitasse platea dictumst. Etiam pulvinar quam quis sapien consectetur, ac volutpat risus ultricies. Suspendisse vel hendrerit massa. Nullam tincidunt purus sit amet elit egestas, sit amet tincidunt odio luctus. Nam eget eros dui. In ultricies nisl id tortor elementum feugiat. Mauris et bibendum nisl, in ultricies turpis.', '2020-10-16 14:58:12'),
(4, 'Tag 1', 'In ipsum magna, aliquam ut fringilla id, finibus vitae est. Donec accumsan nec velit ut dapibus. Praesent at mollis diam. Nulla facilisi. Curabitur tempor blandit purus id pellentesque. Quisque sed ligula aliquam nulla luctus sodales. In risus velit, porttitor at lacus et, consectetur ultrices dolor. Phasellus ac venenatis nibh. Suspendisse potenti. Praesent faucibus ligula sit amet ornare varius. Integer sit amet nunc arcu.\r\n\r\n', '2020-10-17 13:15:31'),
(5, 'Tag 2', 'Phasellus vel placerat ante. Cras sollicitudin quis lacus a blandit. Suspendisse vel cursus mauris. Nulla malesuada metus varius, iaculis lacus vel, facilisis nibh. Cras congue viverra erat, ut hendrerit nunc convallis id. Etiam scelerisque sit amet est nec auctor. Curabitur faucibus convallis tellus, a auctor urna efficitur nec. Praesent luctus malesuada fermentum. Maecenas vestibulum nisi sem. Donec non rhoncus tellus.', '2020-10-17 13:15:43'),
(6, 'Tag 3', 'Vestibulum vel maximus dolor. Quisque in accumsan purus. Duis ut sapien nec massa semper elementum auctor eget odio. Donec vulputate hendrerit libero quis sollicitudin. Sed et varius justo. Maecenas consectetur mollis finibus. Integer at lectus vitae ex commodo condimentum in ut lectus. Fusce porttitor commodo eros, ut condimentum neque faucibus sed. Sed tristique luctus suscipit. Cras tincidunt quam metus, a facilisis justo luctus sed.', '2020-10-17 13:16:23');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(30) NOT NULL,
  `topic_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `comment` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `topic_id`, `user_id`, `comment`, `date_created`, `date_updated`) VALUES
(1, 2, 1, 'Sample Comment', '2020-10-16 16:55:39', '2020-10-16 16:55:39'),
(2, 2, 2, 'test', '2020-10-16 17:04:34', '2020-10-16 17:04:34'),
(3, 2, 1, 'sample', '2020-10-17 08:54:46', '2020-10-17 08:54:46'),
(4, 2, 1, 'asdasd', '2020-10-17 09:42:04', '2020-10-17 09:42:04');

-- --------------------------------------------------------

--
-- Table structure for table `forum_views`
--

CREATE TABLE `forum_views` (
  `id` int(30) NOT NULL,
  `topic_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_views`
--

INSERT INTO `forum_views` (`id`, `topic_id`, `user_id`) VALUES
(1, 2, 2),
(2, 2, 1),
(3, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(30) NOT NULL,
  `comment_id` int(30) NOT NULL,
  `reply` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `comment_id`, `reply`, `user_id`, `date_created`, `date_updated`) VALUES
(1, 1, 'sample reply', 1, '2020-10-17 09:48:06', '0000-00-00 00:00:00'),
(2, 2, '&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 16px; text-align: justify;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec elementum nunc bibendum, luctus diam id, tincidunt nisl. Vestibulum turpis arcu, fringilla sed lacus in, eleifend vulputate purus. Mauris sollicitudin metus in risus finibus fringilla.&lt;/span&gt;&lt;br&gt;', 1, '2020-10-17 09:48:57', '0000-00-00 00:00:00'),
(3, 1, 'asdasd&lt;p&gt;asdasd&lt;/p&gt;', 1, '2020-10-17 09:52:02', '0000-00-00 00:00:00'),
(4, 1, 's', 1, '2020-10-17 10:01:00', '0000-00-00 00:00:00'),
(5, 1, 'asdaasd', 1, '2020-10-17 10:01:06', '0000-00-00 00:00:00'),
(6, 1, 'asdasd&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 1, '2020-10-17 10:01:53', '0000-00-00 00:00:00'),
(7, 1, 'asdsdsd', 1, '2020-10-17 10:16:09', '0000-00-00 00:00:00'),
(8, 1, '1', 1, '2020-10-17 10:16:13', '0000-00-00 00:00:00'),
(9, 1, '2', 1, '2020-10-17 10:16:17', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(30) NOT NULL,
  `category_ids` text NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `category_ids`, `title`, `content`, `user_id`, `date_created`) VALUES
(1, '3,2,1', 'Sample Topic', '&lt;h2 style=&quot;margin-bottom: 0px; font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; color: rgb(0, 0, 0); padding: 0px; text-align: justify;&quot;&gt;Sample Topic&lt;/h2&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px;&quot;&gt;Sed porta nisi quis nunc gravida, ut ornare velit vulputate. Aenean dictum mauris suscipit ante imperdiet tincidunt. Nulla accumsan mauris eu libero semper, eget faucibus mi vulputate. In hac habitasse platea dictumst. Etiam pulvinar quam quis sapien consectetur, ac volutpat risus ultricies. Suspendisse vel hendrerit massa. Nullam tincidunt purus sit amet elit egestas, sit amet tincidunt odio luctus. Nam eget eros dui. In ultricies nisl id tortor elementum feugiat. Mauris et bibendum nisl, in ultricies turpis. Maecenas elit justo, molestie vel porta sit amet, commodo et sapien. Nulla porta non leo quis suscipit. Integer eu commodo nisi. Fusce eu sodales lacus.&lt;/p&gt;&lt;p&gt;&lt;br style=&quot;text-align: justify;&quot;&gt;&lt;/p&gt;', 1, '2020-10-16 12:25:14'),
(2, '2', 'Topic 2', '&lt;p style=&quot;margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec elementum nunc bibendum, luctus diam id, tincidunt nisl. Vestibulum turpis arcu, fringilla sed lacus in, eleifend vulputate purus. Mauris sollicitudin metus in risus finibus fringilla. Praesent a magna eget arcu pretium consectetur a semper nisi. Quisque ut enim blandit, pellentesque quam a, ullamcorper diam. Suspendisse eget ultrices felis. Donec eu tortor lobortis, luctus quam quis, lobortis purus. Nunc varius sagittis nisi, in posuere mauris accumsan ac. Integer a suscipit risus. Proin ultrices diam ac nulla mattis vehicula. Aliquam metus urna, fringilla a suscipit vehicula, sollicitudin non neque. Integer tincidunt porta neque in bibendum. Ut cursus, nunc vitae consequat ullamcorper, neque neque viverra sem, sed rutrum metus ante non odio. Vivamus leo orci, consequat et sagittis vel, varius eu mi.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif;&quot;&gt;Vivamus id odio in diam tincidunt posuere. Morbi tempor, sapien vitae tristique placerat, tortor enim sollicitudin erat, quis ornare erat metus sed ex. Mauris accumsan tristique elit, at tempus odio auctor eget. Nullam ullamcorper convallis orci id condimentum. Donec laoreet est ut feugiat aliquam. Proin porta consectetur hendrerit. Quisque vitae nunc a orci fringilla lobortis. Ut bibendum purus sit amet molestie viverra. Quisque elementum mollis est, sit amet dignissim ligula semper sed. Mauris in nunc mi. Praesent ac felis eget purus ullamcorper porta. Fusce non laoreet mauris. In in sem a sem molestie varius sed id libero.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;pre style=&quot;height: 366px;&quot;&gt;&amp;lt;?php&amp;nbsp;&lt;br style=&quot;height: 366px;&quot;&gt;echo &quot;Hello World&quot;;&lt;br style=&quot;height: 366px;&quot;&gt;?&amp;gt;&lt;/pre&gt;&lt;p style=&quot;height: 366px;&quot;&gt;Aliquam pharetra mollis massa, eu luctus leo vehicula id. Quisque viverra nisl in lorem tincidunt, in mollis ipsum faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec vitae massa ut nunc dapibus consequat a quis elit. Ut felis turpis, tincidunt sed sem vel, auctor bibendum augue. Mauris tempus nisl eu pharetra hendrerit. Sed tincidunt enim quam, sit amet rhoncus purus euismod at. Quisque consectetur libero non elit dictum, at luctus turpis eleifend. Quisque vitae eros interdum, ultricies arcu sed, vulputate justo. Maecenas a metus eget mi tristique porttitor a ac tortor. Vivamus venenatis ornare dolor, at elementum justo sollicitudin quis. Praesent blandit consectetur est nec dapibus. Aliquam erat volutpat. Proin vitae neque vitae elit mattis mollis. Integer ornare pulvinar lectus, vitae venenatis leo mollis nec.&lt;span style=&quot;text-align: justify;&quot;&gt;Sed commodo dui neque, ut faucibus nisl sagittis quis. Nullam ut semper quam, vitae maximus sem. Donec arcu dolor, consectetur eget feugiat gravida, varius sit amet odio. Mauris et lacus in ex rutrum tincidunt. Duis at nibh nec tortor pellentesque lacinia eu non diam. Maecenas id porttitor orci. Maecenas vel consectetur ligula. Donec lacinia et mi ac vulputate.&lt;/span&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Etiam laoreet rutrum orci, non euismod ex auctor sit amet. Aliquam a pharetra nisi, eget facilisis lacus. Vestibulum pellentesque ut felis ac maximus. Fusce nulla sapien, lobortis sed ex non, tempor varius tellus. Ut rhoncus sapien ante, non luctus libero aliquet at. Quisque gravida ligula a lacus convallis convallis. Curabitur in tempus nunc. Nullam bibendum malesuada malesuada. Quisque eget dapibus erat, et tristique nunc. Maecenas placerat tempus ex in dictum.&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;height: 366px;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Mauris ut placerat urna, ut luctus tellus. Sed eleifend pellentesque vulputate. Morbi vestibulum ultricies placerat. Pellentesque quis orci posuere, mattis felis at, pulvinar enim. Ut odio velit, consequat quis tincidunt sit amet, dapibus ut elit. Duis quam dolor, bibendum quis purus vel, commodo porta ex. Vestibulum euismod eros ut tortor gravida malesuada. Sed sagittis auctor risus eget scelerisque. Donec cursus lorem vitae sapien tempor, quis placerat lorem bibendum. Nunc eu sagittis urna. Maecenas quis fermentum ex.&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;height: 366px;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Integer a leo sem. Suspendisse fringilla rhoncus eros eu tempor. In pellentesque blandit felis eget bibendum. Curabitur tristique laoreet diam, id sodales turpis ultrices non. Mauris et neque cursus nunc auctor dapibus quis vel enim. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sit amet nisl vitae enim tincidunt luctus. Sed nisi libero, tincidunt quis orci ac, vestibulum luctus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec porttitor accumsan lorem, imperdiet ultrices justo ultricies ut. Suspendisse potenti. Duis luctus arcu vitae massa semper fermentum. Donec eget pulvinar sapien, sit amet sodales nisi. Sed euismod metus vel turpis convallis, vehicula pharetra eros venenatis.&lt;/span&gt;&lt;/p&gt;', 1, '2020-10-16 16:07:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1=Admin,2=Staff, 3= subscriber'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', 1),
(2, 'Sample User', 'suser@gmail.com', '0192023a7bbd73250516f069df18b500', 2),
(3, 'Sample user', 'suser2@gmail.com', '46fd21746f5a5924c7f515fbf6ccc81e', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_views`
--
ALTER TABLE `forum_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `forum_views`
--
ALTER TABLE `forum_views`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
