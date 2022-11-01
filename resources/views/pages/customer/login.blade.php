@extends('content')
<title>
    Đăng nhập tài khoản
</title>
@section('content')
<section id=""><!--form-->
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Đăng nhập tài khoản</h2>
                    <form action="{{URL::to('/login')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" name="customer_email" placeholder="Tài khoản email" />
                        <input type="password" name="customer_password" placeholder="Mật khẩu" />
                        <span>
                            <input type="checkbox" class="checkbox"> 
                            Ghi nhớ đăng nhập
                        </span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                    <a href="{{URL::to('/reset-password')}}">Quên mật khẩu</a>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Đăng ký tài khoản</h2>
                    <form action="{{URL::to('/register-customer')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" placeholder="Họ tên" name="customer_name" value="{{old('customer_name')}}" />
                        @error('customer_name')
                            <p class="badge btn-danger">{{ $message }}</p>
                        @enderror
                        <input type="text" placeholder="Địa chỉ email" name="customer_email" value="{{old('customer_email')}}"/>
                        @error('customer_email')
                            <p class="badge btn-danger">{{ $message }}</p>
                        @enderror
                        <input type="password" placeholder="Mật khẩu" name="customer_password" value="{{old('customer_password')}}"/>
                        @error('customer_password')
                            <p class="badge btn-danger">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="btn btn-default">Đăng ký</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
</section><!--/form-->

@endsection