CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL primary key AUTO_INCREMENT,
  `email` varchar(120) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `profile_name` varchar(100) DEFAULT NULL,
  `profile_image` varchar(200) DEFAULT NULL,
  `google_auth_code` varchar(16) DEFAULT NULL,
  `created_at` varchar(15) DEFAULT NULL,
  `updated_at` varchar(15) DEFAULT NULL
)