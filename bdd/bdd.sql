CREATE USER employeu WITH PASSWORD 'emp';
CREATE DATABASE employe;
GRANT ALL PRIVILEGES ON DATABASE employe TO employeu;

psql -U employeu -d employe

CREATE TABLE utilisateur (
    id_utilisateur  SERIAL PRIMARY KEY,
    email VARCHAR(255),
    mot_passe VARCHAR(50),
    type INT DEFAULT 5
);

CREATE TABLE categorie(
    id_categorie  SERIAL PRIMARY KEY,
    nom VARCHAR(255),
    horaire_semaine NUMERIC,
    salaire_semaine DOUBLE PRECISION,
    pourcentage_indemnite DOUBLE PRECISION
);

CREATE TABLE employe (
    id_employe  SERIAL PRIMARY KEY,
    id_utilisateur INT REFERENCES utilisateur(id_utilisateur),
    id_categorie INT REFERENCES categorie(id_categorie),
    nom VARCHAR(255),
    prenom VARCHAR(255),
    date_naissance DATE,
    date_embauche DATE,
    date_fin_contrat DATE DEFAULT '2025-01-31'
);

CREATE TABLE horaire (
    id_horaire SERIAL PRIMARY KEY,
    designation VARCHAR(255),
    pourcentage DOUBLE PRECISION
);

CREATE TABLE pointage (
    id_pointage SERIAL PRIMARY KEY,
    id_employe INT REFERENCES employe(id_employe),
    horaire_jour NUMERIC,
    horaire_nuit NUMERIC,
    horaire_ferie NUMERIC,
    date_pointage DATE DEFAULT CURRENT_DATE
);

CREATE TABLE horaire_employe(
    id_horaire_employe SERIAL PRIMARY KEY,
    id_horaire INT REFERENCES horaire(id_horaire),
    id_employe INT REFERENCES employe(id_employe),
    pourcentage DOUBLE PRECISION,
    total_heure NUMERIC,
    salaire_horaire DOUBLE PRECISION,
    date_h DATE DEFAULT CURRENT_DATE
);

CREATE TABLE fiche_paie (
    id_fiche_paie SERIAL PRIMARY KEY,
    id_employe INT REFERENCES employe(id_employe),
    montant DOUBLE PRECISION,
    date_fiche_paie DATE DEFAULT CURRENT_DATE
);
