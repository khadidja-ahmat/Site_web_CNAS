@extends('layouts')
@section('content')
    <section id="about">
        <div class="container">

            <div class="container my-5">

                <div class="container my-5 row">

                    <div class="col-md-6 offset-md-3 card">

                        <h4 ><span style="font-weight: bold">Admin Login</span></h4>


                        <form method="POST" action="{{route('admin.login')}}">

                            @csrf

                            <div class="mb-3">
                                <label for="email" :value="__('Email')"  class="form-label">Email</label>
                                <input type="email" name="email" :value="old('email')" class="form-control" id="email" placeholder="Enter the student name" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" :value="__('Password')"  class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter the student gender" required>
                            </div>

                            <!-- Remember Me -->
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>

                            <div class="flex-end" >
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                                <button type="submit" class="btn btn-primary mb-3 mx-3">Submit</button>
                                <a href="{{route('home')}}" class="btn btn-outline-warning mb-3">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>


            </div>
        </div>
    </section><!-- #about -->
@endsection
