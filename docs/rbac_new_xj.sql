-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 31, 2017 at 06:42 AM
-- Server version: 5.5.56-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rbac`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE IF NOT EXISTS `access` (
  `id` int(11) unsigned NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '权限名称',
  `urls` varchar(1000) NOT NULL DEFAULT '' COMMENT 'json 数组',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：有效 0：无效',
  `updated_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后一次更新时间',
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入时间'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='权限详情表';

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`id`, `title`, `urls`, `status`, `updated_time`, `created_time`) VALUES
(1, 'page1', '["\\/index.php\\/rbac\\/index\\/page1.html"]', 1, '2017-10-29 09:10:18', '2017-10-27 03:22:47'),
(2, 'page2', '["\\/index.php\\/rbac\\/index\\/page2.html"]', 1, '2017-10-29 09:10:33', '2017-10-27 03:23:04'),
(3, 'page3', '["\\/index.php\\/rbac\\/index\\/page3.html"]', 1, '2017-10-29 09:13:52', '2017-10-27 03:23:55'),
(4, 'page4', '["\\/index.php\\/rbac\\/index\\/page4.html"]', 1, '2017-10-29 09:11:05', '2017-10-27 04:08:21'),
(5, 'page1 and page2', '["\\/index.php\\/rbac\\/index\\/page1.html\\r","\\/index.php\\/rbac\\/index\\/page2.html"]', 1, '2017-10-29 09:11:44', '2017-10-27 06:00:55'),
(6, '用户查看', '["\\/index.php\\/rbac\\/user\\/index.html"]', 1, '2017-10-29 09:22:00', '2017-10-29 09:20:44'),
(7, '用户添加', '["\\/index.php\\/rbac\\/user\\/useradd.html"]', 1, '0000-00-00 00:00:00', '2017-10-29 09:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `app_access_log`
--

CREATE TABLE IF NOT EXISTS `app_access_log` (
  `id` int(11) NOT NULL,
  `uid` bigint(20) NOT NULL DEFAULT '0' COMMENT '品牌UID',
  `target_url` varchar(255) NOT NULL DEFAULT '' COMMENT '访问的url',
  `query_params` longtext NOT NULL COMMENT 'get和post参数',
  `ua` varchar(255) NOT NULL DEFAULT '' COMMENT '访问ua',
  `ip` varchar(32) NOT NULL DEFAULT '' COMMENT '访问ip',
  `note` varchar(1000) NOT NULL DEFAULT '' COMMENT 'json格式备注字段',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='用户操作记录表';

--
-- Dumping data for table `app_access_log`
--

INSERT INTO `app_access_log` (`id`, `uid`, `target_url`, `query_params`, `ua`, `ip`, `note`, `created_time`) VALUES
(1, 7, '/index.php/rbac/index/page1.html', '', '', '127.0.0.1', '', '2017-10-31 06:38:52'),
(2, 7, '/index.php/rbac/index/page2.html', '', '', '127.0.0.1', '', '2017-10-31 06:38:53'),
(3, 7, '/index.php/rbac/index/page3.html', '', '', '127.0.0.1', '', '2017-10-31 06:38:53'),
(4, 7, '/index.php/rbac/index/page4.html', '', '', '127.0.0.1', '', '2017-10-31 06:38:54'),
(5, 7, '/index.php/rbac/user/index.html', '', '', '127.0.0.1', '', '2017-10-31 06:38:54'),
(6, 7, '/index.php/rbac/role/index.html', '', '', '127.0.0.1', '', '2017-10-31 06:38:55'),
(7, 7, '/index.php/rbac/authority/index.html', '', '', '127.0.0.1', '', '2017-10-31 06:38:55'),
(8, 7, '/index.php/rbac/operation_log/index.html', '', '', '127.0.0.1', '', '2017-10-31 06:38:56'),
(9, 7, '/index.php/rbac/user/index.html', '', '', '127.0.0.1', '', '2017-10-31 06:39:07'),
(10, 7, '/index.php/rbac/user/useradd.html', '', '', '127.0.0.1', '', '2017-10-31 06:39:09'),
(11, 7, '/index.php/rbac/user/useradd.html', '', '', '127.0.0.1', '', '2017-10-31 06:39:19'),
(12, 7, '/index.php/rbac/user/index.html', '', '', '127.0.0.1', '', '2017-10-31 06:39:22'),
(13, 7, '/index.php/rbac/user/useradd/user_id/44.html', '', '', '127.0.0.1', '', '2017-10-31 06:39:25'),
(14, 7, '/index.php/rbac/user/useradd/user_id/44.html', '', '', '127.0.0.1', '', '2017-10-31 06:39:35'),
(15, 7, '/index.php/rbac/user/index.html', '', '', '127.0.0.1', '', '2017-10-31 06:39:38'),
(16, 7, '/index.php/rbac/operation_log/index.html', '', '', '127.0.0.1', '', '2017-10-31 06:39:41'),
(17, 7, '/index.php/rbac/operation_log/index.html', '', '', '127.0.0.1', '', '2017-10-31 06:40:36');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '角色名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：有效 0：无效',
  `updated_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后一次更新时间',
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入时间'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='角色表';

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `status`, `updated_time`, `created_time`) VALUES
(3, '销售', 1, '0000-00-00 00:00:00', '2017-10-25 08:36:40'),
(4, '运营', 1, '0000-00-00 00:00:00', '2017-10-25 08:39:39'),
(5, '设计', 1, '0000-00-00 00:00:00', '2017-10-25 08:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `role_access`
--

CREATE TABLE IF NOT EXISTS `role_access` (
  `id` int(11) unsigned NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色id',
  `access_id` int(11) NOT NULL DEFAULT '0' COMMENT '权限id',
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入时间'
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 COMMENT='角色权限表';

--
-- Dumping data for table `role_access`
--

INSERT INTO `role_access` (`id`, `role_id`, `access_id`, `created_time`) VALUES
(114, 5, 4, '2017-10-29 09:15:16'),
(115, 5, 3, '2017-10-29 09:15:35'),
(116, 5, 4, '2017-10-29 09:15:35'),
(117, 4, 1, '2017-10-29 09:15:56'),
(118, 5, 3, '2017-10-29 09:20:55'),
(119, 5, 4, '2017-10-29 09:20:55'),
(120, 5, 6, '2017-10-29 09:20:55'),
(121, 5, 3, '2017-10-29 09:23:03'),
(122, 5, 4, '2017-10-29 09:23:03'),
(123, 5, 6, '2017-10-29 09:23:03'),
(124, 5, 7, '2017-10-29 09:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '姓名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '姓名',
  `email` varchar(30) NOT NULL DEFAULT '' COMMENT '邮箱',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是超级管理员 1表示是 0 表示不是',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：有效 0：无效',
  `updated_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后一次更新时间',
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入时间'
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='用户表';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `is_admin`, `status`, `updated_time`, `created_time`) VALUES
(7, 'xiaojing', '4d74a1d0e2c04b7f25fbfb886300736a', '123@qq.com', 1, 1, '2017-10-29 08:03:38', '0000-00-00 00:00:00'),
(36, 'king', '0abdc646042a4684544ee2b258842a1c', '', 0, 1, '2017-10-29 09:16:05', '2017-10-26 10:05:39'),
(37, 'jing', '5eaceeeba8bb8d23a7374a08e401b116', '', 0, 1, '2017-10-26 10:19:35', '2017-10-26 10:19:05'),
(40, '花样百出', '287a37a47a53ad16b70590a9f6fc98a8', '', 0, 1, '0000-00-00 00:00:00', '2017-10-28 10:47:11'),
(41, '草木灰', '9a2e832b2910047fa05c1e469b8d02e5', '', 0, 1, '0000-00-00 00:00:00', '2017-10-28 10:48:58'),
(42, 'haining', '18ea5342657d5fbe54acf99d12ec4471', '', 0, 1, '0000-00-00 00:00:00', '2017-10-29 09:23:27'),
(43, '222', '9932d79c21e40cd0834e8644a999ac33', '', 0, 1, '0000-00-00 00:00:00', '2017-10-29 09:24:03'),
(44, '7788', 'a661c8105ff311840953c8787460b563', '', 0, 1, '2017-10-31 06:39:35', '2017-10-31 06:39:19');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) unsigned NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色ID',
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入时间'
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COMMENT='用户角色表';

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `uid`, `role_id`, `created_time`) VALUES
(5, 1, 44, '2017-10-24 00:34:35'),
(55, 36, 5, '2017-10-29 09:14:58'),
(56, 36, 4, '2017-10-29 09:16:05'),
(57, 42, 3, '2017-10-29 09:23:27'),
(58, 42, 4, '2017-10-29 09:23:27'),
(59, 43, 4, '2017-10-29 09:24:03'),
(60, 44, 5, '2017-10-31 06:39:19'),
(61, 44, 4, '2017-10-31 06:39:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_access_log`
--
ALTER TABLE `app_access_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uid` (`uid`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_access`
--
ALTER TABLE `role_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_role_id` (`role_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_email` (`email`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `app_access_log`
--
ALTER TABLE `app_access_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `role_access`
--
ALTER TABLE `role_access`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
