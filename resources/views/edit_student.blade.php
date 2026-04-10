@extends('admin.admin_layout')
@section('content')
    <section id="about">
        <div class="container">

            <div class="container my-5">
                <div class="container my-5 row">
                    <div class="col-md-4"></div>
                    <div class="col-md-6 card">
                        <h4 >Ajout d'un nouveau Etudiant</h4>


                        <form method="POST" action="{{route('admin.update.student', $student->id)}}" enctype="multipart/form-data">

                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{$student->name}}" required>
                            </div>

                            <div class="mb-3">
                                <label for="sex" class="form-label">Gender</label>
                                <input type="text" name="sex" class="form-control" id="sex" value="{{$student->sex}}" required>
                            </div>

                            <div class="mb-3">
                                <label for="age" class="form-label">Age</label>
                                <input type="text" name="age" class="form-control" id="age" value="{{$student->age}}" required>
                            </div>

                            <div class="mb-3">
                                <label for="mat_id" class="form-label">Choisir la matiere</label>
                                <select name="mat_id" class="form-control" id="mat_id">
                                    @foreach($courses as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Phote</label>
                                <input type="file" name="image" class="form-control" id="image" placeholder="Enter the student image">
                                <div class="pt-3">
                                    @if($student -> image != '' && file_exists(public_path().'/images/students/'.$student -> image))
                                        <img src="{{url('images/students/'.$student -> image)}}" alt="" width="80" height="100">
                                    @endif
                                </div>

                            </div>

                            <div class="flex-end" >
                                <button type="submit" class="btn btn-primary mb-3 mx-3">Update</button>
                                <a href="index.php" class="btn btn-outline-warning mb-3">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- #about -->
@endsection
