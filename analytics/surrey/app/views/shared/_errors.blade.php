@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <h4><strong>Oh no! Something went wrong</strong></h4>
        <hr>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

