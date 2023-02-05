<!-- new member registrationn -->
<section class="page-section" id="registration">
    <div class="container rounded-pill p-1 mb-2 bg-info text-white ">
      <div class="row justify-content-center">
      <?php if($login_role=="1"){?> 
        <h2>New Member Registration By Admin</h2>
         <?php }else {?>
        <h2>New Member Registration</h2>
        <?php }?>
      </div>
    </div>
    <div class="container rounded border p-2 bg-white text-hide"><br>
      <div class="row justify-content-center">
      <?php if($login_role=="1"){?> 
      <div class="col-lg-12 m-2 form-inline"> 
        <label for="text">Enter Member ID: </label> 
        <select id="serchdrmtype" name="serchdrmtype" class="form-control">
              <option value="">Life</option>
              <option value="G">General</option>
              <option value="S">Student</option>
              <option value="T">Pending Approval</option>
        </select> &nbsp;
        <input type="text" class="form-control" id="serchmemid" placeholder="Enter member id" name="serchmemid">
        <button type="submit" class="btn btn-primary" id="btnapp-up-search">Search</button>
       </div>
       <?php }?>
       <hr/>
       <div class="col-lg-5">        
        <div class="form-group">
          <label for="text">Select Member Type:</label> 
          <select id="rmember_type" name="rmember_type" class="form-control">
              <option value="N">--select--</option>   
              <?php //if($login_role=="1"){?>                 
              <option value="">Life Member</option> 
              <option value="G">General Member</option>  
              <?php //}?>     
              <option value="S" selected="selected">Student</option>
          </select>           
        </div>        
        <div class="form-group">
          <label for="uname">Member Name:</label>
          <input type="text" class="form-control" id="rmem_name" placeholder="Enter member name" name="rmem_name" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div>        
        <div class="form-group">
          <label for="uname">Father's Name:</label>
          <input type="text" class="form-control" id="rfather_name" placeholder="Enter father name" name="rfather_name" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div> 
        <div class="form-group">
          <label for="uname">Mother's Name:</label>
          <input type="text" class="form-control" id="rmother_name" placeholder="Enter mother name" name="rmother_name" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group">
          <label for="text">Select Gender:</label> 
          <select id="gender_type" name="gender_type" class="form-control">
              <option value="male">Male</option>
              <option value="female">Female</option>
          </select>           
        </div>        
       </div>
       <div class="col-lg-7">
        <div class="form-group">
          <label for="uname">Present Address:</label>
          <input type="text" class="form-control" id="rpre_address" placeholder="Enter present address" name="rpre_address" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
          </div>        
        <div class="form-group">
          <label for="uname">Permament Address:</label>
          <input type="text" class="form-control" id="rper_address" placeholder="Enter permament address" name="rper_address" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
          </div>  
        <div class="form-group">
          <label for="uname">Mobile/Phone #:</label>
          <input type="text" class="form-control" id="rphone_no" placeholder="Enter phone number" name="rphone_no" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        <div class="form-group">
          <label for="uname">E-mail Address:</label>
          <input type="text" class="form-control" id="remail_add" placeholder="Enter email address" name="remail_add" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        <div id="div-session-year">
         <div class="form-group">
          <label >Hon's session year:</label>
          <input type="text" class="form-control" id="rhonor_session" placeholder="Hon's session(yyyy-yyyy)" name="rhonor_session">          
          </div>   
        </div>    
        <div id="div-pass-year">
          <div class="form-group">
          &nbsp;&nbsp;<label >Hon's pass year:</label>
          &nbsp;&nbsp;<input type="text" class="form-control" id="rhonor_pass" placeholder="Hon's pass yyyy" name="rhonor_pass">          
          </div>
          <div class="form-group">          
          &nbsp;&nbsp;<label >Mast's pass year:</label>
          &nbsp;&nbsp;<input type="text" class="form-control" id="rmaster_pass" placeholder="Mast's pass yyyy" name="rmaster_pass">
          </div> 
         </div> 
         <div class="p-1">
         <?php if($login_role!="1"){?> 
         <button type="submit" class="btn btn-primary btn-x" id="btnapp-mem-registration">New Registration</button>&nbsp;&nbsp;
         <?php }?>
         
         <?php if($login_role=="1"){?> 
         <button type="submit" class="btn btn-success btn-x" id="btnapp-mem-regi-save">Save</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <button type="submit" class="btn btn-info btn-x" id="btnapp-mem-regi-update">Update</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <?php }?>

         <button type="submit" class="btn btn-danger btn-x" id="btnapp-reg-clear">Clear</button> <br> <br>    
         </div>
        </div><br>    
    </div>
  </section>