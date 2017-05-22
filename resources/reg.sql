
-- ----------------------------
--  程序运行后必要的信息表
-- ----------------------------

SET FOREIGN_KEY_CHECKS=0;


-- users 用户信息表格

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `user` varchar(50) NOT NULL UNIQUE COMMENT '用户账号',
  `password` varchar(255) NOT NULL COMMENT '用户密码',
  `name` varchar(255) DEFAULT NULL COMMENT '用户昵称',
  `email` varchar(255) DEFAULT NULL COMMENT '用户邮箱',
  `image` VARCHAR(255) DEFAULT 'default' COMMENT '用户头像',
  `remember_token` VARCHAR(100) DEFAULT  NULL ,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- commit 用户提交的评论存储表

DROP TABLE IF EXISTS `commit`;
CREATE TABLE `commit` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,   -- 记录的索引条数,其实就是层数
  `user_id` varchar(50) NOT NULL COMMENT '留言用户ID',
  `user` varchar(50) NOT NULL COMMENT '用户账号',
  `content` varchar(255) DEFAULT NULL COMMENT '用户留言内容',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;