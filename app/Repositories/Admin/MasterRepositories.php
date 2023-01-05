<?php

namespace App\Repositories\Admin;
use App\Models\SitesModel;
use App\Models\UserAgencyDetailsModel;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Auth;
use App\Models\RoleAdminModel;
use App\Models\EquipmentsMaster;
use App\Models\ServicesMaster;
use App\Models\TypesMaster;
use App\Models\AvailabilityMaster;
use App\Models\FeesMaster;

use File;
class MasterRepositories
{
   public function __construct(AvailabilityMaster $availabilityModel, TypesMaster $typesModel, ServicesMaster $servicesModel, EquipmentsMaster $equipmentsModel, UserModel $user, RoleAdminModel $roleAdminModel, FeesMaster $fees_model)
   {
      $this->UserModel = $user;
      $this->per_page = per_page();
      $this->roleAdminModel = $roleAdminModel;
      $this->equipmentsModel = $equipmentsModel;
      $this->servicesModel = $servicesModel;
      $this->typesModel = $typesModel;
      $this->availabilityModel = $availabilityModel;
      $this->FeesModel = $fees_model;
   }

   //equipmant
   public function equipmentsIndex($request)
   {
      $keyword = $request->get('keyword');
      $result = $this->equipmentsModel->select('*')->where('isdeleted', 0);
      if ($request->get('keyword')) {
         $result = $result->whereRaw("(equipment_name LIKE '%" . $keyword . "%')");
      }
      $result = $result->orderBy('id', 'DESC')->paginate($this->per_page);
      if (isset($result) && !empty($result)) {
         $data = $result->ToArray();
         if (isset($data) && !empty($data)) {
            foreach ($data['data'] as $key => $value) {
            }
         }
         return $data;
      }
   }

   public function equipmentsShow($id)
   {
      $data = $jsonArr = [];
      if (isset($id) && $id != '') {
         $data = $this->equipmentsModel->where('id', $id)->first();
         if (isset($data) && !empty($data)) {
            $jsonArr['id'] = $data['id'];
            $jsonArr['equipment_name'] = $data['equipment_name'];
            $jsonArr['isactive'] = $data['isactive'];
            $jsonArr['isdeleted'] = $data['isdeleted'];
         }
      }
      return $jsonArr;
   }

   public function equipmentsStore($request)
   {
      $data = [];
      $formData = $request->all();
      $equipment_name = isset($formData['equipment_name']) ? $formData['equipment_name'] : '';
      $isactive = isset($formData['isactive']) ? $formData['isactive'] : '';
      $insertArr = [
         'equipment_name' => $equipment_name,
         'isactive' => $isactive,
      ];
      $result = $this->equipmentsModel->create($insertArr);
      if (!empty($result['id'])) {
         $data['status'] = 'success';
         $data['message'] = 'Equipments Added Succefully!';
      } else {
         $data['status'] = 'error';
         $data['message'] = 'Something went wrong! Please try again.';
      }
      return $data;
   }

   public function equipmentsUpdate($id, $request)
   {
      $data = [];
      $formData = $request->all();
      $updateArr['equipment_name'] = isset($formData['equipment_name']) ? $formData['equipment_name'] : '';
      $updateArr['isactive'] = isset($formData['isactive']) ? $formData['isactive'] : '';
      $result = $this->equipmentsModel->where('id', $id)->update($updateArr);
      if ($result) {
         $data['status'] = 'success';
         $data['message'] = 'Equipments successfully Updated';
      } else {
         $data['status'] = 'error';
         $data['message'] = 'error occured while updating Equipments';
      }
      return $data;
   }

   public function equipmentsDestroy($id, $request)
   {
      $result = $this->equipmentsModel->where('id', $id)->update(['isdeleted' => 1]);
      if ($result) {
         $data['status'] = 'success';
         $data['message'] = 'Equipments successfully Deleted';
      } else {
         $data['status'] = 'error';
         $data['message'] = 'error occured while deleting Equipments';
      }
      return $data;
   }
   //end equipmant

