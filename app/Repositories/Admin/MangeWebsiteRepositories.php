<?php

namespace App\Repositories\Admin;
use App\Models\SitesModel;
use App\Models\UserAgencyDetailsModel;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Auth;
use App\Models\ContactUsMaster;
use App\Models\AboutUSManageWebsite;
use App\Models\FaqMaster;
use App\Models\BlogManageWebsite;
use App\Models\AssociatePartnersManageWebsite;
use App\Models\TestimonialsManageWebsite;
use App\Models\WebsiteSettingsModel;
use App\Models\HomePageSliderManageWebsite;
use File;
class MangeWebsiteRepositories
{

public function __construct(ContactUsMaster $contactusModel,
                        FaqMaster  $faqModel,
                        AboutUSManageWebsite $aboutUSManageWebsite,
                        BlogManageWebsite $blogManageWebsite,
                        AssociatePartnersManageWebsite $associatePartners,
                        TestimonialsManageWebsite $testimonials,
                        WebsiteSettingsModel $websiteSettings,
                        HomePageSliderManageWebsite $homepageSlider
                        )
{
    $this->per_page       =   per_page();
    $this->contactusModel = $contactusModel;
    $this->faqModel       = $faqModel;
    $this->aboutUSManageWebsite       = $aboutUSManageWebsite;
    $this->blogManageWebsite       = $blogManageWebsite;
    $this->associatePartners       = $associatePartners;
    $this->testimonials            = $testimonials;
    $this->websiteSettings         = $websiteSettings;
    $this->homepageSlider          = $homepageSlider;
}

//contactUS
    public function contactUsIndex($request)
    {
        $keyword =  $request->get('keyword');
        $result = $this->contactusModel->select('*')->where('isdeleted', 0);
            if ($request->get('keyword')) {
                 $result =  $result->whereRaw("(email LIKE '%".$keyword."%')");
            }
        $result = $result->orderBy('id', 'DESC')->paginate($this->per_page);
            if (isset($result) && !empty($result)) {
                $data = $result->ToArray();
                if (isset($data) && !empty($data)) {
                    foreach ($data['data'] as $key => $value) {
                    }
                }
                return  $data;
            }
    }

    public function contactUsShow($id)
    {
        $data = $jsonArr =  [];
        if (isset($id) && $id != '') {
            $data = $this->contactusModel->where('id', $id)->first();
            if (isset($data) && !empty($data)) {
                $jsonArr['id']                        = $data['id'];
                $jsonArr['email']                     = $data['email'];
                $jsonArr['address']                     = $data['address'];
                $jsonArr['contactno']                 = $data['contactno'];
                 $jsonArr['isactive']                 = $data['isactive'];
                $jsonArr['isdeleted']                 = $data['isdeleted'];
            }
        }
        return $jsonArr;
    }
     public function contactUsStore($request)
    {
      $data = [];
      $formData       = $request->all(); 
       $email     = isset($formData['email']) ?$formData['email']: '';
      $contactno      = isset($formData['contactno']) ?$formData['contactno']: '';
       $isactive      = isset($formData['isactive']) ?$formData['isactive']: '';
       $address      = isset($formData['address']) ?$formData['address']: '';
       
      $insertArr = array(
                    'email'            => $email,
                    'contactno'        => $contactno,
                     'isactive'        =>  $isactive ,
                     'address'        =>  $address ,
                     
      );
  
      $result = $this->contactusModel->create($insertArr);
      if(!empty($result['id'])){
        $data['status']    = 'success';
        $data['message']   =  'ContactUs Added Succefully!';
      }else{
        $data['status']    = 'error';
        $data['message']   = 'Something went wrong! Please try again.';
      }
        return $data;

    }
     public function contactUsUpdate($id, $request)
    {
        $data = [];
        $formData  =  $request->all();
        $updateArr['email']      = isset($formData['email'])?$formData['email']:'';
        $updateArr['contactno']   = isset($formData['contactno'])?$formData['contactno']:'';
         $updateArr['isactive']   = isset($formData['isactive'])?$formData['isactive']:'';
         $updateArr['address']   = isset($formData['address'])?$formData['address']:'';
        $result = $this->contactusModel->where('id', $id)->update($updateArr);
        if ($result) {
            $data['status']   = 'success';
            $data['message']  = 'ContactUs successfully Updated';
        } else {
            $data['status']   = 'error';
            $data['message']  = 'error occured while updating ContactUs';
        }
        return $data;
    }
    public function contactUsDestroy($id, $request)
    {
        $result = $this->contactusModel->where('id', $id)->update(['isdeleted'=>1]);
        if ($result) {
            $data['status']   = 'success';
            $data['message']  = 'ContactUs successfully Deleted';
        } else {
            $data['status']   = 'error';
            $data['message']  = 'error occured while deleting ContactUs';
        }
        return $data;

       }

