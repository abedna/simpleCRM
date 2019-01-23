@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header h5">Employees at <b><a href="/companies/{{$company->id}}">{{$company->Name}}</a></b>
                        <div style="float:right"><a href="{{ route('companies.index') }}">Companies</a> </div>
                    </div>
                    <div class="card-body">

                        @if($flash = session('message'))

                            <div class="alert-success" role="alert">
                                {{$flash}}

                            </div>
                        @elseif($flash = session('deleted'))

                            <div class="alert-danger" role="alert">
                                {{$flash}}

                            </div>
                        @endif
                        <table class="table table-responsive-md table-responsive-sm table-responsive-lg table-hover">
                            <tr class="table-secondary">
                                <td>Id</td>
                                <td>First Name</td>
                                <td>Last Name</td>
                                <td>Email</td>
                                <td>Phone</td>
                                <td>Department</td>
                                <td>Birth Date</td>
                                <td>Salary</td>
                                @role('admin')
                                <td>Action</td>
                                @endrole
                            </tr>
                        @if($employees->isEmpty())
                            <div>No employees yet</div>
                            @else
                            @foreach($employees as $employee)
                            <tr >
                                <td>{{$employee->id}}</td>
                                <td>{{$employee->firstName}}</td>
                                <td>{{$employee->lastName}}</td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->phone}}</td>
                                <td>{{$employee->department}}</td>
                                <td>{{$employee->birthDate}}</td>
                                <td>{{$employee->salary}}</td>
                                @role('admin')
                                <td>
                                    <a class="btn btn-outline-info" href="/companies/{{$employee->company}}/employees/{{$employee->id}}/edit">Edit</a>
                                    <form method="post" action="{{ route('employees.delete', ['company' => $employee->company, 'employee' =>$employee->id]) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                                @endrole
                            </tr>
                            @endforeach
                            @endif
                        </table>
                            @role('admin')
                        <p class="h5">Add new employee</p>
                        <form class="myform" method="post" action="employees">
                            {{csrf_field()}}
                            <div class="row">
                            <div class="form-group col-6">
                                <label for="firstName">First Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="firstName"
                                       @if(old('firstName')) value="{{old('firstName')}}"
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
                                           @endif
                                           placeholder="Department">
                                    <small class="text-danger">{{ $errors->first('department') }}</small>
                                </div>
                            </div>

                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @endrole
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
