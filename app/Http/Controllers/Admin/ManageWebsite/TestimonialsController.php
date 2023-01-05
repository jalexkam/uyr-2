<?php

namespace App\Http\Controllers\Admin\ManageWebsite;

use Illuminate\Http\Request;
use App\Models\TestimonialsManageWebsite;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\MangeWebsiteRepositories;
class TestimonialsController extends Controller
{
    public function __construct(TestimonialsManageWebsite $testimonials,MangeWebsiteRepositories $mangeWebsiteRepositories){
        $this->testimonials                        = $testimonials;
        $this->mangeWebsiteRepositories        = $mangeWebsiteRepositories;
        }
    
        public function index(Request $request){
        $json_arr = [];
        $json_arr = $this->mangeWebsiteRepositories->testimonialsIndex($request);
        return response()->json($json_arr);         
        }

     public function show($id){     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->testimonialsShow($id);
         return response()->json($json_arr);
    }
    public function store(Request $request){     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->testimonialsStore($request);
         return response()->json($json_arr);
    }
    public function update($id,Request $request){     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->testimonialsUpdate($id,$request);
         return response()->json($json_arr);
    }
     public function destroy($id,Request $request){     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->testimonialsDestroy($id,$request);
         return response()->json($json_arr);
    }
}