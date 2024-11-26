CREATE USER 'adminmysql'@'%' IDENTIFIED BY 'P@ssw0rd';

GRANT ALL PRIVILEGES ON *.* TO 'adminmysql'@'%' WITH GRANT OPTION;

FLUSH PRIVILEGES;

INSERT INTO analisis_hospitalito_ira.pacient(dni_pacient, nom, cognom1, cognom2, data_naix) 
VALUES ('123456789', 'Juan', 'Pérez', 'García', '1990-01-01');

INSERT INTO analisis_hospitalito_ira.analisis_sang(ID_Sang, Tipus_SANG, Nivells_glucosa, Colesterol, Recompte_celules_sanguineas, Deficit_nutriens, Hormones, DNI_Pacient) 
VALUES (1, 'A+', '90 mg/dL', '200 mg/dL', '5.0 x10^6/µL', 'Ninguno', 'Normal', '123456789');

INSERT INTO analisis_hospitalito_ira.medic (DNI_Medic, Nom, Cognom, Cognom2, Data_Alta, Data_Baixa, Valido, Contrasenya) 
VALUES ('987654321', 'Alba', 'Oviedo', 'Hola', '2023-01-01', NULL, 1, '$2y$10$lVXJgWv2SrJQb4Lbd3Mhv.JvR4Tr6RLdPQFkbQwtPgLdabGvxcfvW');