@extends('Layouts.Maser')
@section('content')
    <main id="main" class="main">
        <br>
        <form action="{{ route('Product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf


            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name of Product</label>
                @if ($errors->has('name'))
                    <div class="card-body text-danger">
                        <ul>
                            @foreach ($errors->get('name') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="row mb-3">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                @if ($errors->has('description'))
                    <div class="card-body text-danger">
                        <ul>
                            @foreach ($errors->get('description') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <textarea class="form-control" name="description" required></textarea>
            </div>

            <div class="row mb-3">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                @if ($errors->has('image'))
                    <div class="card-body text-danger">
                        <ul>
                            @foreach ($errors->get('image') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input type="file" class="form-control" name="image" accept="image/*" required>
            </div>

            <div class="row mb-3">
                <label for="price" class="col-sm-2 col-form-label">Price</label>
                @if ($errors->has('price'))
                    <div class="card-body text-danger">
                        <ul>
                            @foreach ($errors->get('price') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input type="number" class="form-control" name="price" step="1" required>
            </div>

            <div class="row mb-3">
                <label for="category" class="col-sm-2 col-form-label">Category</label>
                @if ($errors->has('category_id'))
                    <div class="card-body text-danger">
                        <ul>
                            @foreach ($errors->get('category_id') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <select class="form-control" name="category_id" required>
                    <option>Select Category</option>
                    @foreach($category as $x)
                        <option value="{{$x->id}}"> {{$x->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="row mb-3">
                <label for="total_calories" class="col-sm-2 col-form-label">Total Calories</label>
                @if ($errors->has('total_calories'))
                    <div class="card-body text-danger">
                        <ul>
                            @foreach ($errors->get('total_calories') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input type="number" class="form-control" name="total_calories" required>
            </div>

            <div class="row mb-3">
                <label for="protein" class="col-sm-2 col-form-label">protien (g)</label>
                @if ($errors->has('protien'))
                    <div class="card-body text-danger">
                        <ul>
                            @foreach ($errors->get('protien') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input type="number" class="form-control" name="protien" step="1" >
            </div>

            <div class="row mb-3">
                <label for="carb" class="col-sm-2 col-form-label">Carb (g)</label>
                @if ($errors->has('carb'))
                    <div class="card-body text-danger">
                        <ul>
                            @foreach ($errors->get('carb') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input type="number" class="form-control" name="carb" step="1" required>
            </div>

            <div class="row mb-3">
                <label for="fat" class="col-sm-2 col-form-label">Fat (g)</label>
                @if ($errors->has('fat'))
                    <div class="card-body text-danger">
                        <ul>
                            @foreach ($errors->get('fat') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input type="number" class="form-control" name="fat" step="1" required>
            </div>

            <div class="row mb-3">
                <label for="weight" class="col-sm-2 col-form-label">Weight (g)</label>
                @if ($errors->has('weight'))
                    <div class="card-body text-danger">
                        <ul>
                            @foreach ($errors->get('weight') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input type="number" class="form-control" name="weight" required>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>


        <br>

    </main><!-- End #main --><br><br><br>
@endsection