       // FAQs


   
 public function faqIndex($request)
    {
        $keyword =  $request->get('keyword');
        $result = $this->faqModel->select('*')->where('isdeleted', 0);
            if ($request->get('keyword')) {
                 $result =  $result->whereRaw("(email LIKE '%".$keyword."%')");
            }
        $result = $result->orderBy('id', 'DESC')->paginate($this->per_page);
            if (isset($result) && !empty($result)) {
                $data = $result->ToArray();
                if (isset($data) && !empty($data)) {
                    foreach ($data['data'] as $key => $value) {
                    }
                }
                return  $data;
            }
    }

         public function faqShow($id)
    {
        $data = $jsonArr =  [];
        if (isset($id) && $id != '') {
            $data = $this->faqModel->where('id', $id)->first();
            if (isset($data) && !empty($data)) {
                $jsonArr['id']                           = $data['id'];
                $jsonArr['question']                     = $data['question'];
                $jsonArr['answer']                       = $data['answer'];
                $jsonArr['isdeleted']                     = $data['isdeleted'];
            }
        }
        return $jsonArr;
    }
     public function faqStore($request)
    {
      $data = [];
      $formData       = $request->all(); 

       $question     = isset($formData['question']) ?$formData['question']: '';
      $answer      = isset($formData['answer']) ?$formData['answer']: '';
       
      $insertArr = array(
                    'question'            => $question,
                    'answer'             => $answer,
                     
                     
      );
  
      $result = $this->faqModel->create($insertArr);
      if(!empty($result['id'])){
        $data['status']    = 'success';
        $data['message']   =  'FAQs Added Succefully!';
      }else{
        $data['status']    = 'error';
        $data['message']   = 'Something went wrong! Please try again.';
      }
        return $data;

    }
     public function faqUpdate($id, $request)
    {
        $data = [];
        $formData  =  $request->all();
        $updateArr['question']      = isset($formData['question'])?$formData['question']:'';
        $updateArr['answer']      = isset($formData['answer'])?$formData['answer']:'';
       
        $result = $this->faqModel->where('id', $id)->update($updateArr);
        if ($result) {
            $data['status']   = 'success';
            $data['message']  = 'FAQs successfully Updated';
        } else {
            $data['status']   = 'error';
            $data['message']  = 'error occured while updating FAQs';
        }
        return $data;
    }
    
    public function faqDestroy($id, $request)
    {
        $result = $this->faqModel->where('id', $id)->update(['isdeleted'=>1]);
        if ($result) {
            $data['status']   = 'success';
            $data['message']  = 'FAQs successfully Deleted';
        } else {
            $data['status']   = 'error';
            $data['message']  = 'error occured while deleting FAQs';
        }
        return $data;
        
       }

       public function aboutUsShow($id)
       {    
            $data = $jsonArr =  [];
             $data = $this->aboutUSManageWebsite->where('pageName','about-us')->first();
            if (!empty($data)) {
                    $jsonArr['id']                        = $data['id'];
                    $jsonArr['title']                     = $data['title'];
                    $jsonArr['description']               = $data['description'];
                    $jsonArr['image']                     = $data['image'];
                    $jsonArr['status']                    = $data['status'];
            }else{
                    $jsonArr['id']                    = '';
                    $jsonArr['title']                 = '';
                    $jsonArr['description']           = '';
                    $jsonArr['image']                 = '';
                    $jsonArr['status']                = '';
            }
         
           return $jsonArr;
       }

