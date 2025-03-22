@extends('Layouts.Maser')
@section('content')
    <main id="main" class="main">
        <br>
        <form action="{{ route('Staff.update',$staff) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                <input type="text" class="form-control" name="name" value="{{$staff->name}}" required>
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
                <input type="email" class="form-control" name="email" value="{{$staff->email}}" required>
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
                <input type="number" class="form-control" name="salary" step="1" value="{{$staff->salary}}" required>
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
                <input type="text" class="form-control" name="phone"value="{{$staff->phone}}" required>
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
                            <option value="" disabled {{ !$staff->role ? 'selected' : '' }}>Select Employee Role</option>
                            <option value="manager" {{ $staff->role == 'manager' ? 'selected' : '' }}>Restaurant Manager</option>
                            <option value="chef" {{ $staff->role == 'chef' ? 'selected' : '' }}>Chef</option>
                            <option value="sous_chef" {{ $staff->role == 'sous_chef' ? 'selected' : '' }}>Sous Chef</option>
                            <option value="waiter" {{ $staff->role == 'waiter' ? 'selected' : '' }}>Waiter</option>
                            <option value="bartender" {{ $staff->role == 'bartender' ? 'selected' : '' }}>Bartender</option>
                            <option value="cashier" {{ $staff->role == 'cashier' ? 'selected' : '' }}>Cashier</option>
                            <option value="host" {{ $staff->role == 'host' ? 'selected' : '' }}>Host/Hostess</option>
                            <option value="busser" {{ $staff->role == 'busser' ? 'selected' : '' }}>Busser (Table Cleaner)</option>
                            <option value="dishwasher" {{ $staff->role == 'dishwasher' ? 'selected' : '' }}>Dishwasher</option>
                        </select>
                    </div>
                </div>
            <div class="text-end">
                <input type="hidden" class="form-control" name="staff_id" value="{{$staff->id}}">
                <button type="submit" class="btn btn-primary">Upate</button>
            </div>
        </form>


        <br>

    </main><!-- End #main --><br><br><br>
@endsection



