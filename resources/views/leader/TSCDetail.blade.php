@extends('layouts.leaderapp')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
           
                            <a class="btn btn-primary mb-2" href="#" target="_blank"><i class="las la-print"></i>
                                พิมพ์</a>
                            <div class="text-center">
                                <img src="{{ asset('file/logo-id.png') }}" class="mb-2" width="80px" alt="">
                            </div>
                            <div class="text-center h5 fw-bold mb-3">

                                @foreach ($form_detail as $row)
                                    {{ $row->form_name }}
                                @endforeach

                            </div>
                           
                                <div class="row mb-3">
                                    <div class="col">
                                        <span class="col-form-label"><strong>ทะเบียนรถ </strong> :
                                            **</span>
                                    </div>

                                    <div class="col">
                                        <span class="col-form-label"><strong>ประเภทรถ : </strong>#</span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <span class="col-form-label"><strong>โดย</strong> :
                                            {{ Auth::user()->name }}</span>
                                    </div>

                                    <div class="col">
                                        <span class="col-form-label"><strong>บริษัทขนส่ง : </strong>#</span>
                                    </div>
                                </div>
                       
                     
                        <div class="table-responsive-md">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col col-1">#</th>
                                        <th scope="col col-4">ข้อตรวจ</th>
                                        <th class="text-center col-2">ผลการตรวจ</th>
                                        <th class="text-center col-3">ข้อบกพร่อง</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                  </tr>
                                </tbody>
                              <tfoot>
                                    @foreach ($form_detail as $item)
                                        <td colspan="4" align="center">ตรวจสอบวันที่ :
                                            {{ Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}
                                        </td>
                                    @endforeach
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
