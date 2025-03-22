@extends('Layouts.Maser')
@section('content')
    <main id="main" class="main">
        @if (session('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->has('user_id'))
            <div class="card border-danger mb-3">
                <div class="card-header bg-danger text-white">Error</div>
                <div class="card-body text-danger">
                    <p class="card-text">{{ $errors->first('user_id') }}</p>
                </div>
            </div>
        @endif
        <table class="table table-bordered ">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">email</th>
                <th scope="col">image</th>
                <th scope="col">phone</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $counter=1 ?>
            @foreach($user as $x)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $x->name }}</td>
                    <td>{{ $x->email }}</td>
                    <td><img src="{{asset('front')}}/assets/img/profile-img.jpg" alt="Product Image" width="100"></td>
                    <td>{{ $x->phone }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <form action="{{ route('user.delete')}}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                @csrf
                                <input type="hidden" name="user_id" value="{{$x->id}}">
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
                {!! $user->links('pagination::bootstrap-4') !!}
            </div>
        </div>


    </main><!-- End #main --><br><br><br>
@endsection