   //Fees Master
   public function feesIndex($request)
   {
      $keyword = $request->get('keyword');
      $result = $this->FeesModel->select('*')->where('isdeleted', 0);
      if ($request->get('keyword')) {
         // $result = $result->where("(equipment_name LIKE '%" . $keyword . "%')");
      }
      $result = $result->orderBy('id', 'DESC')->paginate($this->per_page);
      if (isset($result) && !empty($result)) {
         $data = $result->ToArray();
         if (isset($data) && !empty($data)) {
            foreach ($data['data'] as $key => $value) {
            }
         }
         return $data;
      }
   }

   public function feesShow($id)
   {
      $data = $jsonArr = [];
      if (isset($id) && $id != '') {
         $data = $this->FeesModel->where('id', $id)->first();
         if (isset($data) && !empty($data)) {
            $jsonArr['id'] = $data['id'];
            $jsonArr['visitType'] = $data['visitType'];
            $jsonArr['betweenKm'] = $data['betweenKm'];
            $jsonArr['amount'] = $data['amount'];
            $jsonArr['status'] = $data['status'];
            $jsonArr['isDeleted'] = $data['isDeleted'];
         }
      }
      return $jsonArr;
   }

   public function feesStore($request)
   {
      $data = [];
      $formData = $request->all();      

      $visitType  = isset($formData['visitType']) ? $formData['visitType'] : '';
      $betweenKm  = isset($formData['betweenKm']) ? $formData['betweenKm'] : '';
      $amount     = isset($formData['amount']) ? $formData['amount'] : '';
      $status     = isset($formData['status']) ? $formData['status'] : '';

      $insertArr = [
         'visitType' => $visitType,
         'betweenKm' => $betweenKm,
         'amount'    => $amount,
         'status'    => $status,
      ];
      $result = $this->FeesModel->create($insertArr);
      if (!empty($result['id'])) {
         $data['status'] = 'success';
         $data['message'] = 'Fees Added Succefully!';
      } else {
         $data['status'] = 'error';
         $data['message'] = 'Something went wrong! Please try again.';
      }
      return $data;
   }

   public function feesUpdate($id, $request)
   {
      $data = [];
      $formData = $request->all();

      $updateArr['visitType'] = isset($formData['visitType']) ? $formData['visitType'] : '';
      $updateArr['betweenKm'] = isset($formData['betweenKm']) ? $formData['betweenKm'] : '';
      $updateArr['amount']    = isset($formData['amount']) ? $formData['amount'] : '';
      $updateArr['status']    = isset($formData['status']) ? $formData['status'] : '';

      $result = $this->FeesModel->where('id', $id)->update($updateArr);
      if ($result) {
         $data['status'] = 'success';
         $data['message'] = 'Fees successfully Updated';
      } else {
         $data['status'] = 'error';
         $data['message'] = 'error occured while updating Fees';
      }
      return $data;
   }

   public function feesDestroy($id, $request)
   {
      $result = $this->FeesModel->where('id', $id)->update(['isDeleted' => 1]);
      if ($result) {
         $data['status'] = 'success';
         $data['message'] = 'Fees successfully Deleted';
      } else {
         $data['status'] = 'error';
         $data['message'] = 'error occured while deleting Fees';
      }
      return $data;
   }
   //end Fees Master

   // start service

   public function serviceIndex($request)
   {
      $keyword = $request->get('keyword');
      $result = $this->servicesModel->select('*')->where('isdeleted', 0);
      if ($request->get('keyword')) {
         $result = $result->whereRaw("(service_name LIKE '%" . $keyword . "%')");
      }
      $result = $result->orderBy('id', 'DESC')->paginate($this->per_page);
      if (isset($result) && !empty($result)) {
         $data = $result->ToArray();
         if (isset($data) && !empty($data)) {
            foreach ($data['data'] as $key => $value) {
            }
         }
         return $data;
      }
   }

