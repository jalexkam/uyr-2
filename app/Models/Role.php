<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @package App
 * @property string $title
*/
class Role extends Model
{
    protected $fillable = ['title','status'];

    public static function boot()
    {
        parent::boot();

        Role::observe(new \App\Observers\AdminActionsObserver);
    }
   
    public static function storeValidation($request)
    {
        return [
            'title' => 'max:191|required|unique:roles',
            'permission' => 'array|required',
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => ['max:191','required','unique:roles,title,'.$request->get('id')],
        ];
    }
    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
}
