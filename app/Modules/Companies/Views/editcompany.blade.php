@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit {{$company->Name}}</div>

                    <div class="card-body">

                        <form class="myform" method="post" action="update-company/{{$company->id}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                            <div class="form-group col-6">
                                <label for="Name">Company Name</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{$company->Name}}"
                                       name="Name">
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Email Adress</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{$company->email}}"
                                       name="email">
                            </div>
                            </div>
                            <div class="row">
                            <div class="form-group col-6">
                                <label for="website">Website</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{$company->website}}"
                                       name="website">
                            </div>
                            <div class="form-group col-6">
                                <label for="logo">Logo</label>
                                <input type="file"
                                       class="form-control-file"
                                       name="logo">
                            </div>
                            </div>
                            <div class="form-group float-right">
                                <a class="btn btn-secondary" href = {{route('home')}}>Cancel</a>
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



