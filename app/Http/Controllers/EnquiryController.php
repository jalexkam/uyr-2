<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\ContactusEnquiries;

use File;
use Auth;
class EnquiryController extends Controller
{    
    public function __construct(ContactusEnquiries $contactusEnquiries){
         $this->tab                   = 'Patient';
         $this->contactusEnquiries = $contactusEnquiries;
         $this->per_page       =   per_page();
    }

    public function index(Request $request)
    {  
        $json_arr = [];
        $result = $this->contactusEnquiries->select('*')->where('isdeleted',0);
        $result = $result->orderBy('id', 'DESC')->paginate($this->per_page);
            if (isset($result) && !empty($result)) {
                $data = $result->ToArray();
                if (isset($data) && !empty($data)) {
                    foreach ($data['data'] as $key => $value) {
                        $data['data'][$key]['created_at'] =  date("Y-m-d", strtotime($value['created_at']));
                    
                    }
                }
                return  $data;
            }
       
        return response()->json($data);
    }

  
    public function show($id)
    {  
        $data = $jsonArr =  [];
        if (isset($id) && $id != '') {
            $data = $this->contactusEnquiries->where('id', $id)->first();
            if (isset($data) && !empty($data)) {
                $jsonArr['id']              = $data['id'];
                $jsonArr['firstName']       = $data['firstName'];
                $jsonArr['lastName']        = $data['lastName'];
                $jsonArr['email']           = $data['email'];
                $jsonArr['phone']           = $data['phone'];
                $jsonArr['message']           = $data['message'];
            }
        }
        
        return response()->json($json_arr);
    }
    
     public function destroy($id,Request $request)
    { 
        
        $result = $this->contactusEnquiries->where('id', $id)->update(['isdeleted'=>1]);
        if ($result) {
            $data['status']   = 'success';
            $data['message']  = 'Careers successfully Deleted';
        } else {
            $data['status']   = 'error';
            $data['message']  = 'error occured while deleting Careers';
        }
        return response()->json($data);
    }
    
}
