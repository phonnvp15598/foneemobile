@extends('content')
<title>@foreach ($details_product as $key => $item)
    {{$item->product_name}}
@endforeach</title>
@section('content')
<style>
    .list-star{
        color: gray;
    }
    .list-star i:hover{
        cursor: pointer;
        
    }
    .list-text{
        display: inline-block;
        width: 84px;
        position: relative;
        background: #4287f5;
        color: #fff;
        padding: 2px 8px;
        box-sizing: border-box;
        font-size: 12px;
        border-radius: 2px;
        margin-left: 18px;
        display: none;
    }
    .list-text::after{
        right: 100%;
        top: 50%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-color: rgba(82,184,88,0);
        border-right-color: #4287f5;
        border-width: 6px;
        margin-top: -6px;
        
    }
    .pro-active{
        color: grey;
    }
    .list-star .rating-active,.pro-active .active{
        color: #fd9727;
    }
    .preview-img {
        /* max-width: 150px; */
        margin: 0 1em 1em 0;
        padding: 0.5em;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
</style>
@foreach ($details_product as $key => $value)
       
<ul class="breadcrumb">
    <li><a href="{{url('/')}}">Trang chủ</a></li>
    <li><a href="{{url('/brand/'.$value->brand_slug)}}">{{$value->brand_name}}</a></li>
    <li style="color: red">{{$value->product_name}}</li>
  </ul>

<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        @foreach ($detail_image->images as $itemImage)    
        <div class="view-product" style="display: none;">                       
            <div class="">
                <a data-toggle="modal" data-target="#zoom{{$itemImage->id}}" style="cursor: pointer"><img  src="{{URL::to('/public/uploads/product/'.$itemImage->image)}}"></a>
                <h3>ZOOM</h3>
                
            </div>
            
        </div>
        @endforeach 
        <!-- Controls -->
        <a class="left item-control"  id="prev" onclick="plusSlides(-1)">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right item-control"  id="next" onclick="plusSlides(1)">
            <i class="fa fa-angle-right"></i>
          </a>
        <div id="similar-product" class="carousel slide" data-ride="carousel">   
              <!-- Wrapper for slides -->
              <div class="center detail-img">
                @php
                    $i =0;
                @endphp
                @foreach ($detail_image->images as $itemImage)
                    <div class="col-sm-4">  
                        <img class="demo cursor"  onclick="currentSlide({{++$i}})" src="{{URL::to('/public/uploads/product/'.$itemImage->image)}}" alt="" width="100px">
                    </div>
                @endforeach
             </div> 
            {{-- <div class="detail-img">
                @php
                    $i =0;
                @endphp
                <div class="row">
                    @foreach ($detail_image->images as $itemImage)
                    <div class="col-xs-4">  
                        <img class="demo cursor"  onclick="currentSlide({{++$i}})" src="{{URL::to('/public/uploads/product/'.$itemImage->image)}}" alt="" width="100px">
                    </div>
                    @endforeach
                </div>                      
               
             </div>       --}}
        </div>

    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="{{URL::to('/public/frontend/images/new.jpg')}}" class="newarrival" alt="" />
            <h2>{{$value->product_name}}</h2>
            <p>ID: {{$value->product_id}}</p>
            <img src="{{URL::to('/public/frontend/images/rating.png')}}" alt="" />
            <form >
                {{ csrf_field() }}
                <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_slug}}" class="cart_product_slug_{{$value->product_id}}">
                <span>
                    <span>{{number_format($value->product_price, 0, '.','.') }} Đ</span>   
                </span><br>
                
                <div class="swatch clearfix swatch-0 option1" data-option-index="0">
                    <div class="product-form__item">
                      <label class="header">Chọn màu sắc: </label>
                      @foreach ($product_color as $item)
                        <div class="swatch-element color  available">
                            <input class="swatchInput cart_product_color_{{$item->color_id}}" id="swatch-0-{{$item->colors->color_name}}" type="radio" name="check-color" value="{{$item->colors->color_name}}"><label class="swatchLbl" for="swatch-0-{{$item->colors->color_name}}" style="background-color:{{$item->colors->color_rbg}};"></label>
                        </div>
                      @endforeach
                    </div>
                </div>
                <div class="swatch clearfix swatch-0 option1" data-option-index="0">
                    <div class="product-form__item">
                      <label class="header">Chọn bộ nhớ: </label>
                      @foreach ($product_memory as $item)
                        <div class="swatch-element color  available">
                            <input class="swatchInput cart_product_memory_{{$item->memory_id}}" id="swatch-0-{{$item->memories->memory_name}}" type="radio" name="check-memory" value="{{$item->memories->memory_name}}"><label class="swatchLbl" for="swatch-0-{{$item->memories->memory_name}}">{{$item->memories->memory_name}}</label>
                        </div>
                      @endforeach
                    </div>
                </div>
                <div class="product-form__item--quantity">
                    <label>Số lượng:</label>
                    <div class="qtyField quantity">
                        <a class="qtyBtn minus decrement-btn changeQuantity" href="javascript:void(0);"><i class="fa fa-minus" aria-hidden="true"></i></a>
                        <input type="text" id="Quantity" name="quantity" value="1" class="product-form__input qty qty-input cart_product_qty_{{$value->product_id}}">
                        <a class="qtyBtn plus increment-btn changeQuantity" href="javascript:void(0);"><i class="fa fa-plus" aria-hidden="true"></i></a>
                        
                    </div>
                </div>
                <span class="button-cart"> 
                    <button data-product_id="{{$value->product_id}}" type="button" class="btn btn-default add-to-cart" name="add-to-cart">
                        <i class="fa fa-shopping-cart"></i>
                        Thêm giỏ hàng
                    </button>
                </span>
                
                {{-- <span>
                   
                    <input type="button" value="-" onclick="tru()">
                    <input id="soluong" type="text" value="1" min="1" max="20" class="cart_product_qty_{{$value->product_id}}">
                    <input type="button" value="+" onclick="cong()"> <br><br>
                    <button data-product_id="{{$value->product_id}}" type="button" class="btn btn-default add-to-cart" name="add-to-cart">
                        <i class="fa fa-shopping-cart"></i>
                        Thêm giỏ hàng
                    </button>
                </span> --}}
            </form>
            <p><b>Trình trạng:</b>
                 <?php 
                    if($value->product_available == 0){
                    ?>
                        <b class="badge btn-danger">Hết hàng</b>
                    <?php  
                    }else {
                        ?>
                        <b class="badge btn-success">Có sẵn</b>
                    <?php  }
                ?>
                
            </p>
            <p><b>Thương hiệu:</b> {{$value->brand_name}}</p>
            <a href=""><img src="{{URL::to('/public/frontend/images/share.png')}}" class="share img-responsive"  alt="" /></a>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->
