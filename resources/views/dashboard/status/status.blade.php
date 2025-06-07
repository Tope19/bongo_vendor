@if($success = session()->get('success'))

    <div class="alert alert-success" role="alert">
         <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
        <div class="alert-text">{!! $success !!}</div>
    </div>
    @php(session()->forget("success"))
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
