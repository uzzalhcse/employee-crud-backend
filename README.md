# Laravel Employee Crud App

A simple crud App with Laravel 7.2

## Installation

Clone the repository-
```
git clone https://github.com/uzzalhcse/employee-crud-backend.git
```

Then cd into the folder with this command-
```
cd employee-crud-backend
```

Then do a composer install
```
composer install
```

Then create a environment file using this command-
```
cp .env.example .env
```

Then edit `.env` file with appropriate credential for your database server. Just edit these two parameter(`DB_USERNAME`, `DB_PASSWORD`).

Then create a database named like `employee_crud` and then do a database migration using this command-
```
php artisan migrate
```

## Seed Dummy Data

Run server using this command-
```
php artisan db:seed
```

Then go to `http://localhost/employee-crud-backend` from your browser and see the app.

