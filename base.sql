-- ============================================================
--   Nom de la base   :  Recettes                                
--   Nom de SGBD      :  ORACLE Version 7.0                    
--   Date de creation :  22/11/16  17:34                      
-- ============================================================


-- ============================================================


drop table RECETTE cascade constraints;

drop table MENU cascade constraints;

drop table INTERNAUTE cascade constraints;

drop table MODIFICATION cascade constraints;

drop table COMMENTAIRE cascade constraints;

drop table NOTE cascade constraints;

drop table INGREDIENT cascade constraints;

drop table CARACTERISTIQUE_NUTRITIONNELLE cascade constraints;

drop table ACTION cascade constraints;

drop table SOUMISSION cascade constraints;

drop table CONTENU cascade constraints;

drop table COMPOSITION cascade constraints;

drop table DEFINITION cascade constraints;


-- ============================================================
--   Table : RECETTE                                           
-- ============================================================
create table RECETTE
(
    NUMERO_RECETTE              NUMBER(3)              not null,
    NOM_RECETTE                 CHAR(20)               not null,
    DATE_CREATION_RECETTE       DATE                           ,
    TEMPS_PREPARATION_RECETTE   NUMBER(3)                      ,
    TEMPS_CUISSON_RECETTE       NUMBER(3)                      ,
    NOMBRE_DE_PERSONNES         NUMBER(3)                      ,        
    constraint pk_recette primary key (NUMERO_RECETTE)
);

-- ============================================================
--   Table : MENU                                       
-- ============================================================
create table MENU
(
    NUMERO_MENU              NUMBER(3)                 not null,
    NOM_MENU                 CHAR(20)                  not null,
    NUMERO_INTERNAUTE        NUMBER(3)                         ,
    constraint pk_menu primary key (NUMERO_MENU)
);

-- ============================================================
--   Table : INTERNAUTE                                              
-- ============================================================
create table INTERNAUTE
(
    NUMERO_INTERNAUTE          NUMBER(3)               not null,
    PSEUDO                     CHAR(20)                not null,
    constraint pk_internaute primary key (NUMERO_INTERNAUTE)
);

-- ============================================================
--   Table : MODIFICATION                                              
-- ============================================================
create table MODIFICATION
(
    NUMERO_MODIFICATION                  NUMBER(3)      not null,
    DESCRIPTION_MODIFICATION             CHAR(20)       not null,
    DATE_MODIFICATION                    DATE                  ,
    constraint pk_modification primary key (NUMERO_MODIFICATION)
);

-- ============================================================
--   Table : COMMENTAIRE                                              
-- ============================================================
create table COMMENTAIRE
(
    NUMERO_COMMENTAIRE              NUMBER(3)          not null,
    NUMERO_INTERNAUTE               NUMBER(3)          not null,
    NUMERO_RECETTE                  NUMBER(3)          not null,
    DESCRIPTION_COMMENTAIRE         CHAR(20)           not null,
    constraint pk_commentaire primary key (NUMERO_COMMENTAIRE)
);

-- ============================================================
--   Table : NOTE                                              
-- ============================================================
create table NOTE
(
    VALEUR_NOTE                  NUMBER(3)             not null,
    NUMERO_RECETTE               NUMBER(3)             not null,
    NUMERO_INTERNAUTE            NUMBER(3)             not null,
    constraint pk_note primary key (NUMERO_INTERNAUTE,NUMERO_RECETTE)
);

-- ============================================================
--   Table : INGREDIENT                                              
-- ============================================================
create table INGREDIENT
(
    NUMERO_INGREDIENT          NUMBER(3)               not null,
    NOM_INGREDIENT             CHAR(20)                not null,
    constraint pk_ingredient primary key (NUMERO_INGREDIENT)
);

