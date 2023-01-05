<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RoleAdminModel;
use App\Models\ContactUsMaster;
use App\Models\AboutUSManageWebsite;
use App\Models\FaqMaster;
use App\Models\ServicesMaster;
use App\Models\BlogManageWebsite;
use App\Models\AssociatePartnersManageWebsite;
use App\Models\TestimonialsManageWebsite;
use App\Models\WebsiteSettingsModel;
use App\Models\HomePageSliderManageWebsite;
use File;
class FrontController extends Controller
{    
    public function __construct(
              AboutUSManageWebsite $aboutUSManageWebsite,
              ContactUsMaster $contactUsMaster,
              FaqMaster $faqMaster,
              BlogManageWebsite $blogManageWebsite,
              AssociatePartnersManageWebsite $associatePartners,
              TestimonialsManageWebsite $testimonials,
              ServicesMaster $servicesModel,
              HomePageSliderManageWebsite $homepageSlider,
              WebsiteSettingsModel $websiteSettings
              )
    {

      $this->aboutUSManageWebsite       = $aboutUSManageWebsite;
      $this->contactUsMaster            = $contactUsMaster;
      $this->faqMaster                  = $faqMaster;
      $this->blogManageWebsite          = $blogManageWebsite;
      $this->associatePartners          = $associatePartners;
      $this->testimonials                        = $testimonials;
      $this->servicesModel              = $servicesModel;
      $this->websiteSettings                        = $websiteSettings;
      $this->homepageSlider                        = $homepageSlider;
        
    }
  
    public function gethomePageData(Request $request)
    {  

      $aboutUSData = $this->aboutUSManageWebsite->where('pageName','about-us')->first();
      $json_arr['aboutUS'] = $aboutUSData;

      $serviceData = $this->servicesModel->where('isdeleted',0)->where('isactive',1)->get();
      $json_arr['service'] = $serviceData;

      $contactData = $this->contactUsMaster->where('isactive',1)->get();
      $json_arr['contact'] = $contactData;

      $faqData = $this->faqMaster->where('isdeleted',0)->get();
      $json_arr['faq'] = $faqData;

      $blogData = $this->blogManageWebsite->where('isdeleted',0)->get();
      $json_arr['blog'] = $blogData;

      $associatePartnersData = $this->associatePartners->where('isdeleted',0)->get();
      $json_arr['associatePartner'] = $associatePartnersData;

      $testimonialsData = $this->testimonials->where('isdeleted',0)->get();
      $json_arr['testimonials'] = $testimonialsData;

      $termsConditionData = $this->aboutUSManageWebsite->where('pageName','terms-condition')->first();
      $json_arr['termsConditionData'] = $termsConditionData;
      
      $privacyPolicyData = $this->aboutUSManageWebsite->where('pageName','privacy-policy')->first();
      $json_arr['privacyPolicyData'] = $privacyPolicyData;

      $socialLinksData = $this->websiteSettings->first();
      $json_arr['socialLinksData'] = $socialLinksData;
      
      $homepageSliderData = $this->homepageSlider->where('isdeleted',0)->get();
      $json_arr['homepageSlider'] = $homepageSliderData;
      

      $wayWorkData = $this->aboutUSManageWebsite->where('pageName','Why-work')->first();
      $json_arr['wayWorkData'] = $wayWorkData;

        // $json_arr = $this->userRepositories->index($request);
         return response()->json($json_arr);
    }

    public function getArticalview($id){
      $articalData = $this->blogManageWebsite->where('id',$id)->first();
      return response()->json($articalData);
    }


    public function insertContactus(Request $request){
      $formData  =  $request->all();
      $insertArr['firstName']      = isset($formData['firstName'])?$formData['firstName']:'';
      $insertArr['lastName']   = isset($formData['lastName'])?$formData['lastName']:'';
      $insertArr['email']      = isset($formData['email'])?$formData['email']:'';
      $insertArr['phone']          = isset($formData['phone'])?$formData['phone']:'';
      $insertArr['message']         = isset($formData['message'])?$formData['message']:'';
      //$result = $this->UserModel->update($insertArr);
      $result =   DB::table('contact_us_enquiries')->insert($insertArr);
      if ($result) {
        $data['status']   = 'success';
        $data['message']  = 'Contact us successfully Updated';
    } else {
        $data['status']   = 'error';
        $data['message']  = 'error occured while updating Contact us ';
    }
    return response()->json($data);
    }

    public function insertCareerForm(Request $request){
     // $formData  =  $request->all();

      $formData = json_decode($request->input('formData'));
      $insertArr['firstName']      = isset($formData->firstName)?$formData->firstName:'';
      $insertArr['lastName']   = isset($formData->lastName)?$formData->lastName:'';
      $insertArr['email']      = isset($formData->email)?$formData->email:'';
      $insertArr['phone']          = isset($formData->phone)?$formData->phone:'';
      $insertArr['message']         = isset($formData->message)?$formData->message:'';
      $insertArr['age']         = isset($formData->age)?$formData->age:'';
      $insertArr['gender']         = isset($formData->gender)?$formData->gender:'';
      $insertArr['address']         = isset($formData->address)?$formData->address:'';
     
      if (!empty($_FILES['file']) && $_FILES['file']['size'] > 0 && $request->file('file'))
      {
            $profilefile = $request->file('file');
            $extension = $profilefile->getClientOriginalExtension();
                $resume = 'resume' . time() . '.' . $extension;
                $destinationPath = public_path('uploads/resume/');
                if (!file_exists($destinationPath) and !is_dir($destinationPath))
                {
                    File::makeDirectory($destinationPath, $mode = 0777, true, true);
                }
                $profilefile->move($destinationPath, $resume);
                $insertArr['resume']    =    $resume;
        
      }
      $result =   DB::table('career')->insert($insertArr);
      if ($result) {
        $data['status']   = 'success';
        $data['message']  = 'Career successfully Updated';
    } else {
        $data['status']   = 'error';
        $data['message']  = 'error occured while updating Career ';
    }
    return response()->json($data);
    }


    

}
