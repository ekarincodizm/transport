//Create By Kimniyom

$(document).ready(function () {
    compensate_calculus();
    load_outgoings();
    load_expenses();
});

//คำนวณรายได้
function Income_Calculator(type) {
    var weigh = $("#weigh").val();
    var unit_price = $("#unit_price").val();
    var per_times = $("#per_times").val();
    var total;
    //var number;
    if (type == 0) {
        Unit_price_Calculator();
        $("#per_times").val("");
        total = (weigh * unit_price);
        var number = accounting.formatNumber(total, 2);
        $("#income_txt").val(number);
        $("#income").val(total);
    } else {
        Pertimes_Calculator();
        $("#unit_price").val("");
        var number = accounting.formatNumber(per_times, 2);
        $("#income_txt").val(number);
        $("#income").val(per_times);
    }
}

//กรณีเลือกคิดตามน้ำหนัก
function Unit_price_Calculator() {
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
function Pertimes_Calculator() {
    $("#type_calculus").val(1);
    $("#unit_price").val("");
    var weigh = $("#weigh").val();
    if (weigh == "") {
        $("#per_times").prop("disabled", true);
        //alert("ยังไม่ได้กรอกช่องน้ำหนัก ...");
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
function save_assign() {
    var url = $("#Url_save_assign").val();
    var driver1 = $("#driver1").val();
    var driver2 = $("#driver2").val();

    var assign_id = $("#assign_id").val();
    var car_id = $("#car_id").val();
    var employer = $("#employer").val();
    var order_date_start = $("#order_date_start").val();
    var order_date_end = $("#order_date_end").val();
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
        employer: employer,
        car_id: car_id,
        order_date_start: order_date_start,
        order_date_end: order_date_end,
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

    if (employer == "") {
        $("#employer").focus();
        return false;
    }

    if (car_id == "") {
        $("#car_id").focus();
        return false;
    }

    if (driver1 == "") {
        $("#driver1").focus();
        return false;
    }

    if (oil_set == "") {
        $("#oil_set").focus();
        return false;
    }


    if (transport_date == "") {
        $("#transport_date").focus();
        return false;
    }

    if (cus_start == "") {
        $("#cus_start").focus();
        return false;
    }

    if (cus_end == "") {
        $("#cus_end").focus();
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


    if (product_type == "") {
        $("#product_type").focus();
        return false;
    }

    if (weigh == "") {
        $("#weigh").focus();
        return false;
    }

    if (type_calculus == "") {
        swal("แจ้งเตือน!", "ยังไม่ได้เลือกประเภทขนส่ง ..!", "warning");
        return false;
    }

    $.post(url, data, function (success) {
        swal("Success", "สร้างใบงานเสร็จแล้ว ..!", "success");
        //window.location.reload();
        window.location = "index.php?r=order-transport";
    });

}

//##################### แก้ไขใบสั่งงาน #################
function update_assign() {
    var url = $("#Url_update_assign").val();
    var id = $("#id").val();
    var driver1 = $("#driver1").val();
    var driver2 = $("#driver2").val();

    var assign_id = $("#assign_id").val();
    var car_id = $("#car_id").val();
    var employer = $("#employer").val();
    var order_date_start = $("#order_date_start").val();
    var order_date_end = $("#order_date_end").val();
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
        id: id,
        assign_id: assign_id,
        employer: employer,
        car_id: car_id,
        order_date_start: order_date_start,
        order_date_end: order_date_end,
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

    if (employer == "") {
        $("#employer").focus();
        return false;
    }

    if (car_id == "") {
        $("#car_id").focus();
        return false;
    }

    if (driver1 == "") {
        $("#driver1").focus();
        return false;
    }

    if (oil_set == "") {
        $("#oil_set").focus();
        return false;
    }


    if (transport_date == "") {
        $("#transport_date").focus();
        return false;
    }

    if (cus_start == "") {
        $("#cus_start").focus();
        return false;
    }

    if (cus_end == "") {
        $("#cus_end").focus();
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


    if (product_type == "") {
        $("#product_type").focus();
        return false;
    }

    if (weigh == "") {
        $("#weigh").focus();
        return false;
    }

    if (type_calculus == "") {
        swal("แจ้งเตือน!", "ยังไม่ได้เลือกประเภทขนส่ง ..!", "warning");
        return false;
    }

    if (unit_price == '' && per_times == '') {
        swal("แจ้งเตือน!", "ยังไม่ได้ใส่ราคาขนส่ง ..!", "warning");
        return false;
    }

    $.post(url, data, function (success) {
        swal("Success!", "แก้ไขข้อมูลแล้ว ..!", "success");
        window.location.reload();
    });

}

//########## บันทึกค้าเชื้อเพลิง #################//
function save_fuel() {
    var url = $("#Url_save_fuel").val();
    var assign_id = $("#assign_id").val();
    var license_plate = $("#license_plate_1").val();
    var oil = $("#oil").val();
    var oil_unit = $("#oil_unit").val();
    var oil_price = $("#oil_price").val();
    var gas = $("#gas").val();
    var gas_unit = $("#gas_unit").val();
    var gas_price = $("#gas_price").val();
    var old_mile = $("#old_mile").val();
    var now_mile = $("#now_mile").val();
    var distance = $("#distance").val();
    var avg_oil = $("#avg_oil").val();
    var compensate = $("#compensate").val();

    if (oil == "" || oil_unit == "" || now_mile == "") {
        //alert("กรอกข้อมูลในเครื่อง * ไม่ครบ");
        swal("แจ้งเตือน!", "กรอกข้อมูลในเครื่อง * ไม่ครบ ..!", "warning");
        return false;
    }
    var data = {
        assign_id: assign_id,
        license_plate: license_plate,
        oil: oil,
        oil_unit: oil_unit,
        oil_price: oil_price,
        gas: gas,
        gas_unit: gas_unit,
        gas_price: gas_price,
        old_mile: old_mile,
        now_mile: now_mile,
        distance: distance,
        avg_oil: avg_oil,
        compensate: compensate
    };

    $.post(url, data, function (datas) {
        $("#oil").val(datas.oil);
        $("#oil_unit").val(datas.oil_unit);
        $("#oil_price").val(datas.oil_price);
        $("#gas").val(datas.gas);
        $("#gas_unit").val(datas.gas_unit);
        $("#gas_price").val(datas.gas_price);
        $("#old_mile").val(datas.old_mile);
        $("#now_mile").val(datas.now_mile);
        $("#distance").val(datas.avg_oil);
        $("#avg_oil").val(datas.avg_oil);
        $("#compensate").val(datas.compensate);
    }, "json");

    swal("Success...", "บันทึกข้อมูลในส่วนนี้แล้ว", "success");

    //$("#process_fuel_success").fadeIn(300).delay(1000).fadeOut(400);
}

function oil_calculus() {
    var oil = $("#oil").val();
    var oil_unit = $("#oil_unit").val();
    var total = (oil * oil_unit);
    var number = accounting.formatNumber(total, 2);
    $("#oil_price_txt").val(number);
    $("#oil_price").val(total);

    distance_calculus();
    compensate_calculus();
}

function gas_calculus() {
    var gas = $("#gas").val();
    var gas_unit = $("#gas_unit").val();
    var total = (gas * gas_unit);
    var number = accounting.formatNumber(total, 2)
    $("#gas_price_txt").val(number);
    $("#gas_price").val(total);
}


//คำนวณระยะทาง 
function distance_calculus() {
    var now_mile = $("#now_mile").val();
    var old_mile = $("#old_mile").val();
    var totla_mile = parseInt((now_mile - old_mile));
    var avg;//ค่าเฉลี่ย
    var oil = $("#oil").val();
    if (totla_mile < 1) {
        avg = 0;
    } else {
        avg = accounting.formatNumber(totla_mile / oil, 2);
    }

    if (parseInt(now_mile) < parseInt(old_mile)) {
        $("#distance").val(0);
    } else {
        $("#distance").val(totla_mile);
    }

    $("#avg_oil").val(avg);
}

//ชดเชยน้ำมัน
function compensate_calculus() {
    var oil = $("#oil").val();//น้ำมันที่เติม
    var oil_set_ofter = $("#oil_set_ofter").val();
    var total = parseInt((oil_set_ofter - oil));

    if (parseInt(oil) > parseInt(oil_set_ofter)) {
        $("#compensate").val(total);
    } else {
        $("#compensate").val(0);
    }
}

/**#######ค่าใช้จ่ายอื่น ๆ #######**/
function load_outgoings() {
    var url = $("#Url_outgoings").val();
    var assign_id = $("#assign_id").val();
    var data = {assign_id: assign_id};
    $.post(url, data, function (datas) {
        $("#tb_outgoings").html(datas);
    });
}

function save_outgoings() {
    $("#l-ding").show();
    var url = $("#Url_save_outgoings").val();
    var assign_id = $("#assign_id").val();
    var detail = $("#detail").val();
    var price = $("#price").val();
    if (detail == '' || price == '') {
        $("#l-ding").hide();
        //alert("กรอกข้อมูลไม่ครบ ...");
        swal("แจ้งเตือน!", "กรอกข้อมูลไม่ครบ ..!", "warning");
        return false;
    }
    var data = {
        assign_id: assign_id,
        detail: detail,
        price: price
    };
    $.post(url, data, function (datas) {
        load_outgoings();
        $("#detail").val("");
        $("#price").val("");
        $("#l-ding").hide();
    });
}

/*########### ค่าใช้จ่ายเกี่ยวกับตัวรถ #############*/
function load_expenses() {
    var url = $("#Url_expenses").val();
    var assign_id = $("#assign_id").val();
    var data = {assign_id: assign_id};
    $.post(url, data, function (datas) {
        $("#tb_expenses").html(datas);
    });
}

function save_expenses() {
    $("#e-ding").show();
    var url = $("#Url_save_expenses").val();
    var car_id = $("#car_id").val();
    var assign_id = $("#assign_id").val();
    var truck_license = $("#truck_license").val();
    var detail = $("#truck_detail").val();
    var price = $("#truck_price").val();
    if (detail == '' || price == '' || truck_license == '') {
        $("#e-ding").hide();
        //alert("กรอกข้อมูลไม่ครบ ...");
        swal("แจ้งเตือน!", "กรอกข้อมูลไม่ครบ..!", "warning");
        return false;
    }
    var data = {
        car_id: car_id,
        assign_id: assign_id,
        truck_license: truck_license,
        detail: detail,
        price: price
    };
    $.post(url, data, function (datas) {
        load_expenses();
        $("#truck_detail").val("");
        $("#truck_price").val("");
        $("#e-ding").hide();
    });
}

//บันทึกหมายเหตุ
function save_messages() {
    var url = $("#Url_save_message").val();
    var assign_id = $("#assign_id").val();
    var message = $("#message").val();
    //alert(message);
    var data = {message: message, assign_id: assign_id};

    $.post(url, data, function (success) {
        swal("Success...", "บันทึกข้อมูลในส่วนนี้แล้ว", "success");
        //$("#process_success").fadeIn(300).delay(1000).fadeOut(400);
    });
}
