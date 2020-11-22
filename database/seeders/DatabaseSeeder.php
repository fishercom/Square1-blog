<?php

namespace Database\Seeders;

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
        //\App\Models\User::factory(1)->create();

		// Seeding profiles
		$profile_admin = \App\Models\Profile::create(['name' => 'Admin', 'active'=>true, 'is_admin'=>true]);

		// Seeding users
        $user_admin = \App\Models\User::create(['email' => 'fishdev@gmail.com', 'password' => 'admin', 'name' => 'Administrator', 'profile_id' => $profile_admin->id, 'active' => true]);

    }
}
