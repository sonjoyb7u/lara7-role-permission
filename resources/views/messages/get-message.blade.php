
@if ($errors->any())
    <div class="alert alert-danger fade show" role="alert">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <div>
            @foreach ($errors->all() as $error)
                <p style="color: brown;"> - {{ $error }}</p>
            @endforeach
        </div>
    </div>
@endif

@if(session()->has('message'))
    <div class="alert alert-{{ session('type') }} fade show" role="alert">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <p style="{{ session('type') == 'success' ? 'color: green; font-weight: bold' : 'color: brown; font-weight: bold' }}"> - {{ session('message') }}</p>
    </div>
@endif

