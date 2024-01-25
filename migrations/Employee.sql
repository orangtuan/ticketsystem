-- xampp.Employee definition
CREATE TABLE `Employee` (
                            `Employee_Id` int(11) NOT NULL AUTO_INCREMENT,
                            `Name` varchar(255) CHARACTER SET utf16 COLLATE utf16_general_ci DEFAULT NULL COMMENT 'name for login',
                            `Password` varchar(255) CHARACTER SET utf16 COLLATE utf16_general_ci DEFAULT NULL COMMENT 'password for login (MD5)',
                            PRIMARY KEY (`Employee_Id`)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci
COMMENT='Employee for login';