   public function serviceShow($id)
   {
      $data = $jsonArr = [];
      if (isset($id) && $id != '') {
         $data = $this->servicesModel->where('id', $id)->first();
         if (isset($data) && !empty($data)) {
            $jsonArr['id'] = $data['id'];
            $jsonArr['service_name'] = $data['service_name'];
            $jsonArr['description'] = $data['description'];
            $jsonArr['image_name'] = $data['image_name'];
            $jsonArr['isactive'] = $data['isactive'];
            $jsonArr['isdeleted'] = $data['isdeleted'];
         }
      }
      return $jsonArr;
   }
   public function serviceStore($request)
   {
      $data = [];
      $formData = json_decode($request->input('formData'));
      $formData = (array) $formData;
      $service_name = isset($formData['service_name']) ? $formData['service_name'] : '';
      $description = isset($formData['description']) ? $formData['description'] : '';
      $isactive = isset($formData['isactive']) ? $formData['isactive'] : '';
      $insertArr = [
         'service_name' => $service_name,
         'description' => $description,
         'isactive' => $isactive,
      ];
      $result = $this->servicesModel->create($insertArr);

      if (!empty($result['id'])) {
         if (!empty($_FILES['file']) && $_FILES['file']['size'] > 0 && $request->file('file')) {
            $fileData = $this->SingleFileUpload($request, $result['id'], 'service');
            $filename = $fileData['fileName'];
            $this->servicesModel->where('id', $result['id'])->update(['image_name' => $filename]);
         }

         $data['status'] = 'success';
         $data['message'] = 'Service Added Succefully!';
      } else {
         $data['status'] = 'error';
         $data['message'] = 'Something went wrong! Please try again.';
      }
      return $data;
   }
   public function serviceUpdate($id, $request)
   {
      $data = [];
      $formData = json_decode($request->input('formData'));
      $formData = (array) $formData;
      $updateArr['service_name'] = isset($formData['service_name']) ? $formData['service_name'] : '';
      $updateArr['description'] = isset($formData['description']) ? $formData['description'] : '';
      $updateArr['isactive'] = isset($formData['isactive']) ? $formData['isactive'] : '';
      // dd($updateArr);
      $result = $this->servicesModel->where('id', $id)->update($updateArr);

      if ($result) {
         if (!empty($_FILES['file']) && $_FILES['file']['size'] > 0 && $request->file('file')) {
            $fileData = $this->SingleFileUpload($request, $id, 'service');
            $filename = $fileData['fileName'];
            $this->servicesModel->where('id', $id)->update(['image_name' => $filename]);
         }

         $data['status'] = 'success';
         $data['message'] = 'Services successfully Updated';
      } else {
         $data['status'] = 'error';
         $data['message'] = 'error occured while updating Services';
      }
      return $data;
   }
   public function serviceDestroy($id, $request)
   {
      $result = $this->servicesModel->where('id', $id)->update(['isdeleted' => 1]);
      if ($result) {
         $data['status'] = 'success';
         $data['message'] = 'Services successfully Deleted';
      } else {
         $data['status'] = 'error';
         $data['message'] = 'error occured while deleting Services';
      }
      return $data;
   }

   public function getServiceList($request)
   {
      $keyword = $request->get('keyword');
      $result = $this->servicesModel->select('*')->where('isdeleted', 0);
      if ($request->get('keyword')) {
         $result = $result->whereRaw("(service_name LIKE '%" . $keyword . "%')");
      }
      $result = $result->orderBy('id', 'DESC')->get();
      if (isset($result) && !empty($result)) {
         //$data = $result->ToArray();
         if (isset($result) && !empty($result)) {
            /*foreach ($data['data'] as $key => $value) {
                }*/
         }
         return $result;
      }
   }

   //End service

   ///strat type

