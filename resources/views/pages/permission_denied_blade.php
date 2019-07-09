@extends('layouts.app')
@section('title', 'No access')

@section('content')
  <div class="col-md-4 offset-md-4">
    <div class="card ">
      <div class="card-body">
        @if (Auth::check())
          <div class="alert alert-danger text-center mb-0">
            The current account has no background access permission.
          </div>
        @else
          <div class="alert alert-danger text-center">
            Please log in and try again
          </div>

          <a class="btn btn-lg btn-primary btn-block" href="{{ route('login') }}">
            <i class="fas fa-sign-in-alt"></i>
            登 录
          </a>
        @endif
      </div>
    </div>
  </div>
@stop

