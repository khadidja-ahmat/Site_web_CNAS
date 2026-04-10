@extends('layout/layout')
@section('content')
    <section id="about mt-5">
        <div class="container">

        
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

