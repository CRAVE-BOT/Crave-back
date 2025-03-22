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
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name of Product</th>
                <th scope="col">Image</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Sub Total</th>
            </tr>
            </thead>
            <tbody>
            @php $counter = 1; $total = 0; @endphp
            @foreach($details as $x)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $x->product->name }}</td>
                    <td><img src="{{ asset('storage/Product_image/'.$x->product->image) }}" alt="Product Image" width="100"></td>
                    <td>{{ $x->quantity }}</td>
                    <td>{{ $x->unit_price }}</td>
                    <td>{{ $x->subtotal }}</td>
                </tr>
                @php $total += $x->subtotal; @endphp
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="5" class="text-end"><strong>Total Price:</strong></td>
                <td><strong>{{$total}}</strong></td>
            </tr>
            </tfoot>
        </table>
        <div class="container mt-3">
            <div class="d-flex justify-content-center">
                {!! $details->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </main>
@endsection
