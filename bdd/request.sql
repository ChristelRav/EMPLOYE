---SELECT TABLE

SELECT * FROM fiche_paie;
SELECT * FROM horaire_employe;
SELECT * FROM pointage;
SELECT * FROM horaire;
SELECT * FROM employe;
SELECT * FROM categorie;
SELECT * FROM utilisateur;

---DELETE TABLE

DELETE FROM fiche_paie;
DELETE FROM horaire_employe;
DELETE FROM pointage;
DELETE FROM horaire;
DELETE FROM employe;
DELETE FROM categorie;
DELETE FROM utilisateur;

---DROP TABLE

DROP TABLE fiche_paie;
DROP TABLE horaire_employe;
DROP TABLE pointage;
DROP TABLE horaire;
DROP TABLE employe;
DROP TABLE categorie;
DROP TABLE utilisateur;

--- TRUNCATE


TRUNCATE  TABLE fiche_paie RESTART  IDENTITY CASCADE;
TRUNCATE  TABLE horaire_employe RESTART  IDENTITY CASCADE;
TRUNCATE  TABLE pointage RESTART  IDENTITY CASCADE;
TRUNCATE  TABLE horaire RESTART  IDENTITY CASCADE;
TRUNCATE  TABLE employe  RESTART IDENTITY CASCADE;
TRUNCATE  TABLE categorie  RESTART IDENTITY CASCADE;
TRUNCATE  TABLE utilisateur  RESTART IDENTITY CASCADE;

--- REQUEST

SELECT * FROM employe WHERE date_fin_contrat > current_date OR date_fin_contrat IS  NULL;

SELECT SUM(horaire_jour) as sj ,  SUM(horaire_nuit) as sn , SUM(horaire_ferie) as sf,  SUM(horaire_jour) +  SUM(horaire_nuit) + SUM(horaire_ferie) as total_heure  , date_pointage
FROM pointage
WHERE id_employe = 4
GROUP BY date_pointage;


SELECT  id_employe , horaire_jour , horaire_nuit , horaire_ferie , date_pointage
FROM pointage
WHERE id_employe = 1 AND horaire_ferie != 0
GROUP BY  id_employe , horaire_jour , horaire_nuit , horaire_ferie , date_pointage;

SELECT  *
FROM employe e
JOIN categorie c ON c.id_categorie = e.id_categorie
WHERE e.id_employe = 2;


SELECT * FROM pointage WHERE id_employe=1 ORDER BY id_pointage DESC LIMIT 1 ;

--CALCUL DE NUIT & CALCUL SUP
SELECT id_employe,SUM(horaire_jour) as sj ,  SUM(horaire_nuit) as sn , SUM(horaire_ferie) as sf,  SUM(horaire_jour) +  SUM(horaire_nuit)  as total_heure  , date_pointage
FROM pointage
WHERE id_employe = 1
GROUP BY date_pointage,id_employe
ORDER BY date_pointage DESC LIMIT 1;

SELECT id_employe ,SUM(horaire_ferie),date_pointage
FROM pointage
WHERE id_employe = 1 AND date_pointage = current_date AND  horaire_ferie != 0 
GROUP BY date_pointage,id_employe;

SELECT   id_employe, COALESCE(SUM(horaire_jour), 0) AS sj, COALESCE(SUM(horaire_ferie), 0) AS sf, date_pointage
FROM pointage
WHERE id_employe = 1 AND date_pointage = current_date AND  horaire_ferie != 0
GROUP BY date_pointage,id_employe;

SELECT *
FROM horaire_employe 
WHERE id_employe = 1 AND  date_h = current_date;

SELECT he.*,h.designation
FROM horaire_employe he
JOIN horaire h ON h.id_horaire = he.id_horaire;


SELECT id_employe, SUM(horaire_jour) as sj, SUM(horaire_nuit) as sn, SUM(horaire_ferie) as sf, SUM(horaire_jour) + SUM(horaire_nuit) as total_heure, date_pointage
 FROM pointage 
 WHERE id_employe = 1 AND  horaire_ferie != 0
 GROUP BY date_pointage , id_employe
  ORDER BY date_pointage DESC LIMIT 1

  SELECT  p.id_employe, COALESCE(SUM(p.horaire_jour), 0) AS sj, COALESCE(SUM(p.horaire_ferie), 0) AS sf, p.date_pointage
FROM  pointage p
WHERE  p.id_employe = 1  AND p.date_pointage = current_date  AND  horaire_ferie != 0
GROUP BY p.date_pointage, p.id_employe;

SELECT * ,  (2500 * pourcentage )/100 as taux_horaire
FROM horaire_employe
WHERE id_employe = 1 AND date_h = current_date;

SELECT * ,  (2500 * pourcentage )/100 as taux_horaire , total_heure * ((2500 * pourcentage )/100) as montant 
FROM horaire_employe
WHERE id_employe = 1 AND date_h = current_date;

SELECT SUM( total_heure * ((2500 * pourcentage )/100)) as montant_total 
FROM horaire_employe
WHERE id_employe = 1 AND date_h = current_date;

SELECT SUM( total_heure * ((2500 * pourcentage )/100)) as montant_total 
FROM horaire_employe
WHERE id_employe = 1 AND date_h = '2024-05-22';

SELECT  (horaire_jour + horaire_nuit) AS sd
FROM pointage
WHERE id_employe = 2
ORDER BY id_pointage DESC
LIMIT 1;


--STATISTIQUE

SELECT fp.id_employe, e.id_categorie, e.nom, e.prenom, c.nom AS categorie_nom, SUM(fp.montant)
FROM fiche_paie fp
JOIN employe e ON fp.id_employe = e.id_employe
JOIN categorie c ON c.id_categorie = e.id_categorie
GROUP BY fp.id_employe, e.id_categorie, e.nom, e.prenom, c.nom;


SELECT date_fiche_paie 
FROM fiche_paie
GROUP BY id_employe,date_fiche_paie
ORDER BY date_fiche_paie DESC LIMIT 1;



SELECT  e.id_employe,  e.id_categorie,  e.nom,  e.prenom,  c.nom AS categorie_nom,  SUM(fp.montant) AS total_montant, 
 (SELECT MAX(date_fiche_paie) FROM fiche_paie  WHERE id_employe = e.id_employe) AS date_fiche_paie
FROM fiche_paie fp
JOIN employe e ON fp.id_employe = e.id_employe
JOIN categorie c ON c.id_categorie = e.id_categorie
GROUP BY e.id_employe, e.id_categorie, e.nom, e.prenom, c.nom;

--TTL HEURE & MONTANT

SELECT he.id_horaire,h.designation,SUM(total_heure) as th 
FROM horaire_employe he
JOIN horaire h ON h.id_horaire = he.id_horaire
GROUP BY he.id_horaire,h.designation;


SELECT he.id_horaire,h.designation,he.pourcentage  ,SUM(total_heure) as th , SUM(total_heure) * he.pourcentage as montant
FROM horaire_employe he
JOIN horaire h ON h.id_horaire = he.id_horaire
GROUP BY he.id_horaire,h.designation,he.pourcentage ;