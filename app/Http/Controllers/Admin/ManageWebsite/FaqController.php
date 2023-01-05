<?php

namespace App\Http\Controllers\Admin\ManageWebsite;

use Illuminate\Http\Request;
use App\Models\FaqMaster;
use App\Http\Controllers\Controller;
use App\Http\Requests\Faq\StoreFaqRequest;
use App\Repositories\Admin\MangeWebsiteRepositories;
class FaqController extends Controller
{
    public function __construct(FaqMaster $faqmodel,MangeWebsiteRepositories $mangeWebsiteRepositories){
        $this->FaqModel                              = $faqmodel;
         $this->mangeWebsiteRepositories             = $mangeWebsiteRepositories;
        }

    public function index(Request $request){
        $json_arr = [];
        $json_arr = $this->mangeWebsiteRepositories->faqIndex($request);
        return response()->json($json_arr);
    }

    public function show($id){     
        $json_arr = [];
        $json_arr = $this->mangeWebsiteRepositories->faqShow($id);
        return response()->json($json_arr);
    }
    public function store(StoreFaqRequest $request){     
        $json_arr = [];
        $json_arr = $this->mangeWebsiteRepositories->faqStore($request);
        return response()->json($json_arr);
    }
    public function update($id,Request $request){     
        $json_arr = [];
        $json_arr = $this->mangeWebsiteRepositories->faqUpdate($id,$request);
        return response()->json($json_arr);
    }
    public function destroy($id,Request $request){     
        $json_arr = [];
        $json_arr = $this->mangeWebsiteRepositories->faqDestroy($id,$request);
        return response()->json($json_arr);
    }
}