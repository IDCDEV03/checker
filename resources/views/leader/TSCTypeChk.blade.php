@extends('layouts.leaderapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">แบบฟอร์ม</div>
                    <div class="card-body">


                        <table class="table table-hover table-striped">
                            <thead>
                                <th>#</th>
                                <th>ฟอร์ม</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($form_list as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->form_name }}</td>

                                        <td>
                                            <a href="{{route('leader_TSCChk',['form_id'=>$item->form_id,'ts'=>request()->ts])}}" class="btn btn-sm btn-outline-dark">เลือก</a>
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
