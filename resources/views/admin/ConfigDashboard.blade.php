@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">ตั้งค่าระบบ</div>

                    <div class="card-body">
                        @foreach ($Userdetail as $item)
                            <h3>หน่วยงาน : {{ $item->fullname }}</h3>
                        @endforeach
                        <hr>
                        <form method="post" action="{{route('admin_InsertConfig',['id'=>request()->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">วิดิทัศน์แนะนำหน่วยงาน (ID Drives)</label>
                                <input type="text" class="form-control" placeholder="Link Youtube" name="vid_company">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">วิดิทัศน์คู่มือการใช้ระบบ</label>
                                <input type="text" class="form-control" placeholder="Link Youtube" name="vid_um">
                            </div>

                     

                            <div class="mb-3">
                                <label for="file_brochure" class="form-label">คู่มือระบบ (Brochure) </label>
                                <input class="form-control form-control-sm" id="file_brochure" type="file" name="file_brochure" accept="image/*">
                                <div class="form-text text-danger">รองรับไฟล์รูปภาพเท่านั้น</div>
                            </div>


                           

                            <button type="submit" class="btn btn-success">บันทึก</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
