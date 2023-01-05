
<html lang="en">
   <head>
      <title>UYR Doctors</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <style type="text/css">
         @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
         /* CLIENT-SPECIFIC STYLES */
         body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;color: #073763 !important;} /* Prevent WebKit and Windows mobile changing default text sizes */
         table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;color: #073763 !important;} /* Remove spacing between tables in Outlook 2007 and up */
         img{-ms-interpolation-mode: bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */
         /* RESET STYLES */
         img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
         table{border-collapse: collapse !important;}
         body{height: 100% !important; margin: 0 auto !important; padding: 0 !important; width: 100% !important; margin:0 auto; background:#fff; font-family: "Poppins", sans-serif; color: #073763 !important; font-size: 13px;
         }
         /* iOS BLUE LINKS */
         a[x-apple-data-detectors] {
         color: inherit !important;
         text-decoration: none !important;
         font-size: inherit !important;
         font-family: inherit !important;
         font-weight: inherit !important;
         line-height: inherit !important;
         }
         p{
         margin: 12px 0px;
         text-align: justify;
         font-size: 13px;
         color: #073763 !important;
         }
         font{
         font-size: 13px;
         color: #073763 !important;
         }
         @media (max-width: 640px){
            .main-table{
            width: 100%
            }
            .table{
            width: 90%;
            margin: 0 auto;
            }
         }

         h5{
         font-size: 16px;
         font-weight: 500;
         margin: 0;
         /*color: #f58634;*/
         /*font-family: "Poppins",sans-serif;*/
         }

         .btn-danger{
            border: 1px solid #ff3547;
            color: #fff;
            background: #ff3547;
            padding: 10px 30px;
            border-radius: 35px;
            cursor: pointer;
            box-shadow: 0 0 4px 1px #bbbbbb;
            margin: 8px 0;
         }
         .btn-success{
            border: 2px solid #00c851;
            color: #00c851 !important;
            background: #dbffeb;
            padding: 12px 35px;
            border-radius: 35px;
            cursor: pointer;
            box-shadow: 0 0 4px 1px #bbbbbb;
            margin: 8px 0 16px;
            font-weight: 600
         }

         .btn-success:hover {
             background: #00c851 !important;
             color: #fff !important;
         }
      </style>
   </head>
   <body size="A4" style="color: #073763 !important;">
      <table width="600" cellpadding="0" cellspacing="0" bgcolor="#fff" height="auto" align="center" class="main-table" style="color: #073763 !important; border: 1px solid #f2f2f2; background: #f4fbff;">
         <tbody style="color: #073763 !important;">
            <tr>
               <td colspan="2" align="center" style="background: #ffffff; padding:16px">
                  <img src="http://67.211.210.169/images/uyr_logo.png" width="120px">
               </td>
            </tr>
            <tr>
               <td height="20"></td>
            </tr>
            <tr>
               <td>
                  <table width="540" cellpadding="0" cellspacing="0" border="0" align="center" class="table" style="color: #073763 !important;">
                     <tr>
                        <td>
                           <h5>Hi {{$first_name}},</h5>
                           <p style="color: #073763 !important;">
                              Forgot your password? 
                           </p>
                              <p style="color: #073763 !important;">
                              We received a request to reset the password for your account. 
                           </p>
                           <p style="color: #073763 !important;">To reset your password, click on the button below  </p>
                        </td>
                     </tr>
                     <tr>
                        <td>
                            <a class="btn" style="color: #00c851 !important; text-decoration: none;" href="{{$activationlink}}">
                           <button class="btn-success" style="cursor: pointer">
                           Reset Password
                           </button>
                           </a>
                        </td>
                        
                     </tr>

                     <tr>
                        <td>
                        <p style="color: #073763 !important;">To reset your password, click on the button below  </p>
                        <a  href="{{$activationlink}}">
                        {{$activationlink}}
                        </a>
                     </td>
                     </tr>
                     <tr>
                        <td height="10px"></td>
                     </tr>
                     <!-- signature start -->
                     <tr>
                        <td>
                           <div>
                              <div dir="ltr" data-smartmail="gmail_signature">
                                 <div dir="ltr">
                                    <div>
                                       <div>
                                          <br/> <br/> <br/> <br/> <br/>
                                          <font>Thanks & Regards,</font>
                                       </div>
                                       <div>
                                          <font><strong style="color: #2a80c5">UYR Doctors</strong><br></font>
                                          <!-- <img src="http://66.23.227.73/images/emailLogo.png" width="100px" style="margin-top:5px;"> -->
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
            
            <tr>
               <td height="40"></td>
            </tr>
         </tbody>
      </table>
   </body>
</html>