<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#reviews" data-toggle="tab">Đánh giá({{count($comment_count)}}/{{round($comment_rate,1)}}<i class="fa fa-star" style="color: #fd9727"></i> )</a></li>
            <li ><a href="#details" data-toggle="tab">Chi tiết sản phẩm </a></li>
            
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="reviews">
            <div class="col-sm-12 show">
                @foreach($comments as $comment)
                    <ul>
                        <li><a href=""><img src="{{asset('/public/frontend/images/avatar_customer2.png')}}" alt="" style="width: 60px;height: 60px;border-radius: 50%;"><b style="margin-left: 10px">{{$comment->Customer->customer_name}}</b></a></li>
                        <li class="pro-active">
                            @for ($j=1; $j <=5; $j++)
                            <i class="fa fa-star {{$j<=$comment->comment_rate ? 'active':''}}"></i>
                            @endfor
                        </li> 
                        <a data-comment-id="{{$comment->comment_id}}" data-name="{{$comment->Customer->customer_name}}" class="badge btn-primary" onclick="showReplyForReplyForm(this)"> {{count($comment->CommentReplys)}} Trả lời <i class="fa fa-reply" aria-hidden="true"></i></a>
                    </ul>
                    <p style="margin-left: 71px;margin-top: -28px;">{{$comment->comment_content}} <i class="fa fa-clock-o pull-right"  title="{{date_format($comment->created_at, 'd/m/Y g:i A')}}">
                        {{date_format($comment->created_at, 'd/m/Y g:i A')}}
                        @php
                            $seconds  = strtotime(date('Y-m-d H:i:s')) - strtotime($comment->created_at);

                            $years = floor($seconds / (12*3600*24*30));
                            $months = floor($seconds / (3600*24*30));
                            $days = floor($seconds / (3600*24));
                            $hours = floor($seconds / 3600);
                            $mins = floor(($seconds - ($hours*3600)) / 60);
                            $secs = floor($seconds % 60);

                            if($seconds < 60)
                                echo "<i> $secs giây trước</i>";
                            else if($seconds < 60*60 )
                                echo "<i> $mins phút trước</i>";
                            else if($seconds < 24*60*60)
                                echo "<i> $hours giờ trước</i>";
                            else if($seconds < 30*24*60*60)
                                echo "<i> $days ngày trước</i>";
                            else if($seconds < 12*30*24*60*60)
                                echo "<i> $months tháng trước</i>";
                            else 
                                echo "<i> $years năm trước</i>";  
                        @endphp
                        </i>
                    </p>
                    <div class="row">
                        <div class="detail-img" style="margin-bottom: 20px">
                            <div class="row">
                                @foreach ($comment->CommentImages as $itemImage)
                                <div class="col-md-2" style="margin-left:85px">                                
                                    <a data-toggle="modal" data-target="#show{{$itemImage->id}}"><img class="demo cursor"  src="{{URL::to('/public/uploads/product/'.$itemImage->comment_image)}}" alt="" width="150px" height="100px"> </a>
                                                             
                                </div>
                                <div class="modal fade fixmodal" id="show{{$itemImage->id}}">
                                    <div class="modal-dialog" style="width: 80% ">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="pull-right" data-dismiss="modal" aria-label="Close">
                                            <i class="fa fa-times"></i></button>
                                          <h3 class="modal-title">{{$comment->comment_content}}</h3>
                                        </div>
                                        <div class="modal-body">                                
                                          <div class="box-body" style="text-align: center">
                                            <img src="{{URL::to('/public/uploads/product/'.$itemImage->comment_image)}}" height="500px" >                                       
                                          </div>
                                          <!-- /.box-body -->                             
                                        </div>
      
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                  </div>
                                @endforeach
                            </div>
                                                                           
                         </div>                         
                     </div>
                     
                     <div id="form-{{$comment->comment_id}}" style="margin-left: 50px; margin-bottom: 50px; display: none; ">
                        <div class="show-reply">
                            @foreach ($comment->CommentReplys as $item)
                            <ul>
                                <li><a href=""><img src="{{asset('/public/frontend/images/avatar_customer2.png')}}" alt="" style="width: 60px;height: 60px;border-radius: 50%;"><b style="margin-left: 10px">{{$item->CustomerReply->customer_name}}</b></a></li>
                                  
                            </ul>
                            <p style="margin-left: 71px;margin-top: -28px;">{{$item->comment_reply_content}}
                                <i class="fa fa-clock-o pull-right" title="{{date_format($item->created_at, 'd/m/Y g:i A')}}">
                                    {{date_format($item->created_at, 'd/m/Y g:i A')}}
                                    @php
                                    $seconds  = strtotime(date('Y-m-d H:i:s')) - strtotime($item->created_at);
        
                                    $years = floor($seconds / (12*3600*24*30));
                                    $months = floor($seconds / (3600*24*30));
                                    $days = floor($seconds / (3600*24));
                                    $hours = floor($seconds / 3600);
                                    $mins = floor(($seconds - ($hours*3600)) / 60);
                                    $secs = floor($seconds % 60);
        
                                    if($seconds < 60)
                                        echo "<i> $secs giây trước</i>";
                                    else if($seconds < 60*60 )
                                        echo "<i> $mins phút trước</i>";
                                    else if($seconds < 24*60*60)
                                        echo "<i> $hours giờ trước</i>";
                                    else if($seconds < 30*24*60*60)
                                        echo "<i> $days ngày trước</i>";
                                    else if($seconds < 12*30*24*60*60)
                                        echo "<i> $months tháng trước</i>";
                                    else 
                                        echo "<i> $years năm trước</i>";  
                                    @endphp
                                    </i> 
                            </p>
                            @endforeach
                        </div>  
                        <form action="{{URL::to('/add-comment-reply')}}" method="POST">
                            @csrf
                        <input name="comment_id" type="hidden" value="{{$comment->comment_id}}" >
                        <textarea name="comment_reply_content"  style="height: 50px;margin-left:20px"  required></textarea>
                        
                        <button type="submit" class="btn btn-default pull-right js-rating-product">
                            Gửi phản hồi
                        </button>
                        </form>
                    </div> 
                @endforeach
                <ul>{{$comments->links()}}</ul>
            </div>
                <?php
                    if(isset($customer_id)){
                        ?>
                            <div>                               
                                <h4>Chọn đánh giá của bạn</h4>
                                <?php 
                                    $listRatingText = [
                                        1 => 'Không thích',
                                        2 => 'Tạm được',
                                        3 => 'Bình thường',
                                        4 => 'Tốt',
                                        5 => 'Tuyệt vời'
                                     ];
                                ?>
                                <span style="font-size: 18px;" class="list-star">
                                    @for($i=1 ; $i<=5 ; $i++)
                                        <i class="fa fa-star" data-key={{$i}}></i>
                                    @endfor
                                </span>
                                <span class="list-text"><span>
                                
                                
                            </div>
                            <form action="{{URL::to('/add-comment-product/'.$value->product_id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input name="comment_rate" type="hidden" value="" class="comment_rate">
                                @error('comment_rate')
                                    <span class="badge btn-danger">{{ $message }}</span>
                                @enderror
                                <input name="customer_id" type="hidden" value="{{$customer_id}}" class="customer_id">
                                <textarea name="comment_content" id="comment_content" placeholder="Viết đánh giá của bạn ..."></textarea>
                                @error('comment_content')
                                    <span class="badge btn-danger">{{ $message }}</span>
                                @enderror
                                <label for="exampleInputEmail1">Thêm ảnh(nếu có)</label>
                                <input type="file" multiple="multiple" class="form-control inputComment"  name="comment_images[]" id="gallery-photo-add">
                                <div class="preview-img"></div>
                                <button type="submit" class="btn btn-default pull-right js-rating-product">
                                    Gửi đánh giá
                                </button>
                            </form>
                        <?php

                    }else {
                        ?>
                            <h4>Vui lòng <a href="{{url('/login')}}">đăng nhập</a> để bình luận sản phẩm</h4>
                        <?php
                    } 
                ?>
        </div>
        <div class="tab-pane fade" id="details" >
            <div class="col-sm-12">
                <b>Nội dung :</b> <div class="product-content">{!!$value->product_content !!}</div>
                <b>Mô tả :</b> <div class="product-desc">{!!$value->product_desc !!} </div>
            </div>
            
        </div>
    </div>
