-- xampp.Employee definition
CREATE TABLE `employee` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(255) CHARACTER SET utf16 COLLATE utf16_general_ci DEFAULT NULL COMMENT 'name for login',
                            `password` varchar(255) CHARACTER SET utf16 COLLATE utf16_general_ci DEFAULT NULL COMMENT 'password for login (MD5)',
                            PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci
COMMENT='Employee for login';
