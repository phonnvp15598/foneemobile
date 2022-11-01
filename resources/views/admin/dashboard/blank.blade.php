@extends('admin_layout')
@section('admin_header')
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.blank') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="active">Blank</li>
    </ol>
@endsection
@section('admin_content')
    <code>Hello wellcome to FoneeMobile Manager Admin</code>
@endsection
