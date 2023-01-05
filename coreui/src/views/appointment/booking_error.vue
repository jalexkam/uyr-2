<template>
   <div>

        <CRow class="mx-0 mt-5 justify-content-center">

         <CCol md="5" lg="4" class="px-2">
            <CCard class="success-card error_card">
              <CCardBody>
                <div class="success-cont text-center">
                  <h5>Please try again</h5>
                  <p class="mb-2">something went wrong</p>
                  <i class="fa fa-exclamation bg-danger border-danger mb-3 mt-2" aria-hidden="true"></i>
                  <!-- <h3>Appointment booked Successfully!</h3>  -->
                  <p>We Couldn't book that appointment.<br>
                  Please reload the page and try again.</p> 
                  <router-link :to="{ name: 'patientBooking'}">
                  <CButton class="btn_custom btn px-5">Go Back</CButton>
              </router-link>
                </div>
              </CCardBody>
            </CCard>
         </CCol>
      </CRow>
         
   </div>
</template>
<script>
   export default{

     }
     
</script>
<style>

  .success-card .card-body {
    padding: 50px 20px;
  }

  .success-cont i {
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    color: #fff;
    width: 60px;
    height: 60px;
    border: 2px solid #2c449e;
    border-radius: 50%;
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    justify-content: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    font-size: 30px;
    margin-bottom: 30px;
    background-color: #2c449e;
}

.success-cont h3 {
    font-size: 24px;
    color: #2c449e
}

.success-cont p {
    margin-bottom: 30px;
}



.card.success-card  {
    border: 1px solid #f0f0f0;
    margin-bottom: 1.875rem;
    border-radius: 10px;
    box-shadow: 0 0 10px rgb(159 159 159 / 17%);
    }

    .error_card h5{
        font-size: 30px
    }
</style>

