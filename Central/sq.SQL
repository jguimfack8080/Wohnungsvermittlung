CREATE TABLE WOHNUNG (
  id INT PRIMARY KEY AUTO_INCREMENT,
  Beschreibung TEXT,
  Latitude DECIMAL(10,6),
  Longitude DECIMAL(10,6),
  Bild VARCHAR(255),
  Preis DECIMAL(10,2),
  Zimmertyp TEXT
);

CREATE TABLE Hausverwalter(
USERNAME VARCHAR(255),
PASSWORD VARCHAR(255)

);

CREATE TABLE Mieter (
  id INT PRIMARY KEY AUTO_INCREMENT,
  NameMi VARCHAR(50),
  VornameMi VARCHAR(50),
  Geburtsdatum DATE,
  Einzugsdatum DATE,
  Dauer INT,
  Hochschule VARCHAR(100)
);
