import Vue from 'vue'
import Router from 'vue-router'
import auth from './../middleware/auth';

const NotFound   = () =>import("@/views/errors/404");
const HomePage   = () =>import ('@/views/frontend/homepage')
const About      = () =>import ('@/views/frontend/about')
const Contact    = () =>import ('@/views/frontend/contact')
const Career     = () =>import ('@/views/frontend/career')
const Blog       = () =>import ('@/views/frontend/blog')
const Blog_Details = ()=>import ('@/views/frontend/blog_details')
const Location  = () =>import ('@/views/frontend/location')
const Calendar  = () =>import ('@/views/frontend/calendar')
const PrivacyPolicy = () =>import ('@/views/frontend/privacy_policy')
const TermsCondition = () =>import ('@/views/frontend/termsCondition')
const WhyUs = () =>import ('@/views/frontend/WhyUs')

// login
const Login             = () => import ('@/views/auth/login')
const UserRegister      = () => import ('@/views/auth/userRegister')
const Doctor_register   = () => import ('@/views/auth/doctorRegister')
const Dashboard         = () => import ('@/views/Dashboard')
const ResetPassword     = () => import ('@/views/auth/reset-password')
const VerifyOTP         = () => import ('@/views/auth/verify-otp')

//Doctor section
const DoctorAdd     = () =>import  ('@/views/doctors/add')
const DoctorEdit    = () =>import  ('@/views/doctors/edit')
const Doctor        = () =>import  ('@/views/doctors/index')
const DoctorView    = () =>import  ('@/views/doctors/view')
const DoctorAppointment = () => import ('@/views/doctors/appointment')
const DoctorAppointmentPatientView = () => import ('@/views/doctors/patientView')
const DoctoraddPrescription = () => import ('@/views/doctors/addPrescription')
const UpdateDoctorProfile = () =>import  ('@/views/settings/update_doctor')


const DoctorPayout      = () =>import  ('@/views/payout/doctorpayout')
const MediatorDoctorPayout      = () =>import  ('@/views/payout/mediatorDoctorPayout')
const ManageBooking = () =>import  ('@/views/doctors/manage_booking')

//Mediator Doctor section
const MediatorList = () =>import  ('@/views/mediator/index')
const MediatorAdd = () =>import  ('@/views/mediator/add')
const MediatorEdit = () =>import  ('@/views/mediator/edit')
const MediatorView = () =>import  ('@/views/mediator/view')

//Sales section
const Sales = () =>import ('@/views/sales/index')
const Addsales = () => import ('@/views/sales/add_sales')

// Containers
const TheContainer = () => import ('@/containers/TheContainer')
const Myaccount = () => import ('@/views/myaccount')

//USERS
const Users = () => import ('@/views/users/index')
const AddUser = () => import ('@/views/users/addUser')
const ChangePassword = () => import ('@/views/users/changePassword')


//Patient
const Patient = ()          => import ('@/views/patient/index')
const ViewPatient = ()      => import ('@/views/patient/view')
const AddPatient = ()       => import ('@/views/patient/add')
const EditPatient = ()      => import ('@/views/patient/edit')
const DoctorSuggest = ()    => import ('@/views/patient/suggestDoctor')
const PatientBooking = ()       => import ('@/views/patient/patientBooking')

const SearchDoctor = ()     =>import ('@/views/patient/searchDoctor')
const PatientAppointment = () => import ('@/views/patient/appointment')
const PatientDoctorView    = () =>import  ('@/views/patient/doctorsView')

//ROLES
const Roles         = () =>import ('@/views/roles/index')
const AddRole       = () =>import ('@/views/roles/addRole')
const EditRole      = () => import ('@/views/roles/EditRole')

const CareersList    = () =>import  ('@/views/frontedForm/careers')
const EnquiryList    = () =>import  ('@/views/frontedForm/enquiry')


//booking careers-list
const AppointmentCheckout = () =>import  ('@/views/appointment/checkout')

const ProfileSettings = () =>import ('@/views/profileSettings')

// Email Setting
const EmailSetting = () =>import ('@/views/emailSettings')


// Appointments
const RequestAppointments = () => import ('@/views/appointment/requestAppointments')
const DoctorSearch = () => import ('@/views/appointment/doctorSearch')
const BookingSuccess = () => import ('@/views/appointment/booking_success')
const BookingError = () => import ('@/views/appointment/booking_error')

// Admin
const Admin        = () => import ('@/views/admin/index')
const AddAdmin      = () => import ('@/views/admin/addAdmin')

//masters
const MasterEquipments = () =>import  ('@/views/masters/master_equipments')
const MasterServices = () =>import  ('@/views/masters/master_services')
const MasterTypes = () => import  ('@/views/masters/master_types')
const MasterAvailability = () => import  ('@/views/masters/master_availability')
const MasterFees = () => import  ('@/views/masters/master_fees')

