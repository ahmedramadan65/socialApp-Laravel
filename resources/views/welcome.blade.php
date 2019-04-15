@extends('layouts.master')
@section('title','Welcome')
@section('content')
@include('includes.alert')
<div class="row">
    <div class="col-md-6">
        <h3>Sign Up</h3>
        <form action="{{route('signup')}}" method="post">
            <div class="form-group ">
                <label for="email">Your E-mail</label>
                <input type="email" class="form-control {{ $errors->has('email') ?  'is-invalid' : '' }}" name="email" id="email" value="{{Request::old('email')}}"/>
            </div>
            <div class="form-group">
                <label for="name">Your First Name</label>
                <input type="text" class="form-control {{$errors->has('first_name') ?  'is-invalid' : ''}}" name="first_name" id="firt_name" value="{{Request::old('first_name')}}"/>
            </div>
            <div class="form-group">
                <label for="password">Your Password</label>
                <input type="password" class="form-control {{ $errors->has('password') ?  'is-invalid' : '' }}" name="password" id="password" />
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <input type="hidden" name="_token" value="{{Session::token()}}" />
        </form>
    </div>
    <div class="col-md-6">
        <h3>Sign In</h3>
        <form action="{{route('signin')}}" method="post">
            <div class="form-group">
                <label for="email">Your E-mail</label>
                <input type="email" class="form-control {{$errors->has('email') ?  'is-invalid' : ''}}" name="email" id="email" value="{{Request::old('email')}}"/>
            </div>
            <div class="form-group">
                <label for="password">Your Password</label>
                <input type="password" class="form-control {{$errors->has('password') ?  'is-invalid' : ''}}" name="password" id="password" />
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <input type="hidden" name="_token" value="{{Session::token()}}" /> 
        </form>
    </div>    
    
</div>
@endsection