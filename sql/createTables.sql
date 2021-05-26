-- Add truncate tables
-- All type are to change i think

CREATE TABLE Utente (
    id int primary key,
    nome varchar(255),
    cognome varchar(255),
    email varchar(255),
    pw varchar(255),
    indirizzo varchar(255),
    civico int,
    dataNascita date
);

CREATE TABLE Ordine (
    id int primary key,
    descrizione text(),
    prezzoTot double(20, 4),
    confermato boolean,
    dataConsegna date,
    dataOrdine date,
    fk_id_utente int foreign key references Utente(id),
    fk_id_negozio int foreign key references Negozio(id)
);

CREATE TABLE Negozio (
    id int primary key,
    nominativo varchar(255),
    email varchar(255),
    pw varchar(255),
    indirizzo varchar(255),
    civico int,
    cellulare varchar(255)
);

CREATE TABLE Prodotto (
    id int primary key,
    nome varchar(255),
    descrizione text(),
    prezzo double(20, 4),
    foto varchar(255),
    categoria int,
    fk_id_negozio foreign key references Negozio(id)
);