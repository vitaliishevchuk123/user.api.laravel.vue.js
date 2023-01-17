<h1 align="center" style="color:cornflowerblue;">User Api</h1>
<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200"></p>

## About the project

- __Implemented simple REST API server (1 POST and 2 GET requests)__
    - _Implemented a demo data generator for the initial filling of the database with data (45
users)._
    - _Displaying a list of users with a “Show more” button, output 6 users per page._
    - _Made possibility to create new user form. No validation is on the front-end part, all validations
are done only on the server side._

## How to use

- Clone the repository with git clone
- Copy .env.example file to .env and edit database credentials there
- To install project run the following commands:
```bash
composer install
php artisan key:generate
php artisan storage:link
php artisan migrate
```
- To create demo users and positions:
```bash
php artisan create:demo-data
```

```bash
npm install
npm run dev
```

- That's it: launch the main URL

***

