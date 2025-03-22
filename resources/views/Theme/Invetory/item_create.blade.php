@extends('Layouts.Maser')
@section('content')
    <main id="main" class="main">
        <br>
        <form action="{{route("Inventory.store")}}" method="POST">
            @csrf
            @if ($errors->has('name'))
                <div class="card border-danger mb-3">
                    <div class="card-header bg-danger text-white">Error</div>
                    <div class="card-body text-danger">
                        <p class="card-text">{{ $errors->first('name') }}</p>
                    </div>
                </div>
            @endif
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                    <input type="text" class="form-control"  name="name" required>
            </div>
            @if ($errors->has('quantity'))
                <div class="card border-danger mb-3">
                    <div class="card-header bg-danger text-white">Error</div>
                    <div class="card-body text-danger">
                        <p class="card-text">{{ $errors->first('quantity') }}</p>
                    </div>
                </div>
            @endif
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Quantity</label>
                <input type="number" class="form-control"  name="quantity" required>
            </div>
            @if ($errors->has('Previous_price'))
                <div class="card border-danger mb-3">
                    <div class="card-header bg-danger text-white">Error</div>
                    <div class="card-body text-danger">
                        <p class="card-text">{{ $errors->first('Previous_price') }}</p>
                    </div>
                </div>
            @endif
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Previous price</label>
                <input type="number" class="form-control"  name="Previous_price" required>
            </div>
            @if ($errors->has('Current_price'))
                <div class="card border-danger mb-3">
                    <div class="card-header bg-danger text-white">Error</div>
                    <div class="card-body text-danger">
                        <p class="card-text">{{ $errors->first('Current_price') }}</p>
                    </div>
                </div>
            @endif
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Current price</label>
                <input type="number" class="form-control"  name="Current_price" required>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>

        <br>

    </main><!-- End #main --><br><br><br>
@endsection


