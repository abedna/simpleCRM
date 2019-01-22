
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Update personal data of {{$employee->firstName}} {{$employee->lastName}} </div>

                    <div class="card-body">

                        <form method="post" action="{{ route('employees.update', ['company' => $employee->company, 'employee' => $employee->id]) }}">
                            {{ csrf_field() }}
                            {{ method_field('patch') }}
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="firstName">First Name</label>
                                    <input type="text"
                                           class="form-control"
                                           name="firstName"
                                           @if(old('firstName')) value="{{old('firstName')}}"
                                           @else value="{{$employee->firstName}}"
                                           @endif
                                           placeholder="First Name">
                                    <small class="text-danger">{{ $errors->first('firstName') }}</small>
                                </div>

                                <div class="form-group col-6">
                                    <label for="lastName">Last Name</label>
                                    <input type="text"
                                           class="form-control"
                                           name="lastName"
                                           @if(old('lastName')) value="{{old('lastName')}}"
                                           @else value="{{$employee->lastName}}"
                                           @endif
                                           placeholder="Last Name">
                                    <small class="text-danger">{{ $errors->first('lastName') }}</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="email">Email Address</label>
                                    <input type="text"
                                           class="form-control"
                                           name="email"
                                           @if(old('email')) value="{{old('email')}}"
                                           @else value="{{$employee->email}}"
                                           @endif
                                           placeholder="email@example.com">
                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                </div>
                                <div class="form-group col-6">
                                    <label for="phone">Phone Number</label>
                                    <input type="text"
                                           class="form-control"
                                           name="phone"
                                           @if(old('phone')) value="{{old('phone')}}"
                                           @else value="{{$employee->phone}}"
                                           @endif
                                           placeholder="123456789">
                                    <small class="text-danger">{{ $errors->first('phone') }}</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="salary">Salary</label>
                                    <input type="text"
                                           class="form-control"
                                           name="salary"
                                           @if(old('salary')) value="{{old('salary')}}"
                                           @else value="{{$employee->salary}}"
                                           @endif
                                           placeholder="1234">
                                    <small class="text-danger">{{ $errors->first('salary') }}</small>
                                </div>
                                <div class="form-group col-3">
                                    <label for="salary">Birth Date</label>
                                    <input type="text"
                                           class="form-control"
                                           name="birthDate"
                                           @if(old('birthDate')) value="{{old('birthDate')}}"
                                           @else value="{{$employee->birthDate}}"
                                           @endif
                                           placeholder="yyyy-mm-dd">
                                    <small class="text-danger">{{ $errors->first('birthDate') }}</small>
                                </div>
                                <div class="form-group col-6">
                                    <label for="department">Department</label>
                                    <input type="text"
                                           class="form-control"
                                           name="department"
                                           @if(old('department')) value="{{old('department')}}"
                                           @else value="{{$employee->department}}"
                                           @endif
                                           placeholder="Department">
                                    <small class="text-danger">{{ $errors->first('department') }}</small>
                                </div>
                            </div>

                            <div class="form-group float-right">
                                <a class="btn btn-secondary" href={!! route('listemployees', ['company' => $employee->company]) !!}>Cancel</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

</html>


