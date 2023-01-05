<?php
    use App\Models\Role;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Permission;
    use App\Models\EmailSettings;

    function chk_permission($tab,$slug=false)
    {
        $json_arr=array();


        if ($tab == 'user' ) 
        {
            $json_arr['add']                = true;
            $json_arr['edit']               = true;
            $json_arr['delete']             = true;
            $json_arr['list']               = true;
            $json_arr['change_password']    = true;

            if(Gate::denies($tab.'_add')){
                $json_arr['add']   = false;
            }
            
            if(Gate::denies($tab.'_edit')) {
                $json_arr['edit']   = false;
            }
            
            if(Gate::denies($tab.'_delete')) {
                $json_arr['delete']   = false;
            }

            if(Gate::denies($tab.'_list')) {
                $json_arr['list']   = false;
            }

            if(Gate::denies($tab.'_change_password')) {
                $json_arr['change_password']   = false;
            }

        }  

        if ($tab == 'role' ) 
        {
            $json_arr['add']            = true;
            $json_arr['edit']           = true;
            $json_arr['delete']         = true;
            $json_arr['list']           = true;

            if(Gate::denies($tab.'_add')){
                $json_arr['add']   = false;
            }
            
            if(Gate::denies($tab.'_edit')) {
                $json_arr['edit']   = false;
            }
            
            if(Gate::denies($tab.'_delete')) {
                $json_arr['delete']   = false;
            }
        }    

        return $json_arr;  
    }

    function mailConfig()
    {
        $data = EmailSettings::select('id','type','smtpHost','smtpUser','smtpPassword','smtpPort','smtpEncryption','smtpDriver','smtpSendmail','smtpPretend','smtpFromAddress','smtpFromName')->where('type','support')->first();

        if(isset($data) && !empty($data)){
            $mailConfig= [
                'driver'        => 'smtp',
                'host'          => $data['smtpHost'],
                'port'          => $data['smtpPort'],
                'from'          => array('address' => $data['smtpFromAddress'], 'name' => $data['smtpFromName']),
                'username'      => $data['smtpUser'],
                'password'      => $data['smtpPassword'],
                'encryption'    => $data['smtpEncryption'],
                'sendmail'      => '/usr/sbin/sendmail -bs',
                'pretend'       => false,
            ];
        }else{
            $mailConfig= [
                'driver'        => 'smtp',
                'host'          => 'email-smtp.eu-west-1.amazonaws.com',
                'port'          => 587,
                'from'          => array('address' => 'yogesh@testqtech.com', 'name' => 'UYR-DOCTORS'),
                'username'      => 'AKIAXAS7RYFEN5MFQF7M',
                'password'      => 'BPx3DeKg87l7P2rR9DJQJeyGFv8wKDDXAotHvIpZ79P7',
                'encryption'    => 'tls',
                'sendmail'      => '/usr/sbin/sendmail -bs',
                'pretend'       => false,
            ];
        }
            return $mailConfig;
    }


   function per_page(){
        return 20;
    }

    function dateFormate($date){
        return date("d F, Y", strtotime($date));
    }

    function timeFormate($time){
        return date("g:i A", strtotime($time));
    }

    function timeArray(){
        return [1=>
        '06:00 AM',
        '06:30 AM',
        '07:00 AM',
        '07:30 AM',
        '08:00 AM',
        '08:30 AM',
        '09:00 AM',
        '09:30 AM',
        '10:00 AM',
        '10:30 AM',
        '11:00 AM',
        '11:30 AM',
        '12:00 PM',
        '12:30 PM',
        '01:00 PM',
        '01:30 PM',
        '02:00 PM',
        '02:30 PM',
        '03:00 PM',
        '03:30 PM',
        '04:00 PM',
        '04:30 PM',
        '05:00 PM',
        '05:30 PM',
        '06:00 PM',
        '06:30 PM',
        '07:00 PM',
        '07:30 PM',
        '08:00 PM',
        '08:30 PM',
        '09:00 PM',
        '09:30 PM',
        '10:00 PM',
        '10:30 PM',
        '11:00 PM',
        '11:30 PM',
        '12:00 AM',
        '12:30 AM',
        '01:00 AM',
        '01:30 AM',
        '02:00 AM',
        '02:30 AM',
        '03:00 AM',
        '03:30 AM',
        '04:00 AM',
        '04:30 AM',
        '05:00 AM',
        '05:30 AM'];
    }

   /* function dateTimeFormate($date,$time){
        return date("M-d-Y", strtotime($date));
    }*/

     function convertDate($chkdt){

        //$chkdt = "Wed Jun 15 2011 00:00:00 GMT 0530 (India Standard Time)";
        $month = substr($chkdt,4,3);
        if($month == 'Jan') $month = '01';
        else if($month == 'Feb') $month = '02';
        else if($month == 'Mar') $month = '03';
        else if($month == 'Apr') $month = '04';
        else if($month == 'May') $month = '05';
        else if($month == 'Jun') $month = '06';
        else if($month == 'Jul') $month = '07';
        else if($month == 'Aug') $month = '08';
        else if($month == 'Sep') $month = '09';
        else if($month == 'Oct') $month = '10';
        else if($month == 'Nov') $month = '11';
        else if($month == 'Dec') $month = '12';
        
        $date = substr($chkdt,7,3);
        $year = substr($chkdt,10,5);
       return $finaldt = date("Y-m-d", mktime(0, 0, 0, $month, $date, $year));
    }


    function distance($lat1, $lon1, $lat2, $lon2, $unit) {
      if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        return 0;
      }
      else {

        if (strpos($lon1, '-') !== false) $lon1 = $lon1; else $lon1 =  '-'.$lon1;
        if (strpos($lon2, '-') !== false) $lon2 = $lon2; else $lon2 =  '-'.$lon2;

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
          return ($miles * 1.609344);
        } else if ($unit == "N") {
          return ($miles * 0.8684);
        } else {
          return $miles;
        }
      }
    }


