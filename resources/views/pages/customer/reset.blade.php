@extends('content')
<title>
    Lấy lại mật khẩu
</title>
@section('content')
<section id=""><!--form-->
        <div class="row">
            <div class="col-sm-6 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Vui lòng cung cấp email để lấy lại mật khẩu</h2>
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <input type="emaill" name="customer_email" placeholder="Email" required/>
                    <button type="submit" class="btn btn-default">Xác nhận</button>
                    </form>
                </div><!--/login form-->
            </div>
            
        </div>
</section><!--/form-->

@endsection