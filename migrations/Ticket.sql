CREATE TABLE `ticket` (
                          `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ticket-number',
                          `title` varchar(255) DEFAULT NULL,
                          `description` text DEFAULT NULL,
                          `creationDate` datetime DEFAULT NULL,
                          `closingDate` datetime DEFAULT NULL,
                          `ticketState` varchar(255) DEFAULT NULL,
                          `mail` varchar(255) DEFAULT NULL COMMENT 'mail address of creator',
                          `name` varchar(255) DEFAULT NULL COMMENT 'name of creator',
                          PRIMARY KEY (`id`),
                          KEY `ticket_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='for creation and editing'

