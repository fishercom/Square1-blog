# PHP Laravel Square1 Test
This project is designed to test your knowledge of web technologies and assess your ability to
create robust PHP web applications with attention to software architecture and security.

### Installation
This application is built in [Laravel Framework](https://laravel.com/) v8.0, It requires next components to run properly:
- PHP v7.3+
- Mysql v5.7+
- Apache Server v2.4+

### Files Configuration
1. To deploy the application, clone this repository:

    `$ git clone https://github.com/fishercom/square1-blog`

2. Create th enviroment file .env, or rename .env.example file, then add next parammeters:
    
    API-REST Endpoint

        API_ENDPOINT=https://sq1-api-test.herokuapp.com/posts
    
    Create a database previously, then add connection parameters

        DB_CONNECTION=mysql
        DB_HOST=[SERVER OR LOCALHOST]
        DB_PORT=3306
        DB_DATABASE=[DATABASE NAME]
        DB_USERNAME=[MYSQL USER]
        DB_PASSWORD=[MYSQL PASSWORD]

    Generate the Application Key
    
    `php artisan key:generate`

3. Update dependencies and clean precompiled files and cache

    `$ composer update`

    `$ php artisan optimize`

    `$ php artisan migrate:refresh --seed`

4. Install Laravel Passport

    Laravel Passport Configuration
    
    `$ php artisan passport:install`

    Edit .env file with new client credentials

        PASSPORT_LOGIN_ENDPOINT=http://127.0.0.1:8000/oauth/token
        PASSPORT_CLIENT_ID=2
        PASSPORT_CLIENT_SECRET=[CLIENT CREDENTIAL ENCRYPTED]


4. Run and schedule queues (optional)

    `$ php artisan queue:work`

5. Lauch web server

    `$ php artisan config:clear`

    `$ php artisan serve`
    
    Now you can see it in your browser
    http://127.0.0.1:8000

Yo can check application running in production mode:
[http://square1-test.deepsoft.pe](http://square1-test.deepsoft.pe)

