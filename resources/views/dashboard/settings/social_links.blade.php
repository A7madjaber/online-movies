@extends('layouts.dashboard.app',['title'=>'Social Links'])
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
                        $social_sites=['facebook','google','Youtube'];

                    @endphp

                    @foreach($social_sites as $social_site)

                        <div class="form-group">
                            <label class="text-capitalize">{{$social_site}}Link : </label>
                            <input type="text" name="{{$social_site}}_link" class="form-control" value="{{setting($social_site.'_link')}}">
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
