@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{$company->Name}} Profile Page</div>

                    <div class="card-body">
                        <img src="{{ URL::asset($company->logo) }}" alt="img" width="100px">
                        <div>{!! $company->description !!}</div>
                        <p> Company size: {{ $company->employees()->count() }} employees</p>
                    </div >

                </div>
            </div>
        </div>
    </div>
@endsection



