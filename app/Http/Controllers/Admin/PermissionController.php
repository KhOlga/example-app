<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
	public function index()
	{
		$columns = [
			'ID',
			'Name',
			'Slug',
			'Description'
		];

		return view('admin.layouts.table', [
			'table' => [
				'id' => 'permissions',
				'columns' => $columns,
				'title' => 'Permissions info',
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
		$data = Permission::selectRaw("permissions.*");

		return datatables($data)
			->orderColumns(['name', 'slug'], '-:column $1')
			->make();
	}
}
