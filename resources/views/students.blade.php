@extends('layouts')
@section('content')
    <section id="about">
        <div class="container">

        <div class="container my-5">
    <h4>Students List</h4>
            <table class="table table-hover table-responsive">
                    <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Sex</th>
                    <th scope="col">Age</th>
                    <th scope="col">Adresse</th>
                        <th scope="col">Photo</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($students as $student)
                            <tr valign="middle">
                                    <td>{{$student -> id}}</td>
                                    <td>{{$student -> name}}</td>
                                    <td>{{$student -> sex}}</td>
                                    <td>{{$student -> age}}</td>
                                    <td>{{$student -> address}}</td>
                                    <td>
                                        @if($student -> image != '' && file_exists(public_path().'/images/students/'.$student -> image))
                                            <img src="{{url('images/students/'.$student -> image)}}" alt="" width="40" height="50"
                                                class="rounded-circle">
                                        @else
                                            <img src="{{url('assets/images/profile.jpeg')}}" alt="" width="40" height="40"
                                                 class="rounded-circle">
                                        @endif

                                    </td>
                                    <td>
                                        <a class='btn btn-sm btn-outline-primary' href='{{route('show.student')}}' role='button'>Details</a>
                                    </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section><!-- #about -->

    <script>
        function deleteStudent(id) {
            if(confirm('Etes vous sure de vouloir supprimer cette enregistrement ?')){
                document.getElementById('delete-' + id).submit();
            }
        }
    </script>

@endsection
