<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AdminAction
 *
 * @package App
 * @property string $user
 * @property string $action
 * @property string $action_model
 * @property integer $action_id
*/
class AdminAction extends Model
{
    use SoftDeletes;
    
    protected $table     = 'admin_action';
    protected $fillable = ['action', 'action_model', 'action_id', 'admin_id','ip_address'];

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIdAttribute($input)
    {
        $this->attributes['admin_id'] = $input ? $input : null;
    }
    
    public function user()
    {
        return $this->belongsTo(AdminAccount::class, 'admin_id');
    }
}
