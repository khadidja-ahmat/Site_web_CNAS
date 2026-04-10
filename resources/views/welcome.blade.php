@extends('layout/layout')
@section('content')

  <!-- Start Slider Area -->
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
                <div class="layer-1-3 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <a class="ready-btn right-btn page-scroll" href="#services">See Services</a>
                  <a class="ready-btn page-scroll" href="#about">Learn More</a>
                </div>
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
  
  <!-- Start apropo area -->
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
      
    @foreach($apropos as $apropo)
        <!-- single-well start-->
        <div class="col-md-6 col-sm-12 col-xs-12">
          <div class="well-left">
            <div class="single-well">
              <a href="#">
      <img src="{{url('images/apropos/'.$apropo->image)}}" alt="">
								</a>
            </div>
          </div>
        </div>
        <!-- single-well end-->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="well-middle">
            <div class="single-well">
              <a href="#">
                <h4 class="sec-head">{{$apropo->titre}}</h4>
              </a>
              <p>{{$apropo->description}}</p>
            {{--   <ul>
                 <li>
                  <i class=""></i> la Caisse Nationale d'Assurance Santé a pour objectif :</li>
               
              </ul> --}}
            </div>
          </div>
        </div>
        @endforeach
        <!-- End col-->
      </div>
      </div>
      </div>
    </div>
  </div>
  <!-- End apropo area -->
    <div class="container">
      <div class="row">
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
        </div>
    </div>
  <!-- Start apropo area -->
  

  <!-- our-skill-area start -->
  <div id="team" class="our-team-area area-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Nos realisations</h2>
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
               <a class="venobox" data-gall="myTeam"  href="images/realisations/{{$realisation->image}}">
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
        <div class="awesome-project-1 fix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="awesome-menu ">
              <ul class="project-menu">
                <li>
                  <a href="#" class="active" data-filter="">" Une galerie en ligne, une exposition accessible a tous"</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
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
  
  @endsection

