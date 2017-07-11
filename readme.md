# Crossover - Event Test
System for reserve stands in events showed in a map

## Requirements
1. PHP 5.6+
2. Apache 2.4
3. Composer 
4. nodejs, npm
5. Bower

## Deployment
1. Deploy DB
Create DB and import DB from /database/scripts/dump.sql and configure access in .env file in root directory app.

2. Configure mailing
Configure your SMT config in .env, by default it configured with mailgun:
```
MAIL_DRIVER=mailgun
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_NAME=
MAIL_USER=
MAIL_PASS=
MAIL_ADDRESS=
MAIL_ADMIN=

MAILGUN_DOMAIN=
MAILGUN_SECRET=
```
*MAIL_ADMIN is the user that receive emails each time new company registrered.

3. Install dependecies and compile css/js
```
composer update
npm install
bower update
gulp --production
```

3. Start queue jobs
Execute this command in root project directory and not close console:
```
php artisan queue:work
```

4. Serve App
For serve app exists two ways:

### 1. Serve with Apache
Follow this steps:

1. Create a virtual host 'events.dev':
```
<VirtualHost *:80>
    DocumentRoot "D:\xampp\htdocs\crossover\public"
    ServerName events.dev
    ErrorLog "logs/events.dev-error.log"
    CustomLog "logs/events.dev-access.log" common
</VirtualHost>
```

2. Add vhost to host file:
```
127.0.0.1         events.dev
```

3. Visit http://events.dev in your browser

### 2. Serve with artisan
1. Ejecute artisan command
```
php artisan serve
```

3. Visit http://localhost:8000 in your browser

## Permissions
If you deploy it in linux, you should be changed permissions on the storage folder:
```
chmod 775 storage -R
```

## Unit test
Run this command in root directory project
```
 ./vendor/bin/phpunit
```

## Live version
[https://events.gozzio.com](https://events.gozzio.com/)

## Contact Us
me@miguelpazo.com