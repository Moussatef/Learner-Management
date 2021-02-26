/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  25/02/2021 16:46:16                      */
/*==============================================================*/


drop table if exists ADMIN;

drop table if exists CLASSE_ETD;

drop table if exists ETUDIANT;

drop table if exists FORMATEUR;

drop table if exists MODULE;

drop table if exists NOTES;

drop table if exists PERSONE;

drop table if exists PERSONNE_FORM;

drop table if exists PRESSON_ETUD;

/*==============================================================*/
/* Table : ADMIN                                                */
/*==============================================================*/
create table ADMIN
(
   ID_ADMIN             int not null,
   NOM                  varchar(15),
   EMAIL                varchar(25),
   PASSWORD             varchar(50),
   primary key (ID_ADMIN)
);



/*==============================================================*/
/* Table : ETUDIANT                                             */
/*==============================================================*/
create table ETUDIANT
(
   ID_ETUDIANT          int not null,
   ID_CLASSE_ETD        int not null,
   primary key (ID_ETUDIANT)
);

/*==============================================================*/
/* Table : FORMATEUR                                            */
/*==============================================================*/
create table FORMATEUR
(
   ID_FORMATEUR         int not null,
   primary key (ID_FORMATEUR)
);

/*==============================================================*/
/* Table : CLASSE_ETD                                           */
/*==============================================================*/
create table CLASSE_ETD
(
   ID_CLASSE_ETD        int not null,
   ID_FORMATEUR         int foreign key references FORMATEUR(ID_FORMATEUR) not null,
   NOM                  varchar(10),
   primary key (ID_CLASSE_ETD,ID_FORMATEUR)
);

/*==============================================================*/
/* Table : MODULE                                               */
/*==============================================================*/
create table MODULE
(
   ID_MODULE            int not null,
   NOM_MODULE           varchar(50),
   primary key (ID_MODULE)
);

/*==============================================================*/
/* Table : NOTES                                                */
/*==============================================================*/
create table NOTES
(
   ID_NOTE              int not null,
   ID_FORMATEUR         int not null,
   ID_ETUDIANT          int not null,
   ID_MODULE            int not null,
   NOTE                 float,
   primary key (ID_NOTE)
);

/*==============================================================*/
/* Table : PERSONE                                              */
/*==============================================================*/
create table PERSONE
(
   ID_PERSON            int not null,
   NOM                  varchar(15),
   PRENOM               varchar(20),
   AGE                  int,
   EMAIL                varchar(25),
   PASSWORD             varchar(50),
   primary key (ID_PERSON)
);

/*==============================================================*/
/* Table : PERSONNE_FORM                                        */
/*==============================================================*/
create table PERSONNE_FORM
(
   ID_FORMATEUR         int not null,
   ID_PERSON            int not null,
   primary key (ID_FORMATEUR, ID_PERSON)
);

/*==============================================================*/
/* Table : PRESSON_ETUD                                         */
/*==============================================================*/
create table PRESSON_ETUD
(
   ID_ETUDIANT          int not null,
   ID_PERSON            int not null,
   primary key (ID_ETUDIANT, ID_PERSON)
);















alter table CLASSE_ETD add constraint FK_CLASSE_FORMATEUR2 foreign key (ID_FORMATEUR)
      references FORMATEUR (ID_FORMATEUR) on delete restrict on update restrict;

alter table ETUDIANT add constraint FK_CLASSE_ETUDIANT foreign key (ID_CLASSE_ETD)
      references CLASSE_ETD (ID_CLASSE_ETD) on delete restrict on update restrict;

alter table NOTES add constraint FK_AFFECTER foreign key (ID_FORMATEUR)
      references FORMATEUR (ID_FORMATEUR) on delete restrict on update restrict;

alter table NOTES add constraint FK_AFFICHER foreign key (ID_ETUDIANT)
      references ETUDIANT (ID_ETUDIANT) on delete restrict on update restrict;

alter table NOTES add constraint FK_RELATION_7 foreign key (ID_MODULE)
      references MODULE (ID_MODULE) on delete restrict on update restrict;

alter table PERSONNE_FORM add constraint FK_PERSONNE_FORM foreign key (ID_FORMATEUR)
      references FORMATEUR (ID_FORMATEUR) on delete restrict on update restrict;

alter table PERSONNE_FORM add constraint FK_PERSONNE_FORM2 foreign key (ID_PERSON)
      references PERSONE (ID_PERSON) on delete restrict on update restrict;

alter table PRESSON_ETUD add constraint FK_PRESSON_ETUD foreign key (ID_ETUDIANT)
      references ETUDIANT (ID_ETUDIANT) on delete restrict on update restrict;

alter table PRESSON_ETUD add constraint FK_PRESSON_ETUD2 foreign key (ID_PERSON)
      references PERSONE (ID_PERSON) on delete restrict on update restrict;

