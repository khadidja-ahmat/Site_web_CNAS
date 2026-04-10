@extends('layouts/layout')
@section('content')

 <!-- Start Slider Area -->
<div id="home" class="slider-area">
    <div class="bend niceties preview-2">
      <div id="ensign-nivoslider" class="slides">
        <img src="img/slider/slider1.jpg" alt="" title="#slider-direction-1" />
        <img src="img/slider/slider2.jpg" alt="" title="#slider-direction-2" />
        <img src="img/slider/slider3.jpg" alt="" title="#slider-direction-3" />
      </div>

      <!-- direction 1 -->
      <div id="slider-direction-1" class="slider-direction slider-one">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow slideInDown" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1">La caisse Nationale d'Assurance Santé </h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">Elle a été créée suite à la Charte de Transition et la loi N026/PR/2020 du 31 décembre portant création d'une Caisse Nationale d'Assurance Santé</h1>
                </div>
                <!-- layer 3 -->
              
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- direction 2 -->
      <div id="slider-direction-2" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content text-center">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1">Les objectifs de la CNAS</h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">Offrir les soins de qualité à toute la population tchadienne sans aucune discrimination et au même point d'égalité
                  </h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <a class="ready-btn right-btn page-scroll" href="#services">See Services</a>
                  <a class="ready-btn page-scroll" href="#about">Learn More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- direction 3 -->
      <div id="slider-direction-3" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1">Notre devise: </h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">"Votre bien être est notre priorité" </h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <a class="ready-btn right-btn page-scroll" href="#services">See Services</a>
                  <a class="ready-btn page-scroll" href="#about">Learn More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Slider Area -->
  <div id="services" class="services-area area-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Apropos</h2>
          </div>
        </div>
      </div>
    <div class="row">
      
     @foreach($abouts as $about)
        <!-- single-well start-->
        <div class="col-md-6 col-sm-12 col-xs-12">
          <div class="well-left">
            <div class="single-well">
              <a href="#">
      <img src="{{url('images/abouts/'.$about->image)}}" alt="">
								</a>
            </div>
          </div>
        </div>
        <!-- single-well end-->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="well-middle">
            <div class="single-well">
              <a href="#">
                <h4 class="sec-head">{{$about->titre}}</h4>
              </a>
              <p>{{$about->description}}</p>
            {{--   <ul>
                 <li>
                  <i class=""></i> la Caisse Nationale d'Assurance Santé a pour objectif :</li>
                <li>
                  <i class="fa fa-check"></i> Assurer une couverture santé universelle;
                </li>
                <li>
                  <i class="fa fa-check"></i>Gérer efficacement les fonts de l'assurance santé;
                </li>
                <li>
                  <i class="fa fa-check"></i>Promouvoir la prévention et la santé pulique;
                </li>
                 <li>
                  <i class="fa fa-check"></i>Mettre en place des programmes de sensibilisation pour prevenir les maladies;.
                </li>
                <li>
                  <i class="fa fa-check"></i>Garantir la qualité des soins;
                </li>
                <li>
                  <i class="fa fa-check"></i>Favoriser l'efficence du systeme de santé.
                </li>
              </ul> --}}
            </div>
          </div>
        </div>
        @endforeach
        <!-- End col-->
      </div>
      </div>
      </div>
  <!-- End About area -->
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="faq-details">
            <div class="panel-group" id="accordion">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#check2">
                                                <span class="acc-icons"></span>  une organisation
											</a>
										</h4>
                </div>
                <div id="check2" class="panel-collapse collapse">
                  <div class="panel-body">
                  <p>
                   Etre une organisation de reference dans le domaine de l'assurance santé en garantissant une couverture universelle, une gestions efficiante des fonds , une promotion de la preventions et de la santé publique, une qualité des soins optimalw et une effiance  du systeme de santé.  </p>
                  <p> Etre une organisme contribuant ainsi a l'amelioration de la santé et du bien-etre de la population. </p>
                </div>
                </div>
              </div>
              <!-- End Panel Default -->
              <!-- Panel Default -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#check3">
                                                <span class="acc-icons"></span>La Caisse Nationale
											</a>
										</h4>
                </div>
                <div id="check3" class="panel-collapse collapse ">
                  <div class="panel-body">
                  <p>La Caisse Nationale a pour objectif principale dassurer une couverture santé universelle, en veillant a ce que tous les citoyens aient accés a des soins de santé essential, independament e leur statut socio-economique.un autre objet clé de la Caisse Nationale d'Assurance santéest de gerer efficacement les fonds de l'assurance santé, en garantissant une utilisation optimale des ressources finanieres afin de maintenir la viabilitédu systeme d'assurance santé. </p>
                  <p>Un autre objectif de la ciasse nationale d'assuranvce santé est de garantir la qualité de soins en mettant en place des mecanismes de controleet d'evaluation de la qualité des prestations médicales fournis aux assurées.</p>
                 </div>
                </div>
              </div>
              <!-- End Panel Default -->
              <!-- Panel Default -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#check4">
                                                <span class="acc-icons"></span>Assurer une protection
											</a>
										</h4>
                </div>
                <div id="check4" class="panel-collapse collapse">
                  <div class="panel-body">
                  <p>Assurer une protection sociale et une couverture santé universelle ,éauitable de qualité pour l'ensemble de la population, en favorisant l'accés aux soins et en garantissant la solidarité entre les assurées.  </p>
                  <p>Gérer efficacement les fonds de l'assurance santéet promouvoir la prévention et l'assurance de la santé publique.  </p>
                 </div>
                </div>
              </div>
              <!-- End Panel Default -->
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="tab-menu">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li class="active">
                <a href="#p-view-1" role="tab" data-toggle="tab">Mission</a>
              </li>
              <li>
                <a href="#p-view-2" role="tab" data-toggle="tab">Vision</a>
              </li>
              <li>
                <a href="#p-view-3" role="tab" data-toggle="tab">Objectif</a>
              </li>
            </ul>
          </div>
          <div class="tab-content">
          <div class="tab-pane active" id="p-view-1">
              <div class="tab-inner">
                <div class="event-content head-team">
                  <h4>Mission</h4>
                  <p>Assurer une protection sociale et une couverture santé universelle ,équitable et de qualité pour l'ensemble de la population, en favorisant l'accés aux bon soins en interne qu'en externe.  </p>
                  <p>Gérer efficacement les fonds de l'assurance santé et promouvoir l'assurance de la santé publique.  </p>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="p-view-2">
              <div class="tab-inner">
                <div class="event-content head-team">
                  <h4>Vision</h4>
                  <p>
                   Etre une organisation de reference dans le domaine de l'assurance santé en garantissant une large couverture, une qualité des soins optimale et une effiance  du systeme de santé.  </p>
                  <p> Etre un organisme contribuant ainsi a l'amelioration de la santé et du bien-etre de la population. </p>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="p-view-3">
              <div class="tab-inner">
                <div class="event-content head-team">
                  <h4>Objectif</h4>
                  <p>La Caisse Nationale a pour objectif principale d'assurer une couverture sanitaire universelle, en veillant a ce que tous les citoyens aient accés à des soins de santé vitaux, independament de leur statut socio-economique.L'objet clé de la CNAS est de gerer efficacement les fonds de l'assurance santé, en garantissant une utilisation optimale des ressources financières allouées à la santé afin de maintenir la viabilité du systeme de l'assurance santé. </p>
                  <p>Un autre objectif de la ciasse nationale d'assuranvce santé est de garantir la qualité de soins en mettant en place des mecanismes de controle et d'evaluation de la qualité des prestations médicales fournis aux assurées.</p>
                </div>
              </div>
          </div>
        </div>
      <!-- end Row -->
    </div>
  </div>

  
{{--   <!-- Start About area -->
<br>

  <div id="about" class="portfolio-area area-padding fix">
    <div class="container">
        <div class="section-header">
          <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Apropos</h2>
          </div>
        </div>
          <p></p>
        </div>

   @foreach($abouts as $about)
        <div class="row gy-4">
          <div class="col-lg-6">
            <h3>{{$about->titre}}</h3>
            <img src="assets/img/about.jpg" class="img-fluid rounded-4 mb-4" alt="">
            <p>{{$about->description}}</p>
            </div>
          <div class="col-lg-6">
            <div class="content ps-0 ps-lg-5">
              <p class="fst-italic">
               <img src="{{url('images/abouts/'.$about->image)}}" alt="">    
              </p>
            </div>
          </div>
        </div>
@endforeach
      </div>
     --}}

  {{-- Mot du directeur--}}
 {{-- Presentation --}}
{{--   Organigramme --}}
  <!-- Start Service area -->
  <div id="services" class="services-area area-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline services-head text-center">
            <h2>Nos institustions</h2>
          </div>
        </div>
      </div>
      <div class="row text-center">
        <div class="services-contents">
        @foreach($institutions as $institution)
          <!-- Start Left services -->
          <div class="col-md-4 col-sm-4 col-xs-12">
          <div class=" about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="#">
											<i class="fa fa-ticket"></i>
										</a>
                  <h4>{{$institution->titre}}</h4>
                  <p>
                  {{$institution->description}}
                  </p>
                </div>
              </div>
              <!-- end about-details -->
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <!-- our-skill-area start -->
  <div id="team" class="our-team-area area-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Nos realisation</h2>
          </div>
        </div>
      </div>
      <div class="row">
             @foreach($realisations as $realisation)
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="single-team-member">
              <div class="awesome-img">
                <a href="#">
                   <img src="{{url('images/realisations/'.$realisation->image)}}" alt="">
									</a>
              </div>
              <div class="team-content text-center">
               <a class="venobox" data-gall="myGallery"  href="images/realisations/{{$realisation->image}}">
                      <h4>{{$realisation->titre}}</h4>
                      <p>{{$realisation->description}}</p>
                    </a>
              </div>
            </div>
          </div>
           @endforeach
          <!-- End column -->
        </div>
      </div>
    </div>
  </div>
  <!-- End Team Area -->  
  <!-- Start reviews Area -->
 {{--  <div class="reviews-area hidden-xs">
    <div class="work-us">
      <div class="work-left-text">
        <a href="#">
						<img src="{{URL::to('images/abouts/1.jpg')}}" alt="">
					</a>
      </div>
      <div class="work-right-text text-center">
        <h2>"Sante préservée, bonheur assuré."</h2>
        <h5>"la santé est la richesse véritable, protégez-la<br>comme un trésor.Un esprit sain dans un corps sain,<br>la clé d'une vie épanouie."</h5>
        <a href="contacts" class="ready-btn">Contactez-nous</a>
      </div>
    </div>
  </div> --}}
    <!-- Start reviews Area -->
  <div class="reviews-area hidden-xs">
    <div class="work-us">
      <div class="work-left-text">
        <a href="#">
						<img src="{{URL::to('images/abouts/2.jpg ')}}" alt="">
					</a>
      </div>
      <div class="work-right-text text-center">
        <h2>"Sante préservée, bonheur assuré."</h2>
        <h5>"la santé est la richesse véritable, protégez-la<br>comme un trésor.Un esprit sain dans un corps sain,<br>la clé d'une vie épanouie."</h5>
        <a href="contacts" class="ready-btn">Contactez-nous</a>
      </div>
    </div>
  </div>
  <!-- End reviews Area -->
  <!-- End reviews Area -->

  <!-- Start portfolio Area -->
   <div id="portfolio" class="portfolio-area area-padding fix">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Nos Galeries</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- Start Portfolio -page -->
        
        <div class="awesome-project-content">
     @foreach($galeries as $galerie)
          <div class="col-md-4 col-sm-4 col-xs-12 design development">
            <div class="single-awesome-project">
              <div class="awesome-img">
                   <a href="#"><img src="{{url('images/galeries/'.$galerie->image)}}" alt=""></a>
                <div class="add-actions text-center">
                  <div class="project-dec">
                    <a class="venobox" data-gall="myGallery" href="images/galeries/{{$galerie   ->image}}">
                      <h4>{{$galerie->titre}}</h4>
                      <span>{{$galerie->description}}</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
       @endforeach
        </div>
      </div>
    </div>
  </div>
  <!-- awesome-portfolio end -->
  <!-- Start Blog Area -->
   <div id="blog" class="blog-area">
    <div class="blog-inner area-padding">
      <div class="blog-overly"></div>
      <div class="container ">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Actualités</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- Start Left Blog -->
          
     @foreach($actualites as $actualite)
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="single-blog">
              <div class="single-blog-img">
               <a href="#">
               <img src="{{url('images/actualites/'.$actualite->image)}}" alt="">
								</a>
              </div>
              <div class="blog-meta">
                <span class="comments-type">
										<i class="fa fa-comment-o"></i>
										<a href="#">13 comments</a>
									</span>
                <span class="date-type">
										<i class="fa fa-calendar"></i>2016-03-05 / 09:10:16
									</span>
              </div>
              <div class="blog-text">
                <h4>
                                        <a href="#">{{$actualite->titre}}</a>
									</h4>
                <p>
                 {{$actualite->description}}  </p>
              </div>
              <span>
									<a href="actualites" class="ready-btn">Détails</a>
								</span>
            </div>
           
            <!-- Start single blog -->
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <!-- End Blog -->
  <!-- Start Suscrive Area -->
  <div class="suscribe-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs=12">
          <div class="suscribe-text text-center">
            <h3>Bienvenue a la caisse nationale de santé</h3>
            <a class="sus-btn" href="#">Retour</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Suscrive Area -->
  <!-- End Contact Area -->
  @endsection

