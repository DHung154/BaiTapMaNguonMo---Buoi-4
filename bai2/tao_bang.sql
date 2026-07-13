CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(20)
);

INSERT INTO students (name, email, phone) VALUES
('Nguyen Van A', 'a@example.com', '0123456789'),
('Tran Thi B', 'b@example.com', '0987654321');
