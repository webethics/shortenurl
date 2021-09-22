<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'destination',
        'slug',
        'user_id',
    ];

    
    /**
	 * Get the full shortened url.
	 *
	 * @return string
	 */
	public function getFullShortenedUrlAttribute()
	{	   
	    return url('/')."/s/{$this->slug}";
	}
}