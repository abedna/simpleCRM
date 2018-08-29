
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Update personal data of {{$employee->firstName}} {{$employee->lastName}} </div>

                    <div class="card-body">

                        <form class="myform" method="post" action="/companies/{{$employee->company}}/employees/{{$employee->id}}/update">
                            {{csrf_field()}}
                            <div class="row">
                            <div class="form-group col-6">
                                <label for="firstName">First Name</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{$employee->firstName}}"
                                       name="firstName">
                            </div>
                            <div class="form-group col-6">
                                <label for="lastName">Last Name</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{$employee->lastName}}"
                                       name="lastName">
                            </div>
                            </div>
                            <div class="row">
                            <div class="form-group col-6">
                                <label for="email">Email Address</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{$employee->email}}"
                                       name="email">
                            </div>
                            <div class="form-group col-6">
                                <label for="phone">Phone Number</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{$employee->phone}}"
                                       name="phone">
                            </div>
                            </div>
                            <div class="form-group float-right">
                                <a class="btn btn-secondary" href={!! route('listemployees', ['company' => $employee->company]) !!}>Cancel</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>

                        @foreach($errors->all() as $error)
                            <div class="alert-danger" role="alert">
                                {{$error}}
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

</html>


