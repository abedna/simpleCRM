#SimpleCRM


## How to Install
1. Clone the project `git clone https://alksndr2@bitbucket.org/alksndr2/laravel.git`
2. Go to the application folder using cd command on your cmd or terminal `$ cd test`
3. Run `$ composer install` on your cmd or terminal 
4. Create database on MySQL
4. Copy .env.example file to .env on the root folder. 
You can type `$ copy .env.example .env` if using command prompt Windows 
or `$ cp .env.example .env` if using terminal, Ubuntu
5. Open your .env file and update database credentials. 
6. Run `$ php artisan key:generate`
7. Run `$ php artisan migrate --seed`
8. Run `$ php artisan serve`
9. Go to localhost:8000
10. Login with email `admin@admin.com` and password `password`

##Features

- manage Companies
    - add new
    - list all
    - update
    - remove
    
- manage Employees
    - add new employees to the company
    - list all employees assigned to the company
    - update 
    - remove
    
