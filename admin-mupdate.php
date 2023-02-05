 <!--  admin report -->
 <section class="page-section" id="admin">
 <div class="container rounded-pill p-1 mb-2 bg-info text-white">
      <div class="row justify-content-center">
        <h2>Member Information Update</h2>
      </div>
    </div>
 <div class="container p-1 mt-2 bg-white rounded text-dark">
    <div class="container  border"><br>
    <?php if($login_role=="1"){?>
     <br>
     <div class="row justify-content-center">     
      <div class="form-inline">
       <label for="uname">Entry Member ID:</label>
       <select id="serchdrmtype" name="serchdrmtype" class="form-control">
              <option value="">Life</option>
              <option value="G">General</option>
              <option value="S">Student</option>
              <option value="T">Temporary</option>
       </select> &nbsp;&nbsp;&nbsp;
       <input type="text" class="form-control" id="serchmemid" name="serchmemid" placeholder="Enter member id"> &nbsp;&nbsp;&nbsp;
       
       <label  id="lbmemName" name="lbmemName"></label> &nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="ckStatus" name="ckStatus"> is Active ?&nbsp;&nbsp;&nbsp;
       <label for="uname">Member Type:</label>
       <select id="updatemtype" name="updatemtype" class="form-control">
              <option value="">Life</option>
              <option value="G">General</option>
              <option value="S">Student</option>
       </select> 
       </div><br>
       <div class="form-inline">       
       <button type="submit" class="btn btn-info btn-x" id="btnapp-up-search">Search</button>&nbsp;&nbsp;
      <!-- <button type="submit" class="btn btn-primary btn-x" id="btnapp-mem-list-search">Preview</button>&nbsp;&nbsp;
      <button type="submit" class="btn btn-success btn-x" id="btnapp-mem-list-print">print</button> &nbsp;&nbsp;-->
       <button type="submit" class="btn btn-success btn-x" id="btnapp-up-update">Update</button>
       </div>
       <!--<div class="PrintAreaMem">
        <div class="text-center d-print-none" style="text-align:center;">
        <h4>বাংলা বিভাগ অ্যালামনাই<br>
        <h6>রাজশাহী বিশ্ববিদ্যালয়, রাজশাহী<br>
        <h4> <label id="rpt-name" name="rpt-name"> </label> </h4>
        </div>
        <div class="text-center"><h6><?php
          //$today = date("Y-m-d H:i:s");
          //echo "Print  Date: ". $today;
          ?></h6></div>
        <div id="rpt-memberlist">  
        <table class="table table-crossover border" style="border: 1px solid black;">
         <thead class="bg-danger" style="border-top: 1px solid;">
          <tr style="border: 1px solid; border-bottom: 1px solid;">
              <th style="border-bottom: 1px solid;">Member ID</th>
              <th style="border-bottom: 1px solid;">Member Name</th>
              <th style="border-bottom: 1px solid;">Mem. Phone </th>
              <th style="border-bottom: 1px solid;">Mem. Type</th>  
              <th style="border-bottom: 1px solid;">Mem. Payment</th>  
          </tr>
          </thead>
          <tbody id="tbody-regi-report-sum-data" style="border: 1px solid;">
          
          </tbody>
          <thead class="bg-danger" style="border-top: 1px solid;">
          <tr style="border: 1px solid; border-bottom: 1px solid;">
              <th style="border-bottom: 1px solid;">Member ID</th>
              <th style="border-bottom: 1px solid;">Member Name</th>
              <th style="border-bottom: 1px solid;">Mem. Phone </th>
              <th style="border-bottom: 1px solid;">Mem. Type</th>  
          </tr>
          </thead>
         </table>  
        </div> 
     -->
        </div> 
      <br>

    </div><br>
    <?php }?>

    </section>