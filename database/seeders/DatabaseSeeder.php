<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Category;
use App\Models\Bookshelf;
use App\Models\Book;
use App\Models\Loan;
use App\Models\LoanDetail;
use App\Models\ReturnModel;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // USER UTAMA
        \App\Models\User::create([
            'npm' => 5520123047,
            'username' => 'hanna23',
            'first_name' => 'Hanna',
            'last_name' => 'Sabatina',
            'email' => 'hanna@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // USER TAMBAHAN
        for ($i = 0; $i < 50; $i++) {
            \App\Models\User::create([
                'npm' => (int) $faker->unique()->numerify('55201########'),
                'username' => $faker->userName,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
            ]);
        }

        // CATEGORY
        for ($i = 0; $i < 10; $i++) {
            \App\Models\Category::create([
                'category' => $faker->word
            ]);
        }

        // BOOKSHELF
        for ($i = 0; $i < 10; $i++) {
            \App\Models\Bookshelf::create([
                'code' => strtoupper($faker->bothify('BS###')),
                'name' => 'Rak ' . $faker->word
            ]);
        }

        // BOOKS
        for ($i = 0; $i < 50; $i++) {
            try {
                \App\Models\Book::create([
                    'title' => $faker->sentence,
                    'author' => $faker->name,
                    'year' => $faker->year,
                    'publisher' => $faker->company,
                    'city' => $faker->city,
                    'cover' => null,
                    'bookshelf_id' => rand(1,10),
                    'category_id' => rand(1,10),
                ]);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }

        // LOANS
        for ($i = 0; $i < 50; $i++) {
            \App\Models\Loan::create([
                'user_npm' => \App\Models\User::inRandomOrder()->first()->npm,
                'loan_at' => now(),
                'return_at' => now()->addDays(rand(3,10)),
            ]);
        }

        // LOAN DETAIL
        for ($i = 0; $i < 50; $i++) {
            \App\Models\LoanDetail::create([
                'loan_id' => rand(1,50),
                'book_id' => rand(1,50),
                'is_return' => $faker->boolean
            ]);
        }

        // RETURNS
        for ($i = 0; $i < 50; $i++) {
            \App\Models\ReturnModel::create([
                'loan_detail_id' => rand(1,50),
                'charge' => $faker->boolean,
                'amount' => $faker->numberBetween(1000,10000),
            ]);
        }
    }
}