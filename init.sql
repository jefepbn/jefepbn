CREATE TABLE devices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    device_id VARCHAR(100) UNIQUE,
    device_name VARCHAR(255),
    ip_address VARCHAR(45),
    last_seen TIMESTAMP,
    payload TEXT
);

CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    device_id VARCHAR(100),
    sender ENUM('ADMIN','DEVICE'),
    message TEXT,
    delivered TINYINT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
