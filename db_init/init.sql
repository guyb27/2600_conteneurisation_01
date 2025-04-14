-- Création de la table utilisateurs
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    role VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Création de la table produits
CREATE TABLE products (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    category VARCHAR(50) NOT NULL
);

-- Insertion de données d'exemple - Utilisateurs
INSERT INTO users (username, password, email, role) VALUES 
('admin', 'super_secret_password_123!', 'admin@example.com', 'admin'),
('john_doe', 'password123', 'john@example.com', 'user'),
('jane_smith', 'securepass456', 'jane@example.com', 'user'),
('bob_johnson', 'bobpass789', 'bob@example.com', 'user'),
('alice_wonder', 'alicepass321', 'alice@example.com', 'moderator'),
('secret_user', 'topsecret987', 'secret@hidden.com', 'admin');

-- Insertion de données d'exemple - Produits
INSERT INTO products (name, description, price, category) VALUES
('Smartphone X', 'Dernier modèle avec appareil photo haute résolution', 899.99, 'Électronique'),
('Ordinateur portable Pro', 'Processeur i7, 16 Go RAM, 512 Go SSD', 1299.99, 'Informatique'),
('Tablette Y', 'Écran 10 pouces, idéal pour le multimédia', 349.99, 'Électronique'),
('Casque sans fil', 'Réduction de bruit active, autonomie 20h', 199.99, 'Audio'),
('Montre connectée', 'Suivi d''activité, notifications, GPS', 149.99, 'Accessoires');

-- Création de la table informations de paiement (données sensibles)
CREATE TABLE payment_info (
    id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL,
    card_type VARCHAR(50) NOT NULL,
    card_number VARCHAR(16) NOT NULL,
    expiry_date VARCHAR(7) NOT NULL,
    cvv VARCHAR(3) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Insertion de données d'exemple - Informations de paiement
INSERT INTO payment_info (user_id, card_type, card_number, expiry_date, cvv) VALUES
(1, 'Visa', '4111111111111111', '12/2024', '123'),
(2, 'MasterCard', '5555555555554444', '10/2025', '321'),
(3, 'Amex', '378282246310005', '06/2023', '456'),
(4, 'Visa', '4242424242424242', '01/2026', '789'),
(5, 'MasterCard', '5105105105105100', '03/2024', '456');
