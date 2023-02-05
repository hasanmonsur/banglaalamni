  <!-- Event Application -->
  <section class="page-section" id="application">
    <div class="container rounded-pill p-1 mb-1 bg-info text-white">
      <div class="row justify-content-center">
        <h2>Event Registration By Admin</h2>
      </div>
    </div>
    <div class="container border bg-white rounded text-dark p-4"><br>
      <div class="row justify-content-center">
        <form action="#">      
        <div class="form-inline p-1 mb-2 bg-warning text-dark">
          <label for="text">Select Event: </label> 
          <select id="drconvid" name="drconvid" class="form-control">
              <!-- <option value="202001">তৃতীয় সম্মিলন উৎসব ২০২০</option> -->
              <option value="202201">চতুর্থ সম্মিলন উৎসব ২০২২</option>
          </select> 
          <label for="text">&nbsp;&nbsp; Member ID: &nbsp;</label> 
           <select id="drmtype" name="drmtype" class="form-control">
              <option value="">Life</option>
              <option value="G">General</option>
              <option value="S">Student</option>
           </select> &nbsp;
          <input type="text" class="form-control" id="txtmemberid" placeholder="Enter Member ID" name="txtmemberid" required>&nbsp;&nbsp;
        
          <button type="submit" class="btn btn-primary" style="width:200px;" id="btnapp-search">Search</button>
        </div>
        <div> 
          <div class="text-danger"><b><label id="txtmessage" name="txtmessage"></b></div>
        </div>
        <div class="form-inline justify-content-lefts">
          <label for="uname">Member Name:&nbsp;&nbsp;</label>
          <input type="text" class="form-control" style="width:40%" id="txtmembername" placeholder="Enter member name" name="txtmembername" required>
          
          <div class="invalid-feedback">Please fill out this field.</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <label for="uname">Member Mobile # :&nbsp;&nbsp;</label>
          <input type="text" class="form-control" id="txtmemmobile" placeholder="Enter mobile number" name="txtmemmobile" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div><br>
        <div class="form-inline justify-content-left">
          <input type="checkbox" style="display: none;" id="mset" name="mset" checked><!--<span class="text-danger">isActive?  </span> &nbsp;&nbsp; | &nbsp;&nbsp;-->
          <label class="text-danger">Member Gender:</label>
          <input type="radio" id="mgender1" name="mgender" value="male"> Male   
          <input type="radio" id="mgender2" name="mgender" value="female"> Female          
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
          <div id="div-dress" class="form-inline">
           <label class="text-danger"> | &nbsp;&nbsp;  Member Panjabi Size :</label>
           <!--<input type="text" class="form-control" id="txtmdresssize" placeholder="Enter size" name="txtmdresssize" norequired>-->
           <select id="txtmdresssize" name="txtmdresssize" class="form-control">
              <option value="">---select --</option>
              <option value="34">34</option>
               <option value="36">36</option>
               <option value="38">38</option>
               <option value="40">40</option>
               <option value="42">42</option>
               <option value="44">44</option>
               <option value="46">46</option>
               <option value="48">48</option>
           </select>
           <input type="hidden" class="form-control" id="txtcastamount" placeholder="Enter size" name="txtcastamount" norequired>
           <div class="valid-feedback">Valid.</div>
           <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>
        <div> 
          <div class="text-danger"><b>Please Entry Guest Information in English</b></div>
        </div>
        <div id="div-guest" >
        <div class="form-inline justify-content-left p-3 mb-2 bg-gray text-dark" >          
          <label for="text" class="text-danger">Guest Name &nbsp;</label> 
          <input type="text" class="form-control" id="txtguestname" placeholder="Enter guest name" name="txtguestname" required>
          <span class="text-default font-weight-bold">&nbsp;Relation&nbsp;</span>
          <select id="grel" name="grel" class="form-control">
              <option value="Husband">Husband</option>
              <option value="Wife">Wife</option>
              <option value="Son">Son</option>
              <option value="Daughter">Daughter</option>
              <option value="Relative">Relative</option>
          </select>
          
          <label class="text-danger">&nbsp;Gender&nbsp;</label>
          <input type="radio" id="ggender1" name="ggender" value="male"> Male  
          <input type="radio" id="ggender2" name="ggender" value="female"> Female          
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>&nbsp;&nbsp;
          <span class="text-default font-weight-bold">&nbsp;Dress&nbsp;</span>
          <!--<span class="text-default font-weight-bold">With Dress?&nbsp;</span><input type="checkbox" id="gset" name="gset">-->
          <select id="gset" name="gset" class="form-control">
              <option value="">---select --</option>
              <option value="sharee">Sharee</option>
               <option value="panjabi">Panjabi</option>
          </select>
          <div id="div-guest-dress" class="form-inline">
          <label class="text-danger"> &nbsp; Panjabi Size :</label>
          <!--<input type="text" class="form-control" id="txtgdresssize" placeholder="Enter size" name="txtgdresssize" norequired>-->
          <select id="txtgdresssize" name="txtgdresssize" class="form-control">
              <option value="">---select --</option>
              <option value="34">34</option>
               <option value="36">36</option>
               <option value="38">38</option>
               <option value="40">40</option>
               <option value="42">42</option>
               <option value="44">44</option>
               <option value="46">46</option>
               <option value="48">48</option>
           </select>
          </div>
          <button type="submit" class="btn btn-primary btn-x" id="btnapp-add">Add</button>
        </div>
        <div>
        <table class="table table-crossover">
         <thead class="p-3 mb-2 bg-info text-white">
          <tr>
            <th>Name</th>
            <th>Gender</th>            
            <th>Dress</th>   
            <th>Size</th>         
            <th></th>
          </tr>
          </thead>
          <tbody id="tbody-guest" class="p-3 mb-2 bg-secondary text-white">
          
          </tbody>
         </table>     
        </div>
        </div>
        <div class="form-inline p-2 mb-2 bg-warning text-dark">
          <label class="text-danger">Member Fee Amount :</label>
           <input type="text" class="form-control" id="txtamount" style="text-align:right;" placeholder="" name="txtamount" required>          
           
           <label class="text-danger">&nbsp;&nbsp;  Total Fee Amount :</label>
           <input type="text" class="form-control" style="text-align:right;" id="txttotalamount" placeholder="" name="txttotalamount" required>          
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div> 
        <button type="submit" class="btn btn-primary btn-x" id="btnapp-registration-admin">Submit Registration</button>
        <button type="submit" class="btn btn-danger btn-x" id="btnapp-clear">Clear</button> <!--invisible-->
        <button type="button" class="btn btn-primary invisible" id="btnapp-voucher-admin" data-toggle="modal" data-target="#voucherModal">Open Voucher</button>
      </form>
      </div><br>    
    </div>

    <input type="hidden" style="border:0px;" id="tranid" placeholder=".." name="tranid">
    <input type="hidden" style="border:0px;" id="totalamt" placeholder="0" name="totalamt">
  </section>