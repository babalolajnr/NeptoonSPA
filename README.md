# NeptoonSPA

NeptoonSPA is a content management system created using Laravel/PHP backend and VueJS as a frontend framework.


## Installation

1. Clone the project
```cmd
git clone https://github.com/babalolajnr/NeptoonSPA.git
```

2. Go into the project folder
```cmd
cd NeptoonSPA
```

3. Install Composer Dependencies
```cmd
composer install
```

4. Install NPM Dependencies
```cmd
npm install
```

5. Create a .env file by creating a copy of the .env.example file
```cmd
cp .env.example .env
```

6. Generate app encryption key
```cmd
php artisan key:generate
```

8. Create a database for the application

9. Fill the required connection credentials in the .env file

10. Migrate the database 
```cmd
php artisan migrate
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
