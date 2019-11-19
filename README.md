TaskManager (mini)
==========

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer create-project jakharbek/mvc-framework
```


Docker
-----

Для начало вам нужно скопировать файл .env.example и переименовать в .env

Потом запольнить всё как вам нужно для работе после вы можете запустить docker-compose

```php
docker-compose up -d
```

Gitlab CI
-----

Для работы с Gitlab CI вам нужно заполнить все переменные среды в гитлаб. Пример в файле .env.gitlab.example


App
------
php.ini
```php
session.gc_maxlifetime=3600
```
lets run project

```bash
cp .env.example .env
docker-compose up -d
docker-compose exec app bash
cd application
cp .env.example .env
vendor/bin/doctrine orm:schema-tool:update --force
php console/seeds/initAdmin.php
```