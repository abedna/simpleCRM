@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header h5">{{__('translations.Companies')}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        @if($flash = session('message'))

                            <div class="alert-success" role="alert">
                                {{__('translations.'.$flash)}}

                            </div>
                        @endif
                        <div>
                        <table class="table table-responsive-sm table-responsive-md table table-responsive-lg table-hover ">
                            @if($flash = session('message-removed'))
                                <tr>
                                    <div class="alert-danger" role="alert">
                                        {{__('translations.'.$flash)}}

                                    </div>
                                </tr>
                            @endif
                            <tr class="table-secondary">
                                <td ></td>
                                <td >{{__('translations.Name')}}</td>
                                <td >Email</td>
                                <td >{{__('translations.Website')}}</td>
                                <td >{{__('translations.Action')}}</td>
                            </tr>
                                @if($companies->isEmpty())
                                    <div>No records yet. Add new company by using the form below:</div>
                                @else
                        @foreach($companies as $company)
                                <tr >
                                    <td ><img src="{{ URL::asset(str_replace('public/', '',($company->logo)))}}" alt="img" width="30px"></td>
                                    <td><a href="/companies/{{$company->id}}"> {{$company->Name}}</a></td>
                                    <td>{{$company->email}}</td>
                                    <td>{{$company->website}}</td>
                                    <td>
                                        @role('admin')
                                        <a class="btn btn-outline-info" href="/companies/{{$company->id}}/edit">{{__('translations.Edit')}}</a>
                                        <a class="btn btn-outline-danger" href="/companies/{{$company->id}}/delete" data-method="delete">{{__('translations.Delete')}}</a>
                                        @endrole
                                        <a class="btn btn-outline-dark" href="/companies/{{$company->id}}/employees">{{__('translations.View Employees')}}</a>
                                    </td>
                                </tr>
                        @endforeach
                        @endif
                        </table>
                        </div>
                        <div class="row justify-content-center">
                            {{ $companies->links() }}
                        </div>
                        <div style="padding-top: 10px; padding-bottom: 10px">
                            <h5></h5>
                        <div class="col-6">
                            <h5>{{__('translations.Best paid employees')}}</h5>
                            <table class="table table-responsive-sm table-responsive-md table table-responsive-lg ">
                                <tr class="table-secondary">
                                    <td>{{__('translations.Company')}}</td>
                                    <td>{{__('translations.Employee')}}</td>
                                    <td>{{__('translations.Salary')}}</td>
                                </tr>
                                @foreach($wages as $company=>$employee)
                                    @if(is_null($employee))
                                    <td>{{$company}}</td>
                                    <td>No employees at the moment</td>
                                    <td>-</td>
                                        @else
                                    <tr>
                                        <td>{{$company}}</td>
                                        <td>{{$employee->firstName}} {{$employee->lastName}}</td>
                                        <td>{{$employee->salary}} PLN</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                        </div>
                        @role('admin')
                        <p class="h5">{{__('translations.Add new company')}}</p>
                        <div >
                            <form class="myform" method="post" action="companies/post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="row">
                                <div class="form-group col-6 ">
                                    <label for="Name">{{__('translations.Company Name')}}</label>
                                    <input type="text"
                                           class="form-control"
                                           value="{{old('Name')}}"
                                           placeholder="{{__('translations.Company Name')}}"
                                           name="Name">
                                    <small class="text-danger">{{ $errors->first('Name') }}</small>
                                </div>
                                <div class="form-group col-6">
                                    <label for="email">{{__('translations.Email address')}}</label>
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
                                    <label for="website">{{__('translations.Website')}}</label>
                                    <input type="text"
                                           class="form-control"
                                           value="{{old('website')}}"
                                           placeholder="{{__('translations.Website')}}"
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
                                    <div class="form-group col-12">
                                        <label for="website">{{__('translations.Description')}}</label>
                                        <textarea name="description" rows="10" cols="80">

                                        </textarea>
                                        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
                                        <script>tinymce.init({ selector:'textarea' });</script>
                                        <small class="text-danger">{{ $errors->first('description') }}</small>
                                    </div>
                                </div>
                                <div class="form-group float-right">
                                    <button type="submit" class="btn btn-primary">{{__('translations.Submit')}}</button>
                                </div>
                            </form>
                        </div>
                    @endrole
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




