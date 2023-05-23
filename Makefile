build:
	composer install
	cd ./web/app/themes/ipcasacaiada; composer install; yarn run build

start: run
run:
	docker compose up -d
	php -S 127.0.0.1:8000 -t web -d display_errors=1 -d upload_max_filesize=10M

stop:
	docker compose down

dev:
	cd ./web/app/themes/ipcasacaiada; yarn run dev
