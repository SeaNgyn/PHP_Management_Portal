CREATE TABLE feedback(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    body TEXT DEFAULT '',
    date DATETIME
);

INSERT INTO feedback(name, email, body, date) VALUES 
('Theanh', 'theanh16@gmail.com', 'I like it', current_timestamp()),
('T1', 't1@gmail.com', 'Please add more video to study', current_timestamp()),
('T2', 't2@gmail.com', 'I dont like it', current_timestamp());