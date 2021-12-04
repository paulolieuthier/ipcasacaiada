setup:
	cd theme; composer install
	cd theme; npm run build

run:
	docker-compose up -d --build

stop:
	docker-compose down

dev:
	cd theme; npm run dev
