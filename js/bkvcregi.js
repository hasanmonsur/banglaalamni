$(document).ready(function () {
    var memberid = $("#memberid").val();
    var membername = $("#txtmembernames").val();
    var convid = $("#convid").val();
    var tranid = $("#tranid").val();
    $("#btnapp-print").hide();
    $("#bKash_button").hide();
    var url = "app-transaction-query.php?memberid=" + memberid + "&convid=" + convid + '&tranid=' + tranid;
    //alert(url);
    $.ajax({
        url: url, success: function (result) {
            var datas = $.parseJSON(result);
            //alert(result);  
            $("#paymenttime").val(datas.tran_date);            

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

});  
