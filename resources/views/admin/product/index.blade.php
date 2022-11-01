@extends('admin_layout')
@section('admin_header')
    <h1>
        Product
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.blank') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.product.index') }}">Product</a></li>
        <li class="active">Index</li>
    </ol>
@endsection
@section('admin_content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <a href="{{ route('admin.product.add') }}" class="btn btn-warning">
                    <i class="fa fa-plus"></i> Thêm sản phẩm
                </a>
                <div class="box-header">
                    <h3 class="box-title">Danh sách sản phẩm</h3>
                    <form class="form-inline pull-right">
                        <input type="text" value="{{ Request::get('product_name') }}" name="product_name"
                            class="form-control" placeholder="Nhập tên sản phẩm">
                        {{-- <input type="text" name="customer_name" value="{{Request::get('customer_name')}}" class="form-control" placeholder="Tên khách hàng"> --}}
                        <select name="brand_id" id="" class="form-control">
                            <option value="" selected>Chọn thương hiệu</option>
                            @if (isset($brands))
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->brand_id }}"
                                        {{ Request::get('brand_id') == $brand->brand_id ? "selected='selected'" : '' }}>
                                        {{ $brand->brand_name }}</option>
                                @endforeach

                            @endif
                        </select>
                        <button type="submit" class="btn btn-primary">Tìm kiếm <i class="fa fa-search"></i></button>
                    </form>
                    <form action="{{ route('delete.selected') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger" type="submit" id="deleteSelected"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa những mục đã chọn không?')">Xóa mục đã chọn
                            <i class="fa fa-trash"></i></button>
                </div>


                <div class="box-body table-responsive no-padding">
                    <table id="myTableProduct" class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="" id="select_all"></th>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh</th>
                                <th>Thương hiệu</th>
                                <th>Giá</th>
                                <th>Nổi bật</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_product as $key => $product)
                                <tr>
                                    <td><input type="checkbox" class="checkbox" name="ids[]"
                                            value="{{ $product->product_id }}"></td>
                                    <td>{{ $product->product_name }}</td>
                                    <td><img src="{{ asset('/public/uploads/product/' . $product->product_image) }}" alt=""
                                            style="width: 50px"></td>
                                    <td>{{ $product->brand->brand_name }}</td>
                                    <td>{{ $product->product_price}}</td>
                                    <td>
                                        <?php
                                if($product->product_status == 0){ ?>
                                        <a style="color: red"
                                            href="{{ route('admin.product.active', ['product_id' => $product->product_id]) }}"><i
                                                class="fa fa-thumbs-down"></i></a>
                                        <?php
                                }else { ?>
                                        <a
                                            href="{{ route('admin.product.unactive', ['product_id' => $product->product_id]) }}"><i
                                                class="fa fa-thumbs-up"></i></a>
                                        <?php
                                }
                               
                          ?>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.product.edit', ['product_id' => $product->product_id]) }}"
                                            class="btn btn-success"><i class="fa fa-pencil"></i></a>
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa {{ $product->product_name }} không?')"
                                            href="{{ route('admin.product.delete', ['product_id' => $product->product_id]) }}"
                                            class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{-- <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{ $all_product->appends(Request::all())->links() }}
                        </ul>
                    </div> --}}
                </div>
                </form>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
{{-- <script>
  $("#deleteSelected").click(function(e){
            e.preventDefault();
            var allids = [];
            $("input:checkbox[name=ids]:checked").each(function(){
               allids.push($(this).val());
            });
            $.ajax({
              url : "{{route('delete.selected')}}",
              type: 'DELETE',
              data : {
                ids : allids,
                _token : $("input[name=_token]").val()
              },
              success:function(response){
                $.each(allids, function(key, val)){
                  $('#pid'+val).remove();
                }
              }

            });
        });
</script> --}}
