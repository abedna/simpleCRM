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
                                       @if(old('Name')) value="{{old('Name')}}"
                                               @else value="{{$company->Name}}"
                                        @endif
                                       name="Name">
                                <small class="text-danger">{{ $errors->first('Name') }}</small>
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Email Adress</label>
                                <input type="text"
                                       class="form-control"
                                       @if(old('email')) value="{{old('email')}}"
                                       @else value="{{$company->email}}"
                                       @endif
                                       name="email">
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                            </div>
                            </div>
                            <div class="row">
                            <div class="form-group col-6">
                                <label for="website">Website</label>
                                <input type="text"
                                       class="form-control"
                                       @if(old('website')) value="{{old('website')}}"
                                       @else value="{{$company->website}}"
                                       @endif
                                       name="website">
                                <small class="text-danger">{{ $errors->first('website') }}</small>
                            </div>
                            <div class="form-group col-6">
                                <label for="logo">Logo</label>
                                <img src="{{ URL::asset($company->logo) }}" alt="img" width="40px">
                                <input type="file"
                                       class="form-control-file"
                                       name="logo">
                                <small class="text-danger">{{ $errors->first('logo') }}</small>
                            </div>
                            </div>
                            <div class="form-group float-right">
                                <a class="btn btn-secondary" href = {{route('home')}}>Cancel</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



