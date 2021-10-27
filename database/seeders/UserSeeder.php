<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
			[
				'first_name' => 'test_name',
				'last_name' => 'test_user',
				'nickname' => 'su_nick',
				'email' => 'super_admin@example-app.com',
				'password' => Hash::make('password'),
				'role' => 'super_admin',
			],
			[
				'first_name' => 'test_name',
				'last_name' => 'test_user',
				'nickname' => 'a_nick',
				'email' => 'admin@example-app.com',
				'password' => Hash::make('password'),
				'role' => 'admin',
			],
			[
				'first_name' => 'test_name',
				'last_name' => 'test_user',
				'nickname' => 'm_nick',
				'email' => 'manager@example-app.com',
				'password' => Hash::make('password'),
				'role' => 'manager',
			],
			[
				'first_name' => 'test_name',
				'last_name' => 'test_user',
				'nickname' => 's_nick',
				'email' => 'supervisor@example-app.com',
				'password' => Hash::make('password'),
				'role' => 'supervisor',
			],
			[
				'first_name' => 'test_name',
				'last_name' => 'test_user',
				'nickname' => 'p_nick',
				'email' => 'promoter@example-app.com',
				'password' => Hash::make('password'),
				'role' => 'promoter',
			],
			[
				'first_name' => 'test_name',
				'last_name' => 'test_user',
				'nickname' => 'fc_nick',
				'email' => 'first_customer@example-app.com',
				'password' => Hash::make('password'),
				'role' => 'customer',
			],
			[
				'first_name' => 'test_name',
				'last_name' => 'test_user',
				'nickname' => 'sc_nick',
				'email' => 'second_customer@example-app.com',
				'password' => Hash::make('password'),
				'role' => 'customer',
			],
			[
				'first_name' => 'test_name',
				'last_name' => 'test_user',
				'nickname' => 'fe_nick',
				'email' => 'first_employee@example-app.com',
				'password' => Hash::make('password'),
				'role' => 'employee',
			],
			[
				'first_name' => 'test_name',
				'last_name' => 'test_user',
				'nickname' => 'se_nick',
				'email' => 'second_employee@example-app.com',
				'password' => Hash::make('password'),
				'role' => 'employee',
			],
		];

		foreach($users as $item) {
			$user = User::create([
				 'first_name' => $item['first_name'],
				 'last_name' => $item['last_name'],
				 'nickname' => $item['nickname'],
				 'email' =>  $item['email'],
				 'password' => $item['password'],
			]);

			RoleUser::create([
				'user_id' => $user->id,
				'role_id' => Role::where('slug', $item['role'])->first()->id,
			]);
		}
    }
}
