<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Controllers\HumController;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name'      => 'Test User',
            'username'  => 'testuser',
            'bio'       => 'I like this app!',
            'email' => 'test@example.com',
        ]);

        \App\Models\Hum::factory(1)->create([
            'user_id'   => '1',
            'hum'       => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam consequatur molestiae non delectus itaque atque dolores eum suscipit ad assumenda ipsum, nemo id. Dolor, dicta commodi debitis deleniti omnis id perspiciatis rem fugiat, aut, totam unde sunt dignissimos. Sed odio consequuntur inventore maxime explicabo cumque, obcaecati iste quis praesentium sit!',
            'replies'   => '1',
            'rehums'    => '5',
            'likes'     => '10'
        ]);
    }
}
