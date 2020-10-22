@extends('layouts.dashboard.app',['title'=>'Edit role'])
@section('content')
    <h2>Edit Roles</h2>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('dashboard.roles.index')}}">Roles</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ul>

<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">

            <form action="{{route('dashboard.roles.update',$Role->id)}}" method="post">
                @csrf
                @method('put')

                @include('dashboard.partials.errors')

                <div class="form-group">
                    <label>Name : </label>
                    <input type="text" name="name" class="form-control" value="{{old('name',$Role->name)}}">
                </div>

                <div class="form-group">
                    <h4 style="font-weight:400">Permissions</h4>
                    <table class="table table-hover">

                        <thead>

                        <tr>

                            <th style="width: 5%">#</th>
                            <th style="width: 15%">Model</th>
                            <th>Permissions </th>
                        </tr>
                        </thead>

                        <tbody>

                        @php
                            $models=['categories','users','movies','settings'];
                        @endphp
                        <tr>
                            @foreach($models as $index=> $model)
                                <td>{{$index+1}}</td>
                                <td>{{$model}}</td>
                                <td>
                                    @php

                                        $Permissions_maps=['create','read','update','delete'];
                                    @endphp

                                   @if($model=='settings')
                                        @php

                                            $Permissions_maps=['create','read'];
                                        @endphp
                                    @endif

                                        <select name="permissions[]" class="form-control select2" multiple>

                                        @foreach($Permissions_maps as $Permission_map)
                                            <option value="{{$Permission_map . '_' . $model}}"
                                                {{ $Role->hasPermission($Permission_map . '_' .  $model)? 'selected' :''}}
                                            >
                                                {{$Permission_map}}</option>
                                        @endforeach

                                    </select>

                                </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Edit</button>
                </div>

            </form>
        </div><!--end of tile-->

    </div>
</div>






@stop
