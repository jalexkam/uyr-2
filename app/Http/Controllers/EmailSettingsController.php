<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmailSettings;
use Illuminate\Support\Facades\Gate;
// use App\Repositories\EmailTemplate\EmailTemplateRepositories;
// use App\Http\Requests\EmailTemplate\UpdateEmailTemplateRequest;
// use App\Http\Requests\EmailTemplate\StoreEmailTemplateRequest;
use Auth;
use File;


class EmailSettingsController extends Controller
{    
    public function __construct(
        User            $user, 
        EmailSettings   $email_settings
    ){
        // $this->middleware('auth:api');
         $this->UserModel          = $user;
         $this->EmailSettings      = $email_settings;
    }
    
    //USERS LIST

    public function show(Request $request)
    {
        $data = $jsonArr =  [];
        $data = $this->EmailSettings->select('id','type','smtpHost','smtpUser','smtpPassword','smtpPort','smtpEncryption','smtpDriver','smtpSendmail','smtpPretend','smtpFromAddress','smtpFromName')->first();

        if (isset($data) && !empty($data)) {
            $jsonArr['id']                  = $data['id'];
            $jsonArr['type']                = $data['type'];
            $jsonArr['smtpHost']            = $data['smtpHost'];
            $jsonArr['smtpUser']            = $data['smtpUser'];
            $jsonArr['smtpPassword']        = $data['smtpPassword'];
            $jsonArr['smtpPort']            = $data['smtpPort'];
            $jsonArr['smtpEncryption']      = $data['smtpEncryption'];
            $jsonArr['smtpDriver']          = $data['smtpDriver'];
            $jsonArr['smtpSendmail']        = $data['smtpSendmail'];
            $jsonArr['smtpPretend']         = $data['smtpPretend'];
            $jsonArr['smtpFromAddress']     = $data['smtpFromAddress'];
            $jsonArr['smtpFromName']        = $data['smtpFromName'];
        }
        return $jsonArr;
    }

    public function update(Request $request,$id)
    {
        $data = [];      
        $formData = $request->all(); 
        $updateArr['type']              = isset($formData['type']) ? $formData['type'] : '';
        $updateArr['smtpHost']          = isset($formData['smtpHost']) ? $formData['smtpHost'] : '';
        $updateArr['smtpUser']          = isset($formData['smtpUser']) ? $formData['smtpUser'] : '';
        $updateArr['smtpPassword']      = isset($formData['smtpPassword']) ? $formData['smtpPassword'] : '';
        $updateArr['smtpPort']          = isset($formData['smtpPort']) ? $formData['smtpPort'] : '';
        $updateArr['smtpDriver']        = isset($formData['smtpDriver']) ? $formData['smtpDriver'] : '';
        $updateArr['smtpEncryption']    = isset($formData['smtpEncryption']) ? $formData['smtpEncryption'] : '';
        $updateArr['smtpSendmail']      = isset($formData['smtpSendmail']) ? $formData['smtpSendmail'] : '';
        $updateArr['smtpPretend']       = isset($formData['smtpPretend']) ? $formData['smtpPretend'] : ''; 
        $updateArr['smtpFromAddress']   = isset($formData['smtpFromAddress']) ? $formData['smtpFromAddress'] : ''; 
        $updateArr['smtpFromName']      = isset($formData['smtpFromName']) ? $formData['smtpFromName'] : ''; 

        // dd($updateArr);
        $result = $this->EmailSettings->where('id', $id)->update($updateArr);

        if ($result) {
            $data['status'] = 'success';
            $data['message'] = 'Email Settings successfully Updated';
        } else {
            $data['status'] = 'error';
            $data['message'] = 'error occured while updating Email Settings';
        }
        return $data;
    }
    
    public function store(Request $request)
    {
        $json_arr = [];
        $formData = $request->All();

        $type               = isset($formData['type']) ? $formData['type'] : '';
        $smtpHost           = isset($formData['smtpHost']) ? $formData['smtpHost'] : '';
        $smtpUser           = isset($formData['smtpUser']) ? $formData['smtpUser'] : '';
        $smtpPassword       = isset($formData['smtpPassword']) ? $formData['smtpPassword'] : '';
        $smtpPort           = isset($formData['smtpPort']) ? $formData['smtpPort'] : '';
        $smtpDriver         = isset($formData['smtpDriver']) ? $formData['smtpDriver'] : '';
        $smtpEncryption     = isset($formData['smtpEncryption']) ? $formData['smtpEncryption'] : '';
        $smtpSendmail       = isset($formData['smtpSendmail']) ? $formData['smtpSendmail'] : '';
        $smtpPretend        = isset($formData['smtpPretend']) ? $formData['smtpPretend'] : '';
        $smtpFromAddress    = isset($formData['smtpFromAddress']) ? $formData['smtpFromAddress'] : '';
        $smtpFromName       = isset($formData['smtpFromName']) ? $formData['smtpFromName'] : '';

        $insertArr = [         
            'type'              => $type,
            'smtpHost'          => $smtpHost,
            'smtpUser'          => $smtpUser,
            'smtpPassword'      => $smtpPassword,
            'smtpPort'          => $smtpPort,
            'smtpDriver'        => $smtpDriver,
            'smtpEncryption'    => $smtpEncryption,
            'smtpSendmail'      => $smtpSendmail,
            'smtpPretend'       => $smtpPretend,
            'smtpFromAddress'   => $smtpFromAddress,
            'smtpFromName'      => $smtpFromName,
         ];
   
        // dd($insertArr);
        $result = $this->EmailSettings->create($insertArr);

        if (!empty($result['id'])) {
            $data['status'] = 'success';
            $data['message'] = 'Email Settings Added Succefully!';
        } else {
            $data['status'] = 'error';
            $data['message'] = 'Something went wrong! Please try again.';
        }

        return response()->json($data);
    }
    
}
