@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{ Breadcrumbs::render('users') }}
        </div>
        <div class="col-md-12">
            <div class="card card-index">
                <div class="card-header">
                    <div class="float-right">
                        <a href="{{ route('users.create') }}" class="btn btn-secondary"><i class="fa fa-plus"></i> Novo</a>
                    </div>
                </div>

                <div class="card-body">
                    @include('users.list')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
