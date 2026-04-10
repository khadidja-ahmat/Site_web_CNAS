@extends('layouts/layout')
@section('content')


  <div id="services" class="services-area area-padding">
    <div class="container">
    <br><br>
        <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Présentation</h2>
          </div>
        </div>
      </div>
      <header class="section-header">

            <div class="single-well">
   @foreach($presentations as $presentation)
                <a href="#">
              <p>{{$presentation->description}}</p>
              </a>
   @endforeach  
   </div>   
  </header>
<div class="faq-area area-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Vue d'ensemble</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="faq-details">
            <div class="panel-group" id="accordion">
              <!-- Panel Default -->
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
                  <p>Assurer une protection sociale et une couverture santé universelle ,éauitable de qualité pour l'ensemble de la population, en favorisant l'accés aux soins et en garantissant la solidarité entre les assurées.  </p>
                  <p>Gérer efficacement les fonds de l'assurance santéet promouvoir la prévention et l'assurance de la santé publique.  </p>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="p-view-2">
              <div class="tab-inner">
                <div class="event-content head-team">
                  <h4>Vision</h4>
                  <p>
                   Etre une organisation de reference dans le domaine de l'assurance santé en garantissant une couverture universelle, une gestions efficiante des fonds , une promotion de la preventions et de la santé publique, une qualité des soins optimalw et une effiance  du systeme de santé.  </p>
                  <p> Etre une organisme contribuant ainsi a l'amelioration de la santé et du bien-etre de la population. </p>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="p-view-3">
              <div class="tab-inner">
                <div class="event-content head-team">
                  <h4>Objectif</h4>
                    <p>La Caisse Nationale a pour objectif principale dassurer une couverture santé universelle, en veillant a ce que tous les citoyens aient accés a des soins de santé essential, independament e leur statut socio-economique.un autre objet clé de la Caisse Nationale d'Assurance santéest de gerer efficacement les fonds de l'assurance santé, en garantissant une utilisation optimale des ressources finanieres afin de maintenir la viabilitédu systeme d'assurance santé. </p>
                  <p>Un autre objectif de la ciasse nationale d'assuranvce santé est de garantir la qualité de soins en mettant en place des mecanismes de controleet d'evaluation de la qualité des prestations médicales fournis aux assurées.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      <!-- end Row -->
    </div>
      <!-- end Row -->
    </div>
  </div>
    </div>
    </div>
  



@endsection

