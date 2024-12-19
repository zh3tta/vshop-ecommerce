# Ecommerce Web App

Modern and highly functional e-commerce SPA project, designed to deliver a smooth and intuitive user experience for both customers and administrators. It was developed using Laravel, Vue.js and Inertia.js. Includes product management, shopping cart and payments with stripe, admin panel and authentication.

## Screenshots

|Main screen|Products|
|:----------------:|:-------:|
|![image1](https://i.ibb.co/64hjb84/main-screen.jpg)|![image2](https://i.ibb.co/dPrs48Y/products-view.jpg)| 

|Description|Dashboard|
|:---------:|:-------:|
|![image3](https://i.ibb.co/1GbSsXc/product-detail.jpg)|![image4](https://i.ibb.co/j66YcSj/dashboard-products.jpg)|  

## Installation

```bash
git clone https://github.com/zh3tta/vshop-ecommerce.git
cd vshop-ecommerce
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