@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach ($formName as $row)    
                    <div class="card-header">ตัวอย่างฟอร์ม :: {{$row->form_name}}</div>
                    @endforeach
                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ข้อตรวจ</th>           
                                    <th>ภาพ</th>                        
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $n = '1';
                                @endphp
                                @foreach ($formPreview as $row)
                                    <tr>
                                        <th colspan="3">
                                            @php
                                                echo 'หมวดหมู่ '.$n++;
                                            @endphp
                                            {{ $row->category_name }}</th>
                                    </tr>
                                    @php
                                        $i = '1';
                                        $cate_id = $row->category_id;
                                        $sql2 = DB::table('form_choices')->where('category_id', '=', $cate_id)->get();
                                    @endphp
                                    @foreach ($sql2 as $row2)
                                        <tr>
                                            <td>
                                                @php
                                                echo $i++;
                                            @endphp</td>
                                            <td>{{ $row2->form_choice }}</td>
                                            <td>  
                                                @if ($row2->choice_img == '0')
                                              <img src="{{ asset('upload/no_img.jpg') }}" width="70px" alt="">
                                          @else
                                              <img src="{{ asset('file/'.$row2->choice_img) }}" width="120px" alt="">
                                          @endif
                                      </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
