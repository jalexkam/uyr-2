<?php

namespace App\Observers;

use App\Models\AdminAction;
use Auth;
use Request;

class AdminActionsObserver
{
    public function saved($model)
    {
        if ($model->wasRecentlyCreated == true) {
            // Data was just created
            $action = 'created';
        } else {
            // Data was updated
            $action = 'updated';
        }
        if (Auth::check()) {
            AdminAction::create([
                'admin_id'      => Auth::user()->id,
                'action'       => $action,
                'action_model' => $model->getTable(),
                'action_id'    => $model->id,
                'ip_address'    => Request::ip()
            ]);
        }
    }


    public function deleting($model)
    {
        if (Auth::check()) {
            AdminAction::create([
                'admin_id'      => Auth::user()->id,
                'action'        => 'deleted',
                'action_model'  => $model->getTable(),
                'action_id'     => $model->id,
                'ip_address'    => Request::ip()
            ]);
        }
    }
}
