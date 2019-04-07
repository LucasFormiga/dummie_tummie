@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{ Breadcrumbs::render('users.edit', $user) }}
        </div>
        <div class="col-md-12">
            <div class="card card-edit">
                <div class="card-header">
                    <span>{{ $user->full_name }}</span>
                </div>

                <div class="card-body">
                    @include('users.form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
