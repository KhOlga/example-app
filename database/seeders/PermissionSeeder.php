<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
			[
				'name' => 'Read list',
				'slug' => 'read_list',
				'description' => 'Here will be permission description.'
			],
			[
				'name' => 'Create',
				'slug' => 'create',
				'description' => 'Here will be permission description.'
			],
			[
				'name' => 'Edit',
				'slug' => 'edit',
				'description' => 'Here will be permission description.'
			],
			[
				'name' => 'Read',
				'slug' => 'read',
				'description' => 'Here will be permission description.'
			],
			[
				'name' => 'Delete',
				'slug' => 'delete',
				'description' => 'Here will be permission description.'
			],
			[
				'name' => 'Soft delete',
				'slug' => 'soft_delete',
				'description' => 'Here will be permission description.'
			],
			[
				'name' => 'Restore',
				'slug' => 'restore',
				'description' => 'Here will be permission description.'
			],
		];

		foreach($permissions as $permission) {
			Permission::create([
			   'name' => $permission['name'],
			   'slug' => $permission['slug'],
			   'description' => $permission['description']
			]);
		}
    }
}
