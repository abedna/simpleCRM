@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header h5">Companies</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        @if($flash = session('message'))

                            <div class="alert-success" role="alert">
                                {{$flash}}

                            </div>
                        @endif
                        <div>
                        <table class="table table-responsive-sm table-responsive-md table table-responsive-lg table-hover ">
                            @if($flash = session('message-removed'))
                                <tr>
                                    <div class="alert-danger" role="alert">
                                        {{$flash}}

                                    </div>
                                </tr>
                            @endif
                            <tr class="table-secondary">
                                <td ></td>
                                <td >Name</td>
                                <td >Email</td>
                                <td >Website</td>
                                <td >Action</td>
                            </tr>
                                @if($companies->isEmpty())
                                    <div>No records yet. Add new company by using the form below:</div>
                                @else
                        @foreach($companies as $company)
                                <tr >
                                    <td ><img src="{{ URL::asset($company->logo) }}" alt="img" width="30px"></td>
                                    <td>{{$company->Name}}</td>
                                    <td>{{$company->email}}</td>
                                    <td>{{$company->website}}</td>
                                    <td>
                                        <a class="btn btn-outline-info" href="/edit-company/{{$company->id}}">Edit</a>
                                        <a class="btn btn-outline-danger" href="/delete-company/{{$company->id}}">Delete</a>
                                        <a class="btn btn-outline-dark" href="/company/{{$company->id}}/employees">View Employees</a>
                                    </td>
                                </tr>


                        @endforeach
                        @endif
                        </table>
                        </div>
                        <div class="row justify-content-center">
                            {{ $companies->links() }}
                        </div>
                        <p class="h5">Add new company</p>
                        <div >
                            <form class="myform" method="post" action="post-company" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="row">
                                <div class="form-group col-6 ">
                                    <label for="Name">Company Name</label>
                                    <input type="text"
                                           class="form-control"
                                           value="{{old('Name')}}"
                                           placeholder="Company Name"
                                           name="Name">
                                    <small class="text-danger">{{ $errors->first('Name') }}</small>
                                </div>
                                <div class="form-group col-6">
                                    <label for="email">Email address</label>
                                    <input type="text"
                                           class="form-control"
                                           value="{{old('email')}}"
                                           placeholder="Email"
                                           name="email">
                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                </div>
                                </div>
                                <div class="row">
                                <div class="form-group col-6">
                                    <label for="website">Website</label>
                                    <input type="text"
                                           class="form-control"
                                           value="{{old('website')}}"
                                           placeholder="Website"
                                           name="website">
                                    <small class="text-danger">{{ $errors->first('website') }}</small>
                                </div>
                                <div class="form-group col-6">
                                    <label for="logo">Logo</label>
                                    <input type="file"
                                           class="form-control-file"
                                           name="logo">
                                    <small class="text-danger">{{ $errors->first('logo') }}</small>
                                </div>
                                </div>
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
@endsection
