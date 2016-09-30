--Commands to Create Database

CREATE DATABASE shoes;
USE shoes;

CREATE TABLE stores (
    id serial PRIMARY KEY,
    name VARCHAR(100)
);

CREATE TABLE brands (
    id serial PRIMARY KEY,
    name VARCHAR (100)
);

CREATE TABLE stores_brands (
    id serial PRIMARY KEY,
    store_id int,
    brand_id int
);
