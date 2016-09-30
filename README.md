# Shoes in my Town
Epicodus - PHP - Databases Extended - Code Review 4

## Features
A description of what it does.

## Technologies

PHP, SQL, Silex, Twig, HTML, CSS and Bootstrap.

## Usage

To use the code, you can clone the repository at [https://github.com/jryanconklin/epicodus-php-cr4-shoes](https://github.com/jryanconklin/epicodus-php-cr4-shoes).

For best results, please:

- Install Composer (available at [https://getcomposer.org/](https://getcomposer.org/))
- Clone the Repository
- Install Silex and Twig via Composer
- Port the Provided "To Do" Database to Your MySQL Provider
- Launch Project in Server Mode

## Specifications

*As a user, I want to create, read, update, and list stores so I can keep track of stores that carry shoes.*

__Input__: "Target"

__Output__: "Target"

#### Specification 2 ####
*As a user, I want to enter brands of shoes.*

__Input__: "Doc Martens"

__Output__: "Doc Martens"

#### Specification 3 ####
*As a user, I want to assign brands to stores that carry them, so that I know which stores carry which brands and at which store I can find the brand I'm looking for.*

__Input 1__: "Doc Martens"

__Input 2__: "Adidias"

__Input 3__: "Target"

__Input 4__: "Fred Meyer"

__Output__: "Doc Martens and Adidas are at Target and Fred Meyer"

## Database Code

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

## Author/s
J. Ryan Conklin

##License
This work can be used under the MIT License.
Copyright (c) 2016 J. Ryan Conklin
