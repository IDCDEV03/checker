@extends('layouts.companyapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">แบบฟอร์ม</div>
                    <div class="card-body">


                        <table class="table table-hover table-bordered">
                            <thead>
                                <th>#</th>
                                <th>ชื่อฟอร์ม</th>

                                <th>ตั้งค่า</th>
                            </thead>
                            <tbody>
                                @foreach ($form_list as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->form_name }}</td>

                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                @if ($item->form_type == '1' or $item->form_type == '2' or $item->form_type == '6')
                                                    <a href="{{ route('company_setform', ['form_id' => $item->form_id]) }}"
                                                        class="btn btn-outline-success"><i class="las la-plus-circle"></i>
                                                        เพิ่มรถ</a>
                                                    <a class="btn btn-outline-primary" href="{{route('company_formper',['form_id'=>$item->form_id])}}"><i
                                                            class="las la-cog"></i> ตั้งค่า</a>
                                                    <a class="btn btn-outline-danger"><i class="las la-times-circle"></i>
                                                        ปิดการใช้</a>
                                                @else
                                                <a class="btn btn-outline-primary" href="{{route('company_formper',['form_id'=>$item->form_id])}}"><i
                                                    class="las la-cog"></i> ตั้งค่า</a>
                                                    <a class="btn btn-outline-danger"><i class="las la-times-circle"></i>
                                                        ปิดการใช้</a>
                                                @endif




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
