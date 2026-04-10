@extends('admin.admin_layout')
@section('content')
    <section id="about">
        <div class="container">

            <div class="container my-5">

                <div class="container my-5 row">

                    <div class="col-md-6 offset-md-3 card">

                        <h4 ><span style="font-weight: bold">Create New Admin</span></h4>


                        <form method="POST" action="{{ route('admin.store') }}">

                            @csrf

                            <div class="mb-3">
                                <label for="name" :value="__('Name')"  class="form-label">Name</label>
                                <input type="text" name="name" :value="old('name')" class="form-control" id="name" placeholder="Enter admin name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" :value="__('Email')"  class="form-label">Email</label>
                                <input type="email" name="email" :value="old('email')" class="form-control" id="email" placeholder="Enter admin email" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" :value="__('Password')"  class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter the student gender" required>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" :value="__('Confirm Password')"  class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Enter Confirm Password" required>
                            </div>


                            <div class="flex-end" >
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('admin.login') }}">
                                    {{ __('Already registered?') }}
                                </a>
                                <button type="submit" class="btn btn-primary mb-3 mx-3">Submit</button>
                                <a href="index.php" class="btn btn-primary mb-3 mx-3">Annuler</a>
                            </div>

                        </form>
                    </div>
                </div>


            </div>
        </div>
    </section><!-- #about -->
@endsection
