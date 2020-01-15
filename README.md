# Scratch PHP Framework

[パーフェクトPHP](https://www.amazon.co.jp/%E3%83%91%E3%83%BC%E3%83%95%E3%82%A7%E3%82%AF%E3%83%88PHP-%E5%B0%8F%E5%B7%9D%E9%9B%84%E5%A4%A7-ebook/dp/B00P0UDWQY) のフレームワークをベースにPHPで色々試す

- Composer
- Dotenv
- Phpmig

## Setup

```bash
$ docker-compose up -d --build
```

- PHP 7.0
- Composer
- MySQL 5.7

```bash
$ docker exec -it PHP_CONTAINER_NAME /bin/bash
% cd /var/www
% composer install
```

## Database migration

### Setup

```bash
$ docker exec -it MYSQL_CONTAINER_NAME bash
% mysql -u root -p
mysql> CREATE DATABASE online_bbs
```

```bash
$ vendor/bin/phpmig migrate
```

### Create Migration File

```bash
$ vendor/bin/phpmig generate MIGRATION_NAME
```
