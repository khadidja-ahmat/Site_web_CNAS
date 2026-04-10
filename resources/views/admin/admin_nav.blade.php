 <header id="header" class="header d-flex align-items-center">

     <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
         <a href="{{route('index')}}" class="logo d-flex align-items-center">
             <!-- Uncomment the line below if you also wish to use an image logo -->
             <img src="assets/img/LOO.png" alt="">
             <h1>ONG Soli-Dev<span>.</span></h1>
         </a>
         <nav id="navbar" class="navbar">
            <div>
                <ul>
                <li class="dropdown">
                     <a href="#" role="button"><span></span> <i
                             class="bi bi-chevron-down dropdown-indicator"></i>Modifier</a>
                     <ul>
                         <li>
                             <a href="{{route('admin.sliders.index')}}">Sliders</a>
                         </li>
                         <li class="dropdown">

                             <a href="{{route('admin.apropos_n.index')}}">Apropos Acceuil G</a>
                         </li>

                         <li class="dropdown">
                             <a href="{{route('admin.apropos2_n.index')}}">Apropos Acceuil D</a>
                         </li>
                         <li class="dropdown">
                             <a href="{{route('admin.apropos.home')}}">Apropos</a>
                         </li>
                         <li class="dropdown">
                             <a href="{{route('admin.activites.home')}}">Activites</a>
                         </li>
                         <li class="dropdown">
                             <a href="{{route('admin.contact_f.index')}}">Liste des contacts</a>
                         </li>
                         <li class="dropdown">
                             <a href="{{route('admin.blog.home')}}">Blog</a>
                         </li>
                         <li class="dropdown">
                             <a href="{{route('admin.realisations.index')}}">Realisations</a>
                         </li>
                         <li class="dropdown">
                             <a href="{{route('admin.contacts.home')}}">Contacts</a>
                         </li>

                 </li>
                </ul>
            </div>
          
             <ul>
                 <li>
                     <a href="{{route('admin.admins')}}">{{ __('Admins') }}</a>
                 </li>
             </ul>

             <ul>
           
                 <li class="dropdown">
                     <a href="#" role="button"><span></span> <i
                             class="bi bi-chevron-down dropdown-indicator"></i>{{ auth()->guard('admin')->user()->name}}</a>
                     <ul>
                         <li>
                             <a
                                 href="{{route('admin.edit', auth()->guard('admin')->user()->id)}}">{{ __('Profile Update') }}</a>
                         </li>
                         <li class="dropdown">
                             <a href="#"
                                 onClick="deleteAdmin({{auth()->guard('admin')->user()->id}});">{{ __('Profile Delete') }}</a>
                         </li>

                         <li class="dropdown">
                             <a href="{{route('admin.logout')}}">{{ __('Log Out') }}</a>
                         </li>
                         <form action="{{route('admin.destroy', auth()->guard('admin')->user()->id)}}" method="post"
                             id="delete-{{auth()->guard('admin')->user()->id }}">

                             @csrf
                             @method('delete')

                         </form>
                 </li>

             </ul>



         </nav><!-- .navbar -->

         <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
         <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

     </div>
 </header><!-- End Header -->
 <!-- End Header -->
 <script>
function deleteAdmin(id) {
    if (confirm('Etes vous sure de vouloir supprimer Votre Compte ?')) {
        document.getElementById('delete-' + id).submit();
    }
}
 </script>