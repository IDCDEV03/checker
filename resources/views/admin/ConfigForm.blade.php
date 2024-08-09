@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">ตั้งค่าฟอร์ม</div>

                    <div class="card-body">

                        @foreach ($agent as $row)
                            <h3>หน่วยงาน : {{ $row->fullname }}</h3>
                        @endforeach
                        <hr>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="3">ฟอร์มที่ใช้ในหน่วยงาน</th>
                                </tr>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ชื่อฟอร์ม</th>
                                    <th scope="col">ตั้งค่า</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($form_agent_list as $data)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $data->form_name }}</td>
                                        <td>
                                            <form action="{{route('admin_UnlistForm')}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="agent_id" value="{{ $data->agent_id }}">
                                                <input type="hidden" name="form_id" value="{{ $data->form_id }}">
                                                <button class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('ต้องการนำฟอร์มออก ใช่หรือไม่?');"
                                                type="submit">นำออก</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                        <hr>
                        <h5>เลือกฟอร์ม</h5>
                        <form action="{{ route('admin_InsertConfigForm', ['id' => request()->id]) }}" method="POST">
                            @csrf
                            @foreach ($form_list as $item)
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="{{ $item->form_id }}"
                                        name="form_chk[]" value="{{ $item->form_id }}">
                                    <label class="form-check-label" for="{{ $item->form_id }}">
                                        {{ $item->form_name }}
                                    </label>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-success">บันทึก</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
