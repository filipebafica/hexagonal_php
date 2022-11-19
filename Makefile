all:

build:
	docker-compose build

up:
	docker-compose up -d

down:
	docker-compose down

run: up
	docker exec -it laravel php artisan serve

clean:
	docker rmi $$(docker images -q)

permission:
	sudo chmod -R 777 app/storage/