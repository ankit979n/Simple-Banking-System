CREATE DATABASE IF NOT EXISTS bank_system;
USE bank_system;

CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    balance DECIMAL(10, 2) DEFAULT 0.00
);

CREATE TABLE IF NOT EXISTS transfers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT,
    receiver_id INT,
    amount DECIMAL(10, 2),
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES customers(id),
    FOREIGN KEY (receiver_id) REFERENCES customers(id)
);



-- Insert sample customer data
INSERT INTO customers (name, email, balance) VALUES
    ('Abhinash Chourasia', 'abhinashkrch@gmail.com', 5000.00),
    ('Pralay Krishna', 'pralaykrishana@gmail.com', 3000.00),
    ('Amit Diashi', 'amit_diashi@gmail.com', 7000.00),
    ('Debasis Maji', 'debasismaji@gmail.com', 4500.00),
    ('Prahallad Das', 'prahalladas@gmail.com', 6000.00);

-- Insert sample transfer data
INSERT INTO transfers (sender_id, receiver_id, amount) VALUES
    (1, 2, 1000.00),
    (3, 4, 1500.00),
    (2, 5, 800.00),
    (4, 1, 2000.00),
    (5, 3, 1200.00);