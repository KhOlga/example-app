<?php

namespace App\Http\Resources;

use App\Models\Membership;
use App\Models\Team;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
		foreach ($this->roles as $role) {
			$roles[] = $role->name;
		}
		//$team = $this->currentTeam->name;

		return [
			'id' => $this->id,
			'first_name' => $this->first_name,
			'last_name' => $this->last_name,
			'nickname' => $this->nickname,
			'email' => $this->email,
			'roles' => $roles,
			'team' => Team::where('id', $this->current_team_id)->first()->name,
			//'team' => $team,
			'team_membership' => Membership::where('user_id', $this->id)->first()->role,
			//'team_membership' => $this->teamRole($team),
		];
    }
}
