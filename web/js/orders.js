//Create By Kimniyom
//คำนวณรายได้
function Income_Calculator(type) {
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
function Unit_price_Calculator() {
    $("#type_calculus").val(0);
    var weigh = $("#weigh").val();
    if (weigh == "") {
        $("#unit_price").prop("disabled", true);
        alert("ยังไม่ได้กรอกช่องน้ำหนัก ...");
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
function Pertimes_Calculator() {
    $("#type_calculus").val(1);
    var weigh = $("#weigh").val();
    if (weigh == "") {
        $("#per_times").prop("disabled", true);
        alert("ยังไม่ได้กรอกช่องน้ำหนัก ...");
        $("#r2").prop("checked", false);
        $("#weigh").focus();
        return false;
    }
    $("#income").val(0);
    $("#income_txt").val(0);
    $("#per_times").prop("disabled", false);
    $("#unit_price").prop("disabled", true);
}

//บันทึกน้ำมันที่กำหนด
function Save_before_release() {
    var url = $("#Url_save_before_release").val();
    var order_id = $("#order_id").val();
    var oil_set = $("#oil_set").val();
    var data = {order_id: order_id, oil_set: oil_set};

    if (oil_set == "") {
        alert("ช่องน้ำมันที่กำหนดต้องไม่เป็นค่าว่าง ..");
        $("#oil_set").focus();
        return false;
    }

    $.post(url, data, function (datas) {
        alert("บันทึกข้อมูลแล้ว");
        $("#oil_set").val(datas.oil_set);
        $("#oil_set_ofter").val(datas.oil_set);
    }, "json");
}

//##################### บันทึกใบสั่งงาน #################
function save_assign() {
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
        oil_set: oil_set,
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

    if (oil_set == "") {
        $("#oil_set").focus();
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

//########## บันทึกค้าเชื้อเพลิง #################//
function save_fuel() {
    var url = $("#Url_save_fuel").val();
    var order_id = $("#order_id").val();
    var oil = $("#oil").val();
    var oil_unit = $("#oil_unit").val();
    var oil_price = $("#oil_price").val();
    var gas = $("#gas").val();
    var gas_unit = $("#gas_unit").val();
    var gas_price = $("#gas_price").val();

    var data = {
        order_id: order_id,
        oil: oil,
        oil_unit: oil_unit,
        oil_price: oil_price,
        gas: gas,
        gas_unit: gas_unit,
        gas_price: gas_price
    };

    $.post(url, data, function (datas) {
        $("#oil").val(datas.oil);
        $("#oil_unit").val(datas.oil_unit);
        $("#oil_price").val(datas.oil_price);
        $("#gas").val(datas.gas);
        $("#gas_unit").val(datas.gas_unit);
        $("#gas_price").val(datas.gas_price);
    }, "json");
}

function oil_calculus() {
    var oil = $("#oil").val();
    var oil_unit = $("#oil_unit").val();
    var total = (oil * oil_unit);
    var number = accounting.formatNumber(total, 2);
    $("#oil_price_txt").val(number);
    $("#oil_price").val(total);
}

function gas_calculus() {
    var gas = $("#gas").val();
    var gas_unit = $("#gas_unit").val();
    var total = (gas * gas_unit);
    var number = accounting.formatNumber(total, 2)
    $("#gas_price_txt").val(number);
    $("#gas_price").val(total);
}

