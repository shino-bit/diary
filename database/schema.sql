-- Створення бази даних
CREATE DATABASE IF NOT EXISTS online_diary;
USE online_diary;

-- Таблиця користувачів
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Таблиця записів щоденника
CREATE TABLE IF NOT EXISTS diary_entries (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    entry_date DATE NOT NULL,  -- Дата запису
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_created (user_id, created_at),
    INDEX idx_entry_date (entry_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Тестові дані (опціонально)
-- Пароль для test@example.com: "password123"
INSERT INTO users (email, password) VALUES 
('test@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

INSERT INTO diary_entries (user_id, title, entry_date, content) VALUES 
(1, 'Перший запис', CURDATE(), 'Це мій перший запис у щоденнику'),
(1, 'Другий запис', DATE_SUB(CURDATE(), INTERVAL 1 DAY), 'Сьогодні чудова погода! Записав нові думки.');
