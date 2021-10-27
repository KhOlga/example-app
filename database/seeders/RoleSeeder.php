<?php

namespace Database\Seeders;

use App\Models\Role;
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
		$roles = [
			[
				'name' => 'Super Admin',
				'slug' => 'super_admin',
			],
			[
				'name' => 'Admin',
				'slug' => 'admin',
			],
			[
				'name' => 'Manager',
				'slug' => 'manager',
			],
			[
				'name' => 'Supervisor',
				'slug' => 'supervisor',
			],
			[
				'name' => 'Promoter',
				'slug' => 'promoter',
			],
			[
				'name' => 'Customer',
				'slug' => 'customer',
			],
			[
				'name' => 'Employee',
				'slug' => 'employee',
			],
		];

		foreach($roles as $role) {
			Role::create([
				'name' => $role['name'],
				'slug' => $role['slug'],
			]);
		}
    }
}
