<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::create([
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'description' => 'A story of wealth and tragedy.',
            'price' => 9.99,
            'category' => 'Fiction',
        ]);
        Book::create([
            'title' => 'Sapiens',
            'author' => 'Yuval Noah Harari',
            'description' => 'A history of humankind.',
            'price' => 14.99,
            'category' => 'Non-Fiction',
        ]);
        Book::create([
            'title' => '1984',
            'author' => 'George Orwell',
            'description' => 'A dystopian novel.',
            'price' => 12.50,
            'category' => 'Fiction',
        ]);
    }
}