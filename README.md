# Laravel Hotel Management System

A comprehensive system for managing hotel operations built with Laravel.

## Overview

This system allows hotel administrators to manage bookings, guest information, room availability, and more rubost features.

## Features

- User management (admin, clients, guests)
- Room booking and availability management
- Reporting and notifications
- AI services 
- Dockerization (docker img availability)

## Requirements

- PHP 8.2+
- Laravel 10.x +
- MySQL 5.7+
- Docker 4.28+
- composer


## Installation
Again make sure that you have setup the environment properly. You will need minimum PHP 8.2, MySQL/MariaDB, and composer.

### clone the repo

```bash
git clone https://github.com/ali-workshop/Diploma_Project_Backup.git

```
```bash
 cd Diploma_Project_Backup
```


### Create a copy of  .env file
Copy .env.example into .env and configure  database credentials

```bash
cp .env.example .env

```  
### Install composer dependencies

```bash
composer install

```

### Set the application key by running 
```bash
php artisan key:generate --ansi

```

### Run migrations 
```bash
php artisan migrate
```

### Start local server by executing 
```bash
php artisan serve
```
### test our application

## Visit here http://127.0.0.1:8000/ to test the application

## Installation with Docker (Bonus)
### Duplicate the .env.example file and rename it to .env
```bash
cp .env.example .env

``` 
### Change the DB host on .env file.
```bash
DB_HOST=db
``` 

### Change the password on .env file.
```bash
DB_PASSWORD=rootpassword
``` 

### Start Docker desktop engin as administrator.

### run the container

```bash
docker-compose up -d --build

``` 
### run the migrations
```bash
docker-compose exec web php artisan migrate

``` 
## Done! See http://localhost:8000
## Usage

- Access admin panel at `/login`.
- Use sample credentials: username `admin@gmail.com`, password `12345678`.
- Explore our project.





## Documentation
###  Documentation avaliable via post man

[click to post man collection ](https://app.getpostman.com/join-team?invite_code=2d46deb60eb5c997b73410879f1c5ab5)

## Contributing

Contributions are welcome! .

## Contributors

- Tuka ([GitHub](https://github.com/TukaHeba))
- Noura ([GitHub](https://github.com/Noura-H-Mahmoud))
- Mona ([GitHub](https://github.com/mona-alrayes))
- Reem ([GitHub](https://github.com/ReemAhmad-dot))

- Khatoon ([GitHub](https://github.com/KhatoonBadrea))


- Ali ([GitHub](https://github.com/ali-workshop))
## Used By

This project is used by the following companies:

- Focal-X- 



## Optimizations

Build the system with more features 💪🏻
