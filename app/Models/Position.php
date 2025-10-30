<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Application;

class Position extends Model
{
    protected $fillable = [
        'title',
        'description',
        'max_applicants',
    ];

	public function applications()
	{
		return $this->hasMany(Application::class);
	}
}
