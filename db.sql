create table admin(
    id int primary key not null auto_increment,
    first_name varchar(50) not null,
    last_name varchar(50) not null,
    email varchar(256) unique not null,
    password varchar(256) not null,
    created_at datetime default current_timestamp,
    modified_at timestamp default current_timestamp
);