       public function aboutUsUpdate($id, $request)
       {
           $data = [];
           //$formData  =  $request->all();
         
           $formData = json_decode($request->input('formData'));
           if(!empty($id)) {
            $updateArr['title']      = isset($formData->title)?$formData->title:'';
            $updateArr['description']   = isset($formData->description)?$formData->description:'';
            $updateArr['status']   = 1;
             $result = $this->aboutUSManageWebsite->where('id', $id)->update($updateArr);
            if ($result) {
                if (!empty($_FILES['file']) && $_FILES['file']['size'] > 0 && $request->file('file'))
                {
                    $fileData = $this->SingleFileUpload($request, $id,'aboutus');
                    $filename = $fileData['fileName'];
                    $this->aboutUSManageWebsite->where('id', $id)->update([ 'image' => $filename ]);
                }

                $data['status']   = 'success';
                $data['message']  = 'About Us successfully Updated';
            } else {
                $data['status']   = 'error';
                $data['message']  = 'error occured while updating About Us';
            }
           }else{
           
            $updateArr['title']      = isset($formData->title)?$formData->title:'';
            $updateArr['description']   = isset($formData->description)?$formData->description:'';
            $updateArr['status']   = 1;
            $result = $this->aboutUSManageWebsite->create($updateArr);
            if(!empty($result)) {
                if (!empty($_FILES['file']) && $_FILES['file']['size'] > 0 && $request->file('file'))
                {
                    $fileData = $this->SingleFileUpload($request, $result->id,'aboutus');
                    $filename = $fileData['fileName'];
                    $this->aboutUSManageWebsite->where('id', $result->id)->update([ 'image' => $filename ]);
                }
            $data['status']   = 'success';
                $data['message']  = 'About Us successfully Updated';
            } else {
                $data['status']   = 'error';
                $data['message']  = 'error occured while updating About Us';
            }
           }
           return $data;
       }


   function SingleFileUpload($request,$id,$folderName)
    {   
    if ($request->file('file'))
    {   
        $formData = json_decode($request->input('formData'));
      
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $fileName = 'file_' . time() . '.' . $extension;
        $destinationPath = public_path('uploads/'.$folderName.'/' . $id);
        if (!file_exists($destinationPath) and !is_dir($destinationPath))
        {
            File::makeDirectory($destinationPath, $mode = 0777, true, true);
        }
        $file->move($destinationPath, $fileName);
        $json_arr['fileName'] = $fileName;
       
        return $json_arr;
    }
}
    public function blogIndex($request){
        $keyword =  $request->get('keyword');
        $result = $this->blogManageWebsite->select('*')
        ->where('isdeleted',0)->where('isactive', 1);
            if ($request->get('keyword')) {
                $result =  $result->whereRaw("(title LIKE '%".$keyword."%')");
            }
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
    }

    public function blogStore($request)
    {
        $data = [];
        $formData = json_decode($request->input('formData'));
        $insertArr['title']      = isset($formData->title)?$formData->title:'';
        $insertArr['description']   = isset($formData->description)?$formData->description:'';
        $insertArr['status']   = 1;
        $insertArr['author_name']  = isset($formData->author_name)?$formData->author_name:'';
        $result = $this->blogManageWebsite->create($insertArr);
        if ($result) {
            if (!empty($_FILES['file']) && $_FILES['file']['size'] > 0 && $request->file('file'))
            {
                $fileData = $this->SingleFileUpload($request, $result['id'],'blog');
                $filename = $fileData['fileName'];
                $this->blogManageWebsite->where('id', $result['id'])->update(['image_name' => $filename ]);
            }

            $data['status']   = 'success';
            $data['message']  = 'Article blog successfully Added';
        } else {
            $data['status']   = 'error';
            $data['message']  = 'error occured while updating Article blog';
        }
       
        return $data;
    }

    public function blogDestroy($id, $request)
    {
        $result = $this->blogManageWebsite->where('id', $id)->update(['isdeleted'=>1]);
        if ($result) {
            $data['status']   = 'success';
            $data['message']  = 'Blog successfully Deleted';
        } else {
            $data['status']   = 'error';
            $data['message']  = 'error occured while deleting Blog';
        }
        return $data;

       }
    public function blogShow($id)
    {
        $data = $jsonArr =  [];
        if (isset($id) && $id != '') {
            $data = $this->blogManageWebsite->where('id', $id)->first();
            if (isset($data) && !empty($data)) {
                $jsonArr['id']              = $data['id'];
                $jsonArr['description']     = $data['description'];
                $jsonArr['author_name']     = $data['author_name'];
                $jsonArr['image_name']      = $data['image_name'];
                $jsonArr['title']           = $data['title'];
                $jsonArr['isdeleted']       = $data['isdeleted'];
            }
        }
        return $jsonArr;
    }

    

