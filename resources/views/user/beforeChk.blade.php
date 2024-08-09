@extends('layouts.userapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('file/logo-id.png') }}" class="mb-2" width="280px" alt="">
                        </div>

                        @foreach ($formName as $row)
                            <div class="text-center h5 mb-3"> แบบฟอร์มตรวจเช็คประจำวัน :: {{ $row->form_name }}
                            </div>
                        @endforeach

                        <form action="">
                            @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">หมายเลขทะเบียนรถ</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                              </select>
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">เลขไมค์</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                          </div>
                        </form>
                       
                           

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
