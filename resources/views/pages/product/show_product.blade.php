@extends('product')
<title>Sản phẩm</title>
@section('content')
<div class="features_items"><!--features_items-->
    <div class="row">
        <div class="col-sm-8"> <h2 class="title text-center">Danh sách sản phẩm</h2></div>
        <div class="col-sm-4">
            <div class="sort-by ">
                <form method="get" id="form_order">
                    <select name="orderby" class="orderby">
                        <option {{Request::get('orderby')== "md" ? "selected='selected'" : ""}} value="md" selected="selected">Mặc định</option>
                        <option {{Request::get('orderby')== "new" ? "selected='selected'" : ""}} value="new">Mới nhất</option>
                        <option {{Request::get('orderby')== "old" ? "selected='selected'" : ""}} value="old">Cũ nhất</option>
                        <option {{Request::get('orderby')== "price-asc" ? "selected='selected'" : ""}} value="price-asc">Giá: Tăng dần</option>
                        <option {{Request::get('orderby')== "price-desc" ? "selected='selected'" : ""}} value="price-desc">Giá: Giảm dần</option>
                        <option {{Request::get('orderby')== "name-asc" ? "selected='selected'" : ""}} value="name-asc">Tên: A-Z</option>
                        <option {{Request::get('orderby')== "name-desc" ? "selected='selected'" : ""}} value="name-desc">Tên: Z-A</option>
                    </select>
                </form>
            </div>
        </div>
    </div> 
    @include('pages.product.productajax')

</div>

@endsection
@section('script')
<script>
    $("body").on("click",".pagination a",function(e){
        e.preventDefault();
           let URL = $(this).attr('href');
        //    console.log(page);
           getPaginationProduct(URL);
    });
     function getPaginationProduct(URL)
     {
          $.ajax({
               type: "GET",
               url: URL
          })
          .success(function(result) {
              $('.render-product').html(result.html)

          });
     }
  </script>


@stop
