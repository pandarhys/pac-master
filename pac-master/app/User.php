<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use Notifiable;
    const ADMIN_TYPE = 1;
    const DEFAULT_TYPE = 0;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token'
	];

	/**
	 * Get all article owner by the user.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function articles()
	{
		return $this->hasMany(Article::class, 'owner_id')->latest('updated_at');
	}

    /**
     * Get all article that the user has access to.
     *
     * @return mixed
     */
	public function accessibleArticles()
	{
//	    return Article::where('owner_id', $this->id)
//            ->orWhereHas('members', function ($query) {
//                $query->where('user_id', $this->id);
//            })
//            ->get();
        if ($this->admin === 1){
            return Article::where('status', 'live')
                ->orWhere('status', 'pending')
                ->orderBy('created_at','desc')
                ->take(10)
                ->get();
        }
        else{
        return Article::where('status', 'live')
            ->orderBy('created_at','desc')
            ->take(10)
            ->get();
        }
	}

	public function pendingArticles()
    {
        if ($this->admin === 1){
            return Article::where('status', 'pending')
                ->orderBy('created_at','desc')
                ->take(10)
                ->get();
        }
        else {
            //TODO Insuffient permissions page
            return redirect('/');
        }
    }

	public function isAdmin()
    {
        return $this->admin === self::ADMIN_TYPE;
    }
}
