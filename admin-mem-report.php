 <!--  admin report -->
 <?php if($login_role=="1"){?>
  <section class="page-section" id="admin">
  <div class="container rounded-pill p-1 mb-2 bg-info text-white">
      <div class="row justify-content-center">
        <h2>Member List Report</h2>
      </div>
    </div>
    <div class="container p-1 mb-2 bg-white rounded text-dark">
      <div class="form-inline bg-success border p-2">
        &nbsp;&nbsp;
        <select id="sradmtype" name="sradmtype" class="form-control">
              <option value="">---Applicent Type --</option>
              <option value="M">Member</option>
               <option value="G">Guest</option>
        </select>&nbsp;&nbsp;
        <select id="sradgset" name="sradgset" class="form-control">
              <option value="">---Drass Type --</option>
              <option value="sharee">Sharee</option>
               <option value="panjabi">Panjabi</option>
        </select>&nbsp;&nbsp;
         <select id="sradresssize" name="sradresssize" class="form-control">
              <option value="">---Size --</option>
              <option value="34">34</option>
               <option value="36">36</option>
               <option value="38">38</option>
               <option value="40">40</option>
               <option value="42">42</option>
               <option value="44">44</option>
               <option value="46">46</option>
               <option value="48">48</option>
               <option value="0">sharee-12</option>
           </select>&nbsp;&nbsp;
          <input type="radio" id="rptype" name="rptype" value="D" checked> Details  &nbsp;&nbsp;
          <input type="radio" id="rptype" name="rptype" value="S"> Summary  &nbsp;&nbsp;

        <button type="submit" class="btn btn-primary" id="btnapp-regi-report">Preview</button>&nbsp;&nbsp;
        <button type="submit" class="btn btn-primary btn-x" id="btnapp-print">print</button>        
        <br><br>
    </div>
    <div>

    </div>
      <div>      
      </div>
      <div class="PrintArea">
        <div class="text-center d-print" style="text-align:center;">
        <h4>বাংলা বিভাগ অ্যালামনাই<br>
        <h6>রাজশাহী বিশ্ববিদ্যালয়, রাজশাহী<br>
        <h4> <label id="rpt-name" name="rpt-name"> </label> </h4>
        <h6> <label id="rpt-conv" name="rpt-conv"> </label> </h6>
        </div>
        <div class="text-center"><h6><?php
          $today = date("Y-m-d H:i:s");
          echo "Print  Date: ". $today;
          ?></h6></div>
      <div id="rpt-details">  
        <table class="table table-crossover border" style="border: 1px solid black;">
         <thead class="bg-danger" style="border-top: 1px solid;">
          <tr style="border: 1px solid; border-bottom: 1px solid;">
              <th style="border-bottom: 1px solid;">App. ID</th>
              <th style="border-bottom: 1px solid;">Member ID</th>
              <th style="border-bottom: 1px solid;">Applicent Name</th>
              <th style="border-bottom: 1px solid;">Gender</th>
              <th style="border-bottom: 1px solid;">Dress Type</th>  
              <th style="border-bottom: 1px solid;">Size</th>             
              <th style="border-bottom: 1px solid;">Event Regi. ID</th>
              <th style="border-bottom: 1px solid;">Tran. ID</th>
              <!-- <th style="border-bottom: 1px solid;">Amount</th> -->
          </tr>
          </thead>
          <tbody id="tbody-regi-report-data" style="border: 1px solid;">
          
          </tbody>
           <thead class="bg-danger" style="border-top: 1px solid;">
          <tr style="border: 1px solid; border-bottom: 1px solid;">
              <th style="border-bottom: 1px solid;"></th>
              <th style="border-bottom: 1px solid;"></th>
              <th style="border-bottom: 1px solid;"></th>
              <th style="border-bottom: 1px solid;">Total</th>
              <th style="border-bottom: 1px solid;">Person: </th>  
              <th style="border-bottom: 1px solid;"> <label id="dtCount" ></label></th>             
              <th style="border-bottom: 1px solid;">Amount:</th>
              <th style="border-bottom: 1px solid;"> <label id="dtAmt" ></label></th>
          </tr>
          </thead>
        </table>  
      </div>
      <div id="rpt-summary">  
        <table class="table table-crossover border" style="border: 1px solid black;">
         <thead class="bg-danger" style="border-top: 1px solid;">
          <tr style="border: 1px solid; border-bottom: 1px solid;">
              <th style="border-bottom: 1px solid;">Member ID</th>
              <th style="border-bottom: 1px solid;">Member Name</th>
              <th style="border-bottom: 1px solid;">T. Guest</th>
              <th style="border-bottom: 1px solid;">T. Male</th>  
              <th style="border-bottom: 1px solid;">T. Fmale</th>             
              <th style="border-bottom: 1px solid;">T. Panjabi</th>
              <th style="border-bottom: 1px solid;">T. Sharee</th>
              <th style="border-bottom: 1px solid;">Total Person</th>
              <th style="border-bottom: 1px solid;">Total Amount</th>
          </tr>
          </thead>
          <tbody id="tbody-regi-report-sum-data" style="border: 1px solid;">
          
          </tbody>
          <thead class="bg-danger" style="border-top: 1px solid;">
          <tr style="border: 1px solid; border-bottom: 1px solid;">
              <th style="border-bottom: 1px solid;"</th>
              <th style="border-bottom: 1px solid;"></th>
              <th style="border-bottom: 1px solid;"></th>
              <th style="border-bottom: 1px solid;"></th>  
              <th style="border-bottom: 1px solid;">Total</th>             
              <th style="border-bottom: 1px solid;">Member: </th>
              <th style="border-bottom: 1px solid;"><label id="smCount" ></label></th>
              <th style="border-bottom: 1px solid;">Amount: </th>
              <th style="border-bottom: 1px solid;"><label id="smAmt" ></label></th>
          </tr>
          </thead>
        </table>  
      </div> 
      
      <div id="rpt-mem-payment">  
        <table class="table table-crossover border" style="border: 1px solid black;">
         <thead class="bg-danger" style="border-top: 1px solid;">
          <tr style="border: 1px solid; border-bottom: 1px solid;">
              <th style="border-bottom: 1px solid;">Member ID</th>
              <th style="border-bottom: 1px solid;">Member Name</th>              
              <th style="border-bottom: 1px solid;">Regi. Date</th>
              <th style="border-bottom: 1px solid;">Fee Amount</th>
              <th style="border-bottom: 1px solid;">Tran. ID</th>
          </tr>
          </thead>
          <tbody id="tbody-regi-report-mem-data" style="border: 1px solid;">
          
          </tbody>
          <thead class="bg-danger" style="border-top: 1px solid;">
          <tr style="border: 1px solid; border-bottom: 1px solid;">
              <th style="border-bottom: 1px solid;">Total</th>             
              <th style="border-bottom: 1px solid;">Member: </th>
              <th style="border-bottom: 1px solid;"><label id="mCount" ></label></th>
              <th style="border-bottom: 1px solid;">Amount: </th>
              <th style="border-bottom: 1px solid;"><label id="mAmt" ></label></th>
          </tr>
          </thead>
        </table>  
      </div> 

      </div>    
    </div>
  </section>

  <?php }?>