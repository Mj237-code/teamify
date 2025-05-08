-- Création de la base de données
CREATE DATABASE IF NOT EXISTS teamify_db;
USE teamify_db;

-- Table Utilisateur
CREATE TABLE utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    mot_de_passe VARCHAR(255),
    role ENUM('admin', 'manager', 'employe') NOT NULL
);

-- Table Département
CREATE TABLE departement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

-- Table Employé
CREATE TABLE employe (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    matricule VARCHAR(50),
    date_embauche DATE,
    id_departement INT,
    poste VARCHAR(100),
    FOREIGN KEY (user_id) REFERENCES utilisateur(id) ON DELETE CASCADE,
    FOREIGN KEY (id_departement) REFERENCES departement(id)
);

-- Table Congés
CREATE TABLE conge (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_employe INT,
    date_debut DATE,
    date_fin DATE,
    type VARCHAR(50),
    statut ENUM('en attente', 'validé', 'refusé') DEFAULT 'en attente',
    FOREIGN KEY (id_employe) REFERENCES employe(id)
);

-- Table Présence
CREATE TABLE presence (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_employe INT,
    date DATE,
    heure_arrivee TIME,
    heure_depart TIME,
    FOREIGN KEY (id_employe) REFERENCES employe(id)
);

-- Table Paie
CREATE TABLE paie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_employe INT,
    mois VARCHAR(10),
    annee YEAR,
    montant DECIMAL(10, 2),
    statut ENUM('versée', 'en attente') DEFAULT 'en attente',
    FOREIGN KEY (id_employe) REFERENCES employe(id)
);

-- Table Recrutement
CREATE TABLE recrutement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    poste VARCHAR(100),
    id_departement INT,
    date_publication DATE,
    statut ENUM('ouvert', 'fermé') DEFAULT 'ouvert',
    FOREIGN KEY (id_departement) REFERENCES departement(id)
);

-- Table Documents
CREATE TABLE document (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_employe INT,
    type ENUM('CV', 'contrat', 'bulletin'),
    nom_fichier VARCHAR(255),
    date_upload DATETIME,
    FOREIGN KEY (id_employe) REFERENCES employe(id)
);