    public function blogUpdate($id, $request)
    {
        $data = [];
        $formData = json_decode($request->input('formData'));
        $updateArr['title']      = isset($formData->title)?$formData->title:'';
        $updateArr['description']   = isset($formData->description)?$formData->description:'';
        $updateArr['author_name']  = isset($formData->author_name)?$formData->author_name:'';
       
        $result = $this->blogManageWebsite->where('id', $id)->update($updateArr);
        if ($result) {
            if (!empty($_FILES['file']) && $_FILES['file']['size'] > 0 && $request->file('file'))
            {
                $fileData = $this->SingleFileUpload($request, $id,'blog');
                $filename = $fileData['fileName'];
                $this->blogManageWebsite->where('id', $id)->update(['image_name' => $filename ]);
            }
            $data['status']   = 'success';
            $data['message']  = 'Blog successfully Updated';
        } else {
            $data['status']   = 'error';
            $data['message']  = 'error occured while updating Blog';
        }
        return $data;
    }


    public function associatePartnersIndex($request){
        $result = $this->associatePartners->select('*')->where('isdeleted',0);
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
    }

    public function associatePartnersStore($request)
    {
        $data = [];
        $formData = json_decode($request->input('formData'));
        $insertArr['image'] =  '';
        $result = $this->associatePartners->create($insertArr);
        if ($result) {
            if (!empty($_FILES['file']) && $_FILES['file']['size'] > 0 && $request->file('file'))
            {
                $fileData = $this->SingleFileUpload($request, $result['id'],'associatePartners');
                $filename = $fileData['fileName'];
                $this->associatePartners->where('id', $result['id'])->update(['image' => $filename ]);
            }
            $data['status']   = 'success';
            $data['message']  = 'Associate Partners successfully Added';
        } else {
            $data['status']   = 'error';
            $data['message']  = 'error occured while updating Associate Partners';
        }
       
        return $data;
    }

    public function associatePartnersDestroy($id, $request)
    {
        $result = $this->associatePartners->where('id', $id)->update(['isdeleted'=>1]);
        if ($result) {
            $data['status']   = 'success';
            $data['message']  = 'Associate Partners successfully Deleted';
        } else {
            $data['status']   = 'error';
            $data['message']  = 'error occured while deleting Associate Partners';
        }
        return $data;

       }

       public function testimonialsIndex($request){
        $result = $this->testimonials->select('*')->where('isdeleted',0);
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
    }

    public function testimonialsDestroy($id, $request)
    {
        $result = $this->testimonials->where('id', $id)->update(['isdeleted'=>1]);
        if ($result) {
            $data['status']   = 'success';
            $data['message']  = 'Testimonial successfully Deleted';
        } else {
            $data['status']   = 'error';
            $data['message']  = 'error occured while deleting Testimonial';
        }
        return $data;

       }

       public function testimonialsStore($request)
       {
        $data = [];
        $formData       = $request->all(); 
        $description     = isset($formData['description']) ?$formData['description']: '';
        $name      = isset($formData['name']) ?$formData['name']: '';
         $insertArr = array(
                       'description'    => $description,
                       'name'           => $name,
         );
     
         $result = $this->testimonials->create($insertArr);
         if(!empty($result['id'])){
           $data['status']    = 'success';
           $data['message']   =  'Testimonials Added Succefully!';
         }else{
           $data['status']    = 'error';
           $data['message']   = 'Something went wrong! Please try again.';
         }
           return $data;
   
       }

       public function testimonialsShow($id)
       {
           $data = $jsonArr =  [];
           if (isset($id) && $id != '') {
               $data = $this->testimonials->where('id', $id)->first();
               if (isset($data) && !empty($data)) {
                   $jsonArr['id']                        = $data['id'];
                   $jsonArr['name']                     = $data['name'];
                   $jsonArr['description']                     = $data['description'];
                   $jsonArr['isdeleted']                 = $data['isdeleted'];
               }
           }
           return $jsonArr;
       }

       public function testimonialsUpdate($id, $request)
       {
           $data = [];
           $formData  =  $request->all();
           $updateArr['name']      = isset($formData['name'])?$formData['name']:'';
           $updateArr['description']   = isset($formData['description'])?$formData['description']:'';
           $result = $this->testimonials->where('id', $id)->update($updateArr);
           if ($result) {
               $data['status']   = 'success';
               $data['message']  = 'Testimonial successfully Updated';
           } else {
               $data['status']   = 'error';
               $data['message']  = 'error occured while updating Testimonial';
           }
           return $data;
       }

       public function termsconditionedit($id)
       {    
            $data = $jsonArr =  [];
             $data = $this->aboutUSManageWebsite->where('pageName','terms-condition')->first();
            if (!empty($data)) {
                    $jsonArr['id']                        = $data['id'];
                    $jsonArr['title']                     = $data['title'];
                    $jsonArr['description']               = $data['description'];
                    $jsonArr['image']                     = $data['image'];
                    $jsonArr['status']                    = $data['status'];
            }else{
                    $jsonArr['id']                    = '';
                    $jsonArr['title']                 = '';
                    $jsonArr['description']           = '';
                    $jsonArr['image']                 = '';
                    $jsonArr['status']                = '';
            }
         
           return $jsonArr;
       }

