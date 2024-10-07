<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## App Laravel 10 + breeze/Inertia/vue3

## Installation

```bash
git clone https://github.com/byZhetta/webapp-laravel10-breezevue.git
cd webapp-laravel10-breezevue
composer install
npm install
php artisan key:generate # key 
```

### Migration

After creating a database and placing it in the `.env` file, in the DB_DATABASE section, proceed with the migrations.

```bash
php artisan migrate
```

### Run app

```bash
php artisan serv # run server
npm run dev # run styles vite
```

## Technologies

- Laravel v10.10
- vite v5.0
- tailwindcss v3.2.1
- vue v3.4.0