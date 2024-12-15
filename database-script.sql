create database gerenciareserva;

CREATE TABLE users (
    id int unsigned AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255),
    created timestamp DEFAULT CURRENT_TIMESTAMP,
    modified timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE espacos (
	id int unsigned AUTO_INCREMENT PRIMARY KEY,
	endereco varchar(255) NOT NULL,
	telefone varchar(15),
	lotacao int,
	hora_inicio time,
	hora_fim time,
	created timestamp DEFAULT CURRENT_TIMESTAMP,
	modified timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE adicionals (
	id int unsigned AUTO_INCREMENT PRIMARY KEY,
	nome varchar(255) NOT NULL,
	created timestamp DEFAULT CURRENT_TIMESTAMP,
	modified timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE reservas (
	id int unsigned AUTO_INCREMENT PRIMARY KEY,
	cliente_nome varchar(255) NOT NULL,
	cliente_cpf varchar(11) NOT NULL,
	inicio datetime NOT NULL,
	fim datetime NOT NULL,
    recepcao int,
    coffe_break varchar(50),
	created timestamp DEFAULT CURRENT_TIMESTAMP,
	modified timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE reservas_adicionals (
	reserva_id int unsigned NOT NULL,
    adicional_id int unsigned NOT NULL,
    PRIMARY KEY (reserva_id, adicional_id),
    FOREIGN KEY (reserva_id) REFERENCES reservas(id) ON DELETE CASCADE,
    FOREIGN KEY (adicional_id) REFERENCES adicionals(id) ON DELETE CASCADE
);

insert into users (username, password)
values ('Administrador', '9b48d645a7294103ceef0c0d77ca1f2951a28952');

insert into espacos (endereco, telefone, lotacao, hora_inicio, hora_fim)
values ('Rua Afonso Pena, 1990', '67999998888', 80, '09:00:00', '16:30:00');

insert into adicionals (nome)
values ('Flipcharts'),
('Backdrops'),
('Banners de boas vindas'),
('Telão de fundo para palco'),
('Placas de mesa');

insert into reservas (cliente_nome, cliente_cpf, inicio, fim, recepcao, coffe_break)
values ('Angela Bauhs', '32165498701', '2024-12-22 13:00:00', '2024-12-22 16:30:00', 3, 'Tradicional');

insert into reservas_adicionals (reserva_id, adicional_id)
values (1, 1),
(1, 3);


