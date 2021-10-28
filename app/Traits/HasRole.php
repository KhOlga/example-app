<?php

namespace App\Traits;

use App\Models\User;

trait HasRole
{
	public static function isSuperAdmin(string $email): bool
	{
		if ($user = User::where('email', $email)->first()) {
			foreach ($user->roles as $role) {
				if ($role->slug === 'super_admin' | $role->slug === 'admin') {
					return true;
				}
				return false;
			}
		}
		return false;
	}
}