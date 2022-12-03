@extends('layout/masterLayout')
@section('title')
 Danh sách phí ship
@endsection
@push('styles')
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <!-- Main content -->
        <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="row" style="padding-top:10px;">
                    <div class="col-2 mb-3">
                        <button type="button" class="btn btn-success"><a class="text-white" href="{{route('feeship.add')}}" >+ Thêm mới</a></button>
                    </div>
                </div>
                <div class="col-12 table-responsive">
                    <table class="table table-striped display nowrap hover" id="dataTableFeeShip" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Khu vực</th>
                                <th>Giá ship</th>
                                <th>Thao tác</th>
                            </tr>
                            </tr>
                        </thead>
                    </table>
                </div>
                <hr/>
              </div>
            </div>
        </div>
@endsection
@prepend('scripts')
<script type="module" src="{{Vite::asset('resources/js/feeship/list.js')}}"></script>
<script type="module" src="{{Vite::asset('resources/js/components/confirmDel.js')}}"></script>
<script type="module" src="{{Vite::asset('resources/js/components/confirmEnd.js')}}"></script>
@endprepend


