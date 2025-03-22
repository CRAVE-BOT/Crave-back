@extends('Layouts.Maser')
@section('content')
    <main id="main" class="main">
        <br>
        <a href="{{route('Product.create')}}" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
            Add new Product
        </a>
        <br>
        @if (session('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->has('product_id'))
            <div class="card border-danger mb-3">
                <div class="card-header bg-danger text-white">Error</div>
                <div class="card-body text-danger">
                    <p class="card-text">{{ $errors->first('product_id') }}</p>
                </div>
            </div>
        @endif
        <table class="table table-bordered ">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">image</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Total-calories</th>
                <th scope="col">Protein</th>
                <th scope="col">Carb</th>
                <th scope="col">Fat</th>
                <th scope="col">Weight</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $counter=1 ?>
            @foreach($data as $x)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $x->name }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($x->description, 32, '...') }}</td>
                    <td><img src="{{ asset('storage/Product_image/'.$x->image) }}" alt="Product Image" width="100"></td>
                    <td>${{ number_format($x->price, 2) }}</td>
                    <td>{{ $x->category->name}}</td>
                    <td>{{ $x->total_calories}}</td>
                    <td>{{ $x->protien .'g'}}</td>
                    <td>{{ $x->carb .' g'}}</td>
                    <td>{{ $x->fat.'g' }}</td>
                    <td>{{ $x->weight.' g'}}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <form action="{{ route('Product.edit')}}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$x->id}}">
                                <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                            </form>
                            <form action="{{ route('Product.delete')}}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$x->id}}">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="container mt-3">
            <div class="d-flex justify-content-center">
                {!! $data->links('pagination::bootstrap-4') !!}
            </div>
        </div>


    </main><!-- End #main --><br><br><br>
@endsection


