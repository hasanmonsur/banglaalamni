<!-- search payment status -->
<section class="page-section text-white" id="search">

    <div class="container rounded-pill p-1 mb-2 bg-info text-white">
      <div class="row justify-content-center">
        <h2>Search Information</h2>
      </div>
    </div>

     <div class="container border p-2 bg-white rounded text-dark">
      <div class="form-inline">       
        <label for="text">Select Event:</label> 
        <select id="srdrconvid" name="srdrconvid" class="form-control">
              <option value="202201">চতুর্থ সম্মিলন উৎসব ২০২২</option>
              <option value="202001">তৃতীয় সম্মিলন উৎসব ২০২০</option>
              <option value="9900">নিবন্ধিত সদস্য তালিকা </option>
        </select> 
        <label for="text">Enter Member ID: </label> 
        <select id="srdrmtype" name="srdrmtype" class="form-control">
              <option value="">Life</option>
              <option value="G">General</option>
              <option value="S">Student</option>
              <option value="T">Pending Approval</option>
        </select> &nbsp;
        <input type="text" class="form-control" id="srtxtmember" placeholder="Enter member id" name="srtxtmember">
        
      </div>
      <div class="form-inline p-2">
        <label for="text">Mobile #:</label> 
        <input type="text" class="form-control" id="srtxtmobile" placeholder="Enter mobile #" name="srtxtmobile">
        <label for="text">Tran #:</label> 
        <input type="text" class="form-control" id="sertranid" placeholder="Enter transaction no" name="sertranid">
        
        <button type="submit" class="btn btn-primary" id="btnapp-regisearch">Search</button>
        <button type="submit" class="btn btn-info" id="btnapp-mem-voucher">voucher (mem)</button>
        <button type="submit" class="btn btn-success" id="btnapp-regi-voucher">voucher (event)</button>
       </div>
      <br>

      <div>
        <table class="table table-crossover border">
         <thead class="bg-info">
          <tr>              
              <th>Reg-Type</th>
              <th>Name</th>
              <th>Gender</th>
              <th>Dress Type</th>
              <th>Size</th>
              <th>Amount</th>
          </tr>
          </thead>
          <tbody id="tbody-regi-data">
          
          </tbody>
          <tbody id="tbody-mem-regi-data">
          
          </tbody>

         </table>     
        </div>    
    </div>
  </section>