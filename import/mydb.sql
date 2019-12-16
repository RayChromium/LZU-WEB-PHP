-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2019-12-16 21:52:15
-- 服务器版本： 5.7.28
-- PHP 版本： 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `mydb`
--

-- --------------------------------------------------------

--
-- 表的结构 `bbs`
--

CREATE TABLE `bbs` (
  `id` int(11) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `isRec` bit(1) NOT NULL DEFAULT b'0',
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `time` datetime NOT NULL,
  `address` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bbs`
--

INSERT INTO `bbs` (`id`, `nickname`, `phone`, `isRec`, `title`, `content`, `time`, `address`) VALUES
(39, 'Edward', '15682888993', b'0', 'Hello', 'This is the first post!', '2019-12-16 21:25:02', 'China -> Lanzhou'),
(40, 'Edward', '15682888993', b'0', 'Location', 'IP to location', '2019-12-16 21:25:45', 'United States -> Mountain View'),
(41, 'Xinyu', '13619366642', b'0', 'Hi xinyu', 'Weibo ', '2019-12-16 21:26:24', 'United States -> Mountain View'),
(42, 'Edward', '15682888993', b'0', 'The', 'Test', '2019-12-16 21:30:57', 'United States -> Mountain View'),
(43, 'Edward', '15682888993', b'0', 'My sql', 'Db ', '2019-12-16 21:31:16', 'United States -> Mountain View'),
(44, 'Edward', '15682888993', b'1', 'Blank', 'Next', '2019-12-16 21:31:30', 'United States -> Mountain View'),
(45, 'Edward', '15682888993', b'0', 'Next page', 'Llll', '2019-12-16 21:31:41', 'United States -> Mountain View'),
(46, 'Edward', '15682888993', b'0', 'Lanzhou', 'University', '2019-12-16 21:32:29', 'China -> Lanzhou'),
(47, 'Xinyu', '13619366642', b'0', 'school', 'xxxy', '2019-12-16 21:32:50', 'China -> Lanzhou'),
(48, 'Xinyu', '13619366642', b'1', 'xxxy', 'school of information and science', '2019-12-16 21:33:11', 'China -> Lanzhou'),
(49, 'Xinyu', '13619366642', b'0', 'xgb', 'xuesheng', '2019-12-16 21:35:18', 'China -> Lanzhou'),
(50, 'Xinyu', '13619366642', b'0', 'xyz', 'xinyu zhang', '2019-12-16 21:35:32', 'China -> Lanzhou'),
(51, 'Edward', '15682888993', b'0', 'Cairui', 'c y', '2019-12-16 21:35:57', 'China -> Lanzhou'),
(52, 'Xinyu', '13619366642', b'0', 'sno', '320170941801', '2019-12-16 21:36:14', 'China -> Lanzhou');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `phone` varchar(11) CHARACTER SET utf8 NOT NULL,
  `admin` bit(1) NOT NULL DEFAULT b'0',
  `sex` varchar(5) CHARACTER SET utf8 DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `nickname` varchar(20) CHARACTER SET utf8 NOT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`phone`, `admin`, `sex`, `birthdate`, `nickname`, `qq`, `email`, `password`) VALUES
('13619366642', b'0', 'M', '2019-12-01', 'Xinyu', NULL, 'zhangxinyu2017@lzu.edu.cn', ''),
('15596888091', b'1', 'M', '1999-01-06', 'zxy', '1649239969', 'ixyzhang@smail.nchu.edu.tw', 'zxy'),
('15682888993', b'0', 'M', '2019-12-11', 'Edward', '852929021', 'edzxy@qq.com', '');

--
-- 转储表的索引
--

--
-- 表的索引 `bbs`
--
ALTER TABLE `bbs`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`phone`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `bbs`
--
ALTER TABLE `bbs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