function checkPermission($slug){
    $user = auth()->user();
    $role_id = $user['role_type'];
    $arg = [];
    if(isset($role_id) && !empty($role_id)){
        $result = Role::with(['permission'])->findOrFail($role_id);
           foreach($result->permission as $row){
                array_push($arg,$row['id']);
           }
       }
        $parent_tabs = Permission::select('*')->where('status',1)->where('is_menu',1)->orderBy('order', 'ASC')->get()->toArray();
          $permissionData=array();
          if (isset($parent_tabs)) 
          {
            foreach($parent_tabs as $key=>$row){
                if(in_array($row['id'], $arg))
                   $permissionData[] = $row['slug'];

                /*foreach($child_tabs as $key1=> $row1)
                {
                 if(in_array($row1['id'], $arg))
                  $data[$key]['child'][$key1] = $row1;
                }*/
            }
          }
        if (in_array($slug, $permissionData)) return true;
}

function medicalhistory(){
    $medicalHistory = array("Alcohol"=>"Alcohol",
    "Drug Abuse"=>"Drug Abuse",
    "Joint Disease/Injury"=>"Joint Disease/Injury",
    "Anemia"=>"Anemia",
    "Ear Trouble /Hearing Loss"=>"Ear Trouble /Hearing Loss",
    "Measles - Red"=>"Measles  Red",
    "Arthritis"=>"Arthritis",
    "Eating Disorder"=>"Eating Disorder",
    "Migraine Headaches"=>"Migraine Headaches",
    "Asthma"=>"Asthma",
    "Eye Disease/Problems"=>"Eye Disease/Problems",
    "MononucleosisInfectious"=>"",
    "Back Problems"=>"Back Problems",
    "Gallbladder Trouble"=>"Gallbladder Trouble",
    "Mumps"=>"Mumps",
    "Cancer"=>"Cancer",
    "Hay Fever (Recurrent)"=>"Hay Fever (Recurrent)",
    "Paralysis"=>"Paralysis",
    "Chicken Pox"=>"Chicken Pox",
    "Head Injury"=>"Head Injury",
    "Pneumonia"=>"Pneumonia",
    "Colitis"=>"Colitis",
    "Headache (Recurrent)"=>"Headache (Recurrent)",
    "Polio"=>"Polio",
    "Convulsions/Seizures"=>"Convulsions/Seizures",
    "Heart Disease/Problem"=>"Heart Disease/Problem",
    "Psychological Counseling"=>"Psychological Counseling",
    "Cough (Chronic)"=>"Cough (Chronic)",
    "Hepatitis/Jaundice"=>"Hepatitis/Jaundice",
    "Rheumatic Fever"=>"Rheumatic Fev ",
    "Depression"=>"Depression",
    "Hernia /Rupture"=>"Hernia /Rupture",
    "Rubella (3 Day Measles)"=>"Rubella (3 Day Measles)",
    "Diabetes"=>"Diabetes",
    "High Blood Pressure"=>"High Blood Pressure",
    "Scarlet Fever"=>"Scarlet Fever",
    "Disability/Handicapped"=>"Disability/Handicapped",
    "intestinal/stomach Trouble"=>"intestinal/stomach Trouble",
    "Sexually Transmitted Disease (STD)"=>"Sexually Transmitted Disease (STD)");
    return  $medicalHistory;
}
