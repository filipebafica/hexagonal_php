all:

build:
	docker compose build

up:
	docker compose up -d

down:
	docker compose down

run: up
	docker exec -it laravel bash -c "composer install"
	docker exec -it laravel php artisan serve --host=0.0.0.0

clean:
	docker rmi $$(docker images -q)

permission:
	sudo chmod -R 777 app/storage/
	sudo chmod -R 777 app/.phpunit.result.cache