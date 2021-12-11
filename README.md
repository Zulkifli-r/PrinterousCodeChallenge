# Printerous Code Challenge

## Installation
```sh
git clone git@github.com:Zulkifli-r/PrinterousCodeChallenge.git
cd PrinterousCodeChallenge
composer install
```
update `.env` file according to your environment, then run :
```sh
php artisan migrate
php artisan db:seed // to seed admin user
php artisan storage:link // to link storage with public directory
php artisan serve // to serve the app at https://localhost:8000 (default)
```
if images not working, please make sure your `APP_URL` in `.env` is match with your current url

## Testing
You can run the test with:
```sh
php artisan test
``` 

