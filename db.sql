CREATE TABLE client (
    id INT PRIMARY KEY,
    LastName VARCHAR(255),
    FirstName VARCHAR(255),
    Address VARCHAR(255),
    Telephone VARCHAR(255)
);

CREATE TABLE Partenaire (
    id INT PRIMARY KEY,
    LastName VARCHAR(255),
    FirstName VARCHAR(255),
    Metier VARCHAR(255),
    Ville VARCHAR(255),
    Creneaux VARCHAR(255),
    YearExperience INT,
    Note FLOAT,
    Nbr_commande INT,
    Email VARCHAR(255),
    Telephone VARCHAR(255)
);

CREATE TABLE services (
    id INT PRIMARY KEY,
    Id_P INT,
    Nom VARCHAR(255),
    Description VARCHAR(255),
    Prix FLOAT,
    Note FLOAT,
    Nbr_commande INT,
    FOREIGN KEY (Id_P) REFERENCES Partenaire(id)
);

CREATE TABLE commentaire (
    id INT PRIMARY KEY,
    Id_S INT ,
    Id_C INT ,
    message VARCHAR(255),
    Rating FLOAT,
    Date_post DATE,
    publisher VARCHAR(255),
    published BOOLEAN,
    FOREIGN KEY (Id_S) REFERENCES services(id),
    FOREIGN KEY (Id_C) REFERENCES client(id)
);

CREATE TABLE reservation (
    id INT PRIMARY KEY,
    Id_S INT,
    Id_C INT,
    Date_reserv DATE,
    Statuts VARCHAR(255),
    FOREIGN KEY (Id_S) REFERENCES services(id),
    FOREIGN KEY (Id_C) REFERENCES client(id)
);
