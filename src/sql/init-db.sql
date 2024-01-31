-- Create 'employee' table
CREATE TABLE IF NOT EXISTS employee (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Create 'ticket_state' table for the TicketState enum
CREATE TABLE IF NOT EXISTS ticket_state (
    id INT AUTO_INCREMENT PRIMARY KEY,
    state VARCHAR(50) NOT NULL UNIQUE
);

-- Pre-populate 'ticket_state' table with states
INSERT INTO ticket_state (state) VALUES ('Open'), ('Validated'), ('InProgress'), ('Closed');

-- Create 'ticket' table
CREATE TABLE IF NOT EXISTS ticket (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    creationDate DATETIME NOT NULL,
    closingDate DATETIME,
    state_id INT NOT NULL,
    mail VARCHAR(255),
    name VARCHAR(255),
    FOREIGN KEY (state_id) REFERENCES ticket_state(id)
);