   public function typesIndex($request)
   {
      $keyword = $request->get('keyword');
      $result = $this->typesModel->select('*')->where('isdeleted', 0);
      if ($request->get('keyword')) {
         $result = $result->whereRaw("(type_name LIKE '%" . $keyword . "%')");
      }
      $result = $result->orderBy('id', 'DESC')->paginate($this->per_page);
      if (isset($result) && !empty($result)) {
         $data = $result->ToArray();
         if (isset($data) && !empty($data)) {
            foreach ($data['data'] as $key => $value) {
            }
         }
         return $data;
      }
   }
   public function typesShow($id)
   {
      $data = $jsonArr = [];
      if (isset($id) && $id != '') {
         $data = $this->typesModel->where('id', $id)->first();
         if (isset($data) && !empty($data)) {
            $jsonArr['id'] = $data['id'];
            $jsonArr['type_name'] = $data['type_name'];
            $jsonArr['isactive'] = $data['isactive'];
            $jsonArr['isdeleted'] = $data['isdeleted'];
         }
      }
      return $jsonArr;
   }
   public function typesStore($request)
   {
      $data = [];
      $formData = $request->all();
      $type_name = isset($formData['type_name']) ? $formData['type_name'] : '';
      $isactive = isset($formData['isactive']) ? $formData['isactive'] : '';
      $insertArr = [
         'type_name' => $type_name,
         'isactive' => $isactive,
      ];
      $result = $this->typesModel->create($insertArr);
      if (!empty($result['id'])) {
         $data['status'] = 'success';
         $data['message'] = 'Types Added Succefully!';
      } else {
         $data['status'] = 'error';
         $data['message'] = 'Something went wrong! Please try again.';
      }
      return $data;
   }
   public function typesUpdate($id, $request)
   {
      $data = [];
      $formData = $request->all();
      $updateArr['type_name'] = isset($formData['type_name']) ? $formData['type_name'] : '';
      $updateArr['isactive'] = isset($formData['isactive']) ? $formData['isactive'] : '';
      $result = $this->typesModel->where('id', $id)->update($updateArr);
      if ($result) {
         $data['status'] = 'success';
         $data['message'] = 'Types successfully Updated';
      } else {
         $data['status'] = 'error';
         $data['message'] = 'error occured while updating Types';
      }
      return $data;
   }
   public function typesDestroy($id, $request)
   {
      $result = $this->typesModel->where('id', $id)->update(['isdeleted' => 1]);
      if ($result) {
         $data['status'] = 'success';
         $data['message'] = 'Types successfully Deleted';
      } else {
         $data['status'] = 'error';
         $data['message'] = 'error occured while deleting Types';
      }
      return $data;
   }

   public function getTypesList($request)
   {
      $keyword = $request->get('keyword');
      $result = $this->typesModel->select('*')->where('isdeleted', 0);
      if ($request->get('keyword')) {
         $result = $result->whereRaw("(type_name LIKE '%" . $keyword . "%')");
      }
      $result = $result->orderBy('id', 'DESC')->get();
      if (isset($result) && !empty($result)) {
         //$data = $result->ToArray();
         if (isset($result) && !empty($result)) {
            /*foreach ($data['data'] as $key => $value) {
                }*/
         }
         return $result;
      }
   }

   //End types

   //start Availability

