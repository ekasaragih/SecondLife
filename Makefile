# Makefile Setup for SecondLife

# Rule to install :
# 1. Dependencies using Composer
# 2. Copy .env.example to .env
# 4. Setup database environment
# 5. Generate application key
# 6. Migrate the database fresh

setup:
	composer install
	cp .env.example .env
	sed -i '' 's/^DB_DATABASE=.*/DB_DATABASE=bnp-laravel/' .env
	sed -i '' 's/^DB_PORT=.*/DB_PORT=3306/' .env
	php artisan key:generate
	php artisan migrate:fresh
	php artisan db:seed --class=RoleSeeder
	php artisan db:seed --class=UserSeeder

refresh:
	php artisan migrate:fresh
	php artisan db:seed --class=RoleSeeder
	php artisan db:seed --class=UserSeeder