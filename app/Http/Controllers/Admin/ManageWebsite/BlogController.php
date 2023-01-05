<?php

namespace App\Http\Controllers\Admin\ManageWebsite;

use Illuminate\Http\Request;
use App\Models\BlogManageWebsite;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\MangeWebsiteRepositories;
class BlogController extends Controller
{
    public function __construct(BlogManageWebsite $blogModel,MangeWebsiteRepositories $mangeWebsiteRepositories){
        $this->blogModel                        = $blogModel;
        $this->mangeWebsiteRepositories        = $mangeWebsiteRepositories;
        }
    
        public function index(Request $request){
        $json_arr = [];
        $json_arr = $this->mangeWebsiteRepositories->blogIndex($request);
        return response()->json($json_arr);         
        }

     public function show($id){     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->blogShow($id);
         return response()->json($json_arr);
    }
    public function store(Request $request){     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->blogStore($request);
         return response()->json($json_arr);
    }
    public function update($id,Request $request){     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->blogUpdate($id,$request);
         return response()->json($json_arr);
    }
     public function destroy($id,Request $request){     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->blogDestroy($id,$request);
         return response()->json($json_arr);
    }
}