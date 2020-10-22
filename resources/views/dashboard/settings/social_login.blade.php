@extends('layouts.dashboard.app',['title'=>'Social Login'])
@section('content')
    <h2>Settings</h2>
        <ul class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{route('dashboard.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Social Login</li>

        </ul>

<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">

            <form action="{{route('dashboard.settings.store')}}" method="post">
                @csrf
                @method('post')

                @include('dashboard.partials.errors')

               @php
                   $social_sites=['facebook','google'];

                   @endphp

                @foreach($social_sites as $social_site)

                    <div class="form-group">
                        <label class="text-capitalize">{{$social_site}} client id : </label>
                        <input type="text" name="{{$social_site}}_client_id" class="form-control" value="{{setting($social_site.'_client_id')}}">
                    </div>


                    <div class="form-group">
                        <label class="text-capitalize">{{$social_site}} client secret : </label>
                        <input type="text" name="{{$social_site}}_client_secret" class="form-control" value="{{setting($social_site.'_client_secret')}}">
                    </div>

                    <div class="form-group">
                        <label class="text-capitalize">{{$social_site}} redirect url : </label>
                        <input type="text" name="{{$social_site}}_redirect_url" class="form-control" value="{{setting($social_site.'_redirect url')}}">
                    </div>






                @endforeach

                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Add</button>
                </div>

            </form>
        </div><!--end of tile-->

    </div>
</div>











@stop
