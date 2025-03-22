@extends('Layouts.Maser')
@section('content')
    <main id="main" class="main">
        <br>
        <form action="{{ route('Staff.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
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
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                @if ($errors->has('email'))
                    <div class="card-body text-danger">
                        <ul>
                            @foreach ($errors->get('email') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="row mb-3">
                <label for="salary" class="col-sm-2 col-form-label">Salary</label>
                @if ($errors->has('salary'))
                    <div class="card-body text-danger">
                        <ul>
                            @foreach ($errors->get('salary') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input type="number" class="form-control" name="salary" step="1" required>
            </div>

            <div class="row mb-3">
                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                @if ($errors->has('phone'))
                    <div class="card-body text-danger">
                        <ul>
                            @foreach ($errors->get('phone') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input type="text" class="form-control" name="phone" required>
            </div>
                <div class="row mb-3">
                    <label for="role" class="col-sm-2 col-form-label">Role</label>

                    @if ($errors->has('role'))
                        <div class="card-body text-danger">
                            <ul>
                                @foreach ($errors->get('role') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="col-sm-10">
                        <select class="form-control" name="role" required>
                            <option value="">Select Employee Role</option>
                            <option value="manager">Restaurant Manager</option>
                            <option value="chef">Chef</option>
                            <option value="sous_chef">Sous Chef</option>
                            <option value="waiter">Waiter</option>
                            <option value="bartender">Bartender</option>
                            <option value="cashier">Cashier</option>
                            <option value="host">Host/Hostess</option>
                            <option value="busser">Busser (Table Cleaner)</option>
                            <option value="dishwasher">Dishwasher</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                @if ($errors->has('password'))
                    <div class="card-body text-danger">
                        <ul>
                            @foreach ($errors->get('password') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="row mb-3">
                <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm Password</label>
                @if ($errors->has('password_confirmation'))
                    <div class="card-body text-danger">
                        <ul>
                            @foreach ($errors->get('password_confirmation') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>


        <br>

    </main><!-- End #main --><br><br><br>
@endsection



