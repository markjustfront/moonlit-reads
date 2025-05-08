## Project Structure

The Moonlit Reads project is organized to support a Laravel 11 application with Vue.js for dynamic frontend interactions, Axios for API calls, Tailwind CSS for styling, and MySQL via Laravel Sail. The structure is modular for easy modification, with separate controllers for database and non-database operations, and all dependencies are pre-installed or local for offline use.

moonlit-reads/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/ (from laravel/ui)
│   │   │   ├── BookController.php
│   │   │   ├── Crud/
│   │   │   │   └── BookCrudController.php
│   │   ├── Models/
│   │   │   └── Book.php
├── database/
│   ├── migrations/
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2014_10_12_100000_create_password_reset_tokens_table.php
│   │   ├── 2019_08_19_000000_create_failed_jobs_table.php
│   │   ├── 2019_12_14_000001_create_personal_access_tokens_table.php
│   │   └── 2025_05_08_000000_create_books_table.php
│   ├── seeders/
│   │   └── BookSeeder.php
├── public/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   ├── vue.js
│   │   ├── axios.js
│   │   └── app.js
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── views/
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   ├── register.blade.php
│   │   │   └── ...
│   │   ├── books/
│   │   │   ├── index.blade.php
│   │   │   └── show.blade.php
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   └── welcome.blade.php
├── routes/
│   └── web.php
├── .env
├── composer.json
├── docker-compose.yml
├── package.json
├── tailwind.config.js
