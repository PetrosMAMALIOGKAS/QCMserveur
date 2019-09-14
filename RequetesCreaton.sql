CREATE TABLE PERSONNE 
	( idPersonne INTEGER(8) AUTO_INCREMENT,
	  nom VARCHAR(25),
	  prenom VARCHAR(12),
	  email VARCHAR(50) UNIQUE,
	  motDePasse VARCHAR(15),
	  statut CHAR(3),
	  CONSTRAINT PK_Personne PRIMARY KEY (idPersonne)
	  );
	 
CREATE TABLE QCM 
	( idQcm INTEGER(8) AUTO_INCREMENT,
	  createur INTEGER(8) NOT NULL,
	  designation VARCHAR(40),
	  dateLimite DATE, 
	  CONSTRAINT PK_Qcm PRIMARY KEY (idQcm),
	  CONSTRAINT FK_QcmPersonne FOREIGN KEY (createur) REFERENCES PERSONNE(idPersonne)
	);
	
CREATE TABLE COMPLETER
	( idPersonne INTEGER(8),
	  idQcm INTEGER(8),
	  resultat FLOAT(2,2),
	  dateSoumis DATE,
	  CONSTRAINT PK_Completer PRIMARY KEY (idPersonne, idQcm),
	  CONSTRAINT FK_CompleterPersonne FOREIGN KEY (idPersonne) REFERENCES PERSONNE (idPersonne),
	  CONSTRAINT FK_CompleterQcm FOREIGN KEY (idQcm) REFERENCES QCM (idQcm)
	  );
	 
CREATE TABLE THEME
	( idTheme INTEGER(8) AUTO_INCREMENT,
	  designation VARCHAR(30),
	  createur INTEGER(8),
	  CONSTRAINT PK_Theme PRIMARY KEY (idTheme),
	  CONSTRAINT FK_ThemePersonne FOREIGN KEY (createur) REFERENCES PERSONNE (idPersonne)
	  );
	  
CREATE TABLE QUESTION
	( idQuestion INTEGER(8) AUTO_INCREMENT,
	  auteur INTEGER(8) NOT NULL,
	  theme INTEGER(8) NOT NULL,
	  reponseCorrect TINYINT(1),
	  CONSTRAINT PK_Question PRIMARY KEY (idQuestion),
	  CONSTRAINT FK_QuestionPersonne FOREIGN KEY (auteur) REFERENCES PERSONNE (idPersonne),
	  CONSTRAINT FK_QuestionTheme FOREIGN KEY (theme) REFERENCES THEME (idTheme)
	  );
	
CREATE TABLE CONTIENT
	( idQuestion INTEGER(8),
	  idQcm INTEGER(8),
	  CONSTRAINT PK_Contient PRIMARY KEY (idQuestion, idQcm),
	  CONSTRAINT FK_ContientQuestion FOREIGN KEY (idQuestion) REFERENCES QUESTION(idQuestion),
	  CONSTRAINT FK_ContientQcm FOREIGN KEY (idQcm) REFERENCES QCM (idQcm)
	);
	
CREATE TABLE REPONSE 
	( idQuestion INTEGER(8),
	  idReponse INTEGER(8) AUTO_INCREMENT UNIQUE,
	  texte VARCHAR(100),
	  CONSTRAINT PK_Reponse PRIMARY KEY (idQuestion, idReponse),
	  CONSTRAINT FK_ReponseQuestion FOREIGN KEY (idQuestion) REFERENCES QUESTION(idQuestion)
	  );
	  
	  
CREATE TABLE REPONSESQCM 
	( idQuestion INTEGER(8),
	  idPersonne INTEGER(8),
	  idQcm INTEGER(8),
	  reponseDonne INTEGER(8),
	  CONSTRAINT PK_Reponse PRIMARY KEY (idQuestion, idPersonne, idQcm),
	  CONSTRAINT FK_ReponsesQcmCompleter01 FOREIGN KEY (idPersonne) REFERENCES COMPLETER(idPersonne),
	  CONSTRAINT FK_ReponsesQcmCompleter02 FOREIGN KEY (idQcm) REFERENCES COMPLETER(idQcm)
	  );
	  
ALTER TABLE question ADD texteQuestion VARCHAR(100);
ALTER TABLE qcm ADD publication BOOLEAN;
ALTER TABLE qcm ALTER publication SET DEFAULT 0;
ALTER TABLE qcm MODIFY dateLimite DATETIME;
ALTER TABLE completer MODIFY dateSoumis DATETIME;
ALTER TABLE completer MODIFY resultat INTEGER(8);
ALTER TABLE qcm MODIFY designation VARCHAR(80);
ALTER TABLE qcm ADD publieResultats BOOLEAN DEFAULT 0;
ALTER TABLE personne MODIFY motDePasse VARCHAR(200);
	  
