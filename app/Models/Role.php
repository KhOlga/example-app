<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'slug'];

	/**
	 * The users that belong to the role.
	 */
	public function users(): BelongsToMany
	{
		return $this->belongsToMany(User::class)->using(RoleUser::class);
	}

	/**
	 * The permissions that belong to the role.
	 */
	public function permissions(): BelongsToMany
	{
		return $this->belongsToMany(Permission::class)->using(RolePermission::class);
	}
}
