CREATE TABLE Utente (
    id int AUTO_INCREMENT primary key,
    nome varchar(255),
    cognome varchar(255),
    email varchar(255),
    pw varchar(255),
    città varchar(255),
    indirizzo varchar(255),
    civico int,
    dataNascita date
);

CREATE TABLE Negozio (
    id int AUTO_INCREMENT primary key,
    nominativo varchar(255),
    descrizione text(1000),
    email varchar(255),
    cellulare varchar(255),
    pw varchar(255),
    città varchar(255),
    indirizzo varchar(255),
    civico int
);

CREATE TABLE Ordine (
    id int AUTO_INCREMENT primary key,
    descrizione text(1000),
    prezzoTot double(20, 2),
    confermato boolean,
    dataConsegna dateTime,
    dataOrdine dateTime,
    fk_id_utente int,
    fk_id_negozio int,
    FOREIGN KEY (fk_id_utente) REFERENCES Utente(id),
    FOREIGN KEY (fk_id_negozio) REFERENCES Negozio(id)
);

CREATE TABLE Prodotto (
    id int AUTO_INCREMENT primary key,
    nome varchar(255),
    descrizione text(1000),
    prezzo double(20, 2),
    foto varchar(255),
    categoria varchar(255),
    fk_id_negozio int,
    FOREIGN KEY (fk_id_negozio) REFERENCES Negozio(id)
);

CREATE TABLE Contiene (
    quantità int,
    fk_id_ordine int,
    fk_id_prodotto int,
    FOREIGN KEY (fk_id_ordine) REFERENCES Ordine(id),
    FOREIGN KEY (fk_id_prodotto) REFERENCES Prodotto(id)
);

CREATE TABLE Orario (
    id int AUTO_INCREMENT primary key,
    giorno int,
    oraChiusura dateTime,
    oraApertura dateTime,
    fk_id_negozio int,
    FOREIGN KEY (fk_id_negozio) REFERENCES Negozio(id)
);