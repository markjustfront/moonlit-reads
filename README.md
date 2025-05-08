moonlit-reads/
├── app/
│   ├── Http/
│   │   ├── Controllers/
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
│   │   │   ├── create.blade.php
│   │   │   ├── edit.blade.php
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