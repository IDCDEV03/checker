@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">E-Checker</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::user()->role == 'leader')
                    <a class="btn btn-lg btn-outline-secondary " aria-current="page"
                    href="{{ route('leader_index') }}"> <i class="las la-home"></i> เข้าสู่หน้าหลัก</a>

                    @elseif (Auth::user()->role == 'company')

                    <a class="btn btn-lg btn-outline-secondary " aria-current="page"
                    href="{{ route('company_index') }}"> <i class="las la-home"></i> เข้าสู่หน้าหลัก</a>

                    @elseif (Auth::user()->role == 'user')

                    <a class="btn btn-lg btn-outline-secondary " aria-current="page"
                    href="{{ route('user_index') }}"> <i class="las la-home"></i> เข้าสู่ระบบตรวจเช็ค</a>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
