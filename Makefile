up:
	docker compose up -d

down:
	docker compose down

exec:
	docker compose exec php sh

install:
	docker compose exec php sh -c "composer install"

update:
	docker compose exec php sh -c "composer update"

test:
	docker compose exec php sh -c "./vendor/phpunit/phpunit/phpunit ./tests/."