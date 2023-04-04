@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @can('isAdmin')
                        <a class="btn btn-success btn-lg" href="{{ route('trainings.index') }}">
                            You have Admin Access
                        </a>

                    @elsecan('isManager')
                        <a class="btn btn-success btn-lg" href="{{ route('trainings.index') }}">
                            You have Manager Access
                        </a>

                    @else
                        <a class="btn btn-success btn-lg" href="{{ route('trainings.index') }}">
                            You have User Access
                        </a>
                    @endcan


                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
