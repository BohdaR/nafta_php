CREATE TABLE operations
(
    id   serial PRIMARY KEY,
    name varchar(20)
);

CREATE TABLE data
(
    id           serial PRIMARY KEY,
    input_data   text  NOT NULL,
    output_data  float NOT NULL,
    operation_id int references operations
);

CREATE TABLE users
(
    id       serial PRIMARY KEY,
    login    varchar(15) NOT NULL,
    password varchar(32) NOT NULL
);
