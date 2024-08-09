@extends('layouts.companyapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">แบบฟอร์ม</div>
                    <div class="card-body">


                        @foreach ($form_per as $item)
                            <table class=" table table-hover table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>ชื่อฟอร์ม</th>
                                    <th>การอนุญาต</th>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->form_name }}</td>

                                        <td>
                                            <form action="{{ route('company_InsertPer') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ request()->form_id }}" name="form_id">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1" id="user_role1" name="user_role"
                                                        @if ($item->user_role == '1') checked @endif>
                                                    <label class="form-check-label" for="user_role1">
                                                        ผู้ใช้ทั่วไป/ผู้เรียน
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1" id="leader_role2" name="leader_role"
                                                        @if ($item->leader_role == '1') checked @endif>
                                                    <label class="form-check-label" for="leader_role2">
                                                        เจ้าหน้าที่/หัวหน้าฝ่าย
                                                    </label>
                                                </div>

                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <input type="hidden" name="form_id" value="{{ $item->form_id }}">
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                            </form>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
