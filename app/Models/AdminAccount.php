<?php
namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Hash;

class AdminAccount extends Model implements
    AuthenticatableContract,
    AuthorizableContract
{
    use Authenticatable, Authorizable;

    // The attributes that are mass assignable.
    protected $fillable = ['id', 'first_name', 'last_name', 'user_name', 'password','pass_word','email','role_type','created_at', 'updated_at'];

    public $timestamps = false;

    // The attributes that should be hidden for arrays.
    protected $hidden = [
        'password'
    ];

    public static function boot()
    {
        parent::boot();

        AdminAccount::observe(new \App\Observers\AdminActionsObserver);
    }
    

    // Get the oauth providers.
    public function oauthProviders()
    {
        return $this->hasMany(OAuthProvider::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_admin');
    }

    public function get_role()
    {
        return $this->belongsToMany(Role::class, 'role_admin');
    }
}
