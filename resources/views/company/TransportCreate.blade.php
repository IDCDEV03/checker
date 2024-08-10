@extends('layouts.companyapp')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-warning mb-3">
                <div class="card-header">เพิ่มบริษัทผู้ขนส่งใหม่</div>

                <div class="card-body ">
                    <form method="POST" action="{{route('company_TransportInsert')}}" >
                        @csrf

                        <div class="row mb-3">
                            <label for="course" class="col-md-4 col-form-label text-md-end">ชื่อบริษัท<span class="text-danger">*</span></label>                       
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="ts_name" required autofocus>
                                </div>                          
                        </div>

                 
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">ที่อยู่<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="ts_address" >
                            </div>
                        </div>
                   

                        <div class="row mb-3">
                            <label for="course" class="col-md-4 col-form-label text-md-end">จังหวัด<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                              
                                <select id="input_province" name="ts_province"  class="form-control">
                                    <option value="">-กรุณาเลือกจังหวัด</option>
                                </select>
                              
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="course" class="col-md-4 col-form-label text-md-end">อำเภอ<span class="text-danger">*</span></label>
                            <div class="col-md-6">

                                <select id="input_amphoe" name="ts_amphur"   class="form-control">
                                    <option value="">-กรุณาเลือกเขต/อำเภอ</option>
                                </select>
                                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="course" class="col-md-4 col-form-label text-md-end">ตำบล<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <select id="input_tambon" name="ts_tambon"   class="form-control">
                                    <option value="">-กรุณาเลือกแขวง/ตำบล</option>
                                    </select>
                              
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="course" class="col-md-4 col-form-label text-md-end">รหัสไปรษณีย์<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                              
                                <input id="input_zipcode" name="ts_zipcode"   class="form-control" placeholder="รหัสไปรษณีย์" />
                              
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="course" class="col-md-4 col-form-label text-md-end">เบอร์โทร</label>
                            <div class="col-md-6">
                              
                             <input id="phone" type="text" class="form-control" name="ts_phone"  >
                              
                            </div>
                        </div>

                  
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   บันทึก
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showProvinces() {
    let input_province = document.querySelector("#input_province");
    let url = "https://ckartisan.com/api/provinces";
    console.log(url);
    // if(input_province.value == "") return;
    fetch(url)
    .then((response) => response.json())
    .then((result) => {
        console.log(result);
        //UPDATE SELECT OPTION
        let input_province = document.querySelector("#input_province");
        input_province.innerHTML =
        '<option value="">-กรุณาเลือกจังหวัด</option>';
        for (let item of result) {
        let option = document.createElement("option");
        option.text = item.province;
        option.value = item.province;
        input_province.appendChild(option);
        }
        //QUERY AMPHOES
        showAmphoes();
    });
}

function showAmphoes() {
    let input_province = document.querySelector("#input_province");
    let url =
    "https://ckartisan.com/api/amphoes?province=" + input_province.value;
    console.log(url);
    // if(input_province.value == "") return;
    fetch(url)
    .then((response) => response.json())
    .then((result) => {
        console.log(result);
        //UPDATE SELECT OPTION
        let input_amphoe = document.querySelector("#input_amphoe");
        input_amphoe.innerHTML =
        '<option value="">-กรุณาเลือกเขต/อำเภอ</option>';
        for (let item of result) {
        let option = document.createElement("option");
        option.text = item.amphoe;
        option.value = item.amphoe;
        input_amphoe.appendChild(option);
        }
        //QUERY AMPHOES
        showTambons();
    });
}
function showTambons() {
    let input_province = document.querySelector("#input_province");
    let input_amphoe = document.querySelector("#input_amphoe");
    let url =
    "https://ckartisan.com/api/tambons?province=" +
    input_province.value +
    "&amphoe=" +
    input_amphoe.value;
    console.log(url);
    // if(input_province.value == "") return;
    // if(input_amphoe.value == "") return;
    fetch(url)
    .then((response) => response.json())
    .then((result) => {
        console.log(result);
        //UPDATE SELECT OPTION
        let input_tambon = document.querySelector("#input_tambon");
        input_tambon.innerHTML =
        '<option value="">-กรุณาเลือกแขวง/ตำบล</option>';
        for (let item of result) {
        let option = document.createElement("option");
        option.text = item.tambon;
        option.value = item.tambon;
        input_tambon.appendChild(option);
        }
        //QUERY AMPHOES
        showZipcode();
    });
}
function showZipcode() {
    let input_province = document.querySelector("#input_province");
    let input_amphoe = document.querySelector("#input_amphoe");
    let input_tambon = document.querySelector("#input_tambon");
    let url =
    "https://ckartisan.com/api/zipcodes?province=" +
    input_province.value +
    "&amphoe=" +
    input_amphoe.value +
    "&tambon=" +
    input_tambon.value;
    console.log(url);
    // if(input_province.value == "") return;
    // if(input_amphoe.value == "") return;
    // if(input_tambon.value == "") return;
    fetch(url)
    .then((response) => response.json())
    .then((result) => {
        console.log(result);
        //UPDATE SELECT OPTION
        let input_zipcode = document.querySelector("#input_zipcode");
        input_zipcode.value = "";
        for (let item of result) {
        input_zipcode.value = item.zipcode;
        break;
        }
    });
}
//EVENTS
document
    .querySelector("#input_province")
    .addEventListener("change", (event) => {
    showAmphoes();
    });
document
    .querySelector("#input_amphoe")
    .addEventListener("change", (event) => {
    showTambons();
    });
document
    .querySelector("#input_tambon")
    .addEventListener("change", (event) => {
    showZipcode();
    });

showProvinces();
</script>


@endsection
