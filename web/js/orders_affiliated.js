//Create By Kimniyom
$(document).ready(function(){
   Calculator_total(); 
});
//คำนวณรายได้
function Income_Calculator_affiliated(type) {
    var weigh = $("#weigh").val();
    var unit_price = $("#unit_price").val();
    var per_times = $("#per_times").val();
    var total;
    //var number;
    if (type == 0) {
        $("#per_times").val("");
        total = (weigh * unit_price);
        var number = accounting.formatNumber(total, 2);
        $("#income_txt").val(number);
        $("#income").val(total);
    } else {
        $("#unit_price").val("");
        var number = accounting.formatNumber(per_times, 2);
        $("#income_txt").val(number);
        $("#income").val(per_times);
    }
}

//กรณีเลือกคิดตามน้ำหนัก
function Unit_price_Calculator_affiliated() {
    $("#type_calculus").val(0);
    $("#per_times").val("");
    var weigh = $("#weigh").val();
    if (weigh == "") {
        $("#unit_price").prop("disabled", true);
        //alert("ยังไม่ได้กรอกช่องน้ำหนัก ...");
        swal("แจ้งเตือน!", "ยังไม่ได้กรอกช่องน้ำหนัก..!", "warning");
        $("#r1").prop("checked", false);
        $("#weigh").focus();
        return false;
    }
    $("#income").val(0);
    $("#income_txt").val(0);
    $("#unit_price").prop("disabled", false);
    $("#per_times").prop("disabled", true);
}

//กรณีคิดตามเที่ยว
function Pertimes_Calculator_affiliated() {
    $("#type_calculus").val(1);
    $("#unit_price").val("");
    var weigh = $("#weigh").val();
    if (weigh == "") {
        $("#per_times").prop("disabled", true);
        swal("แจ้งเตือน!", "ยังไม่ได้กรอกช่องน้ำหนัก..!", "warning");
        $("#r2").prop("checked", false);
        $("#weigh").focus();
        return false;
    }
    $("#income").val(0);
    $("#income_txt").val(0);
    $("#per_times").prop("disabled", false);
    $("#unit_price").prop("disabled", true);
}


//##################### บันทึกใบสั่งงาน #################
function save_assign_affiliated() {
    var url = $("#Url_save_assign").val();
    var driver1 = $("#driver1").val();
    var driver2 = $("#driver2").val();

    var assign_id = $("#assign_id").val();
    var order_id = $("#order_id").val();
    var transport_date = $("#transport_date").val();
    var cus_start = $("#cus_start").val();
    var cus_end = $("#cus_end").val();
    var changwat_start = $("#changwat_start").val();
    var changwat_end = $("#changwat_end").val();
    var product_type = $("#product_type").val();
    var weigh = $("#weigh").val();
    var oil_set = $("#oil_set").val();
    var type_calculus = $("#type_calculus").val();
    var unit_price = $("#unit_price").val();
    var per_times = $("#per_times").val();
    var income = $("#income").val();
    var allowance_driver1 = $("#allowance_driver1").val();
    var allowance_driver2 = $("#allowance_driver2").val();

    var data = {
        assign_id: assign_id,
        order_id: order_id,
        transport_date: transport_date,
        cus_start: cus_start,
        cus_end: cus_end,
        changwat_start: changwat_start,
        changwat_end: changwat_end,
        product_type: product_type,
        weigh: weigh,
        type_calculus: type_calculus,
        unit_price: unit_price,
        per_times: per_times,
        income: income,
        allowance_driver1: allowance_driver1,
        allowance_driver2: allowance_driver2,
        driver1: driver1,
        driver2: driver2
    };

    //Validate 
    if (transport_date == "") {
        $("#transport_date").focus();
        return false;
    }

    if (cus_start == "") {
        $("#cus_start").focus();
        return false;
    }

    if (changwat_start == "") {
        $("#changwat_start").focus();
        return false;
    }

    if (changwat_end == "") {
        $("#changwat_end").focus();
        return false;
    }

    if (cus_end == "") {
        $("#cus_end").focus();
        return false;
    }

    if (product_type == "") {
        $("#product_type").focus();
        return false;
    }

    if (weigh == "") {
        $("#weigh").focus();
        return false;
    }
    
    if (type_calculus == "") {
        $("#type_calculus").focus();
        return false;
    }

    $.post(url, data, function (success) {
        window.location.reload();
    });

}

//บันทึกหมายเหตุ
function save_message() {
    var url = $("#Url_save_message").val();
    var order_id = $("#order_id").val();
    var message = $("#message").val();
    var income_total = $("#income_total").val();
    var price_affiliated = $("#price_affiliated_txt").val();
    var price_employer = $("#price_employer").val();
    var data = {
        message: message, 
        order_id: order_id,
        income_total: income_total,
        price_affiliated: price_affiliated,
        price_employer: price_employer
    };

    $.post(url, data, function (success) {
        swal("บันทึกรายการสำเร็จ", "บันทึกรายการสำเร็จ", "success");
        window.location.reload();
        //$("#process_success").fadeIn(300).delay(1000).fadeOut(400);
    });
}

//คำนวนรายได้
//คำนวณรายได้
function Calculator_total() {
    var price_employer = $("#price_employer").val();
    var price_affiliated = $("#price_affiliated_txt").val();
    var total;
    //var number;
        total = (parseInt(price_employer) - parseInt(price_affiliated));
        var number = accounting.formatNumber(total, 2);
        $("#income_total_txt").val(number);
        $("#income_total").val(total);
}

