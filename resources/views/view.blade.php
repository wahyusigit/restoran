@extends('layout.admin')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">User</div>
        <div class="panel-body">
          {{-- <transition> --}}
            <router-view></router-view>
          {{-- </transition> --}}
        </div>
      </div>
    </div>
  </div>
@endsection