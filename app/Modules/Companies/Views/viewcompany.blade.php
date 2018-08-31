@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{$company->Name}} Profile Page</div>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-2">
                            <img src="{{ URL::asset(str_replace('public/', '',($company->logo)))}}" alt="img" width="100%">
                        </div>
                            <div class="col-8">{!! $company->description !!}</div>
                        </div>
                            <div style="padding-top: 10px; padding-bottom: 10px"> Company size: {{ $numberOfEmployees }} employees</div>
                        <a class="btn btn-outline-dark" href="/companies/{{$company->id}}/employees">View Employees</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



