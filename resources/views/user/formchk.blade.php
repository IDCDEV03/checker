@extends('layouts.userapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-primary" role="alert">
                    <i class="las la-file-alt"></i> <a href="{{route('user_ListChk')}}" class="alert-link"> รายงานผลการตรวจเช็ค</a>
                   </div>

                <div class="card">
                    <div class="card-header">แบบฟอร์มเช็ค</div>
                    <div class="card-body">
                        <ol class="list-group list-group-numbered">
                            @foreach ($formChk as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">
                                            <a href="{{route('user_NewFormChk',['form_id'=>$item->form_id])}}">
                                            {{ $item->form_name }}
                                            </a>
                                        </div>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">
                                        {{ $item->form_category }}
                                    </span>
                                </li>
                            @endforeach

                        </ol>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
