@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                        <form method="post"  action="{{route('home.update',$userinfo->id)}}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username',$userinfo->username) }}"  autocomplete="email" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control @error('f_name') is-invalid @enderror" name="f_name" value="{{ old('f_name',$userinfo->f_name) }}"  autocomplete="email" autofocus>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control @error('l_name') is-invalid @enderror" name="l_name" value="{{ old('l_name',$userinfo->l_name) }}"  autocomplete="email" autofocus>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control @error('email_address') is-invalid @enderror" name="email_address" value="{{ old('email_address',$userinfo->email_address) }}"  autocomplete="email" autofocus>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ old('mobile_number',$userinfo->mobile_number) }}"  autocomplete="email" autofocus>
                                </div>
                            </div>

                            <div class="form-group row mb-0 text-center ">
                                <div class="col-md-8 offset-2">
                                    <button type="submit" class="btn" style="background-color: #007E33; color: white">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
            <br>
        </div>



    </div>
</div>
@endsection
