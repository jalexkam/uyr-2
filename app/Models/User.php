<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;
    use HasFactory;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','first_name','last_name','user_name','email','password','role_type','pass_word','phone_number','parent_id','status','is_deleted','gender','age','resetPasswordKey','verifyEmailSend','otp','otpExpiredAt','otp_verified','otpToken'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    protected $dates = [
        'deleted_at'
    ];
    
    protected $guard_name = 'api';

    // protected $attributes = [ 
    //     'menuroles' => 'user',
    // ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
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
