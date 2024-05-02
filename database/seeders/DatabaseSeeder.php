<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Message;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true
        ]);

        User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),

        ]);

        User::factory(10)->create();

        for($i = 0; $i < 5; $i++) {
            $group = Group::factory()->create([
                'owner_id' => 1
            ]);

            $user = User::inRandomOrder()->limit(rand(2,3))->pluck('id')->toArray();
            $group->users()->attach(array_unique([1,...$user]));
        }

        Message::factory(1000)->create();
        $messages = Message::whereNull('group_id')->orderBy('created_at', 'desc')->get();


    }
}
