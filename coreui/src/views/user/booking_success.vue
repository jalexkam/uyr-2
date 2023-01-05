<template>
   <div>

        <CRow class="mx-0 mt-5 justify-content-center">

         <CCol md="6" class="px-2">
            <CCard class="success-card">
              <CCardBody>
                <div class="success-cont text-center">
                  <i class="fa fa-check"></i> 
                  <h3>Appointment booked Successfully!</h3> 
                  <p>Appointment booked with <strong>Dr. George Anderson</strong><br> on <strong>16 Sep 2021 10:00 AM to 11:00AM</strong></p> 
                  <CButton class="btn_custom btn" to="Invoice">View Invoice</CButton>
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
</style>

