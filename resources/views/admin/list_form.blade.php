@extends('layouts.app')

@section('content')
    <div class="container-fluid">


        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">ฟอร์มทั้งหมด</div>

                    <div class="card-body">
                        <p class="mb-4">
                            <a href="{{ route('admin_create_form') }}" class="btn btn-sm btn-primary">สร้างฟอร์มใหม่</a>
                        </p>


                        <table class="table table-bordered" id="dataTables">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ชื่อฟอร์ม</th>
                                    <th>สถานะ</th>
                                    <th scope="col">ตั้งค่า</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = '1';
                                @endphp
                                @foreach ($list_form as $item)
                                    <tr>
                                        <th scope="row">
                                            @php
                                                echo $i++;
                                            @endphp</th>
                                        <td>{{ $item->form_name }}</td>
                                        <td>
                                            @if ($item->form_status == '1')
                                                <span class="badge text-bg-success">เปิด</span>
                                            @elseif ($item->form_status == '0')
                                                <span class="badge text-bg-warning">ปิด</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin_formDetail', ['id' => $item->form_id]) }}"
                                                class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                data-bs-title="รายละเอียด">
                                                <i class="las la-list"></i>
                                            <a href="{{ route('admin_formDetail', ['id' => $item->form_id]) }}"
                                                class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                data-bs-title="ปิดการใช้งาน">
                                                <i class="las la-times-circle"></i>
                                            </a>
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
