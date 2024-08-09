@extends('layouts.companyapp')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">ตั้งค่าฟอร์ม</div>
                    <div class="card-body">
                        @foreach ($form_name as $item)
                            <span class="h4">แบบฟอร์ม :: {{ $item->form_name }}</span>

                            <hr>
                            <form action="{{ route('company_insertcar', ['form_id' => request()->form_id]) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="car_plate" class="form-label">ทะเบียนรถ</label>
                                    <input type="text" class="form-control" id="car_plate" name="car_plate"
                                        placeholder="ระบุหมายเลขทะเบียนรถ">
                                </div>
                                <div class="mb-3">
                                    <label for="car_plate" class="form-label">ทะเบียนจังหวัด</label>
                                    <select class="form-select" name="car_province">
                                        <option selected disabled>--เลือกจังหวัด</option>
                                        @foreach ($province_th as $row)
                                            <option value="{{ $row->name_th }}">{{ $row->name_th }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @if ($item->form_type == 1)
                                    <div class="mb-3">
                                        <label for="car_plate" class="form-label">ชนิดรถ</label>
                                        <select class="form-select" name="car_type">
                                            <option selected disabled>--เลือกประเภท</option>
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
                        <hr>
                        <table class="table table-bordered" id="dataTables">
                            <thead class="table-warning">
                                <th>#</th>
                                <th>ทะเบียนรถ</th>
                                <th>ประเภทรถ</th>
                                <th>สถานะ</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($car_data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->car_plate }} {{ $item->car_province }}</td>
                                        <td>{{ $item->car_type }}</td>
                                        <td>
                                            @if ($item->car_status == '1')
                                                <span class="badge text-bg-success">ปกติ</span>
                                            @else
                                                <span class="badge text-bg-danger">ปิดการใช้</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a class="btn btn-primary" href="{{route('company_editcar',['id'=>$item->id])}}"><i class="las la-pen"></i>
                                                    แก้ไข</a>
                                                @if ($item->car_status == '1')
                                                    <a href="{{route('company_updatestatuscar',['form_id'=>$item->form_id,'id'=>$item->id,'status'=>'close'])}}" class="btn btn-secondary"><i class="las la-times-circle"></i>
                                                        ปิดการใช้</a>
                                                @elseif ($item->car_status == '0')
                                                    <a href="{{route('company_updatestatuscar',['form_id'=>$item->form_id,'id'=>$item->id,'status'=>'open'])}}" class="btn btn-success"><i class="las la-check"></i>
                                                        เปิดการใช้</a>
                                                @endif
                                               

                                                <a href="{{route('company_DeleteCar',['form_id'=>$item->form_id,'id'=>$item->id])}}" class="btn btn-danger" onclick="return confirm('ต้องการลบ ใช่หรือไม่?');"><i class="las la-trash-alt"></i> ลบ</a>

                                            </div>
                                        </td>
                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
