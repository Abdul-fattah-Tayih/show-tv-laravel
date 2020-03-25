<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'user'];

        foreach($roles as $key => $role) {
            \App\Role::updateOrCreate(['id' => $key + 1], [
                'name' => $role,
                'slug' => $role
            ]);
        }
    }
}
