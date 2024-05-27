INSERT INTO utilisateur (email, mot_passe)
VALUES
('john.doe@example.com', '123'),
('jane.smith@example.com', '456'),
('alice.jones@example.com', '789');


INSERT INTO utilisateur (email, mot_passe,type)
VALUES
('bob.brown@example.com', '1234',1);


INSERT INTO categorie (nom, horaire_semaine, salaire_semaine, pourcentage_indemnite)
VALUES
('Cadre', 40, 200000, 30),
('Normal', 40, 100000, 30),
('Gardien', 56, 110000, 25),
('Chauffeur', 40, 120000, 10);


INSERT INTO employe (id_utilisateur, id_categorie, nom, prenom, date_naissance, date_embauche, date_fin_contrat)
VALUES
(1,2, 'Doe', 'John', '1985-01-15', '2010-06-01', '2025-01-21'),
(2,3, 'Smith', 'Jane', '1990-02-20', '2015-08-15', '2021-02-11'),
(3,2, 'Jones', 'Alice', '1982-03-30', '2008-11-10', NULL),
(4,2, 'Brown', 'Bob', '1975-04-25', '2005-09-20', '2025-06-01');

INSERT INTO horaire (designation, pourcentage) VALUES
('HN', 100),
('HS30', 130),
('HS50', 150),
('HM30', 30),
('HM40', 40),
('HF', 100),
('HF50', 50);

INSERT INTO pointage (id_employe, horaire_jour, horaire_nuit, horaire_ferie,date_pointage) VALUES
(1, 17, 0, 8,'2024-05-18'),
(1, 10, 2, 0,'2024-05-18'),
(1, 10, 8, 0,'2024-05-18'),
(1, 5, 8, 0,'2024-05-18');

INSERT INTO fiche_paie (id_employe, montant, date_fiche_paie) 
VALUES (1, 168250.00, '2024-05-22');

INSERT INTO fiche_paie (id_employe, montant) 
VALUES (1, 153725.00);