//mangeWebsite
const ContactUs = () =>import  ('@/views/mangeWebsite/contactUs')
const Faq = () =>import  ('@/views/mangeWebsite/faq')
const AddFaq = () =>import  ('@/views/mangeWebsite/addfaq')
const ManageWebsiteBlogList = () =>import  ('@/views/mangeWebsite/blog')
const ManageWebsiteBlogAdd = () => import  ('@/views/mangeWebsite/add_blog')
const ManageWebsiteAboutus = () => import  ('@/views/mangeWebsite/about_edit')
const ManageWebsiteBlogEdit = () => import  ('@/views/mangeWebsite/edit_blog')
const ManageWebsiteAssociatePartners = () =>import  ('@/views/mangeWebsite/associate_partners')
const ManageWebsiteHomepage = () => import  ('@/views/mangeWebsite/homepage')

const ManageWebsitePrivacyPolicy = () =>import  ('@/views/mangeWebsite/edit_privacy_policy')
const ManageWebsiteTermsCondition = () =>import  ('@/views/mangeWebsite/edit_terms_condition')

const ManageWebsiteTestimonial = () =>import  ('@/views/mangeWebsite/testimonial')
const ManageWebsiteAddTestimonial = () =>import  ('@/views/mangeWebsite/add_testimonial')
const ManageWebsiteSocialLinks = () => import  ('@/views/mangeWebsite/social_links')
const ManageWebsiteWhyUS = () =>import  ('@/views/mangeWebsite/edit_why_us')




// Orders 
const Orders = () =>import  ('@/views/orders/Orders')
//patient/appointment
const Appointment_list = () =>import  ('@/views/doctors/appointment_list')

const Favorite = () =>
    import ('@/views/user/favorite')


const Invoice = () =>
    import ('@/views/user/invoice')

const Accepted_appointment = () =>
    import  ('@/views/booking/accepted_appointment')


const slider_list = () =>
    import  ('@/views/website/slider')
const add_slider = () =>
    import  ('@/views/website/add_slider')





// MASTERS

Vue.use(Router)
let router = new Router({
    mode: 'history', // https://router.vuejs.org/api/#mode
    linkActiveClass: 'active',
    scrollBehavior: () => ({ y: 0 }),
    routes: configRoutes()
})

