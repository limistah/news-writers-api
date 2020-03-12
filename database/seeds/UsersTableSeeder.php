<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create()->each(function (App\User $author) {
            $posts = factory(App\Article::class, 10)
                ->create([
                    'author_id' => $author->id,
                    'author_name' => $author->name,
                ]);
        });;
    }
}
