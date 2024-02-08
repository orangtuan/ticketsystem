-- Create 'employee' table
CREATE TABLE IF NOT EXISTS `employee` (
    `id`       INT(11)      NOT NULL,
    `name`     VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL
);

ALTER TABLE `employee`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `employee`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Create 'customer' table
CREATE TABLE IF NOT EXISTS `customer` (
    `id`    INT(11)         NOT NULL,
    `email` VARCHAR(255)    NOT NULL,
    `name`  VARCHAR(255)    NOT NULL
);

ALTER TABLE `customer`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `customer`
    MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

-- Create 'ticket_state' table for the TicketState enum
CREATE TABLE IF NOT EXISTS `ticket_state`
(
    `id`    INT(11)     NOT NULL,
    `state` VARCHAR(50) NOT NULL
);

ALTER TABLE `ticket_state`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `ticket_state`
    MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ticket_state`
    MODIFY `state` VARCHAR(50) NOT NULL UNIQUE;

-- Pre-populate 'ticket_state' table with states
INSERT INTO `ticket_state` (state)
    VALUES ('Open'),
           ('Validated'),
           ('InProgress'),
           ('Closed');

-- Create 'ticket' table
CREATE TABLE IF NOT EXISTS `ticket`
(
    `id`           INT(11)      NOT NULL,
    `state_id`     INT(11)      NOT NULL,
    `customer_id`  INT(11)      NOT NULL,
    `employee_id`  INT(11)      NOT NULL,
    `title`        VARCHAR(255) NOT NULL,
    `description`  TEXT         NULL,
    `creationDate` DATETIME     NOT NULL,
    `closingDate`  DATETIME     NULL
);

ALTER TABLE `ticket`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `ticket`
    MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ticket`
    ADD FOREIGN KEY (`state_id`)    REFERENCES `ticket_state` (`id`),
    ADD FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
    ADD FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`);

-- Create 'message' table
CREATE TABLE IF NOT EXISTS `message` (
    `id`          INT   NOT NULL,
    `ticket_id`   INT   NOT NULL,
    `employee_id` INT   NULL,
    `customer_id` INT   NULL,
    `message`     TEXT  NOT NULL
);

ALTER TABLE `message`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `message`
    MODIFY `id` INT NOT NULL AUTO_INCREMENT;

ALTER TABLE `message`
    ADD CONSTRAINT `ticket_id`
        FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`);

ALTER TABLE `message`
    ADD CONSTRAINT `customer_id`
        FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

ALTER TABLE `message`
    ADD CONSTRAINT `employee_id`
        FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`);



-- DO NOT USE IN CASE OF FIRE --
-- DROP TABLE message;
-- DROP TABLE ticket;
-- DROP TABLE ticket_state;
-- DROP TABLE employee;
-- DROP TABLE customer;