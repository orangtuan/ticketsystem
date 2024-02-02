-- Create 'employee' table
CREATE TABLE IF NOT EXISTS employee
(
    id       INT AUTO_INCREMENT PRIMARY KEY,
    name     VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL

);

CREATE TABLE IF NOT EXISTS customer
(
    id       INT AUTO_INCREMENT PRIMARY KEY,
    email     VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL
);

-- Create 'ticket_state' table for the TicketState enum
CREATE TABLE IF NOT EXISTS ticket_state
(
    id    INT AUTO_INCREMENT PRIMARY KEY,
    state VARCHAR(50) NOT NULL UNIQUE
);

-- Pre-populate 'ticket_state' table with states
INSERT INTO ticket_state (state)
VALUES ('Open'),
       ('Validated'),
       ('InProgress'),
       ('Closed');

-- Create 'ticket' table
CREATE TABLE IF NOT EXISTS ticket
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    state_id     INT NOT NULL,
    customer_id  INT NOT NULL,
    employee_id  INT NOT NULL,
    title        VARCHAR(255) NOT NULL,
    description  TEXT         NULL,
    creationDate DATETIME     NOT NULL,
    closingDate  DATETIME     NULL,
    FOREIGN KEY (state_id) REFERENCES ticket_state (id),
    FOREIGN KEY (customer_id) REFERENCES customer (id),
    FOREIGN KEY (employee_id) REFERENCES employee (id)
);
