
@if($errors->any())
    <div class="p-3 mb-2 alter alert-danger">
        @foreach($errors->all() as $error)
            <p class="mb-0">{{$error}}</p>
        @endforeach
    </div>
@endif
