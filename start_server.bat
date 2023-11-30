@echo off
@REM Directory of Laravel project
cd /d F:\project-laravel\Dashboard\ams_project

@REM Run database migrations
php artisan migrate

@REM Run user data into table
php artisan db:seed --class=UsersTableSeeder

cd /d F:\project-laravel\Dashboard\ams_project\public

rmdir storage

y

cd ..

@REM Set directory of image become public
php artisan storage:link

@REM Running server
php artisan serve --port=8002