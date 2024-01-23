build:
	@docker-compose up -d --build
	@docker-compose exec -T app composer install -n
	@ echo "\n$(green)Dependencies are build$(no_color)\n\n"

up:
	@ docker-compose up -d
	@ echo "\n$(green)Dependencies are up$(no_color)\n\n"

down:
	@ docker-compose down

bash:
	@docker-compose exec app bash

test:
	@docker-compose exec -T app php ./vendor/bin/phpunit --coverage-text

test-coverage:
	@docker-compose exec -T app php ./vendor/bin/phpunit --coverage-html coverage

infection:
	@docker-compose exec -T app composer run-script infection

