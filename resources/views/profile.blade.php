@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-blue bg-primary text-white text-center py-4">
                    <h2 class="mb-0">Profile Account</h2>
                </div>
                <div class="card-body p-5">
                    @if(Auth::check())
                        <div class="form-group row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext text-secondary">{{ Auth::user()->name }}</p>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext text-secondary">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning text-center" role="alert">
                            User not authenticated.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