       public function privacypolicyedit($id)
       {    
            $data = $jsonArr =  [];
             $data = $this->aboutUSManageWebsite->where('pageName','privacy-policy')->first();
            if (!empty($data)) {
                    $jsonArr['id']                        = $data['id'];
                    $jsonArr['title']                     = $data['title'];
                    $jsonArr['description']               = $data['description'];
                    $jsonArr['image']                     = $data['image'];
                    $jsonArr['status']                    = $data['status'];
            }else{
                    $jsonArr['id']                    = '';
                    $jsonArr['title']                 = '';
                    $jsonArr['description']           = '';
                    $jsonArr['image']                 = '';
                    $jsonArr['status']                = '';
            }
         
           return $jsonArr;
       }


       public function whyusedit($id)
       {    
            $data = $jsonArr =  [];
             $data = $this->aboutUSManageWebsite->where('pageName','Why-work')->first();
            if (!empty($data)) {
                    $jsonArr['id']                        = $data['id'];
                    $jsonArr['title']                     = $data['title'];
                    $jsonArr['description']               = $data['description'];
                    $jsonArr['image']                     = $data['image'];
                    $jsonArr['status']                    = $data['status'];
            }else{
                    $jsonArr['id']                    = '';
                    $jsonArr['title']                 = '';
                    $jsonArr['description']           = '';
                    $jsonArr['image']                 = '';
                    $jsonArr['status']                = '';
            }
         
           return $jsonArr;
       }


       

       public function socialLinksShow($id)
       {
           $data = $jsonArr =  [];
               $data = $this->websiteSettings->first();
               if (isset($data) && !empty($data)) {
                   $jsonArr['id']                        = $data['id'];
                   $jsonArr['instagram']                 = $data['instagram'];
                   $jsonArr['linkedIn']                  = $data['linkedIn'];
                   $jsonArr['twitter']                   = $data['twitter'];
                   $jsonArr['facebook']                   = $data['facebook'];
                   $jsonArr['youTube']                   = $data['youTube'];
               }
           return $jsonArr;
       }


       public function socialLinksUpdate($id, $request)
       {
           $data = [];
           $formData  =  $request->all();
           $updateArr['instagram']      = isset($formData['instagram'])?$formData['instagram']:'';
           $updateArr['linkedIn']   = isset($formData['linkedIn'])?$formData['linkedIn']:'';
           $updateArr['youTube']   = isset($formData['youTube'])?$formData['youTube']:'';
           $updateArr['twitter']   = isset($formData['twitter'])?$formData['twitter']:'';
           $updateArr['facebook']   = isset($formData['facebook'])?$formData['facebook']:'';
           $result = $this->websiteSettings->where('id', $id)->update($updateArr);
           if ($result) {
               $data['status']   = 'success';
               $data['message']  = 'Social Links successfully Updated';
           } else {
               $data['status']   = 'error';
               $data['message']  = 'error occured while updating Social Links';
           }
           return $data;
       }


       public function homepageSliderIndex($request){
        $result = $this->homepageSlider->select('*')->where('isdeleted',0);
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
    }

    public function homepageSliderStore($request)
    {
        $data = [];
        $formData = json_decode($request->input('formData'));
        $insertArr['image'] =  '';
        $result = $this->homepageSlider->create($insertArr);
        if ($result) {
            if (!empty($_FILES['file']) && $_FILES['file']['size'] > 0 && $request->file('file'))
            {
                $fileData = $this->SingleFileUpload($request, $result['id'],'homepageSlider');
                $filename = $fileData['fileName'];
                $this->homepageSlider->where('id', $result['id'])->update(['image' => $filename ]);
            }
            $data['status']   = 'success';
            $data['message']  = 'Home Page Slider successfully Added';
        } else {
            $data['status']   = 'error';
            $data['message']  = 'error occured while updating Home Page Slider';
        }
       
        return $data;
    }

    public function homepageSliderDestroy($id, $request)
    {
        $result = $this->homepageSlider->where('id', $id)->update(['isdeleted'=>1]);
        if ($result) {
            $data['status']   = 'success';
            $data['message']  = 'Home Page Slider successfully Deleted';
        } else {
            $data['status']   = 'error';
            $data['message']  = 'error occured while deleting Home Page Slider';
        }
        return $data;

       }



       
}