-- ============================================================
--   Table : CARACTERISTIQUE NUTRITIONNELLE                                              
-- ============================================================
create table CARACTERISTIQUE_NUTRITIONNELLE 
(
    NUMERO_CARACTERISTIQUE          NUMBER(3)          not null,
    NOM_CARACTERISTIQUE             CHAR(20)           not null,
    constraint pk_caracteristique primary key (NUMERO_CARACTERISTIQUE)
);
-- ============================================================
--   Table : ACTION                                              
-- ============================================================
create table ACTION
(
    NUMERO_INTERNAUTE               NUMBER(3)          not null,
    NUMERO_MODIFICATION             NUMBER(3)          not null,
    constraint pk_action primary key (NUMERO_INTERNAUTE,NUMERO_MODIFICATION)
);
-- ============================================================
--   Table : SOUMISSION                                  
-- ============================================================
create table SOUMISSION
(
    NUMERO_MODIFICATION        NUMBER(3)               not null,
    NUMERO_RECETTE             NUMBER(3)               not null,
    constraint pk_soumission primary key (NUMERO_MODIFICATION,NUMERO_RECETTE)
);
-- ============================================================
--   Table : CONTENU
-- ============================================================
create table CONTENU
(
    NUMERO_RECETTE          NUMBER(3)                  not null,
    NUMERO_INGREDIENT       NUMBER(3)                  not null,
    QUANTITE                NUMBER(3)                          ,
    UNITE                   CHAR(20)                   not null,
    constraint pk_contenu primary key (NUMERO_RECETTE,NUMERO_INGREDIENT)
);
-- ============================================================
--   Table : COMPOSITION                                              
-- ============================================================
create table COMPOSITION
(
    NUMERO_RECETTE               NUMBER(3)             not null,
    NUMERO_MENU                  NUMBER(3)             not null,
    constraint pk_composition primary key (NUMERO_RECETTE,NUMERO_MENU)
);

-- ============================================================
--   Table : DEFINITION                                              
-- ============================================================
create table DEFINITION
(
    NUMERO_INGREDIENT               NUMBER(3)          not null,
    NUMERO_CARACTERISTIQUE          NUMBER(3)          not null,
    constraint pk_definition primary key (NUMERO_INGREDIENT,NUMERO_CARACTERISTIQUE)
);


alter table ACTION
    add constraint fk1_action foreign key (NUMERO_INTERNAUTE)
       references INTERNAUTE (NUMERO_INTERNAUTE) on delete cascade
    add constraint fk2_action foreign key (NUMERO_MODIFICATION)
       references MODIFICATION (NUMERO_MODIFICATION) on delete cascade;

alter table NOTE
    add constraint fk1_note foreign key (NUMERO_INTERNAUTE)
       references INTERNAUTE (NUMERO_INTERNAUTE) on delete cascade
    add constraint fk2_note foreign key (NUMERO_RECETTE)
       references RECETTE (NUMERO_RECETTE) on delete cascade;

alter table SOUMISSION
    add constraint fk1_soumission foreign key (NUMERO_MODIFICATION)
       references MODIFICATION (NUMERO_MODIFICATION) on delete cascade
    add constraint fk2_soumission foreign key (NUMERO_RECETTE)
       references RECETTE (NUMERO_RECETTE) on delete cascade;
       
alter table COMMENTAIRE
    add constraint fk1_commentaire foreign key (NUMERO_INTERNAUTE)
       references INTERNAUTE (NUMERO_INTERNAUTE) on delete cascade
    add constraint fk2_commentaire foreign key (NUMERO_RECETTE)
       references RECETTE (NUMERO_RECETTE) on delete cascade;

alter table MENU
    add constraint fk1_menu foreign key (NUMERO_INTERNAUTE)
       references INTERNAUTE (NUMERO_INTERNAUTE) on delete cascade;

alter table COMPOSITION
    add constraint fk1_composition foreign key (NUMERO_RECETTE)
       references RECETTE (NUMERO_RECETTE) on delete cascade
    add constraint fk2_composition foreign key (NUMERO_MENU)
       references MENU (NUMERO_MENU) on delete cascade;
       
alter table DEFINITION	
    add constraint fk1_definition foreign key (NUMERO_INGREDIENT)
       references INGREDIENT (NUMERO_INGREDIENT) on delete cascade
    add constraint fk2_definition foreign key (NUMERO_CARACTERISTIQUE)
       references CARACTERISTIQUE_NUTRITIONNELLE (NUMERO_CARACTERISTIQUE) on delete cascade;
             
alter table CONTENU
    add constraint fk1_contenu foreign key (NUMERO_RECETTE)
       references RECETTE (NUMERO_RECETTE) on delete cascade
    add constraint fk2_contenu foreign key (NUMERO_INGREDIENT)
       references INGREDIENT (NUMERO_INGREDIENT) on delete cascade;

