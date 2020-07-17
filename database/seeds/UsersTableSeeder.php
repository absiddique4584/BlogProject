<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->defaultUser();
        $faker = Faker\Factory::create();

        foreach (range(1,20) as $index){
            User::create([
                'name' => $faker->name,
                'email' =>  $faker->unique()->email,
                'password' => bcrypt($faker->password),
                'image' => $faker->imageUrl(),
            ]);
        }
    }
    public function defaultUser(){
        User::create([
            'name' => 'Admin',
            'email' => 'blog@blog.com',
            'password' => bcrypt('12345678'),
            'image' => '955471442_20200324083532_421624165.jpg',
        ]);
    }
}
