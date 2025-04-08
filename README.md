# Momentum Solutions Technical Assessment

## Introduction
This is a Laravel project that provides a simple API for managing posts using the `Sanctum` authentication mechanism. The API supports CRUD operations for posts, along with validation and authorization.

## Requirements
- PHP 8.0 or higher
- Composer
- Laravel 8 or higher
- MySQL or any other database
- Node.js (for Frontend-related commands, if needed)

## Installation Steps

### 1. **Clone the Repository**
First, clone this repository to your local machine using Git:

git clone https://github.com/midoasmer/Momentum-Solutions-Technical-Assessment.git


### 2. Navigate to the Project Directory


### 3. Install Dependencies
Make sure you have Composer installed on your machine. Then, run the following command to install all the required dependencies:

composer install


### 4. Set Up Environment
Copy the example environment file to .env Then, modify the database settings in the .env file to match your local environment, for example:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password


### 5. Generate Application Key
Ensure that your application key is generated:

php artisan key:generate


### 6. Run Database Migrations
If there are any database migrations, run the following command to apply them:

php artisan migrate


### 7. Run the Local Development Server
To start the local development server, use the following command:

php artisan serve


### 9. API Setup
After setting up the project and running it, you can begin using the API to perform CRUD operations on posts. Tools like Postman can be used to test the API endpoints.

