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
                <th scope="col">Name of User</th>
                <th scope="col">Status</th>
                <th scope="col">Total Price</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Order Date</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @php $counter = 1; @endphp
            @foreach($orders as $x)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $x->user->name }}</td>
                    <td>
                        @if ($x->status == 'Pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif ($x->status == 'Completed')
                            <span class="badge bg-success">Completed</span>
                        @else
                            <span class="badge bg-secondary">{{ $x->status }}</span>
                        @endif
                    </td>

                    <td>{{ $x->total_price }}</td>
                    <td>{{ $x->payment_method }}</td>
                    <td>{{ \Carbon\Carbon::parse($x->order_date)->format('d M Y - h:i A') }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <form action="{{ route('Orders.show', $x) }}" method="get">
                                <button type="submit" class="btn btn-warning btn-sm">Show</button>
                            </form>
                            <form action="{{ route('Orders.delete', $x) }}" method="POST"
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
                {!! $orders->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </main>
@endsection
