<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
	public function index()
	{
		$columns = [
			'ID',
			'Name',
			'Slug',
		];

		return view('admin.layouts.table', [
			'table' => [
				'id' => 'roles',
				'columns' => $columns,
				'title' => 'Roles info',
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
		$data = Role::selectRaw("roles.*");

		return datatables($data)
			->orderColumns(['name', 'slug'], '-:column $1')
			->make();
	}
}
