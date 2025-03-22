@extends('Layouts.Maser')
@section('content')
    <main id="main" class="main">
        <br>
        <a href="{{route('Staff.create')}}"
           class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
            Add new Staff
        </a>
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
                <th scope="col">Name</th>
                <th scope="col">email</th>
                <th scope="col">phone</th>
                <th scope="col">salary</th>
                <th scope="col">role</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $counter = 1 ?>
            @foreach($staffs as $x)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $x->name }}</td>
                    <td>{{ $x->email }}</td>
                    <td>{{ $x->phone }}</td>
                    <td>{{ $x->salary }}</td>
                    <td>{{ $x->role }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <form action="{{ route('Staff.edit',$x->name)}}" method="GET">
                                <button type="submit" class="btn btn-warning btn-sm">Update</button>
                            </form>
                            <form action="{{ route('Staff.delete',$x->name)}}" method="POST"
                                  onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                @csrf
                               @method('delete')
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
                {!! $staffs->links('pagination::bootstrap-4') !!}
            </div>
        </div>


    </main><!-- End #main --><br><br><br>
@endsection


