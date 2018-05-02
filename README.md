Fahrkartentool
==============

Crowdsourcing-Tool for the historical tickets collection of the German Museum of Technology (Deutsches Technikmuseum). Written in Laravel and Vue.js.

Tool for automated ticket recognition: https://github.com/finnp/fahrkarten-technikmuseum

Installation instructions
-------------------------

- Clone repository
- Install dependencies: composer install
- Create local environment file: cp ./.env.example ./.env
- Update .env with your local configuration. A default admin user can be seeded by filling in the fields prefixed with ADMIN_
- Create app encryption key: php artisan key:generate
- Run migrations and seeders: php artisan migrate --seed

Artisan commands
----------------

- Scan public/img/tickets folder for new tickets: php artisan tickets: scan
- Generate thumbnails: php artisan tickets:thumbs