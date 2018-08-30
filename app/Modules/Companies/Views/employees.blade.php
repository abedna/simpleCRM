@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header h5">Employees at <b><a href="/companies/{{$company->id}}">{{$company->Name}}</a></b>
                        <div style="float:right"><a href="/home">Companies</a> </div>
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
                                <td>Action</td>
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
                                <td>
                                    <a class="btn btn-outline-info" href="/companies/{{$employee->company}}/employees/{{$employee->id}}/edit">Edit</a>
                                    <a class="btn btn-outline-danger" href="/companies/{{$employee->company}}/employees/{{$employee->id}}/delete">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                        <p class="h5">Add new employee</p>
                        @foreach($errors->all() as $error)
                            <div class="alert-danger" role="alert">
                                {{$error}}
                            </div>
                        @endforeach
                        <form class="myform" method="post" action="employees">
                            {{csrf_field()}}

                            <div class="row">
                            <div class="form-group col-6">
                                <label for="firstName">First Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="firstName"
                                       placeholder="First Name">
                            </div>

                            <div class="form-group col-6">
                                <label for="lastName">Last Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="lastName"
                                       placeholder="Last Name">
                            </div>
                            </div>
                            <div class="row">
                            <div class="form-group col-6">
                                <label for="email">Email Address</label>
                                <input type="text"
                                       class="form-control"
                                       name="email"
                                       placeholder="Email">
                            </div>
                            <div class="form-group col-6">
                                <label for="phone">Phone Number</label>
                                <input type="text"
                                       class="form-control"
                                       name="phone"
                                       placeholder="Phone">
                            </div>
                            </div>
                            <div class="row">
                            <div class="form-group col-6">
                                <label for="department">Department</label>
                                <input type="text"
                                       class="form-control"
                                       name="department"
                                       placeholder="Department">
                            </div>
                            <div class="form-group col-6">
                                <label for="salary">Salary</label>
                                <input type="text"
                                       class="form-control"
                                       name="salary"
                                       placeholder="Salary">
                            </div>
                            </div>
                            @if($employees->isEmpty())
                            <input type="hidden" name="company" value="'id'">
                            @else
                            <input type="hidden" name="company" value="{{$employee->id}}">
                            @endif

                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </form>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
