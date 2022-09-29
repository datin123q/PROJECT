-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220928.000bf397a4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 29, 2022 lúc 06:10 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `commentsection`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `assignments`
--

CREATE TABLE `assignments` (
  `aid` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `stime` datetime NOT NULL,
  `ftime` date NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `assignments`
--

INSERT INTO `assignments` (`aid`, `title`, `content`, `stime`, `ftime`, `pid`) VALUES
(52, 'Bài Tập1', ' VD DFGB\r\nVĐGB', '2022-09-28 23:43:56', '2022-09-30', 22);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ass_file`
--

CREATE TABLE `ass_file` (
  `afid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ass_file`
--

INSERT INTO `ass_file` (`afid`, `aid`, `file`) VALUES
(8, 52, 'index.htm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `message` text NOT NULL,
  `aid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`cid`, `uid`, `date`, `message`, `aid`) VALUES
(52, 13, '2022-09-28 23:44:44', ' DSFSFF1', 52);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `log`
--

CREATE TABLE `log` (
  `logid` int(11) NOT NULL,
  `substance` varchar(255) NOT NULL,
  `uid` int(12) NOT NULL,
  `logtime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `project`
--

CREATE TABLE `project` (
  `pid` int(11) NOT NULL,
  `ptitle` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `project`
--

INSERT INTO `project` (`pid`, `ptitle`) VALUES
(22, 'ProJect1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `usn` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birth` date DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `MSSV` varchar(12) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `role` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`uid`, `usn`, `pwd`, `name`, `birth`, `phone`, `MSSV`, `mail`, `role`) VALUES
(12, 'admin', 'admin', 'Giáo Viên', NULL, NULL, NULL, NULL, 1),
(13, '20194015', '20194015', 'Trịnh Đạt', NULL, NULL, '20194015', NULL, 0),
(14, '20194016', '20194016', 'Trần A', NULL, NULL, '20194016', NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_ass`
--

CREATE TABLE `user_ass` (
  `wid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `result` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `mark` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user_ass`
--

INSERT INTO `user_ass` (`wid`, `uid`, `aid`, `result`, `date`, `mark`) VALUES
(114, 13, 52, 0, '2022-09-29', 0),
(118, 14, 52, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_pro`
--

CREATE TABLE `user_pro` (
  `upid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `work_file`
--

CREATE TABLE `work_file` (
  `fid` int(11) NOT NULL,
  `wid` int(11) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `work_file`
--

INSERT INTO `work_file` (`fid`, `wid`, `file`) VALUES
(20, 114, 'index.php');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `pid` (`pid`);

--
-- Chỉ mục cho bảng `ass_file`
--
ALTER TABLE `ass_file`
  ADD PRIMARY KEY (`afid`),
  ADD KEY `aid` (`aid`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `aid` (`aid`);

--
-- Chỉ mục cho bảng `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`logid`),
  ADD KEY `uid` (`uid`);

--
-- Chỉ mục cho bảng `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`pid`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- Chỉ mục cho bảng `user_ass`
--
ALTER TABLE `user_ass`
  ADD PRIMARY KEY (`wid`),
  ADD KEY `uid` (`uid`,`aid`),
  ADD KEY `aid` (`aid`);

--
-- Chỉ mục cho bảng `user_pro`
--
ALTER TABLE `user_pro`
  ADD PRIMARY KEY (`upid`),
  ADD KEY `uid` (`uid`,`pid`),
  ADD KEY `pid` (`pid`);

--
-- Chỉ mục cho bảng `work_file`
--
ALTER TABLE `work_file`
  ADD PRIMARY KEY (`fid`),
  ADD KEY `wid` (`wid`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `assignments`
--
ALTER TABLE `assignments`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `ass_file`
--
ALTER TABLE `ass_file`
  MODIFY `afid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `log`
--
ALTER TABLE `log`
  MODIFY `logid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `project`
--
ALTER TABLE `project`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `user_ass`
--
ALTER TABLE `user_ass`
  MODIFY `wid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT cho bảng `user_pro`
--
ALTER TABLE `user_pro`
  MODIFY `upid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `work_file`
--
ALTER TABLE `work_file`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `project` (`pid`);

--
-- Các ràng buộc cho bảng `ass_file`
--
ALTER TABLE `ass_file`
  ADD CONSTRAINT `ass_file_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `assignments` (`aid`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `assignments` (`aid`);

--
-- Các ràng buộc cho bảng `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`);

--
-- Các ràng buộc cho bảng `user_ass`
--
ALTER TABLE `user_ass`
  ADD CONSTRAINT `user_ass_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`),
  ADD CONSTRAINT `user_ass_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `assignments` (`aid`);

--
-- Các ràng buộc cho bảng `user_pro`
--
ALTER TABLE `user_pro`
  ADD CONSTRAINT `user_pro_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`),
  ADD CONSTRAINT `user_pro_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `project` (`pid`);

--
-- Các ràng buộc cho bảng `work_file`
--
ALTER TABLE `work_file`
  ADD CONSTRAINT `work_file_ibfk_1` FOREIGN KEY (`wid`) REFERENCES `user_ass` (`wid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
