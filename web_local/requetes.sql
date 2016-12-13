-- sucré-salé : on utilise à la fois du miel et du sel 

SELECT
  r.NOM_RECETTE
FROM
  recette r,
  contenu c,
  contenu c2,
  ingredient i,
  ingredient i2
WHERE
  r.NUMERO_RECETTE = c.NUMERO_RECETTE 
  AND c.NUMERO_INGREDIENT = i.NUMERO_INGREDIENT 
  AND i.NOM_INGREDIENT = "miel" 
  AND r.NUMERO_RECETTE = c2.NUMERO_RECETTE 
  AND c2.NUMERO_INGREDIENT = i2.NUMERO_INGREDIENT 
  AND i2.NOM_INGREDIENT = "sel";



-- top : les recettes ont été notée par plus de cinq internautes a 3

SELECT
  r.NOM_RECETTE
FROM
  recette r,
  note n
HAVING
  COUNT(
    r.NUMERO_RECETTE = n.NUMERO_RECETTE AND n.VALEUR_NOTE = 3
  ) >= 5;



-- commune : les recettes sont présentes dans trois menus et ont reçu plus de 10 notes et plus de 3 commentaires

SELECT
  r.NOM_RECETTE
FROM
  recette r,
  note n,
  menu m,
  composition cp,
  commentaire c
HAVING
  COUNT(
    r.NUMERO_RECETTE = n.NUMERO_RECETTE AND n.VALEUR_NOTE > 0
  ) >= 10 AND COUNT(
    r.NUMERO_RECETTE = c.NUMERO_RECETTE
  ) >= 3 AND COUNT(
    r.NUMERO_RECETTE = cp.NUMERO_RECETTE AND cp.NUMERO_MENU = m.NUMERO_MENU
  ) >= 3;




---------------REQUETES STATISTIQUES-------------------

-- Le nombre de recettes d’une catégorie créée depuis le début de l’année

SELECT
  COUNT(*) AS Nombre
FROM
  recette r,
  appartient a,
  categorie c
WHERE
  r.NUMERO_RECETTE = a.NUMERO_RECETTE AND a.NUMERO_CATEGORIE = c.NUMERO_CATEGORIE AND r.DATE_CREATION_RECETTE > 2016 -01 -01;




-- Le classement des recettes selon les notes données par les internautes

SELECT
  r.NOM_RECETTE,
  AVG(n.VALEUR_NOTE) "Note moyenne"
FROM
  recette r,
  note n
WHERE
  r.NUMERO_RECETTE = n.NUMERO_RECETTE
GROUP BY
  r.NOM_RECETTE
ORDER BY
  AVG(n.VALEUR_NOTE)
DESC;



-- Pour les menus réalisés par un internaute, la moyenne des notes données pour les recettes qu’il comprend.

SELECT
  m.NOM_MENU ,
  AVG(n.VALEUR_NOTE) "Note moyenne"
FROM
  NOTE n,
  INTERNAUTE i,
  MENU m,
  COMPOSITION c
WHERE
  m.NUMERO_INTERNAUTE = i.NUMERO_INTERNAUTE AND c.NUMERO_MENU = m.NUMERO_MENU AND c.NUMERO_RECETTE = n.NUMERO_RECETTE
GROUP BY
  i.NUMERO_INTERNAUTE
ORDER BY
  AVG(n.VALEUR_NOTE)
DESC


-- Pour le tri des ingredients, division en plusieurs sous-requetes (requete complete en dessous):

-- moyrecette(notes) 

SELECT
  i.nom_ingredient,
  AVG(n.VALEUR_NOTE)
FROM
  note n,
  ingredient i,
  contenu c
WHERE
  i.NUMERO_INGREDIENT = c.NUMERO_INGREDIENT AND c.NUMERO_RECETTE = n.NUMERO_RECETTE
GROUP BY
  i.NUMERO_INGREDIENT;
  
  
  
-- ratio de calories

SELECT
  i.NOM_INGREDIENT,
  d.VALEUR /(
  SELECT
    SUM(VALEUR)
  FROM
    definition
  WHERE
    NUMERO_CARACTERISTIQUE = 1
) AS "Ratio"
FROM
  ingredient i,
  definition d
WHERE
  i.NUMERO_INGREDIENT = d.NUMERO_INGREDIENT AND d.NUMERO_CARACTERISTIQUE = 1
GROUP BY
  i.NUMERO_INGREDIENT


-- Somme des coefs de commentaires

SELECT
  i.NOM_INGREDIENT,
  SUM(
    IF(
      @nbCom :=(
      SELECT
        COUNT(c.NUMERO_COMMENTAIRE)
      FROM
        commentaire c,
        contenu ct
      WHERE
        i.NUMERO_INGREDIENT = ct.NUMERO_INGREDIENT AND ct.NUMERO_RECETTE = c.NUMERO_RECETTE
    ) <= 3,
    1,
    IF(@nbCom <= 10,
    2,
    3)
    )
  )
FROM
  ingredient i
GROUP BY
  i.NUMERO_INGREDIENT
  
  
--
-- La requete finale :
--


SELECT
  i.NOM_INGREDIENT,
  (
  SELECT
    AVG(n.VALEUR_NOTE)
  FROM
    note n, contenu c
  WHERE
    i.NUMERO_INGREDIENT = c.NUMERO_INGREDIENT AND c.NUMERO_RECETTE = n.NUMERO_RECETTE) *
(SELECT
  d.VALEUR /
(SELECT
    SUM(VALEUR)
  FROM
    definition
  WHERE
    NUMERO_CARACTERISTIQUE = 1)
FROM
  definition d
WHERE
  i.NUMERO_INGREDIENT = d.NUMERO_INGREDIENT AND d.NUMERO_CARACTERISTIQUE = 1) *
(SELECT SUM(
      IF(
      @nbCom :=(
      SELECT
        COUNT(c.NUMERO_COMMENTAIRE)
      FROM
        commentaire c, contenu ct
      WHERE
        i.NUMERO_INGREDIENT = ct.NUMERO_INGREDIENT AND ct.NUMERO_RECETTE = c.NUMERO_RECETTE) <= 3, 1,			          
          IF(@nbCom <= 10, 2, 3)))) RES
FROM
  ingredient i
GROUP BY
  i.NUMERO_INGREDIENT
ORDER BY
  RES
DESC;

