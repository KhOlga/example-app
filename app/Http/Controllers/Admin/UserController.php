<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function index()
	{
		$columns = [
			'ID',
			'First name',
			'Last name',
			'Nickname',
			'E-mail',
			'Roles',
			'Teams',
			'Creation date',
			'Updated at'
		];

		return view('admin.layouts.table', [
			'table' => [
				'id' => 'users',
				'columns' => $columns,
				'title' => 'Users info',
			]
		]);
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse|mixed
	 * @throws \Exception
	 */
	public function data()
	{
		$data = User::selectRaw("users.*")
			->whereNotNull('email')
			->with('roles', 'teams');

		return datatables($data)
			->addColumn('roles', function ($row) {
				return $row->roles->map(function ($item) {
					return $item->name;
				})->implode(', ');
			})
			->addColumn('teams', function ($row) {
				return $row->teams->map(function ($item) {
					return $item->name;
				})->implode(', ');
			})
			->addColumn('created_at', function (User $user) {
				return $user->created_at->format('Y-m-d H:i:s');
			})
			->orderColumns(['nickname', 'created_at'], '-:column $1')
			->make();
	}
}
