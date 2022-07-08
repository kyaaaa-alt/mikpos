# MIKPOS

MIKPOS is a management users and payments that can be used in HotSpot and PPP MikroTik RouterOS users.
(RouterOS API Based, NOT RADIUS!)

## Donate
QRIS & VIRTUAL ACCOUNT (Indonesia Only)

[!["Buy Me A Coffee"](https://nauf.space/orange_img.webp)](https://nauf.space/donate)

### Discuss on Discord

[https://discord.gg/hRqhzX2J4u](https://discord.gg/hRqhzX2J4u)

### FRONTEND

#### CSS

1. [Bootstrap v5](https://getbootstrap.com/) - CSS Framework
2. [FontAwesome 4](https://fontawesome.com/v4/icons/) - The complete set of 675 icons.

#### JS

1. [Jquery v3.3.6](https://jquery.com/) - Designed to simplify HTML DOM tree traversal and manipulation
2. [Sticky JS](http://stickyjs.com/) - jQuery plugin that gives you the ability to make any element on your page always stay visible.
3. [SweetAlert2](https://sweetalert2.github.io/) - A beautiful, responsive, customizable JavaScript Alert

#### Other Plugins

1. [Datatables](https://datatables.net/) - Advanced interaction controls to your HTML tables the free & easy way

### BACKEND PACKAGES

* [CodeIgniter 4](https://www.codeigniter.com/) - The small framework with powerful features
* [evilfreelancer/routeros-api-php](https://github.com/EvilFreelancer/routeros-api-php) - RouterOS API Client.

## Minimum Requirements
1. [PHP]
* `php` >=7.2|7.4	
* `ext-intl`
* `ext-sockets`
* `ext-php_openssl`
* `ext-json` (enabled by default - don't turn it off)
* `ext-mysqlnd`
* `ext-libcurl`
* `ext-mbstring`
* `ext-xml` (enabled by default - don't turn it off)

2. [MySQL]
* MySQL via the MySQLi driver (version 5.1 and above only)

## Setup
Create database 'mikposdb' without quote, then
Copy `.env.examples` to `.env` and set the database settings.
Uncomment '#' and set database line settings below :

```env
database.default.hostname = localhost
database.default.database = mikposdb
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

## Installation 

1. `composer install`
2. `php spark migrate`
3. `php spark db:seed UsersSeeder`
4. Run the project with `php spark serve`
5. Open `http://localhost:8080` on the browser

## Default Dashboard Credential

Username : `admin`
Password : `admin`

## Important

**Please** don't expose your `.env` file in GitHub repositories or public. This will bring an unexpected consequences for your project.

