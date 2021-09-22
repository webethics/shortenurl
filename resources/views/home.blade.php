@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('flash-message')
            <div class="card">
                <div class="card-header">{{ __('URL Shortening') }}</div>

                <div class="card-body">
                   <form method="POST" action="{{ route('save-url') }}">
                        @csrf

                        <div class="form-group row">
                            
                            <div class="col-md-10 m-auto">
                                <label for="name" class="mt-sm-1">{{ __('Enter the url you want to shorten.') }}</label>
                                <input id="destination" type="text" class="form-control @error('destination') is-invalid @enderror" name="destination" placeholder="http://example.com" value="{{ old('destination') }}"  autocomplete="off" autofocus>
                                
                                @error('destination')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                      

                        <div class="form-group row mb-0">
                            <div class="col-md-10 m-auto">
                                <button type="submit" class="btn btn-primary btn-lg float-right">
                                    {{ __('Shorten URL') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-lg-5">
        <div class="col-md-12">
             @include('urls')
        </div>
    </div>
</div>
@endsection
