# Ecommerce Website (Laravel + Vue.js)

## Description

####  This project is inspired with SHEIN ecommerce website. Customer can browse product specification and add them in their cart. Customer can also proceed to checkout to check products on their cart. This project was built to practice my skills in Laravel + Vuejs stack.

#### Admin panel frontend repository: https://github.com/cur1ousFranz/ecommerce_admin_panel

# Getting Started

## Installation

#### Clone the repository

```
git clone https://github.com/cur1ousFranz/ecommerce.git
```
#### Navigate to Laravel main directory

```
cd ecommerce
```
#### Install required dependencies

```
composer install
```

#### Copy the example env file and make the required configuration changes in the .env file

```
cp .env.example .env
```

#### Generate a new application key

```
php artisan key:generate
```

#### Run the database migrations (Set the database connection in .env before migrating)

```
php artisan migrate
```

#### Start laravel local development server.

```
php artisan serve
```

#### You may now access the Laravel server at http://127.0.0.1:8000

### Database seeding

#### Populate the database with seed data with relationship that includes category and attributes. This can help you to test the API and start creating categorized products.

#### Run the database seeder and you're done.

```
php artisan db:seed
```

#### ***Note:*** It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

```
php artisan migrate:fresh --seed
```

## Next is running the local development of Vuejs frontend.

#### *Open New Terminal:* Navigate to Vuejs directory inside the Laravel main directory

```
cd vue
```

#### Install required dependencies

```
npm install
```

### Start local development server.

```
npm run dev
```

#### You can now access the server at http://localhost:5173 that communicates in Laravel backend at server http://127.0.0.1:8000


## Features

* Customer Registration, Update Profile Information (CRUD).
* SMS Verification (API).
* Email Verification (gmail smtp) for change password.
* Display different products with different categories.
* Customer can add products on cart, update cart's product as well as delete cart's product (CRUD).
* Sorting product by differenct category combination.
* Create, read, update and delete product (CRUD).
