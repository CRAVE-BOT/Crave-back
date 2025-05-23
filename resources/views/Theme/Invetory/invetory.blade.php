@extends('Layouts.Maser')
@section('content')
    <main id="main" class="main">
        <a href="{{route('Inventory.create')}}"
           class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
            Add new Item
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
                <th scope="col">quantity</th>
                <th scope="col">quantity(G) </th>
                <th scope="col">Previous Price</th>
                <th scope="col">Current Price</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $counter = 1 ?>
            @foreach($inventory as $x)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $x->name }}</td>
                    <td>{{ $x->quantity.' KG' }}</td>
                    <td>{{ $x->quantity_in_grams.' G' }}</td>
                    <td>{{ $x->Previous_price }}</td>
                    <td>{{ $x->Current_price }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <form action="{{ route('Inventory.edit',$x->name)}}" method="get">
                                <button type="submit" class="btn btn-warning btn-sm">Update</button>
                            </form>
                            <form action="{{ route('Inventory.delete',$x->name)}}" method="POST"
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
                {!! $inventory->links('pagination::bootstrap-4') !!}
            </div>
        </div>


    </main><!-- End #main --><br><br><br>
@endsection


