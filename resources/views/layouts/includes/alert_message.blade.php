@if (session()->has('success'))
<div class="container-fluid">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        @if(is_array(session('success')))
        <ul>
            @foreach (session('success') as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
        @else
        {{ session('success') }}
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            
        </button>
    </div>
</div>
@endif



@if ($errors->any())

<div class="container-fluid">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">

       
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            
        </button>


    </div>
</div>

@endif



<div id="commonError"></div>
<div id="commonSuccess"></div>