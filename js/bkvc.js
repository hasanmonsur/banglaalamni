$(document).ready(function () {
    var memberid = $("#memberid").val();
    var convid = $("#convid").val();
    var tranid = $("#tranid").val();
    $("#btnapp-print").hide();
    $("#bKash_button").hide();
    var url = "app-registration-query.php?memberid=" + memberid + "&convid=" + convid + '&tranid=' + tranid;
    //alert(url);
    $.ajax({
        url: url, success: function (result) {
            var datas = $.parseJSON(result);
            //alert(result);  
            $("#paymenttime").val(datas.tran_date);
            var guests = datas.regi_info;
            $("#tbody-regi-data").empty();
            $.each(guests, function (i, data) {
                var strdata = data.memberid.split("|");
                //alert(strdata[0]);
                if (strdata[0]=='M')
                    $("#tbody-regi-data").append('<tr><td>Member</td><td>' + data.guestname + '</td><td>' + data.gender + '</td><td>' + data.dresstype + '</td><td>' + data.dresssize + '</td></td><td>' + data.amount + '</td></tr>');
                else
                    $("#tbody-regi-data").append('<tr><td>Guest</td><td>' + data.guestname + '</td><td>' + data.gender + '</td><td>' + data.dresstype + '</td><td>' + data.dresssize + '</td></td><td>' + data.amount + '</td></tr>');
            });

            if (datas.tran_status == 'Y')
                {
                $("#tran_status").val('PAID');
                $("#btnapp-print").show();
                $("#bKash_button").hide();
                }
            else
                {
                    $("#tran_status").val('UNPAID');
                    $("#btnapp-print").hide();
                    $("#bKash_button").show();                
                }

        }
    });

    $("#btnapp-print").click(function () {
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = { mode: mode, popClose: close };
        $("div.PrintArea").printArea(options);
        $("#bKash_button").hide();
        return false;
    });

    $("#btnapp-print-02").click(function () {
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = { mode: mode, popClose: close };
        $("div.PrintArea").printArea(options);
        //$("#bKash_button").hide();
        return false;
    });

});  
