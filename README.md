## Start project

Для запуска на локальной среде:

- composer install
- перименовать .env.example в .env
- установить alias sail для bash (alias sail='bash vendor/bin/sail')
- выволнить команду (sail up -d)
- установить ключ приложения (sail artisan key:generate)
- запустить миграции (sail artisan migrate)
- **[Перейти по адресу](http://localhost/register)**