</div><!--/category-tab-->
@endforeach
<!--/recommended_items-->
@endsection
@section('relative')
<h2 class="title text-center">Sản phẩm liên quan</h2>
<div class="responsive">
    @foreach ($relative_product as $key => $all) 
            <div class="col-sm-2">
                <div class="product-image-wrapper">
                    <div class="single-products">
                            <div class="productinfo text-center">
                                <form>
                                    @csrf
                                    <input type="hidden" value="{{$all->product_id}}" class="cart_product_id_{{$all->product_id}}">
                                    <input type="hidden" value="{{$all->product_name}}" class="cart_product_name_{{$all->product_id}}">
                                    <input type="hidden" value="{{$all->product_image}}" class="cart_product_image_{{$all->product_id}}">
                                    <input type="hidden" value="{{$all->product_price}}" class="cart_product_price_{{$all->product_id}}">
                                    <input type="hidden" value="{{$all->product_slug}}" class="cart_product_slug_{{$all->product_id}}">
                                    <input type="hidden" value="1" class="cart_product_qty_{{$all->product_id}}">
                                    <a href="{{URL::to('product/'.$all->product_slug)}}">
                                        <div class="fix-anh"><img src="{{URL::to('public/uploads/product/'.$all->product_image)}}" alt="" class="thumb"/></div>
                                    </a>
                                    <h2>{{number_format($all->product_price, 0, '.','.') }} Đ</h2>
                                    <p style="text-transform: uppercase">{{$all->product_name}}</p>
                                    {{-- <form action="{{URL::to('/save-cart')}}" method="post">
                                        {{ csrf_field() }} --}}
                                        {{-- <input type="hidden" name="qty" value="1">
                                        <input type="hidden" name="productid_hidden" value="{{$all->product_id}}"/> --}}
                                        {{-- <button data-product_id="{{$all->product_id}}" type="button" class="btn btn-default add-to-cart" name="add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button> --}}
                                    {{-- </form> --}}
                                </form>                 
                            </div>
                    </div>
                    
                </div>
            </div>
      
    @endforeach
</div>

@endsection

@section('script')
<script>
    $(function(){
        let listStar = $('.list-star .fa');
        listRatingText = {
                            1 : 'Không thích',
                            2 : 'Tạm được',
                            3 : 'Bình thường',
                            4 : 'Tốt',
                            5 : 'Tuyệt vời'
                        };
        listStar.mouseover(function(){
            let $this = $(this);
            let number = $(this).attr('data-key');
            listStar.removeClass('rating-active');
            $('.comment_rate').val(number); //lay gia tri sao
            $.each(listStar, function(key, value){
                if( key+1 <= number){
                    $(this).addClass('rating-active');
                }
            });
            $('.list-text').text('').text(listRatingText[$this.attr('data-key')]).show();
            console.log($this.attr('data-key'));
        });
        $('js-rating-product').click(function(e){
            event.preventDefault();
            let comment_content = $('#comment_content').val();
            // let comment_rate = $('.comment_rate').val();
            let url = $(this).attr('href');
            // if(comment_content && comment_rate){
            //     $.ajax({
            //         url : url,
            //         type: GET,
            //         data = [
            //             comment_content:comment_content,comment_rate:comment_rate
            //         ];
            //     }).done(function(result){
            //         console.log(result);
            //     });
            // }
        });
    });
</script>
<script>
    $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML('<img style="width:150px">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $('#gallery-photo-add').on('change', function() {
        imagesPreview(this, 'div.preview-img');
    });
});
</script>
@endsection
