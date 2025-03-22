@extends('Layouts.Maser')
@section('content')
    <main id="main" class="main">
        <br>
        @if (session('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <table class="table table-bordered ">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Num of Table</th>
                <th scope="col">Num of People</th>
                <th scope="col">Date</th>
                <th scope="col">The Time</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $counter = 1 ?>
            @foreach($table as $x)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $x->user->name }}</td>
                    <td>{{ $x->table->number }}</td>
                    <td>{{ $x->number_people }}</td>
                    <td>{{ $x->date }}</td>
                    <td>{{ $x->the_time.' PM' }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <form action="{{ route('Table.reserve.delete', $x->id) }}" method="POST"
                                  onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                @csrf
                                @method('DELETE')
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


