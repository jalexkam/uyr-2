<?php

namespace App\Http\Controllers\Admin\ManageWebsite;

use Illuminate\Http\Request;
use App\Models\HomePageSliderManageWebsite;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\MangeWebsiteRepositories;
class HomepageSlider extends Controller
{
    public function __construct(HomePageSliderManageWebsite $homepageSlider,MangeWebsiteRepositories $mangeWebsiteRepositories){
        $this->homepageSlider                        = $homepageSlider;
        $this->mangeWebsiteRepositories                 = $mangeWebsiteRepositories;
        }
    
        public function index(Request $request){
        $json_arr = [];
        $json_arr = $this->mangeWebsiteRepositories->homepageSliderIndex($request);
        return response()->json($json_arr);         
        }

     public function show($id){     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->homepageSliderShow($id);
         return response()->json($json_arr);
    }
    public function store(Request $request){     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->homepageSliderStore($request);
         return response()->json($json_arr);
    }
    public function update($id,Request $request){     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->homepageSliderUpdate($id,$request);
         return response()->json($json_arr);
    }
     public function destroy($id,Request $request){     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->homepageSliderDestroy($id,$request);
         return response()->json($json_arr);
    }
}