# Installation

Ceate a database and configure the `example.env` file accordingly. Rename it to just `.env` when you are done.

Then, install the dependencies by running

    composer install

After that, you can migrate the database with

    php artisan migrate

To be able to upload to the storage folder, you also need to add a symlink to the public folder by running

    php artisan storage:link


Then, you can run the database seeder with

    php artisan db:seed

# Usage

The seeder will create two users, one with `admin` and the other with `user` role. You can start the application by running

    php artisan serve --no-reload

After that, you can log in and start using the app in your browser.

### Admin credentials:

**E-mail:** admin@example.com

**Password:** admin

### User credentials:

**E-mail:** user@example.com

**Password:** user
