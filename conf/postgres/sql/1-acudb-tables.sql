CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL
);

-- Identifiants de l'admin
INSERT INTO users (username, password_hash) VALUES ('admin', 'admin');

-- Identifiants des users
INSERT INTO users (username, password_hash) VALUES ('user1', 'mdp1');
INSERT INTO users (username, password_hash) VALUES ('user2', 'mdp2');
INSERT INTO users (username, password_hash) VALUES ('user3', 'mdp3');