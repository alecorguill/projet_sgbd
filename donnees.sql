-- ============================================================
--    suppression des donnees
-- ============================================================

delete from RECETTE;

commit ;

-- ============================================================
--    creation des donnees
-- ============================================================

-- RECETTE

insert into RECETTE values (  1 , 'Kebab', '22-NOV-16', 110, 50, 2);
insert into RECETTE values (  2 , 'Pot-au-feu', '23-NOV-16', 30, 240, 4);
insert into RECETTE values (  3 , 'Pizza Margherita', '23-NOV-16', 35, 25, 2);
insert into RECETTE values (  4 , 'Veloute poireaux', '24-NOV-16', 45, 50, 3);
insert into RECETTE values (  5 , 'Tartiflette', '24-NOV-16', 75, 40, 5);
insert into RECETTE values (  6 , 'Pates au beurre', '24-NOV-16', 2, 10, 2);
insert into RECETTE values (  7 , 'Foret noire', '24-NOV-16', 50, 0, 2);
insert into RECETTE values (  8 , 'Crepes', '24-NOV-16', 20, 10, 6);

insert into MENU values ( 1, 'Repas chez Mamie', 2);
insert into MENU values ( 2, 'Foot Pizza Biere', 1);
insert into MENU values ( 3, 'Basse Ville', 3);

insert into COMPOSITION values ( 2, 1 );
insert into COMPOSITION values ( 7, 1 );
insert into COMPOSITION values ( 3, 2 );
insert into COMPOSITION values ( 8, 2 );
insert into COMPOSITION values ( 1, 3 );
insert into COMPOSITION values ( 8, 3 );

insert into INTERNAUTE values ( 1 , 'lchaumartin');
insert into INTERNAUTE values ( 2 , 'jroullaid');
insert into INTERNAUTE values ( 3 , 'adeGorguill');

