# Platform
###### Version: 2024.12.22.4

Platform is a multisite and multilingual compatibility Management System based on Symfony PHP Framework. It's ideal for managing and growing any organization. Free and open-source and always will be.

---

## How to install?

- Clone source code from GitHub
- Copy `.env.dist` to `.env` and modify.
- Run `composer install` command
- Create database with `php bin/console doctrine:database:create` command
- Migrate database with `php bin/console doctrine:migrations:migrate` command
- Update Composer dependencies with `composer update` command
- Update NPM dependencies with `npm install` command
- Build assets with `npm run build` command
- Update Webpack Encore with `npm run encore production` command

---

## Documentation

## Ops Book

### How to update or deploy?

One line command to update:

```bash
git status;
git pull;
php bin/console doctrine:migrations:migrate;
composer update;
composer dump-autoload -o;
php bin/console cache:clear;
```

### Developer Book

Platform based on:

- latest Symfony PHP Framework (https://symfony.com)
- latest Twig template engine (https://twig.symfony.com/)
- latest Bootstrap (https://getbootstrap.com)
- latest chart.js (https://www.chartjs.org/)

---

## Copyright

Platform made with 💚 in Hungary by Gergő Harkály (https://www.harkalygergo.hu).
