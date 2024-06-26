# Geotagging Admin and API Project

This project is a Laravel-based web application designed for administering and providing API support for a geotagging mobile application.

## Installation

To get this project up and running on your local machine, follow these steps:

1. **Create `.env` file**

   Copy the `.env.example` file to a new file named `.env`:
   ```sh
   cp .env.example .env

2. **Install Composer Dependencies**

   Install the PHP dependencies using Composer:
   ```sh
   composer install

3. **Install NPM Dependencies**

   Install the Node.js dependencies using NPM:
   ```sh
   npm install

4. **Compile Assets**

   Compile the frontend assets using Laravel Mix:
   ```sh
   npm run dev

5. **Run Database Migrations**

   Set up the database schema by running the migrations:
   ```sh
   php artisan migrate

6. **Seed the Database**

   Populate the database with initial data:
   ```sh
   php artisan db:seed


## Admin User

You can log in to the admin interface using the following credentials:

Email: admin@unmul.com
Password: 123456

