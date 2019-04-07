@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{ Breadcrumbs::render('users.create') }}
        </div>
        <div class="col-md-12">
            <div class="card card-create">
                <div class="card-body">
                    @include('users.form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
