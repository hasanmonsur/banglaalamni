$(document).ready(function () {

    $("#btnapp-add").attr("disabled", true);
    $("#txtmembername").attr("readonly", true);
    $("#txttotalamount").attr("readonly", true);
    $("#txtamount").attr("readonly", true);
    $('#rpt-details').show();
    $('#rpt-name').text('Details Registration Completed List');
    $('#rpt-summary').hide();
    $("#totalamt").attr("readonly", true);
    $("#div-session-year").hide();
    $("#div-pass-year").hide();
    $("#div-session-year").show();
    $('#rpt-mem-payment').hide();
    $('#rpt-regi-mem-list').hide();

    $("input[name='rptype']").change(function () {
        var rptype = $("input[name='rptype']:checked").val();   
        //alert(drtype);     
        if (rptype == 'D'){            
            $('#rpt-name').text('Details Registration Completed List');
            $('#rpt-details').show();
            $('#rpt-summary').hide();
        } 
        if (rptype == 'S') {
            $('#rpt-name').text('Summary Registration Completed List');
            $('#rpt-summary').show();
            $('#rpt-details').hide();
        }

        return false;
    });

    $('#sradrconvid').change(function () {
        var convid = $("#sradrconvid").val();
        //alert(convid);
        if (convid=='99000') {
            $('#rpt-mem-payment').show();
            $('#rpt-details').hide();
            $('#rpt-summary').hide();
            $('#rpt-regi-mem-list').hide();
        }
        else if (convid=='99001') {            
            $('#rpt-regi-mem-list').show();
            $('#rpt-mem-payment').hide();
            $('#rpt-details').hide();
            $('#rpt-summary').hide();
        }
        else{
            $('#rpt-mem-payment').hide();
            $('#rpt-details').show();
            $('#rpt-summary').hide();
            $('#rpt-regi-mem-list').hide();
        }
        
    });

    $('#txtmemberid').keyup(function () {
        $(this).val($(this).val().toUpperCase());
    });


    //$('#txtguestname').keyup(function () {
       // $(this).val($(this).val().toUpperCase());
    //});

    $("input[name=mgender][value=male]").prop('checked', true);
    $("input[name=ggender][value=male]").prop('checked', true);

    $('#mset').change(function () {
        $("#btnapp-clear").click();
    });

    $("#btnapp-search").click(function () {
        var memtype = $("#drmtype").val();
        var memberid = memtype + $("#txtmemberid").val();
        var convid = $("#drconvid").val();
        $("#div-guest-dress").hide();
        //alert(memtype);
        if (memtype == 'S') {
            $("#div-guest").hide();
        }
        else {
            $("#div-guest").show();
        }

        //$("#gset").empty();
        var url = "app-registration-search.php?memtype=" + memtype + "&memberid=" + memberid + "&convid=" + convid;
        $("#txtmemberid").val('');
        $("#txtmembername").val('');
        $("#mgender").val('');
        $('#gset').val('');
        $("#txtmemmobile").val('');
        $("#tbody-guest").empty();
        $("#txtamount").val('');
        $("#txttotalamount").val('0');

        if (memberid.length > 0) {
            $.ajax({
                url: url, success: function (result) {
                    var datas = $.parseJSON(result);
                    $("#txtmemberid").val('');
                    $("#txtmembername").val('');
                    $("#mgender").val('');                    
                    $("#txtmemmobile").val('');
                    $("#tbody-guest").empty();
                    $("#txttotalamount").val('');
                    $("#txtamount").val('');
                    $("#txtmessage").empty();
                    $("#txtmemberid").val(datas.memberid);
                    var fields = datas.membername.split('|');
                    $("#txtmembername").val(fields[0]);
                    if (fields.length>1)
                     $("#txtmemmobile").val(fields[1]);

                    if (datas.mregistat > 0) $('#mset').prop('checked', false);
                    else $('#mset').prop('checked', true);

                    if (datas.gender == 'male') {
                        $("input[name=mgender][value=male]").prop('checked', true);
                        $("input[name=mgender][value=female]").prop('checked', false);
                        $("#div-dress").show();
                    }
                    if (datas.gender == 'female') {
                        $("#div-dress").hide();
                        $("input[name=mgender][value=male]").prop('checked', false);
                        $("input[name=mgender][value=female]").prop('checked', true);
                    }
                    $("input[name=mgender]").prop('disabled', true);

                    if (datas.mregistat > 0) 
                    {
                        $("#txtamount").val('0');
                        $("#txtcastamount").val('0');
                        $("#txttotalamount").val('0');
                        $("#txtmessage").text('Member allready registered...!');
                    }
                    else                         
                    {
                        $("#txtmessage").val('');
                        $("#txtamount").val(datas.totalamount);
                        $("#txtcastamount").val(datas.totalamount);
                        $("#txttotalamount").val(datas.totalamount);
                    }    

                    //$("#txttotalamount").val(datas.totalamount);
                    //$("#txtcastamount").val(datas.totalamount);
                    $("#btnapp-add").attr("disabled", false);

                }
            });
            $("#txtmemmobile").focus();
        }
        else {
            $("#btnapp-add").attr("disabled", true);
            alert('entry member id...');
        }

        return false;

    });

    $("#btnapp-clear").click(function () {
        var memberid = $("#txtmemberid").val();
        //alert(memberid);
        var url = "app-registration-clear.php";
        //alert(url);
        $.ajax({
            url: url, success: function (result) {
                //alert(result);
                $("#txtmemberid").val('');
                $("#txtmembername").val('');
                $("#mgender").val('');
                $("#txtmdresssize").val('');
                $("#tbody-guest").empty();
                $("#txtamount").val('');
                $("#txttotalamount").val('0');
            }
        });
        //alert(memberid);

        return false;

    });

    $("#btnapp-logout").click(function () {
        alert('Thanks! you are logout ..!!');
        $("#btnapp-clear").click();
        //window.location.href = "index.php"
        location.reload();
        return true;
    });

    $("#btnapp-add").click(function () {
        var convid = $("#drconvid").val();
        var memberid = $("#txtmemberid").val();
        //alert(dresssize+"  "+dresstype);
        var grel = $("#grel").val();
        var guestname = $("#txtguestname").val();
        guestname = guestname + '(' + grel+')';
        //alert(guestname + "  " + grel);
        var gender = $("input[name='ggender']:checked").val();
        var dresssize = $("#txtgdresssize").val();
        
        var ismember = $('#mset').is(":checked");
        var dresstype = $("#gset").val();
        //alert(gender);
        if (dresssize == null || dresssize == '') dresssize = "0";
        //alert(dresssize+"  "+dresstype);
        if (guestname != '') {
            if (gender == 'male' && dresssize == '0' && dresstype == 'panjabi') alert('please entry dress size');
            else {
                var totalamt = parseInt($("#txttotalamount").val());
                var totalcustamt = parseInt($("#txtcastamount").val());//--help to dada bhai
                var url = "app-registration-add.php?memberid=" + memberid + "&guestname=" + guestname + "&gender=" + gender + "&dresssize=" + dresssize + "&dresstype=" + dresstype + "&convid=" + convid;
                //alert(url);
                $.ajax({
                    url: url, success: function (result) {
                        //alert(result);
                        var datas = $.parseJSON(result);
                        //alert(datas);
                        $("#tbody-guest").empty();
                        var totalamt = 0;
                        if (ismember)
                            totalamt = totalcustamt;
                        //alert(totalamt);
                        $.each(datas, function (i, data) {
                            totalamt = totalamt + data.amount;
                            //alert("resut11: "+totalamt);
                            $("#tbody-guest").append('<tr><td>' + data.guestname + '</td><td>' + data.gender + '</td><td>' + data.dresstype + '</td><td>' + data.dresssize + '</td><td><a class="delete" href="#" >Delete-' + data.guestid + '</a></td></tr>');
                            $("#txtguestname").val('');
                            $("#gset").val('');
                            $("#txtgdresssize").val('0');
                            $("#txttotalamount").val(totalamt);
                        });

                        //alert("resut: "+$("#tbody-guest"));
                    }
                });
            }
        }
        else {
            alert('Entry Guest name plz');
        }
        return false;
    });
    
    $("input[name='ggender']").change(function(){
        $('#gset').val('');
    });

    $('#gset').change(function () {
        var drtype = $('#gset').val();
        var gender = $("input[name='ggender']:checked").val();
        //alert(drtype+'   '+gender);
        if (gender == 'male' && drtype == 'panjabi') {
            $("#div-guest-dress").show();
        }
        else if (gender == 'female' && drtype == 'sharee') {
            $("#div-guest-dress").hide();
        }
        else if (gender == 'male' && drtype == 'sharee') {
            alert('please select valid gender');
            $('#gset').val('');
        }
        else if (gender == 'female' && drtype == 'panjabi') {
            alert('please select valid gender');
            $('#gset').val('');
        }

        return false;
    })

    $("#tbody-guest").delegate('a.delete', 'click', function (e) {

        var btnval = $(this).text();
        //alert(btnval);
        var url = "app-registration-delete.php?btnval=" + btnval;
        //var totalcustamt=parseInt($("#txtcastamount").val());
        //alert(url);
        $.ajax({
            url: url, success: function (result) {
                var datas = $.parseJSON(result);
                //alert(datas);
                var totalamt = parseInt($("#txttotalamount").val());
                var totalcustamt = parseInt($("#txtcastamount").val());//--help to dada bhai

                $("#tbody-guest").empty();
                var totalamt = totalcustamt;
                //alert(totalamt);
                $.each(datas, function (i, data) {
                    totalamt = totalamt + data.amount;
                    //totalamt=totalamt-1000;
                    //alert("resut11: "+data["guestname"]);
                    $("#tbody-guest").append('<tr><td>' + data.guestname + '</td><td>' + data.gender + '</td><td>' + data.dresssize + '</td><td><a class="delete" href="#" >Delete-' + data.guestid + '</a></td></tr>');

                    $("#txttotalamount").val(totalamt);

                });

                if (datas.length <= 0) $("#txttotalamount").val(totalcustamt);

            }
        });

        return false;

    });

    // event registration
    $("#btnapp-registration").click(function () {
        var convid = $("#drconvid").val();
        var memberid = $("#txtmemberid").val();
        var membername = $("#txtmembername").val();
        var memmobileno = $("#txtmemmobile").val();
        var mgender = $("input[name='mgender']:checked").val();
        if (mgender == '') mgender = 'male';
        var dresssize = $("#txtmdresssize").val();
        var amount = $("#txtamount").val();
        var totalamount = $("#txttotalamount").val();
        var ismember = $('#mset').is(":checked");
        //alert(mgender+'--'+dresssize+'--'+ismember);
        if (dresssize == null || dresssize == '') dresssize = "0";

        if (memberid == '' || membername == '' || memmobileno == '')
            alert('please entry vali data.(mobile #, name or other..)');
        else if (mgender == 'male' && dresssize == '0' && ismember)
            alert('please entry dress size');
        else {
            var url = "app-registration-save.php?convid=" + convid + "&memberid=" + memberid + "&memmobileno=" + memmobileno + "&membername=" + membername + "&gender=" + mgender + "&dresssize=" + dresssize + "&amount=" + amount + "&totalamount=" + totalamount + "&ismember=" + ismember;
            //alert(url);
            if (totalamount>0){
            $.ajax({
                url: url, success: function (result) {
                    var datas = $.parseJSON(result);
                    $("#tranid").val(datas.tran_id);
                    var guests = datas.regi_info;
                    var member = datas.member_info;
                    $("#totalamt").val(member.totalamount);
                    $("#btnapp-voucher").click();
                }
            });
           }
           else{
               alert('Altert: There have no transaction data..');
           }

        }
        return false;
    });

    $("#btnapp-registration-admin").click(function () {
        var convid = $("#drconvid").val();
        var memberid = $("#txtmemberid").val();
        var membername = $("#txtmembername").val();
        var memmobileno = $("#txtmemmobile").val();
        var mgender = $("input[name='mgender']:checked").val();
        if (mgender == '') mgender = 'male';
        var dresssize = $("#txtmdresssize").val();
        var amount = $("#txtamount").val();
        var totalamount = $("#txttotalamount").val();
        var ismember = $('#mset').is(":checked");
        //alert(mgender+'--'+dresssize+'--'+ismember);
        if (dresssize == null || dresssize == '') dresssize = "0";

        if (memberid == '' || membername == '' || memmobileno == '')
            alert('please entry vali data.(mobile #, name or other..)');
        else if (mgender == 'male' && dresssize == '0' && ismember)
            alert('please entry dress size');
        else {
            var url = "app-registration-save.php?convid=" + convid + "&memberid=" + memberid + "&memmobileno=" + memmobileno + "&membername=" + membername + "&gender=" + mgender + "&dresssize=" + dresssize + "&amount=" + amount + "&totalamount=" + totalamount + "&ismember=" + ismember;
            //alert(url);
            if (totalamount>0){
            $.ajax({
                url: url, success: function (result) {
                    var datas = $.parseJSON(result);
                    $("#tranid").val(datas.tran_id);
                    var guests = datas.regi_info;
                    var member = datas.member_info;
                    $("#totalamt").val(member.totalamount);
                    $("#btnapp-voucher-admin").click();
                }
            });
           }
           else{
               alert('Altert: There have no transaction data..');
           }

        }
        return false;
    });

    $("#btnapp-regisearch").click(function () {
        var membertype = $("#srdrmtype").val();
        var memmobile = $("#srtxtmobile").val();
        var memberid = $("#srtxtmember").val();
        var convid = $("#srdrconvid").val();
        var tranid = $("#sertranid").val();
        
        memberid = membertype+''+memberid;

        var url = "app-registration-find.php?memberid=" + memberid + "&convid=" + convid + '&tranid=' + tranid+ '&mobile=' + memmobile;
        //alert(url);
        //var gend="";
        if (memberid.length > 0 || memmobile.length > 0) {
            $.ajax({
                url: url, success: function (result) {
                    var datas = $.parseJSON(result);
                    var guests = datas.regi_info;
                    $("#tbody-regi-data").empty();
                    $("#tbody-mem-regi-data").empty();
                    //alert(datas.mem_id);
                    if(guests!=null){
                    $.each(guests, function (i, data) {
                        var strdata = data.memberid.split("|");
                        alert(strdata[0]);
                        if (strdata[0] == 'M')
                            $("#tbody-regi-data").append('<tr><td>Member</td><td>' + data.guestname + '</td><td>' + data.gender + '</td><td>' + data.dresstype + '</td><td>' + data.dresssize + '</td></td><td>' + data.amount + '</td></tr>');
                        else
                            $("#tbody-regi-data").append('<tr><td>Guest</td><td>' + data.guestname + '</td><td>' + data.gender + '</td><td>' + data.dresstype + '</td><td>' + data.dresssize + '</td></td><td>' + data.amount + '</td></tr>');

                       });
                   }
                   else{
                      $("#tbody-mem-regi-data").append('<tr><td>Member </td><td>' + datas.mem_id + '</td><td></td><td></td><td></td></td><td></td></tr>');
                   }

                }
            });

        }
        else {
            alert('entry member id...');
        }
       
        return false;
    });
/*
    $("#btnapp-regi-report").click(function () {
        var convid = $("#sradrconvid").val();

        var rptype = $("input[name='rptype']:checked").val();   
        var sradmtype = $("#sradmtype").val();
        var sradgset = $("#sradgset").val();
        var sradresssize = $("#sradresssize").val();
        if (rptype == 'D') $('#rpt-details').show();
        if (rptype == 'S') $('#rpt-summary').show();
        var url = "app-registration-reports.php?convid=" + convid + "&sradmtype=" + sradmtype + "&sradgset=" + sradgset + "&sradresssize=" + sradresssize + "&rptype=" + rptype;
        //alert(url);
        var rCount=0;
        var rSumAmt=0;
        $.ajax({
            url: url, success: function (result) {
                var datas = $.parseJSON(result);
                $("#tbody-regi-report-data").empty();
                $("#tbody-regi-report-sum-data").empty();
                $.each(datas, function (i, data) {
                    if (rptype=="D"){
                    var srsize = parseInt(data.reg_dress);
                    if (data.reg_dress_type == null || data.reg_dress_type =='') srsize='';
                    if (data.reg_dress_type == 'sharee') srsize='12';

                        rSumAmt = rSumAmt + parseFloat(data.reg_amount);
                        rCount = rCount + 1; 
                    if (data.p_type == 'M')                                             
                        $("#tbody-regi-report-data").append('<tr class="bg-success" style="border: 1px solid black;"><td>Member</td><td>' + data.mem_id + '</td><td>' + data.reg_name + '</td><td>' + toCamelCase(data.reg_gender) + '</td><td>' + toCamelCase(data.reg_dress_type) + '</td><td>' + srsize + '</td><td>' + data.reg_id + '</td><td>' + data.tran_id + '</td></tr>');
                    else
                        $("#tbody-regi-report-data").append('<tr class="bg-default" style="border: 1px solid black;"><td>Guest</td><td>' + data.mem_id + '</td><td>' + data.reg_name + '</td><td>' + toCamelCase(data.reg_gender) + '</td><td>' + toCamelCase(data.reg_dress_type) + '</td><td>' + srsize + '</td><td>' + data.reg_id + '</td><td>' + data.tran_id + '</td></tr>');
                    }
                    else {
                        rCount = rCount + 1;
                        rSumAmt = rSumAmt + parseFloat(data.tAmount);

                        $("#tbody-regi-report-sum-data").append('<tr class="bg-success" style="border: 1px solid black;"><td>' + data.mem_id +'</td><td>' + data.mem_name + '</td><td>' + data.nGuest + '</td><td>' + data.nMale + '</td><td>' + data.nFemale + '</td><td>' + data.nPdress + '</td><td>' + data.nSdress + '</td><td>' + data.tPerson + '</td><td style="text-align:right;">' + data.tAmount + '</td></tr>');    
                    }
                });
                //alert(rSumAmt);
                $("#dtCount").text(rCount);
                $("#dtAmt").text(rSumAmt);
                $("#smCount").text(rCount);
                $("#smAmt").text(rSumAmt);

            }
        });

        return false;

    });*/

    $("#btnapp-regi-report").click(function () {
        var convid = $("#sradrconvid").val();

        var rptype = $("input[name='rptype']:checked").val();
        var sradmtype = $("#sradmtype").val();
        var sradgset = $("#sradgset").val();
        var sradresssize = $("#sradresssize").val(); 
        var sradrconvid = $("#sradrconvid option:selected" ).text(); 
        
        //alert(sradrconvid);  
        //alert(rptype);    
        if (convid == '99000') {
            rptype='M';
            $('#rpt-mem-payment').show();
        }
        else if (convid == '99001') {
            rptype='L';
            $('#rpt-regi-mem-list').show();
        }
        else {
            if (rptype == 'D') $('#rpt-details').show();
            if (rptype == 'S') $('#rpt-summary').show();
        }

        var url = "app-registration-reports.php?convid=" + convid + "&sradmtype=" + sradmtype + "&sradgset=" + sradgset + "&sradresssize=" + sradresssize + "&rptype=" + rptype;
        //alert(url);
        var rCount = 0;
        var rSumAmt = 0;
        $.ajax({
            url: url, success: function (result) {
                var datas = $.parseJSON(result);
                $("#tbody-regi-report-data").empty();
                $("#tbody-regi-report-sum-data").empty();
                $("#tbody-regi-report-mem-data").empty();
                $("#tbody-regi-report-mem-list").empty();
                
                $.each(datas, function (i, data) {
                    if (rptype == "D") {
                        var srsize = parseInt(data.reg_dress);
                        if (data.reg_dress_type == null || data.reg_dress_type == '') srsize = '';
                        if (data.reg_dress_type == 'sharee') srsize = '12';

                        rSumAmt = rSumAmt + parseFloat(data.reg_amount);
                        rCount = rCount + 1;
                        if (data.p_type == 'M')
                            $("#tbody-regi-report-data").append('<tr class="bg-success" style="border: 1px solid black;"><td>Member</td><td>' + data.mem_id + '</td><td>' + data.reg_name + '</td><td>' + toCamelCase(data.reg_gender) + '</td><td>' + toCamelCase(data.reg_dress_type) + '</td><td>' + srsize + '</td><td>' + data.reg_id + '</td><td>' + data.tran_id + '</td></tr>');
                        else
                            $("#tbody-regi-report-data").append('<tr class="bg-default" style="border: 1px solid black;"><td>Guest</td><td>' + data.mem_id + '</td><td>' + data.reg_name + '</td><td>' + toCamelCase(data.reg_gender) + '</td><td>' + toCamelCase(data.reg_dress_type) + '</td><td>' + srsize + '</td><td>' + data.reg_id + '</td><td>' + data.tran_id + '</td></tr>');
                    }
                    else if (rptype == "S") {
                        rCount = rCount + 1;
                        rSumAmt = rSumAmt + parseFloat(data.tAmount);

                        $("#tbody-regi-report-sum-data").append('<tr class="bg-success" style="border: 1px solid black;"><td>' + data.mem_id + '</td><td>' + data.mem_name + '</td><td>' + data.nGuest + '</td><td>' + data.nMale + '</td><td>' + data.nFemale + '</td><td>' + data.nPdress + '</td><td>' + data.nSdress + '</td><td>' + data.tPerson + '</td><td style="text-align:right;">' + data.tAmount + '</td></tr>');
                    }
                    else if (rptype == "M") {
                        rCount = rCount + 1;
                        rSumAmt = rSumAmt + parseFloat(data.tran_amt);

                        $("#tbody-regi-report-mem-data").append('<tr class="bg-success" style="border: 1px solid black;"><td>' + data.mem_id + '</td><td>' + data.mem_name + '</td><td>' + data.tran_date + '</td><td>' + data.tran_amt + '</td><td style="text-align:right;">' + data.tran_id + '</td></tr>');
                    }
                    else if (rptype == "L") {
                        rCount = rCount + 1;
                        $("#tbody-regi-report-mem-list").append('<tr class="bg-success" style="border: 1px solid black;"><td>' + data.mem_id + '</td><td>' + data.mem_name + '</td><td>' + data.regi_date + '</td><td>' + data.mem_contact + '</td><td style="text-align:right;">' + data.pass_year + '</td></tr>');
                    }
                    else{
                        alert('Have no valid serach input....')
                    }


                });
                //alert(rSumAmt);
                $("#rpt-conv").text(sradrconvid)
                $("#dtCount").text(rCount);
                $("#dtAmt").text(rSumAmt);
                $("#smCount").text(rCount);
                $("#smAmt").text(rSumAmt);
                $("#mCount").text(rCount);
                $("#mAmt").text(rSumAmt);

            }
        });

        return false;

    });

    function toCamelCase(text) {
        text = text.replace(/[-_\s.]+(.)?/g, (_, c) => c ? c.toUpperCase() : '');
        return text.substr(0, 1).toUpperCase() + text.substr(1);
    }
    
    $('#rmember_type').change(function () {
        var memtype = $('#rmember_type').val();
        //alert(memtype);
        if (memtype == 'S') {
            $("#div-session-year").show();
            $("#div-pass-year").hide();
        }
        if (memtype == 'G' || memtype == '') {
            $("#div-pass-year").show();
            $("#div-session-year").hide();
        }
        else{
            $("#div-session-year").show();
        }

        return false;
    });

    $("#btnapp-up-search").click(function () {
        var memtype = $("#serchdrmtype").val();
        var memberid = memtype + $("#serchmemid").val();        
        var url = "app-member-status-search.php?memtype=" + memtype + "&memberid=" + memberid;
        $("#lbmemName").text('');
        $('#ckStatus').prop('checked', false);   
        //alert(url);
 
        $.ajax({
            url: url, success: function (result) {
                var datas = $.parseJSON(result);
                //alert(datas);
                $("#serchmemid").val(datas.mem_id);  
                $("#lbmemName").text(datas.mem_name);
                
                if (datas.payment_status=='Y')
                    $('#ckStatus').prop('checked', true);
                else
                    $('#ckStatus').prop('checked', false);
                

                if (datas.member_type == 'G' || datas.member_type == '') {
                    $("#div-pass-year").show();
                    $("#div-session-year").hide();
                }
                else {
                    $("#div-session-year").show();
                }
                //alert(datas.mem_name);
                $("#rmember_type").val(datas.member_type);
                $("#rmem_id").val(datas.mem_id);
                $("#rmem_name").val(datas.mem_name);
                $("#rfather_name").val(datas.mem_fname);
                $("#rmother_name").val(datas.mem_mname);
                $("#gender_type").val(datas.mem_gender);
                $("#rpre_address").val(datas.mem_preaddress);
                $("#rper_address").val(datas.mem_peraddress);
                $("#rphone_no").val(datas.mem_contact);
                $("#remail_add").val(datas.mem_email);
                $("#rhonor_pass").val(datas.own_pass_year);
                $("#rmaster_pass").val(datas.ms_pass_year);
                $("#rhonor_session").val(datas.own_pass_year);
                
            }
        });

        $("#btnapp-up-update").focus();
        return false;
    });
    
    $("#btnapp-up-update").click(function () {
        var memtype = $("#serchdrmtype").val();
        var memberid = $("#serchmemid").val();
        var updatemtype = $("#updatemtype").val();
        
        var mregistat = 'N';
        if ($("#ckStatus").is(":checked"))
          mregistat = 'Y';

        //alert(mregistat);
        var url = "app-member-status-update.php?memtype=" + memtype + "&memberid=" + memberid + "&mregistat=" + mregistat+ "&updatemtype=" + updatemtype;
        alert(url);
        $.ajax({
            url: url, success: function (result) {
                var datas = $.parseJSON(result);  
                
                alert('Member Status Update Done !!');
            }
        });        
        return false;
    });

    $("#btnapp-mem-regi-save").click(function () {

        var membertype = $("#rmember_type").val();
        var rmemid = $("#rmem_id").val();
        var rmemname = $("#rmem_name").val();
        var rfathername = $("#rfather_name").val();

        var rmothername = $("#rmother_name").val();
        var gendertype = $("#gender_type").val();
        var rpreaddress = $("#rpre_address").val();

        var rperaddress = $("#rper_address").val();
        var rphoneno = $("#rphone_no").val();
        var remailadd = $("#remail_add").val();
        var rhonorpass = $("#rhonor_pass").val();
        var rmasterpass = $("#rmaster_pass").val();
        var rhonorsession = $("#rhonor_session").val();
        if (membertype == "S") {
            rhonorpass = rhonorsession;
            rmasterpass = "";
        }
        else {
            rhonorsession = "";
        }

        if (rmemname == '') alert('please member name');
        else if (rphoneno == '') alert('please entry mobile #');
        //else if (membertype == '') alert('please member type');
        else if (rfathername == '') alert('please father name');
        else if (gendertype == '') alert('please select gender type');
        else {
            var url = "app-new-registration-save.php?membertype=" + membertype + "&rmemname=" + rmemname + "&rfathername=" + rfathername + "&rmothername=" + rmothername + "&gendertype=" + gendertype + "&rpreaddress=" + rpreaddress + "&rperaddress=" + rperaddress + "&rphoneno=" + rphoneno + "&remailadd=" + remailadd + "&rhonorpass=" + rhonorpass + "&rmasterpass=" + rmasterpass;
            //alert(url);
            $.ajax({
                url: url, success: function (result) {
                    //alert(result);
                    if(result!=""){
                        $("#btnapp-reg-clear").click();
                        ///alert('Member Save Successfull.....!!!');
                        alert(result); 
                    }                   
                    else
                        alert('Member Save Failed.....!!!');
                }
            });
        }
        return false;
    }); 

    $("#btnapp-mem-regi-update").click(function () {

        var membertype = $("#rmember_type").val();
        var memtype = $("#serchdrmtype").val();
        var rmemid = $("#serchmemid").val();
        var rmemname = $("#rmem_name").val();
        var rfathername = $("#rfather_name").val();
        var rmothername = $("#rmother_name").val();
        var gendertype = $("#gender_type").val();
        var rpreaddress = $("#rpre_address").val();
        var rperaddress = $("#rper_address").val();
        var rphoneno = $("#rphone_no").val();
        var remailadd = $("#remail_add").val();
        var rhonorpass = $("#rhonor_pass").val();
        var rmasterpass = $("#rmaster_pass").val();
        var rhonorsession = $("#rhonor_session").val();
        if (membertype == "S") {
            rhonorpass = rhonorsession;
            rmasterpass = "";
        }
        else {
            rhonorsession = "";
        }

        //alert(rmemid);
        if (rmemname == '') alert('please member name');
        else if (rphoneno == '') alert('please entry mobile #');
        else if (rfathername == '') alert('please father name');
        else if (gendertype == '') alert('please select gender type');
        else {
            var url = "app-new-registration-update.php?memid=" + rmemid + "&membertype=" + membertype + "&rmemname=" + rmemname + "&rfathername=" + rfathername + "&rmothername=" + rmothername + "&gendertype=" + gendertype + "&rpreaddress=" + rpreaddress + "&rperaddress=" + rperaddress + "&rphoneno=" + rphoneno + "&remailadd=" + remailadd + "&rhonorpass=" + rhonorpass + "&rmasterpass=" + rmasterpass;
            //alert(url);
            $.ajax({
                url: url, success: function (result) {
                    //alert(result);
                    if(result=="Y"){
                        $("#btnapp-reg-clear").click();
                        alert('Member Upadate Successfull.....!!!'); 
                    }                   
                    else
                        alert('Member Upadate Failed.....!!!');
                }
            });
        }
        return false;
    }); 


    $("#btnapp-mem-registration").click(function () {
        var membertype = $("#rmember_type").val();
        var rmemid = $("#rmem_id").val();
        var rmemname = $("#rmem_name").val();
        var rfathername = $("#rfather_name").val();

        var rmothername = $("#rmother_name").val();
        var gendertype = $("#gender_type").val();
        var rpreaddress = $("#rpre_address").val();

        var rperaddress = $("#rper_address").val();
        var rphoneno = $("#rphone_no").val();
        var remailadd = $("#remail_add").val();
        var rhonorpass = $("#rhonor_pass").val();
        var rmasterpass = $("#rmaster_pass").val();
        var rhonorsession = $("#rhonor_session").val();
        if (membertype == "S") {
            rhonorpass = rhonorsession;
            rmasterpass = "";
        }
        else {
            rhonorsession = "";
        }

        if (rmemname == '') alert('please member name');
        else if (rphoneno == '') alert('please entry mobile #');
        //else if (membertype == '') alert('please member type');
        else if (rfathername == '') alert('please father name');
        else if (gendertype == '') alert('please select gender type');
        else {
            var url = "app-new-registration.php?membertype=" + membertype + "&rmemname=" + rmemname + "&rfathername=" + rfathername + "&rmothername=" + rmothername + "&gendertype=" + gendertype + "&rpreaddress=" + rpreaddress + "&rperaddress=" + rperaddress + "&rphoneno=" + rphoneno + "&remailadd=" + remailadd + "&rhonorpass=" + rhonorpass + "&rmasterpass=" + rmasterpass;
            //alert(url);
            $.ajax({
                url: url, success: function (result) {
                    if (result != '' && membertype==''){
                        //alert('Dear member your registration success..Member ID: '+result);
                        if (confirm('Dear member your registration success..Member ID: ' + result + '\n' 
                            +'Are you want to complete pay through online?')) 
                        {
                            //------------------                           
                            window.open('payment-regi.php?memberid=' + result + '&rmemname=' + rmemname, "wndPopUp", 'width=1200,height=800');

                            return false;
                        } else {
                            $("#btnapp-reg-clear").click();
                            alert('Dear Sir your registration success..Member ID: ' + result+'\n Please contact at 01765773311, for Payment Next Time Through Offline..');
                        }
                    }
                    else if (result != ''){
                        $("#btnapp-reg-clear").click();
                        alert('Dear Sir your registration success..Member ID: ' + result );
                        alert('Please keep it Safe Member ID: ' + result +' , if you forget then search by your mobile #');
                    }
                    else 
                        alert('Dear Sir your registration fail, plz retry with valid data..');
                }
            });
        }
        return false;
    });    

    $("#btnapp-reg-clear").click(function () {        
        var url = "app-registration-clear.php";
        //alert(url);
        $.ajax({
            url: url, success: function (result) {
                //alert(result);
                $("#rmem_id").val('');
                $("#rmem_name").val('');
                $("#rfather_name").val('');
                $("#rmother_name").val('');
                $("#rpre_address").val('');
                $("#rper_address").val('');
                $("#rphone_no").val('');
                $("#remail_add").val(''); 
                $("#rhonor_session").val(''); 
                $("#rhonor_pass").val(''); 
                $("#rmaster_pass").val(''); 
            }
        });

        return false;

    });

    $("#btnapp-voucher").click(function (event) {
        var amount = $("#totalamt").val(); // "Save";           
        var tranid = $("#tranid").val();
        var memberid = $("#txtmemberid").val();
        var convid = $("#drconvid").val();
        window.open('payment.php?memberid=' + memberid + '&convid=' + convid + '&amount=' + amount + '&tranid=' + tranid, "wndPopUp", 'width=1200,height=800');
        return false;
    });

    $("#btnapp-voucher-admin").click(function (event) {
        var amount = $("#totalamt").val(); // "Save";           
        var tranid = $("#tranid").val();
        var memberid = $("#txtmemberid").val();
        var convid = $("#drconvid").val();
        window.open('payment-admin.php?memberid=' + memberid + '&convid=' + convid + '&amount=' + amount + '&tranid=' + tranid, "wndPopUp", 'width=1200,height=800');
        return false;
    });


    $('#LoginModal').on('shown.bs.modal', function () {
        $('#LoginModaldiv').modal('show');
    });

    $("#btnapp-login").click(function () {
        var useremail = $("#useremail").val();
        var userpass = $("#userpass").val();
        //alert(memberid);
        var url = "app-admin-login.php?useremail=" + useremail + "&userpass=" + userpass;
        //alert(url);
        $.ajax({
            url: url, success: function (result) {
                $("#loginStat").html(result);
                $('#LoginModaldiv').modal('hide');
                alert(result);
            }
        });
        //window.location.href = "index.php"
        location.reload();
        return true;
    });

    $("#btnapp-print").click(function () {

        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = { mode: mode, popClose: close };
        $("div.PrintArea").printArea(options);

        return false;
    });

    $("#btnapp-mem-list-print").click(function () {

        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = { mode: mode, popClose: close };
        $("div.PrintAreaMem").printArea(options);

        return false;
    });

    $("#btnapp-mem-voucher").click(function () {

        var left = 5;
        var top = 5;
        
        var memid = $("#srdrmtype").val()+$("#srtxtmember").val();        
        var convid = $("#srdrconvid").val();

        //alert("payment-voucher-mem-regi.php?memberid="+memid+"&convid="+convid);
        window.open("payment-voucher-mem-regi.php?memberid="+memid+"&convid="+convid, "Member Voucher", "menubar=no,toolbar=no,status=no,width=1200,height=600,top=5,left=5");

        return false;
    });
    
    $("#btnapp-regi-voucher").click(function () {

        var left = 5;
        var top = 5;
        
        var memid = $("#srdrmtype").val()+$("#srtxtmember").val();        
        var convid = $("#srdrconvid").val();

        window.open("payment-voucher-event.php?memberid="+memid+"&convid="+convid, "Event Voucher", "menubar=no,toolbar=no,status=no,width=1200,height=600,top=5,left=5");
        return false;
    });




});