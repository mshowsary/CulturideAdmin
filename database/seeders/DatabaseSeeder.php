<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            //FRONT
            CitiesTableSeeder::class,
            CategoriesTableSeeder::class,
            ArtistTableSeeder::class,
            SliderTableSeeder::class,
            EventTableSeeder::class,
        ]);
    }
}
