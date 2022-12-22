@extends('layout/masterLayout')
@section('title')
{{$title}}
@endsection
@push('style')
@endpush
@section('content')
<div class="container-fluid">
    @php
        use App\Models\Variantion;
        use App\Models\Propertie;
    @endphp
    <x-alert errorText="{{ trans('alert.add.error') }}" />
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Vui lòng điền thông tin chi tiết về đơn hàng </h3>
                </div>
                <form action="{{route('order.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="customer_name">Tên người nhận</label>
                                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" placeholder="Nhập tên người nhận" value="{{ old('customer_name') }}">
                                    @error('customer_name')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="type">Hình thức mua hàng</label>
                                    <select class="form-control" name="type" id="select_type" required>
                                        <option value="0"> Mua hàng offline </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Điện thoại</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control float-right @error('bill_phone') is-invalid @enderror" id="bill_phone" name="bill_phone" placeholder="Nhập số điện thoại" value="{{ old('bill_phone') }}">
                                    </div>
                                    @error('bill_phone')
                                    <small class="error-form" style="color: red;font-style: italic"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control float-right" id="address"  name="address" value="Tại cửa hàng" placeholder="Nhập địa chỉ người nhận" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city_id">Tỉnh/Thành</label>
                                    <select class="form-control" name="city_id" id="city_id">
                                        @foreach ($city as $city)
                                            <option value="{{$city->id}}" {{$city->id == 32 ? 'selected' : ''}}>{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dist_id">Quận/Huyện</label>
                                    <select class="form-control" name="dist_id" id="dist_id">
                                        @foreach ($dist as $dist)
                                            <option value="{{$dist->id}}" {{$dist->id == 355 ? 'selected' : ''}}>{{$dist->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="payment">Hình thức thanh toán</label>
                                    <select class="form-control loaigiamgiatien" name="payment" id="payment">
                                        <option value="0"> Thanh toán khi nhận hàng </option>
                                        <option value="1"> Thanh toán online </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row g-3 align-items-center box-form-giam-gia add-them-san-pham">
                                    @php if (Session::get('dataSessionProduct') != null) { @endphp
                                    <div class="col-6">
                                        <label for="" class="col-form-label pr-4">Sản phẩm</label>
                                        <small class="text-secondary"><span class="text-danger">{{count(Session::get('dataSessionProduct'))}} </span>&nbsp;sản phẩm đã được chọn</small>
                                    </div>
                                    <div class="col-6 text-right">
                                        <a href="{{route('order.list')}}" class="btn btn-warning mr-2"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Thoát</a>
                                        <div class="btn btn-outline-dark mr-2" data-toggle="modal" data-target="#modal-discountProduct"><i class="fas fa-plus"></i> Thêm sản phẩm</div>
                                        <button type="submit" class="btn btn-success "><i class="fas fa-check "></i> Hoàn tất</button>
                                    </div>
                                    @php
                                    } else { @endphp
                                    <div class="col-8">
                                        <label for="" class="col-form-label pr-4">Sản phẩm</label>
                                    </div>
                                    <div class="col-4 text-right">
                                    </div>
                                    @php
                                    }
                                    @endphp
                                </div>
                            </div>
                        </div>
                        @php
                        if (Session::get('dataSessionProduct') != null) { @endphp
                        <div class="my-2 box-form-giam-gia">
                            <table id="dataTableLoadSpSession" class="table table-striped table-bordered" style="width:100% !important;">
                                <thead>
                                    <th>ID</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá gốc</th>
                                    <th>Số lượng mua</th>
                                    <th>Thành tiền</th>
                                    <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody-product">
                                    @php
                                      if(Session::has('dataSessionProduct')&& !empty(Session::get('dataSessionProduct'))){
                                        $session=Session::get('dataSessionProduct');
                                        foreach ($session as $value) {
                                           @endphp
                                            <tr>
                                                <td><input type="hidden" name="product_id[]" value="{{$value->id}}">{{$value->id}}</td>
                                                <td>
                                                    <div class="d-flex">
                                                      <input type="hidden" name="product_image[]" value="{{$value->product_image}}">
                                                      <img width="100px" src="{{$value->product_image}}" style="padding-right:10px;" alt="">
                                                        <div>
                                                            <input type="hidden" name="product_name[]" value="{{$value->product_name}}">
                                                            {{$value->product_name}}
                                                            @php
                                                                if($value->is_variation==1){
                                                                    $variant=Variantion::with('propertie')->where('product_id',$value->id)->get();
                                                                        if(isset($variant[0])){
                                                                            $html = '<input type="hidden" class="tenbienthe" name="variant_name[]">
                                                                            <select class="form-control bienthe" name="variant_id[]">';
                                                                            foreach($variant as $key => $variant){
                                                                                $html .= '<option value="'.$variant->id.' '.$variant->price.'"> ';
                                                                                $propertie=Propertie::where('id',$variant->propertie->id)->first();
                                                                                    $html .="$propertie->propertie_value";
                                                                                if($variant->propertie_id_link!=null){
                                                                                    $arr_link = explode(' ', $variant->propertie_id_link);
                                                                                    $arr_search = array_search('', $arr_link);
                                                                                    unset($arr_link[$arr_search]);
                                                                                    foreach($arr_link as $index => $arr_link){
                                                                                        $propertie_id_link = Propertie::where('id',$arr_link)->first();
                                                                                        $html .="$propertie_id_link->propertie_value".' ';
                                                                                    }
                                                                                }
                                                                                $html .= '</option>';
                                                                            }
                                                                            $html .= '</select>';
                                                                            echo $html;
                                                                        }
                                                                }else{
                                                                    $null = '<input type="hidden" name="variant_name[]" value="">
                                                                    <input type="hidden" name="variant_id[]" value="">';
                                                                    echo $null;
                                                                }
                                                            @endphp
                                                        </div>
                                                     </div>
                                                </td>
                                                <td class="tien">
                                                    <input type="hidden" name="price[]" value="{{$value->product_price}}">
                                                    <p data-price="{{$value->product_price}}">{{number_format($value->product_price,0,'','.')}} ₫</p>
                                                </td>
                                                <td><input type="number" name="amount[]" value="1" min="1" max="{{$value->product_quantity}}" class="form-control soluong"></td>
                                                <td class="thanhtien">
                                                    <input type="hidden" name="into_price[]" id="into_price" value="{{$value->product_price}}">
                                                    <p>{{number_format($value->product_price,0,'','.')}} ₫</p>
                                                </td>
                                                <td><a href="{{route('order.deleteDataSession',['product'=>$value->id])}}"><i class="fas fa-trash-alt"></i></a></td>
                                             </tr>
                                           @php
                                        }
                                        @endphp
                                        @php
                                      }
                                    @endphp
                                </tbody>
                                <tr class="tongtien">
                                    <td colspan="4" style="text-align:center;font-weight:bold">Tổng tiền</td>
                                    <td><input type="hidden" name="total" value="">
                                        <p></p>
                                    </td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                        @php } else {@endphp
                        <div class="my-2 justify-content-center box-form-giam-gia remove-khi-co-sp">
                            <div class="box-chua-co-san-pham text-center mx-auto">
                                <img src="{{asset('nodata.png')}}" alt="">
                                <div class="text-center my-3">
                                    <div class="btn btn-info" data-toggle="modal" data-target="#modal-discountProduct"><i class="fas fa-plus"></i> Thêm sản phẩm</div>
                                </div>
                            </div>
                        </div>
                        @php }@endphp
                    </div>
                </form>
            </div>
        </div>
    </div>
    </form>
    <div class="modal fade " id="modal-discountProduct" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header ">
                    <div>
                        <h4 class="modal-title">Chọn sản phẩm</h4>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body px-2 pt-0 pb-2">
                    <div class="table-sp my-4  table-responsive">
                        <table class=" align-middle table table-hover display nowrap hover" style="width:100% !important;" id="dataTableProductAll">
                            <thead>
                                <tr>
                                    <th scope="col"><input name="checkall_id_sp" id="checkall_id_sp" type="checkbox"></th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Tình trạng</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Kho</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" id="submitAddProductSession" class="btn btn-info">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('#checkall_id_sp').click(function(event) {
        if (this.checked) {
            $(':checkbox.check_id_sp:not(:disabled)').each(function() {
                this.checked = true;
            });
        } else {
            $(':checkbox.check_id_sp:not(:disabled)').each(function() {
                this.checked = false;
            });
        }
    });
    $('.soluong').keyup(function() {
        into_price = ($(this).val()*$(this).closest('tr').find('.tien p').data('price'));
        $(this).parent().next('.thanhtien').children().val(into_price);
        $(this).parent().next('.thanhtien').children().next().text(into_price.toLocaleString('vi', {style : 'currency', currency : 'VND'}));
        totalPrice();
    })
    $('.bienthe').change(function() {
        str_price = ($(this).val());
        arr_price = str_price.split(' ');
        $(this).parent().parent().parent().next('.tien').children().val(arr_price[1]);
        $(this).parent().parent().parent().next('.tien').children().next().text(parseInt(arr_price[1]).toLocaleString('vi', {style : 'currency', currency : 'VND'}));
        $(this).parent().parent().parent().closest('tr').find('.tien p').data('price', arr_price[1]);
        price = $(this).parent().parent().parent().closest('tr').find('.tien p').data('price');
        quantity = $(this).parent().parent().parent().closest('tr').find('.soluong').val();
        $(this).parent().parent().parent().closest('tr').find('.thanhtien').children().val(quantity*price);
        $(this).parent().parent().parent().closest('tr').find('.thanhtien').children().next().text((quantity*price).toLocaleString('vi', {style : 'currency', currency : 'VND'}));
        totalPrice();
    })
    function totalPrice(){
        var total_price = 0;
        $('.tbody-product tr').each(function() {
            var into_price = $(this).find('.thanhtien input').val();
            total_price = total_price + parseFloat(into_price);
            var val_variant = $(this).find('.bienthe option:selected').text();
            $(this).find('.tenbienthe').val(val_variant);
        })
        $('.tongtien input').val(total_price);
        $('.tongtien p').html(parseInt(total_price).toLocaleString('vi', {style : 'currency', currency : 'VND'}));
    }
    $(document).ready(function(){
        totalPrice();
    });
</script>
@endpush
@prepend('scripts')
<script type="module" src="{{Vite::asset('resources/js/order/add.js')}}"></script>
@endprepend