   public function availabilityIndex($request)
   {
      $keyword = $request->get('keyword');
      $result = $this->availabilityModel->select('*')->where('isdeleted', 0);
      if ($request->get('keyword')) {
         $result = $result->whereRaw("(time_from LIKE '%" . $keyword . "%')");
      }
      $result = $result->orderBy('id', 'DESC')->paginate($this->per_page);
      if (isset($result) && !empty($result)) {
         $data = $result->ToArray();
         if (isset($data) && !empty($data)) {
            foreach ($data['data'] as $key => $value) {
               $data['data'][$key]['time_from'] = date("h:i A", strtotime($value['time_from']));
               $data['data'][$key]['time_to'] = date("h:i A", strtotime($value['time_to']));
            }
            return $data;
         }
      }
   }
   public function availabilityShow($id)
   {
      $data = $jsonArr = [];
      if (isset($id) && $id != '') {
         $data = $this->availabilityModel->where('id', $id)->first();
         if (isset($data) && !empty($data)) {
            $jsonArr['id'] = $data['id'];
            $jsonArr['time_from'] = date("h:i A", strtotime($data['time_from']));
            $jsonArr['time_to'] = date("h:i A", strtotime($data['time_to']));
            $jsonArr['isactive'] = $data['isactive'];
            $jsonArr['isdeleted'] = $data['isdeleted'];
         }
      }
      return $jsonArr;
   }
   public function availabilityStore($request)
   {
      $data = [];
      $formData = $request->all();
      $time_from = isset($formData['time_from']) ? $formData['time_from'] : '';
      $isactive = isset($formData['isactive']) ? $formData['isactive'] : '';
      $time_to = isset($formData['time_to']) ? $formData['time_to'] : '';
      $insertArr = [
         'time_from' => date("h:i:s", strtotime($time_from)),
         'time_to' => date("h:i:s", strtotime($time_to)),
         'isactive' => $isactive,
      ];
      $result = $this->availabilityModel->create($insertArr);
      if (!empty($result['id'])) {
         $data['status'] = 'success';
         $data['message'] = 'Types Added Succefully!';
      } else {
         $data['status'] = 'error';
         $data['message'] = 'Something went wrong! Please try again.';
      }
      return $data;
   }
   public function availabilityUpdate($id, $request)
   {
      $data = [];
      $formData = $request->all();
      $updateArr['time_from'] = isset($formData['time_from']) ? date("H:i:s", strtotime($formData['time_from'])) : '';
      $updateArr['isactive'] = isset($formData['isactive']) ? $formData['isactive'] : '';
      $updateArr['time_to'] = isset($formData['time_to']) ? date("H:i:s", strtotime($formData['time_to'])) : '';

      // dd($updateArr, $formData);
      $result = $this->availabilityModel->where('id', $id)->update($updateArr);
      if ($result) {
         $data['status'] = 'success';
         $data['message'] = 'Types successfully Updated';
      } else {
         $data['status'] = 'error';
         $data['message'] = 'error occured while updating Types';
      }
      return $data;
   }
   public function availabilityDestroy($id, $request)
   {
      $result = $this->availabilityModel->where('id', $id)->update(['isdeleted' => 1]);
      if ($result) {
         $data['status'] = 'success';
         $data['message'] = 'Types successfully Deleted';
      } else {
         $data['status'] = 'error';
         $data['message'] = 'error occured while deleting Types';
      }
      return $data;
   }
   public function getAvailabilityList($request)
   {
      $keyword = $request->get('keyword');
      $result = $this->availabilityModel->select('*')->where('isdeleted', 0);
      if ($request->get('keyword')) {
         $result = $result->whereRaw("(time_from LIKE '%" . $keyword . "%')");
      }
      $result = $result->orderBy('id', 'DESC')->get();
      if (isset($result) && !empty($result)) {
         //$data = $result->ToArray();
         if (isset($result) && !empty($result)) {
            foreach ($result as $key => $value) {
               $result[$key]['time_from'] = date("h:i A", strtotime($value['time_from']));
               $result[$key]['time_to'] = date("h:i A", strtotime($value['time_to']));
            }
         }
         return $result;
      }
   }

   function SingleFileUpload($request, $id, $folderName)
   {
      if ($request->file('file')) {
         $formData = json_decode($request->input('formData'));

         $file = $request->file('file');
         $extension = $file->getClientOriginalExtension();
         $fileName = 'file_' . time() . '.' . $extension;
         $destinationPath = public_path('uploads/' . $folderName . '/' . $id);
         if (!file_exists($destinationPath) and !is_dir($destinationPath)) {
            File::makeDirectory($destinationPath, $mode = 0777, true, true);
         }
         $file->move($destinationPath, $fileName);
         $json_arr['fileName'] = $fileName;

         return $json_arr;
      }
   }
   public function dateTimeArr($request)
   {
    $result= array();
    $datetime = array(1=>'06:00 AM','07:00 AM','08:00 AM','09:00 AM','10:00 AM','11:00 AM','12:00 PM','01:00 PM','02:00 PM','03:00 PM','04:00 PM','05:00 PM','06:00 PM','07:00 PM','08:00 PM','09:00 PM','10:00 PM','11:00 PM','12:00 AM','01:00 AM','02:00 AM','03:00 AM','04:00 AM','05:00 AM');
    $result['datetimeArr'] = $datetime;
    return  $result;
   }
}
