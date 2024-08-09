@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">

                        @foreach ($dashboard as $item)
                   
                            <ul class="list-group list-group-light">
                               
                                <a href="{{ route('user_FormChk') }}" style="text-decoration:none">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">

                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('images/checked.png') }}" class="rounded-circle"
                                                alt="" style="width: 45px; height: 45px" />
                                            <div class="ms-3">
                                             <p class="fw-bold mb-1">แบบฟอร์มตรวจเช็คประจำวัน</p>
                                            </div>
                                        </div>
                                        <i class="las la-angle-right"></i>
                                    </li>
                                </a>
                            </ul>

                    </div>
                </div>
            </div>
        </div>

      
        @endforeach
    @endsection