export default router
function configRoutes() {
    return [{
            path: '/',
            redirect: '/homepage',
            name: 'Auth',
            component: {
                render(c) { return c('router-view') }
            },
            children: [ { path: 'login',name: 'login', component: Login },
                        { path: '/homepage',name: 'homepage', component: HomePage }]
            },
                   
            { path: '/register',  name: 'register', component: UserRegister },
            { path: '/doctor_register', name: 'doctor_register', component: Doctor_register },

            { path: '/reset-password/:key',  name: 'reset-password', component: ResetPassword },
            { path: '/verify-otp/:id',  name: 'verify-otp', component: VerifyOTP },
            
            { path: '/about',name: 'about',component: About},
            
            { path: '/privacy-policy',name: 'privacy-policy',component: PrivacyPolicy},
            { path: '/terms-condition',name: 'terms-condition',component: TermsCondition},

            { path: '/why-us', name: 'why-us', component: WhyUs,},

            


            { path: '/contact',name: 'contact',component: Contact },
            { path: '/career',name: 'career',component: Career},
            { path: '/blog', name: 'blog',component: Blog},
            { path: '/blog_details/:id', name: 'blog_details', component: Blog_Details },
            {
            path: '/location',
            name: 'location',
            component: Location
            },  
             {
            path: '/calendar',
            name: 'calendar',
            component: Calendar
            },           

            {
            path: '/',
            redirect: '/dashboard',
            name: 'Home',
            component: TheContainer,
            children: [{ path: 'dashboard',name: 'dashboard', component: Dashboard},

                // Admin Section 
                { path: '/admin',       name: 'admin', component: Admin},
                { path: '/admin/page/:page', name: 'paginate_admin', component: Admin },
                { path: '/admin/add',    name: 'addAdmin',component: AddAdmin },
                { path: '/admin/edit/:id',name: 'edit', component: AddAdmin},

                // users Section 
                { path: '/users',       name: 'users', component: Users},
                { path: '/users/page/:page', name: 'paginate_users', component: Users },
                { path: '/users/add',     name: 'AddUser',component: AddUser },
                { path: '/users/edit/:id', name: 'Addedit', component: AddUser},
                
                // sales Section 
                { path: '/sales',       name: 'sales', component: Sales, meta: { middleware: [auth],},},
                { path: '/sales/page/:page', name: 'paginate_sales', component: Sales },
                { path: '/sales/add',     name: 'addsales', component: Addsales },
                { path: '/sales/edit/:id',name: 'editSales', component: Addsales },
                
                // doctor Section 
                { path: '/doctor',      name: 'doctor', component: Doctor,},
                { path: '/doctor/page/:page',name: 'paginate_doctor', component: Doctor },
                { path: '/doctor/add',       name: 'doctoradd',component: DoctorAdd,},
                { path: '/doctor/edit/:id',  name: 'edit_doctor',component: DoctorEdit,},
                { path: '/doctor/view/:id',  name: 'view_doctor',component: DoctorView,},
                { path: '/doctor/view/:id/:doctor_suggest_id',  name: 'view_doctor_patient',component: DoctorView,},

                { path: '/updateDoctorProfile/:id',name: 'updateDoctorProfile',component: UpdateDoctorProfile,},
                { path: '/doctor/appointment', name: 'doctor_appointment', component: DoctorAppointment},
                { path: '/doctor/appointment/page/:page', name: 'paginate_doctor_appointment', component: DoctorAppointment},
                { path: '/doctor/appointment/patient/view/:id', name: 'doctor_appointment_patient_view', component: DoctorAppointmentPatientView},
                { path: '/doctor/appointment/patient/add_prescription/:id', name: 'doctor_add_prescription', component: DoctoraddPrescription},
               
                // mediator Section
                { path: '/mediator',        name: 'mediator', component: MediatorList,},
                { path: '/mediator/page/:page',  name: 'paginate_mediator', component: MediatorList },
                { path: '/mediator/add',    name: 'add_mediator',component: MediatorAdd,},
                { path: '/mediator/view/:id',name: 'view_mediator',component: MediatorView},
                { path: '/mediator/edit/:id',name: 'edit_mediator',component: MediatorEdit},

                //Booking
                { path: '/manage_booking',  name: 'manage_booking',component: ManageBooking,},
                
                //Patient
                { path: '/patient', name: 'patient', component: Patient},
                { path: '/patient/page/:page',name: 'paginate_patient', component: Patient },
                { path: '/patient/view/:id',name: 'view_patient',component: ViewPatient,},       
                { path: '/patient/add',name: 'add_patient',component: AddPatient,},
                { path: '/patient/edit/:id',name: 'edit_patient',component: EditPatient},
                { path: '/patient/suggestDoctor/:id',name: 'suggest_doctor',component: DoctorSuggest},
                { path: '/patient/patientBooking',name: 'patientBooking',component: PatientBooking},
                { path: '/patient/patientBooking/fav/:d_id/:p_id',name: 'favPatientBooking',component: PatientBooking},

                //{ path: '/patient/searchDoctor/:id',name: 'searchDoctor',component: SearchDoctor},
                //{ path: '/patient/searchDoctor/:id/page/:page',name: 'paginate_searchDoctor',component: SearchDoctor},
                
                { path: '/booking/searchDoctor/:id/:p_id',name: 'searchDoctor',component: SearchDoctor},
                { path: '/booking/searchDoctor/:id/:p_id/page/:page',name: 'paginate_searchDoctor',component: SearchDoctor},
               
                { path: '/patient/appointment', name: 'patient_appointment', component: PatientAppointment},
                { path: '/patient/appointment/page/:page', name: 'paginate_patient_appointment', component: PatientAppointment},
                { path: '/patient/doctor/view/:id',  name: 'view_patient_doctor',component: PatientDoctorView,},

                //appointment
                { path: '/appointment/requestAppointments', name: 'requestAppointments', component: RequestAppointments},
                { path: '/appointment/requestAppointments/page/:page',name: 'paginate_requestAppointments', component: RequestAppointments },
                { path: '/appointment/doctorSearch/:doctor_suggest_id', name: 'doctorSearch', component: DoctorSearch},
                
                //roles
                { path: '/roles', name: 'roles',  component: Roles, },
                { path: '/roles/add',name: 'add_roles',component: AddRole,},
                { path: '/roles/edit/:id',name: 'edit_roles',component: EditRole,},

                { path: '/appointment/checkout/:patient_id/:appointment_id',name: 'appointment_checkout',component: AppointmentCheckout},
                //Master
                { path: '/master-equipments',name: 'equipments', component: MasterEquipments,},
                { path: '/master-equipments/page/:page',name: 'paginate_equipments', component: MasterEquipments,},
                { path:'/master-services', name: 'services',component: MasterServices,},
                { path:'/master-services/page/:page', name: 'paginate_services',component: MasterServices,},
                { path: '/master-availability', name: 'availability', component: MasterAvailability, },
                { path: '/master-availability/page/:page', name: 'paginate_availability', component: MasterAvailability, },
                { path: '/master-types', name: 'types',component: MasterTypes,},
                { path: '/master-types/page/:page', name: 'paginate_types',component: MasterTypes,},
                { path: '/master-fees', name: 'fees',component: MasterFees},                
                { path: '/master-fees/page/:page', name: 'paginate_fees',component: MasterFees},                
                
                //manageWebsite
                {path: '/manage-website/contact-us', name: 'manage-website-contactUs',component: ContactUs},
                {path: '/manage-website/faq', name: 'faq',component: Faq},
                {path: '/manage-website/faq/addfaq', name: 'add_faq',component: AddFaq},
                {path: '/manage-website/faq/edit/:id',name: 'edit_faq', component: AddFaq},
                {path: '/manage-website/about-us',name: 'manage-website-aboutus',component: ManageWebsiteAboutus},
                
                {path: '/manage-website/associate-partners',name: 'manage-website-associate-partners',component: ManageWebsiteAssociatePartners,},
                {path: '/manage-website/homepage', name: 'manage-website-homepage', component: ManageWebsiteHomepage, },
                // {path: '/manage-website/services',name: 'manage-website-services',component: Aboutus},

                {path: '/manage-website/blog',name: 'manage-website-blog', component: ManageWebsiteBlogList, },
                {path: '/manage-website/blog/page/:page',name: 'manage-website-blog-page', component: ManageWebsiteBlogList, },
                {path: '/manage-website/add-blog', name: 'manage-website-add-blog',component: ManageWebsiteBlogAdd,},
                {path: '/manage-website/blog-edit/:id',name: 'manage-website-edit-blog', component: ManageWebsiteBlogEdit},
                
                {path: '/manage-website/testimonial',name: 'manage-website-testimonial', component: ManageWebsiteTestimonial},
              
                {path: '/manage-website/add-testimonial',name: 'manage-website-add-testimonial', component: ManageWebsiteAddTestimonial},
                {path: '/manage-website/edit-testimonial/:id',name: 'manage-website-edit-testimonial', component: ManageWebsiteAddTestimonial },
                
                {path: '/manage-website/privacy-policy',name: 'manage-website-privacy-policy', component: ManageWebsitePrivacyPolicy},
                {path: '/manage-website/terms-condition',name: 'manage-website-terms-condition', component: ManageWebsiteTermsCondition},
                
                {path: '/manage-website/social-links',name: 'manage-website-social-links',component: ManageWebsiteSocialLinks},
                
                { path: '/manage-website/slider-list',name: 'slider_list', component: slider_list, },
                { path: '/manage-website/add-slider', name: 'add_slider',component: add_slider, },
                { path: '/manage-website/why-us', name: 'manage-website-why-us',component: ManageWebsiteWhyUS, },

               
                // mediator Orders
                 {path: '/orders', name: 'orders',component: Orders,},

                 {path: '/careers-list',name: 'careers-list',component: CareersList},
                 {path: '/careers-list/page/:page',name: 'careers-list-page',component: CareersList},
                 {path: '/enquiry-list',name: 'enquiry-list',component: EnquiryList},
                 {path: '/enquiry-list/page/:page',name: 'enquiry-list-page',component: EnquiryList},


                {
                    path: '/changepassword/:id',
                    name: 'changePassword',
                    component: ChangePassword,
                    // meta:{
                    //   requiresAdmin: true
                    // }
                },
                
                {
                    path: '/profile',
                    name: 'profileSettings',
                    component: ProfileSettings,
                },

                {
                    path: '/email-setting',
                    name: 'emailSetting',
                    component: EmailSetting,
                },

                 {
                    path: '/myaccount',
                    name: 'Myaccount',
                    component: Myaccount
                },
                
                 
                {
                    path: '/appointment_list',
                    name: 'appointment_list',
                    component: Appointment_list,
                },
             
                {path: '/doctor-payout',name: 'doctor-payout',component: DoctorPayout,},
                {path: '/doctor-payout/page/:page',name: 'doctor-payout-page',component: DoctorPayout},
                {path: '/mediator-doctor-payout',name: 'mediator-doctor-payout',component: MediatorDoctorPayout,},
                {path: '/mediator-doctor-payout/page/:page',name: 'mediator-doctor-payout-page',component: MediatorDoctorPayout},
                
                {
                    path: '/accepted_appointment',
                    name: 'accepted_appointment',
                    component: Accepted_appointment,
                },
              
                
               
                { path: '/favorite-list', name: 'favorite', component: Favorite },
                { path: '/favorite-list/page/:page',name: 'favorite-list-page',component: Favorite },
               
                { path: 'appointment/booking-success',name: 'booking-success',component: BookingSuccess,},

                {
                    path: 'appointment/booking-error',
                    name: 'booking-error',
                    component: BookingError,
                },

                

                {
                    path: '/invoice',
                    name: 'invoice',
                    component: Invoice,
                },
               
               { path: '*', component: NotFound }
                

              
            ]
        }
        
    ]
}