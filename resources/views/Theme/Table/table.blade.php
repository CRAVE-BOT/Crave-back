@extends('Layouts.Maser')
@section('content')
    <main id="main" class="main">
        <br>
        <a href="{{route('Table.create')}}"
           class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
            Add new Table
        </a>
        <br>
        @if (session('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->has('table_id'))
            <div class="card border-danger mb-3">
                <div class="card-header bg-danger text-white">Error</div>
                <div class="card-body text-danger">
                    <p class="card-text">{{ $errors->first('table_id') }}</p>
                </div>
            </div>
        @endif
        <table class="table table-bordered ">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Number</th>
                <th scope="col">Num of Chairs</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $counter = 1 ?>
            @foreach($table as $x)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $x->number }}</td>
                    <td>{{ $x->number_chairs }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <form action="{{ route('Table.edit',  $x->number) }}" method="GET">
                                <button type="submit" class="btn btn-warning btn-sm">Update</button>
                            </form>
                            <form action="{{ route('Table.delete',$x->number)}}" method="POST"
                                  onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                @csrf
                                @method('Delete')
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
                {!! $table->links('pagination::bootstrap-4') !!}
            </div>
        </div>


    </main><!-- End #main --><br><br><br>
@endsection


