<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('validateLogin',        'AuthController@validateLogin');
    Route::post('login',                'Auth\LoginController@login');
    Route::post("register",             "Auth\RegisterController@register");
    Route::post("registerDoctor",       "Auth\RegisterController@registerDoctor");
    Route::post("forgotPassword",       "Auth\RegisterController@forgotPassword");
    Route::post("resetPassword",        "Auth\RegisterController@resetPassword");
    Route::post("validateOtp",                  "Auth\RegisterController@validateOtp");
    Route::post("resendOtp",                    "Auth\RegisterController@resendOtp");
    Route::post("checkIfAlreadyVerified/{id}",  "Auth\RegisterController@checkIfAlreadyVerified");

});



Route::group(['middleware' => 'api'], function ($router) {
        Route::get('menu', 'MenuController@index');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('returnMyorder', 'CronController@returnMyorder');
        Route::get('front/gethomePageData', 'FrontController@gethomePageData');
        Route::get("front/getArticalview/{id}", "FrontController@getArticalview");   
        Route::post("front/insertContactus", "FrontController@insertContactus");
        Route::post("front/insertCareerForm", "FrontController@insertCareerForm");
     //MASTERS
     Route::get("manageWebsite/termsconditionedit/{id}", "Admin\ManageWebsite\AboutUsController@termsconditionedit");    
     Route::get("manageWebsite/privacypolicyedit/{id}", "Admin\ManageWebsite\AboutUsController@privacypolicyedit");    
     Route::get("manageWebsite/whyusedit/{id}", "Admin\ManageWebsite\AboutUsController@whyusedit");    
     

     Route::group(['prefix'=>'manageWebsite'], function () 
     {
         Route::apiResource("contactUs", "Admin\ManageWebsite\ContactUsController");
         Route::apiResource("faq", "Admin\ManageWebsite\FaqController");
         Route::apiResource("aboutUs", "Admin\ManageWebsite\AboutUsController");
         Route::post('aboutUs/update/{id}', 'Admin\ManageWebsite\AboutUsController@update');
         Route::apiResource("blog", "Admin\ManageWebsite\BlogController");
         Route::post("blog/update/{id}", "Admin\ManageWebsite\BlogController@update");
         //manageWebsite/aboutUs
         Route::apiResource("associate_partners", "Admin\ManageWebsite\AssociatePartners");
        
         Route::apiResource("socialLinks", "Admin\ManageWebsite\SocialLinksController");
         Route::apiResource("homepage_slider", "Admin\ManageWebsite\HomepageSlider");
         Route::apiResource("testimonials", "Admin\ManageWebsite\TestimonialsController");
         
         
         
         
    });

    Route::group(['prefix'=>'masters'], function () 
    {
        // CONTACT US
       // Route::group(['prefix'=>'contactUsMaster'], function () 
       // {
            // Route::get('contactUsList',           'Admin\Master\ContactUsMasterController@index');
            // Route::get('getData/{id}',             'Admin\Master\ContactUsMasterController@getData');
            // Route::post('contactUsForm/{id}',    'Admin\Master\ContactUsMasterController@contactUsForm');
            // Route::post('delete/{id}',    'Admin\Master\ContactUsMasterController@destroy');
       // });//

        // FAQs
        // EQUIPMENTS
            Route::apiResource("equipment", "Admin\Master\EquipmentMasterController");
            Route::apiResource("service", "Admin\Master\ServiceMasterController");
            Route::post("service/update/{id}", "Admin\Master\ServiceMasterController@update");
            Route::apiResource("types", "Admin\Master\TypeMasterController");            
            Route::get('getTypesList', 'Admin\Master\TypeMasterController@getTypesList');
            Route::get('getServiceList', 'Admin\Master\ServiceMasterController@getServiceList');
            Route::apiResource("availability", "Admin\Master\AvailabilityMasterController");
            Route::get('getAvailabilityList', 'Admin\Master\AvailabilityMasterController@getAvailabilityList');
            Route::get('dateTimeArr', 'Admin\Master\AvailabilityMasterController@dateTimeArr');
            Route::apiResource("fees", "Admin\Master\FeesMasterController");
   
        });
    });


