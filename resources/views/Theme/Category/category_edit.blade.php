@extends('Layouts.Maser')
@section('content')
    <main id="main" class="main">
        <br>
        <form action="{{route("Category.update",$category)}}" method="POST">
            @csrf
            @method('PUT')
            @if ($errors->has('name'))
                <div class="card border-danger mb-3">
                    <div class="card-header bg-danger text-white">Error</div>
                    <div class="card-body text-danger">
                        <p class="card-text">{{ $errors->first('name') }}</p>
                    </div>
                </div>
            @endif
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Name of Category</label>
                    <input type="text" class="form-control"  name="name"  value="{{$category->name}}">
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>

        <br>

    </main><!-- End #main --><br><br><br>
@endsection


