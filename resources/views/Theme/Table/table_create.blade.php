@extends('Layouts.Maser')
@section('content')
    <main id="main" class="main">
        <br>
        <form action="{{route("Table.store")}}" method="POST">
            @csrf
            @if ($errors->has('number'))
                <div class="card border-danger mb-3">
                    <div class="card-header bg-danger text-white">Error</div>
                    <div class="card-body text-danger">
                        <p class="card-text">{{ $errors->first('number') }}</p>
                    </div>
                </div>
            @endif
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Number of Table</label>
                    <input type="text" class="form-control"  name="number" required>
            </div>
            @if ($errors->has('number_chairs'))
                <div class="card border-danger mb-3">
                    <div class="card-header bg-danger text-white">Error</div>
                    <div class="card-body text-danger">
                        <p class="card-text">{{ $errors->first('number_chairs') }}</p>
                    </div>
                </div>
            @endif
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Number of Chairs</label>
                <input type="text" class="form-control"  name="number_chairs" required>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>

        <br>

    </main><!-- End #main --><br><br><br>
@endsection


