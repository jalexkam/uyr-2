<?php

namespace App\Http\Controllers\Admin\ManageWebsite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\MangeWebsiteRepositories;
class SocialLinksController extends Controller
{
    public function __construct(MangeWebsiteRepositories $mangeWebsiteRepositories){
         $this->mangeWebsiteRepositories             = $mangeWebsiteRepositories;
        }
     public function show($id)
    {     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->socialLinksShow($id);
         return response()->json($json_arr);
    }
    public function store(Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->socialLinksStore($request);
         return response()->json($json_arr);
    }
    public function update($id,Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->socialLinksUpdate($id,$request);
         return response()->json($json_arr);
    }

}