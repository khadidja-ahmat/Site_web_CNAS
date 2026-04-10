<header>
    <!-- header-area start -->
    <div id="sticker" class="header-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12">

            <!-- Navigation -->
            <nav class="navbar navbar-default">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".bs-example-navbar-collapse-1" aria-expanded="false">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
								</button>
                <!-- Brand -->
                    <a class="navbar-brand page-scroll sticky-logo" href="index.html">
                          <h1><span>C</span>NAS</h1>
                    </a>
                 </div>
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse main-menu bs-example-navbar-collapse-1" id="navbar-example">
                <ul class="nav navbar-nav navbar-right">
                          <li class="active">
                            <a class="page-scroll" href="admin">Acceuil</a>
                          </li>
                              <li class="dropdown">
                                <a class="page-scroll" href="#"  data-toggle="dropdown">Modifier<span class="caret"></span></a>
                                  <ul class="dropdown-menu" role="menu">
                                  <li><a href="presentations" >Sliders</a></li>
                                  <li><a href="{{route('admin.abouts.home')}}" >Apropos</a></li>
                                  <li><a href="{{route('admin.institutions.home')}}" >Institutions</a></li>
                                  <li><a href="{{route('admin.realisations.home')}}" >Réalisations</a></li>
                                  <li><a href="{{route('admin.galeries.home')}}" >Galerie photos</a></li>
                                  <li><a href="{{route('admin.presentations.home')}}" >Presentation</a></li>
                                  <li><a href="{{route('admin.organigrammes.home')}}" >Organigramme</a></li>
                                  <li><a href="{{route('admin.presidents.home')}}" >President</a></li>
                                  <li><a href="{{route('admin.actualites.home')}}" >Actualités</a></li>
                                  <li><a class="page-scroll" href="{{route('admin.contacts.home')}}">Contacts</a></li>
                                </ul> 
                              </li>
                              <li>
                              <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                                  <li class="nav-item">
                                      <a class="nav-link" href="{{route('admin.admins')}}">{{ __('Admins') }}</a>
                                  </li>

                                  <li class="dropdown">
                                      <a class="nav-link dropdown" href="#" id="dropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                                          {{ auth()->guard('admin')->user()->name}}
                                      </a>
                                      <ul class="dropdown-menu" role="menu">
                                          <li><a class="dropdown-item text-light" href="{{route('admin.edit', auth()->guard('admin')->user()->id)}}">{{ __('Profile Update') }}</a></li>
                                          <li><a class="dropdown-item text-light"  role='button' href="#" onClick="deleteAdmin({{auth()->guard('admin')->user()->id}});" >{{ __('Profile Delete') }}</a></li>
                                          <li><a class="dropdown-item text-light" href="{{route('admin.logout')}}">{{ __('Log Out') }}</a></li>

                                          <form action="{{route('admin.destroy', auth()->guard('admin')->user()->id)}}" method="post"  id="delete-{{auth()->guard('admin')->user()->id }}">

                                              @csrf
                                              @method('delete')

                                          </form>

                                      </ul>
                                  </li>

                                  </ul>
                              </li>
                   </ul> 
               </div>
         
              <!-- navbar-collapse -->
            </nav>
            <!-- END: Navigation -->
          </div>
        </div>
      </div>
    </div>
    <!-- header-area end -->
  </header>