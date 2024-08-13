@extends('layouts.leaderapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">QR CODE</div>
                    <div class="card-body">
                        @foreach ($truck_data as $item)
                            
                      
                        <div class="row">
                            <div class="col-md-8">
                                <p class="mb-2">ทะเบียนรถ : {{$item->plate_top}}</p>
                                <p class="mb-2">บริษัทขนส่ง : {{$item->ts_name}}</p>
                                <p class="mb-2">ตรวจครั้งที่ : {{$item->chk_num}} </p>
                                <p class="mb-2">วันที่และเวลาตรวจ : {{ Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}
                                </p>
                                <a href="" id="container" >{!! $simple !!}</a><br/>
                                <button id="download" class="mt-2 btn btn-primary text-light" onclick="downloadSVG()">Download QR CODE</button>
                            </div>
                           
                        </div>
                        @php
                        $date_format = date('Y-m-d', strtotime($item->created_at));
                            $plate_top = $item->plate_top;
                            $svg = $plate_top.'_'.$date_format.'.svg';
                        @endphp
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function downloadSVG() {
          const svg = document.getElementById('container').innerHTML;
          const blob = new Blob([svg.toString()]);
          const element = document.createElement("a");
          element.download = '{{$svg}}';
          element.href = window.URL.createObjectURL(blob);
          element.click();
          element.remove();
        }
        </script>
@endsection
