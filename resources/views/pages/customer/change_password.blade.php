@extends('content')
<title>
    Thay đổi mật khẩu
</title>
@section('content')
<section id=""><!--form-->
        <div class="row">
            <div class="col-sm-6 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Thay đổi mật khẩu mới</h2>
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <input type="password" name="customer_password" placeholder="Mật khẩu" required/>
                        <input type="password" name="customer_password_confirm" placeholder="Xác nhận mật khẩu" required/>
                    <button type="submit" class="btn btn-default">Xác nhận</button>
                    </form>
                </div><!--/login form-->
            </div>          
        </div>
</section><!--/form-->
@endsection