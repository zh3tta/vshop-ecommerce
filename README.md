## vshop-webapp

## Installation

```bash
git clone https://github.com/zhetta/vshop-webapp.git
cd vshop-webapp
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