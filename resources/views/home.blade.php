@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('You are logged in!') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4>Thank you for registering</h4>
                    <a class="text-center" href="{{url('manage_contacts')}}" title="">Continue</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
