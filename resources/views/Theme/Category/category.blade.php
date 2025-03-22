@extends('Layouts.Maser')
@section('content')
    <main id="main" class="main">
        <br>
        <a href="{{route('Category.create')}}" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
            Add new Category
        </a>
        <br>
        @if (session('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->has('category_id'))
            <div class="card border-danger mb-3">
                <div class="card-header bg-danger text-white">Error</div>
                <div class="card-body text-danger">
                    <p class="card-text">{{ $errors->first('category_id') }}</p>
                </div>
            </div>
        @endif
        <table class="table table-bordered ">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Num of Product</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $counter=1 ?>
            @foreach($data as $x)
            <tr>

                <td>{{$counter++}}</td>
                <td>{{$x->name}}</td>
                <td>{{ $x->products_count}}</td>
                <td>
                    <form action="{{route("Category.edit", $x->name)}}" method="GET" style="display:inline;">

                        <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                    </form>
                    <form action="{{route('Category.delete',$x->name)}}" method="POST" style="display:inline;">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟');">
                            Delete
                        </button>
                    </form>
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


