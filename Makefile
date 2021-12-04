setup:
	cd theme; composer install
	cd theme; npm run build

start: run
run:
	docker-compose up -d --build

stop:
	docker-compose down

dev:
	cd theme; npm run dev

build:
	cd theme; npm run build
