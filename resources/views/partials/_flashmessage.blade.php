@if(session('successmessage'))
    <div class="alert alert-success" role="alert">
        <strong>Success:</strong> {{ session('successmessage') }}
    </div>
@endif

@if($errors->any())
<div class="alert alert-danger" role="alert">
    <strong>Errors:</strong>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

