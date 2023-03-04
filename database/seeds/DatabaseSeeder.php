<?php
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        // $this->call(UsersTableSeeder::class);
        // DB::table('articles')->insert([
        //     'nickname' => Str::random(10),
        //     'email' => Str::random(10).'@gmail.com',
        //     'password' => Hash::make('password'), 
        // ]);
        // // 複数のテストデータの作り方わからない。
        factory(User::class, 3)->create();
        factory(User::class, 50)->create()->each(function ($articles) {
            $articles->posts()->save(factory(User::class)->make());
        });
    }

 }  
  

