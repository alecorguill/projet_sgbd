-- ============================================================
--   Nom de la base   :  Recettes                                
--   Nom de SGBD      :  ORACLE Version 7.0                    
--   Date de creation :  22/11/16  17:34                      
-- ============================================================


-- ============================================================


drop table ROLE cascade constraints;

drop table FILM cascade constraints;

drop table REALISATEUR cascade constraints;

drop table ACTEUR cascade constraints;

-- ============================================================
--   Table : RECETTE                                           
-- ============================================================
create table RECETTE
(
    NUMERO_RECETTE              NUMBER(3)              not null,
    NOM_RECETTE                 CHAR(20)               not null,
    DATE_CREATION_RECETTE       DATE                       ,
    TEMPS_PREPARATION_RECETTE   NUMBER(3)                       ,
    TEMPS_CUISSON_RECETTE       NUMBER(3)                           ,
    NOMBRE_DE_PERSONNES         NUMBER(3),        
    constraint pk_recette primary key (NUMERO_RECETTE)
);

-- ============================================================
--   Table : MENU                                       
-- ============================================================
create table MENU
(
    NUMERO_MENU              NUMBER(3)              not null,
    NOM_MENU                 CHAR(20)               not null,
    NUMERO_INTERNAUTE        NUMBER(3)                       ,
    constraint pk_menu primary key (NUMERO_MENU)
);

-- ============================================================
--   Table : INTERNAUTE                                              
-- ============================================================
create table INTERNAUTE
(
    NUMERO_INTERNAUTE          NUMBER(3)              not null,
    PSEUDO                     CHAR(20)               not null,
    constraint pk_internaute primary key (NUMERO_INTERNAUTE)
);

-- ============================================================
--   Table : MODIFICATION                                              
-- ============================================================
create table MODIFICATION
(
    NUMERO_MODIFICATION                  NUMBER(3)              not null,
    DESCRIPTION_MODIFICATION             CHAR(20)              not null,
    DATE_MODIFICATION                    DATE                       ,
    constraint pk_modification primary key (NUMERO_MODIFICATION)
);

-- ============================================================
--   Table : COMMENTAIRE                                              
-- ============================================================
create table COMMENTAIRE
(
    NUMERO_COMMENTAIRE              NUMBER(3)              not null,
    NUMERO_INTERNAUTE               NUMBER(3)              not null,
    NUMERO_RECETTE                  NUMBER(3)              not null,
    DESCRIPTION_COMMENTAIRE         CHAR(20)              not null,
    constraint pk_commentaire primary key (NUMERO_COMMENTAIRE)
);

-- ============================================================
--   Table : NOTE                                              
-- ============================================================
create table NOTE
(
    VALEUR_NOTE                  NUMBER(3)              not null,
    NUMERO_RECETTE               NUMBER(3)              not null,
    NUMERO_INTERNAUTE            NUMBER(3)              not null,
    constraint pk_note primary key (NUMERO_INTERNAUTE,NUMERO_RECETTE)
);

-- ============================================================
--   Table : INGREDIENT                                              
-- ============================================================
create table INGREDIENT
(
    NUMERO_INGREDIENT          NUMBER(3)              not null,
    NOM_INGREDIENT             CHAR(20)              not null,
    constraint pk_ingredient primary key (NUMERO_INGREDIENT)
);

-- ============================================================
--   Table : CARACTERISTIQUE NUTRITIONNELLE                                              
-- ============================================================
create table CARACTERISTIQUE_NUTRITIONNELLE 
(
    NUMERO_CARACTERISTIQUE          NUMBER(3)              not null,
    NOM_CARACTERISTIQUE             CHAR(20)                not null,
    constraint pk_caracteristique primary key (NUMERO_CARACTERISTIQUE)
);
-- ============================================================
--   Table : ACTION                                              
-- ============================================================
create table ACTION
(
    NUMERO_INTERNAUTE               NUMBER(3)              not null,
    NUMERO_MODIFICATION             NUMBER(3)              not null,
    constraint pk_action primary key (NUMERO_INTERNAUTE,NUMERO_MODIFICATION)
);
-- ============================================================
--   Table : SOUMISSION                                  
-- ============================================================
create table SOUMISSION
(
    NUMERO_MODIFICATION        NUMBER(3)              not null,
    NUMERO_RECETTE             NUMBER(3)              not null,
    constraint pk_soumission primary key (NUMERO_MODIFICATION,NUMERO_RECETTE)
);
-- ============================================================
--   Table : CONTENU
-- ============================================================
create table CONTENU
(
    NUMERO_RECETTE          NUMBER(3)              not null,
    NUMERO_INGREDIENT       NUMBER(3)              not null,
    QUANTITE                NUMBER(3)                       ,
    UNITE                   CHAR(20)
    constraint pk_contenu primary key (NUMERO_RECETTE,NUMERO_INGREDIENT)
);
-- ============================================================
--   Table : COMPOSITION                                              
-- ============================================================
create table COMPOSITION
(
    NUMERO_RECETTE               NUMBER(3)              not null,
    NUMERO_MENU                  NUMBER(3)              not null,
    constraint pk_composition primary key (NUMERO_RECETTE,NUMERO_MENU)
);

-- ============================================================
--   Table : DEFINITION                                              
-- ============================================================
create table DEFINITION
(
    NUMERO_INGREDIENT               NUMBER(3)              not null,
    NUMERO_CARACTERISTIQUE          NUMBER(3)              not null,
    constraint pk_definition primary key (NUMERO_INGREDIENT,NUMERO_CARACTERISTIQUE)
);

alter table RECETTE
    add constraint fk1_recette foreign key (NUMERO_RECETTE)
       references NOTE (NUMERO_RECETTE);
    add constraint fk2_recette foreign key (NUMERO_RECETTE)
       references SOUMISSION (NUMERO_RECETTE);
    add constraint fk3_recette foreign key (NUMERO_RECETTE)
       references COMMENTAIRE (NUMERO_RECETTE);
    add constraint fk3_recette foreign key (NUMERO_RECETTE)
       references CONTENU (NUMERO_RECETTE);
    

alter table INTERNAUTE
    add constraint fk1_internaute foreign key (NUMERO_INTERNAUTE)
       references NOTE (NUMERO_ACTEUR);
    add constraint fk2_internaute foreign key (NUMERO_INTERNAUTE)
       references COMMENTAIRE (NUMERO_ACTEUR);
    add constraint fk3_internaute foreign key (NUMERO_INTERNAUTE)
       references MENU (NUMERO_ACTEUR);

alter table MODIFICATION
    add constraint fk1_modification foreign key (NUMERO_FILM)
       references ACTION (NUMERO_FILM);

