@extends('admin.admin_layout')
@section('content')
    <section id="about">
        <div class="container">

            <div class="container my-5">

                <div class="container my-5 row">

                    <div class="col-md-6 offset-md-3 card">

                        <h4 ><span style="font-weight: bold">Update you Profile</span></h4>


                        <form method="POST" action="{{ route('admin.update', $user->id) }}">

                            @csrf
                            @method('patch')

                            <div class="mb-3">
                                <label for="name" :value="__('Name')"  class="form-label">Name</label>
                                <input type="text" name="name" value="{{$user->name}}" class="form-control" id="name" placeholder="Enter admin name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" :value="__('Email')"  class="form-label">Email</label>
                                <input type="email" name="email" value="{{$user->email}}" class="form-control" id="email" placeholder="Enter admin email" required>
                            </div>


                            <div class="flex-end" >
                                <button type="submit" class="btn btn-primary mb-3 mx-3">Submit</button>
                                <a href="{{route('admin.admins')}}" class="btn btn-outline-warning mb-3">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>


            </div>
        </div>
    </section><!-- #about -->
@endsection
