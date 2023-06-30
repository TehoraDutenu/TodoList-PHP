CREATE TABLE
    IF NOT EXISTS `user` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(100) NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS `post` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titre VARCHAR(200) NOT NULL,
        description VARCHAR(255) NOT NULL,
        created_at INT NOT NULL,
        user_id INT NOT NULL,
        FOREIGN KEY (user_id) REFERENCES user(id)
    );