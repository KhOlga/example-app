<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use DataTables;


class RoleController extends Controller
{
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function data(Request $request)
	{
		if ($request->ajax()) {
			$data = Role::latest()->get();
			return Datatables::of($data)
				->addIndexColumn()
				->addColumn('action', function($row){
					$actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
					return $actionBtn;
				})
				->rawColumns(['action'])
				->make(true);
		}
	}
}
