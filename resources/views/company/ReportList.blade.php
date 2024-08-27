@extends('layouts.companyapp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">สรุปรายงาน </div>
                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">ประจำวันที่</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">ถึงวันที่</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">บริษัท</label>
                                <select class="form-select form-select">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-2">ค้นหา</button>
                          </div>

                        <!---end_cardBody---->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
