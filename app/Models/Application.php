<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id',
        'position_id',
    ];

	public function position()
	{
		return $this->belongsTo(Position::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
