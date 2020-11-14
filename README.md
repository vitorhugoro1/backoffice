# Simple Announcement System

This project has proposal of improve my personal knowledgement about Laravel Jetstream, Laravel Livewire and some Test techniques.

## Requirements

To run this project will need the follow items installed on machine:

- PHP 7.4 (with all [Laravel Requirements](https://laravel.com/docs/8.x/installation#server-requirements) installed)
- Postgres (has an simple setup on docker compose file)

After install all this items, will need run the next commands:

```bash
cp .env.example .env
## Change the .env Database connections to use of preference
php artisan migrate
php artisan serve
## Or use Laravel Valet or Homestead
```

## Running Tests

Use the follow commands to run testsuites:

```bash
php artisan test
php artisan dusk
```
