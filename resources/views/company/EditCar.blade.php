@extends('layouts.companyapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">แก้ไขข้อมูลรถ</div>
                <div class="card-body">
                    @foreach ($edit_data as $item)
                    <form action="{{route('company_updatecar',['id'=>request()->id,'form_id'=>$item->form_id])}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="car_plate" class="form-label">ทะเบียนรถ</label>
                            <input type="text" class="form-control" id="car_plate" name="car_plate"
                                value="{{$item->car_plate}}">
                        </div>
                        <div class="mb-3">
                            <label for="car_plate" class="form-label">ทะเบียนจังหวัด</label>
                            <select class="form-select" name="car_province">
                                <option value="{{ $item->car_province }}">>>{{ $item->car_province }}</option>
                                @foreach ($province_th as $row)
                                    <option value="{{ $row->name_th }}">{{ $row->name_th }}</option>
                                @endforeach
                            </select>
                        </div>

                        @if ($item->form_type == 1)
                            <div class="mb-3">
                                <label for="car_plate" class="form-label">ชนิดรถ</label>
                                <select class="form-select" name="car_type">
                                    <option value="{{ $item->car_type }}">>>{{ $item->car_type }}</option>
                                    <option value="รถยนต์">รถยนต์</option>
                                    <option value="รถกระบะ">รถกระบะ</option>
                                    <option value="รถตู้">รถตู้</option>
                                </select>
                            </div>
                        @elseif ($item->form_type == 2)
                            <div class="mb-3">
                                <label for="car_plate" class="form-label">ชนิดรถ</label>
                                <select class="form-select" name="car_type">
                                    <option selected disabled>--เลือกประเภท</option>
                                    <option value="รถหกล้อ">รถ 6 ล้อ</option>
                                    <option value="รถสิบล้อ">รถ 10 ล้อ</option>
                                    <option value="รถพ่วง">รถพ่วง</option>
                                    <option value="รถกึ่งพ่วง">รถกึ่งพ่วง</option>
                                </select>
                            </div>
                        @endif


                        <button type="submit" class="btn btn-primary">บันทึก</button>
                @endforeach
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
