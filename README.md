## Next and Lumen

This app is built with [Next (React)](https://nextjs.org/) and [Lumen (Laravel)](https://lumen.laravel.com/). Please Look at their respective documentation to learn more.

## Prerequisite

- PHP 8.0
- Node 18
- MySQL 5.7

## (Recommended) Usage with Lando

[Lando](https://lando.dev/) is local development environment DevOps tool, built on Docker. The repository includes `.lando.yml` config file and is already pre-scripted.

Assumed Lando is installed, simply run command below.

```
lando start
```

Wait for the build process, and if everything goes well, the apps should be virtually hosted on:
 
- Client App - `http://demo-vascomm-store.lndo.site`.
- Api - `http://api.demo-vascomm-store.lndo.site`.
- PhpMyAdmin - `http://pma.demo-vascomm-store.lndo.site`.
- Swagger - `http://swagger.demo-vascomm-store.lndo.site`.
- Mailhog - `http://mailhog.demo-vascomm-store.lndo.site`.

That's it.

## Usage

### Lumen

Inside `lumen-php` directory, copy `.env.example` to `.env`. Change the content to suit your environments.

```
APP_NAME=Lumen
APP_ENV=local
APP_KEY="pUiuHfeTMAoAsUFkZfuNozWuCaI4LcyL"
APP_DEBUG=true
APP_URL=http://localhost
APP_TIMEZONE=UTC

LOG_CHANNEL=stack
LOG_SLACK_WEBHOOK_URL=

DB_CONNECTION=mysql
DB_HOST=database
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=mysql
DB_PASSWORD=mysql

CACHE_DRIVER=file
QUEUE_CONNECTION=sync

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME="Example app"
```

Then run these commands.

```
composer install
php artisan migrate --seed
php artisan passport:install --force
php -S localhost:8000 -t public
```

The app should be running on `http://localhost:8000`.

Refer to the API at [demo-vascomm-store.openapi.json](https://github.com/hendrijuhanda/demo-vascomm-store/blob/develop/swagger/demo-vascomm-store.openapi.json).

### Lumen

Next, inside `next-nodejs` directory, again copy `.env.example` to `.env` then change the content accordingly. Make sure to match `NEXT_PUBLIC_API_URL` to the host where `lumen` app running.

```
NEXT_PUBLIC_API_URL="http://localhost:8000/api/v1"
NEXT_PUBLIC_IMAGE_DOMAIN="localhost"
```

Then, run these commands.

```
npm install
npm run build
npm run start
```

The app should be running on `http://localhost:3000`.
