
@extends('layouts.app')
@section('title','Error')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content')

      <section class="error-page overlay">
            <div class="container">
                <div class="error-content normal-err text-center">
                    <h2>Error</h2>
                    <h4>Opps !</h4>
                    @if(Session::has('error'))
                     <div class="alert alert-success" role="alert">
                        <p>{{ Session::get('error') }}</p>
                     </div>
                  @endif
                    <a href="{{route('login')}}" title="" class="btn-style2">Login</a>
                </div><!--error-content end-->
            </div>
        </section><!--error-page end-->
@endsection
@section('footer')
@include('includes.footer')
@endsection
@section('script')
@include('includes.scripts')
@endsection