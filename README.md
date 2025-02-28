## Requirements
| Requirement | Version   |
|-------------|-----------|
| PHP         |   8.1.10  |
| Mysql       |   8.0.30  |

## Installation
Make sure all requirements are installed on the system.
Clone the project and install dependencies:
```bash
$ git clone https://github.com/wisnuuakbr/hashmicro.git
$ cd hashmicro
```

## Configuration
Copy the .env.example file and rename it to .env  
Change the config for your local server
```bash
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

## Generate App Key
Generate the application key using the following command:
```bash
$ php artisan key:generate
```

## Migration & Seeder
Run the migrations table:
```bash
$ php artisan migrate
```
Run the seeder:
```bash
$ php artisan db:seed
```

## Run Application
Run the application:
```bash
$ php artisan serve
```

## Account Info
You can create new or using this default account
```bash
usermail : wisnu@test.com
password : password
```
