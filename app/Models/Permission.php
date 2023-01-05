<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 *
 * @package App
 * @property string $title
*/
class Permission extends Model
{
    protected $table    = "permissions";
    protected $fillable = ['name','slug','parent_id','href','is_menu','check_slug','icon'];

   
    public static function boot()
    {
        parent::boot();

        //Permission::observe(new \App\Observers\AdminActionsObserver);
    }

    public static function storeValidation($request)
    {
        return [
            'name' => 'max:191|required|unique:permissions',
        ];
    }

    public static function updateValidation($request)
    {
        return [
           'name' => ['max:191','required','unique:permissions,id,'.$request->get('id')],
        ];
    }
}
