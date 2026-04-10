@extends('layout/layout')
@section('content')
    <section id="about">
        <div class="container">

            <div class="container my-5">
                <h4>Students List</h4>

                <div class="flex-end" >
                    <a href="{{route('admin.create')}}" class="btn btn-sm btn-primary float-right">Nouveau</a>
                </div>

                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{Session::get('success')}}
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                @endif

                <table class="table table-hover table-responsive">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Date</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($admins as $admin)
                        <tr valign="middle">
                            <td>{{$admin -> id}}</td>
                            <td>{{$admin -> created_at}}</td>
                            <td>{{$admin -> name}}</td>
                            <td>{{$admin -> email}}</td>
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