Route::group(["middleware" => "auth:api"], function () {
    // DOCTOR ROUTES
        $user = Auth::user();
        Route::get("/get_user", "Settings\ProfileController@get_user");
        Route::post("settings/save_profile","Settings\ProfileController@save_profile");
        Route::post("settings/save_profile_photo","Settings\ProfileController@save_profile_photo");
        Route::post("settings/save_profile_photo","Settings\ProfileController@save_profile_photo");
        Route::get('settings/getBankDetails', "Settings\ProfileController@getBankDetails");
        Route::post('settings/addBankDetails/{id}', "Settings\ProfileController@addBankDetails");
        
        Route::get('settings/getAppointmentSlot', "Settings\ProfileController@getAppointmentSlot");
        Route::post('settings/submitTimeSlotForm/{id}', "Settings\ProfileController@submitTimeSlotForm");

        Route::get('left_menus', 'LeftMenusController@index');
        Route::post('logout', 'AuthController@logout');

        Route::apiResource("doctor", "DoctorController");
        Route::get('doctor/getDoctorProfile/{id}', 'DoctorController@getDoctorProfile');
        Route::get('doctor/change_account_status/{id}', 'DoctorController@change_account_status');
        Route::post('doctor/updateDoctor/{id}', 'DoctorController@updateDoctor');
        Route::get('doctor/getPatientAppointment/{appontment_id}', 'DoctorController@getPatientAppointment');
        Route::post('doctor/patientMedicalReport/{id}', 'DoctorController@patientMedicalReport');
        Route::post('doctor/deleteMedicalReport/{id}', 'DoctorController@deleteMedicalReport');
        Route::get('doctor/getPatientDoctorinfoAppointment/{appontment_id}', 'DoctorController@getPatientDoctorinfoAppointment');
        Route::post('doctor/patientPrescriptionAdd/{appontment_id}', 'DoctorController@patientPrescriptionAdd');
        Route::get('doctor/getPrescriptionData/{appontment_id}', 'DoctorController@getPrescriptionData');
        Route::get('doctors/doctor_booking_slot', 'DoctorController@doctor_booking_slot');
        Route::get('getEquipmentList', 'DoctorController@getEquipmentList');


        
        
        Route::get("careers/updateStatus/{id}", "CareersController@updateStatus");
        Route::apiResource("careers", "CareersController");
        Route::apiResource("enquiry", "EnquiryController");
        
        Route::apiResource("mediatorDoctor", "MediatorDoctorController");
        Route::post('mediatorDoctor/updateMediator/{id}', 'MediatorDoctorController@updateMediator');

        // EMAIL SETTINGS
        Route::apiResource('emailSettings', 'EmailSettingsController');
        Route::get('emailSettings/getEmailSettings', 'EmailSettingsController@show');

        // USERS ROUTES
        Route::apiResource("users", "UsersController");
        Route::get('user', 'UsersController@fetchUser');
        Route::get('users/getRoles', 'UsersController@getRoles');
        Route::get("users/delete/{id}", "UsersController@destroy");
        Route::get('users/show/{id}', 'UsersController@show');
        Route::post('users/changePassword/{id}', 'UsersController@changePassword');
        Route::post('users/profileSettings/{id}', 'UsersController@profileSettings');

        Route::apiResource("admin", "AdminController");
        Route::get("admin/delete/{id}", "UsersController@destroy");


        // SALES ROUTES
        Route::apiResource("sales", "SalesController");
        Route::get('sales/show/{id}', 'SalesController@show');
        Route::get("sales/delete/{id}", "SalesController@destroy");
        Route::get('sales/getRoles', 'SalesController@getRoles');
        Route::get('sales/getsalesdata/{id}', 'SalesController@getSalesData');
        Route::post('sales/updatesales/{id}', 'SalesController@update');
        Route::post('sales/changePassword/{id}', 'SalesController@changePassword');
        Route::post('sales/profileSettings/{id}', 'SalesController@profileSettings');

        // PATIENT ROUTES
        Route::apiResource("patients", "PatientsController");
        Route::get('patient/searchDoctor', 'PatientsController@searchDoctor');
        Route::post('patients/updatePatients/{id}', 'PatientsController@updatePatients');
        Route::post('patients/suggestDoctor/{id}', 'PatientsController@suggestDoctor');
        Route::get('patients/details/{id}', 'PatientsController@details');
        Route::get('patients/getdoctorData/{id}', 'PatientsController@getdoctorData');
        Route::get('patients/getFavDoctorData/{id}', 'PatientsController@getFavDoctorData');
        
        Route::get('getPatientsList', 'PatientsController@getPatientsList');
        Route::post('patients/bookingRequest', 'PatientsController@bookingRequest');
        Route::get('getFavoriteDoctorList', 'PatientsController@getFavoriteDoctorList');
        Route::get('favoriteStatusChange', 'PatientsController@favoriteStatusChange');
            
        
        //ROLES ROUTES

        Route::get('/requestAppointments', 'AppointmentsController@requestAppointments');
        Route::get('/requestAppointments/delete/{id}', 'AppointmentsController@delete');
        Route::get('/appointment/get_requestAppointment/{id}', 'AppointmentsController@get_requestAppointment');
        Route::get('/appointment/searchDoctor', 'AppointmentsController@searchDoctor');
        Route::get('/appointment/sent_suggestToPatient', 'AppointmentsController@sent_suggestToPatient');
        Route::get('/appointment/patientAppointment', 'AppointmentsController@patientAppointment');
        Route::get('/appointment/doctorAppointment', 'AppointmentsController@doctorAppointment');
        Route::get('/appointment/changeAppointmentStatus', 'AppointmentsController@changeAppointmentStatus');
        Route::get('/appointment/getBookingData/{id}', 'AppointmentsController@getBookingData');
        Route::get('/appointment/create_appointment', 'AppointmentsController@create_appointment');
        Route::get('/appointment/getMedicalHistory', 'AppointmentsController@getMedicalHistory');
      
        Route::post('/appointment/submitConsultationForm', 'AppointmentsController@submitConsultationForm');

        Route::post('/appointment/submitConsultationComment', 'AppointmentsController@submitConsultationComment');
        

        //Payment
        Route::post('/payment/order_payment', 'AppointmentsController@order_payment');

        //Payout 
         Route::get('/payout/doctorPayout', 'PayoutController@doctorPayout');
         Route::get('/payouts/exportToDoctorCsv', 'PayoutController@exportToDoctorCsv');
         Route::get('/payouts/exportMidToDoctorCsv', 'PayoutController@exportMidToDoctorCsv');

        //---------
        Route::get('roles/index', 'RolesController@index');
        Route::post('roles/deleterole/{id}', 'RolesController@delete');
        Route::get('roles/get_menus/{id}', 'RolesController@getMenus');
        Route::post('roles/store_roles', 'RolesController@storeRoles');
        Route::get('roles/fetcheditdata/{id}', 'RolesController@show');
        Route::post('roles/update_role/{id}', 'RolesController@update');
        Route::get('/getDashboardData', 'DashboardController@getDashboardData');
        
        //Orders
        Route::get('/Orders/OrdersBooking', 'OrdersController@OrdersBooking');
        Route::get('/Orders/updateStatus/{id}', 'OrdersController@updateStatus');
        Route::get('/Orders/getPatientCondtion/{id}', 'OrdersController@getPatientCondtion');
        Route::get('/Orders/getConsultation/{id}', 'OrdersController@getConsultation');
        
        

        //bookingOrders
});

 Route::get('/doPayment',             'AppointmentsController@doPayment');
 Route::get('/cancelPayment',         'AppointmentsController@cancelPayment');
 
