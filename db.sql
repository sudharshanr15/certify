create table admin(
    id int primary key not null auto_increment,
    first_name varchar(50) not null,
    last_name varchar(50) not null,
    email varchar(256) unique not null,
    password varchar(256) not null,
    created_at datetime default current_timestamp,
    modified_at timestamp default current_timestamp
);

create table organization(
    id int primary key not null auto_increment,
    name varchar(256) not null,
    logo varchar(256) not null
);

create table competition(
    id int primary key not null auto_increment,
    organization int not null,
    competition varchar(256) not null,
    image varchar(256),
    year varchar(15) not null,
    created_at datetime default current_timestamp,
    modified_at timestamp default current_timestamp
);

create table participants(
    id int primary key not null auto_increment,
    first_name varchar(50) not null,
    last_name varchar(50) not null,
    email varchar(256) not null,
    usn varchar(100) not null,
    degree varchar(15) not null,
    organization varchar(256) not null,
    competition varchar(256) not null,
    winner int not null default 0,
    place int,
    created_at datetime default current_timestamp,
    modified_at timestamp default current_timestamp
);

create table certificate(
    id int primary key not null auto_increment,
    user_id int not null,
    certificate varchar(256) not null
);

create table reset_password_tokens(
    id int primary key not null auto_increment,
    user_id int not null,
    token varchar(256) not null,
    created_at datetime default current_timestamp,
    modified_at timestamp default current_timestamp
);