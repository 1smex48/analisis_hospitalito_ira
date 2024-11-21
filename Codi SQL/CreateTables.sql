CREATE TABLE analisis_hospitalito_ira.pacient (
  dni_pacient varchar(9) NOT NULL,
  nom varchar(50) NOT NULL,
  cognom1 varchar(255) NOT NULL,
  cognom2 varchar(50) NOT NULL,
  data_naix varchar(50) NOT NULL,
  PRIMARY KEY (dni_pacient)
)
ENGINE = INNODB,
CHARACTER SET utf8mb4,
COLLATE utf8mb4_0900_ai_ci;

CREATE TABLE analisis_hospitalito_ira.analisis_sang (
  ID_Sang int NOT NULL AUTO_INCREMENT,
  Tipus_SANG varchar(255) NOT NULL,
  Nivells_glucosa varchar(255) NOT NULL,
  Colesterol varchar(255) NOT NULL,
  Recompte_celules_sanguineas varchar(255) NOT NULL,
  Deficit_nutriens varchar(255) NOT NULL,
  Hormones varchar(255) NOT NULL,
  DNI_Pacient varchar(9) NOT NULL,
  PRIMARY KEY (ID_Sang)
)
ENGINE = INNODB,
CHARACTER SET utf8mb4,
COLLATE utf8mb4_0900_ai_ci;

ALTER TABLE analisis_hospitalito_ira.analisis_sang
ADD CONSTRAINT FK_analisis_sang_dni_pacient FOREIGN KEY (DNI_Pacient)
REFERENCES analisis_hospitalito_ira.pacient (dni_pacient);

CREATE TABLE analisis_hospitalito_ira.analisis_orina (
  ID_Orina int NOT NULL AUTO_INCREMENT,
  Color varchar(255) NOT NULL,
  Olor varchar(255) NOT NULL,
  Densitat varchar(255) NOT NULL,
  pH varchar(255) NOT NULL,
  Nitrits varchar(255) NOT NULL,
  Proteines varchar(255) NOT NULL,
  Glucosa varchar(255) NOT NULL,
  Cetones varchar(255) NOT NULL,
  Bilirubina varchar(255) NOT NULL,
  Urobilinogen varchar(255) NOT NULL,
  Hemoglobina varchar(255) NOT NULL,
  Leucocits varchar(255) NOT NULL,
  Eritrocits varchar(255) NOT NULL,
  Cilindres varchar(255) NOT NULL,
  Cristalls varchar(255) NOT NULL,
  Bacteris varchar(255) NOT NULL,
  DNI_Pacient varchar(9) NOT NULL,
  PRIMARY KEY (ID_Orina)
)
ENGINE = INNODB,
CHARACTER SET utf8mb4,
COLLATE utf8mb4_0900_ai_ci;

ALTER TABLE analisis_hospitalito_ira.analisis_orina
ADD CONSTRAINT FK_analisis_orina_dni_pacient FOREIGN KEY (DNI_Pacient)
REFERENCES analisis_hospitalito_ira.pacient (dni_pacient);

CREATE TABLE analisis_hospitalito_ira.analisis_eses (
  ID_Eses int NOT NULL AUTO_INCREMENT,
  Color varchar(255) NOT NULL,
  Consistencia varchar(255) NOT NULL,
  Parasits varchar(255) NOT NULL,
  DNI_Pacient varchar(9) NOT NULL,
  PRIMARY KEY (ID_Eses)
)
ENGINE = INNODB,
CHARACTER SET utf8mb4,
COLLATE utf8mb4_0900_ai_ci;

ALTER TABLE analisis_hospitalito_ira.analisis_eses
ADD CONSTRAINT FK_analisis_eses_dni_pacient FOREIGN KEY (DNI_Pacient)
REFERENCES analisis_hospitalito_ira.pacient (dni_pacient);