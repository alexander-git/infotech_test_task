make init:
	cp .env.example .env
	cp ./src/protected/.env.example ./src/protected/.env
	docker-compose up -d
	docker exec -t php-fpm  sh -c "cd protected && composer install"
	docker exec -t php-fpm  sh -c "protected/yiic migrate up --interactive=0"

up:
	docker compose up -d

down:
	docker compose down

stop:
	docker compose stop

php-sh:
	docker exec -it php-fpm sh

restart:
	docker-compose down
	docker-compose up -d

recreate:
	docker-compose down
	docker-compose build
	docker-compose up -d

migrate:
	docker exec -t php-fpm  sh -c "protected/yiic migrate up --interactive=0"