@extends('layouts/layout')
@section('content')
<div class="header-bg page-area">
    <div class="home-overly"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="slider-content text-center">
            <div class="header-bottom">
              <div class="layer2 wow zoomIn" data-wow-duration="1s" data-wow-delay=".4s">
                <h1 class="title2">Contactez nous</h1>
              </div>
              <div class="layer3 wow zoomInUp" data-wow-duration="2s" data-wow-delay="1s">
                <h2 class="title3">" Votre prise en charge sanitaire est notre priorité absolue. Contactez nous dès maintenant pour bénéficier de notre expertise et de notre soutien inconditionnel."</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<div id="contact" class="contact-area">
    <div class="contact-inner area-padding">
      <div class="contact-overly"></div>
      <div class="container ">
 <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Contactez-nous</h2>
            </div>
          </div>
        </div>
 <div class="row">
    @foreach ($adresses as $adresse)
      
    
        <!-- Start contact icon column -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="contact-icon text-center">
              <div class="single-icon">
                <i class="fa fa-mobile"></i>
                <p>{{$adresse->tel}}<br>
                  <span>{{$adresse->heure}}</span>
                </p>
              </div>
            </div>
          </div>
          <!-- Start contact icon column -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="contact-icon text-center">
              <div class="single-icon">
                <i class="fa fa-envelope-o"></i>
                <p>{{$adresse->email}}<br>
                  <span>{{$adresse->site}}</span>
                </p>
              </div>
            </div>
          </div>
          <!-- Start contact icon column -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="contact-icon text-center">
              <div class="single-icon">
                <i class="fa fa-map-marker"></i>
                <p>{{$adresse->adresse}}<br>
                  <span>{{$adresse->lieu}}</span>
                </p>
              </div>
            </div>
          </div>
        @endforeach
    

          <!-- Start Google Map -->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <!-- Start Map -->

            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3900.969569628064!2d15.030699673964724!3d12.114234633097306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x111963467bbd99bd%3A0x78e4db5567d30d81!2sOffice%20National%20des%20M%C3%A9dias%20Audiovisuels%20Tchad%20(ONAMA)!5e0!3m2!1sfr!2std!4v1699340680772!5m2!1sfr!2std" width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>
            <!-- End Map -->
          </div>
          <!-- End Google Map -->

          <!-- Start  contact -->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form contact-form">
              
              <form action="{{route('admin.contacts.store')}}" method="post" role="form" enctype="multipart/form-data" >
              @csrf
                <div class="form-group">
                  <input type="text" name="nom" class="form-control" id="nom" placeholder="Votre nom"/>
                  </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="email" id="email" placeholder="Votre email" />
                 </div>
                <div class="form-group">{{-- 
                  <input type="text" class="form-control" name="objet" id="objet" placeholder="Objet"/>  --}}
                   <select name="objet" class="form-control" id="objet">
                            <option value="Santé"></option>
                            <option value="Partenariat">Partenariat</option>
                            <option value="Stage">Stage</option>
                            <option value="Services">Services</option>
                            <option value="Santé">Santé</option>
                    </select> 
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" id="message"  placeholder="Message"></textarea>
                  </div>
                <div class="text-center"><button type="submit">Soummetre</button></div>
          
              </form>
              <!--Sin le formulaire a été soumis-->
              <?php
              if (isset($_POST["message"])){
                $message ="Ce message vous a été envoyé via la page contact du site CNAS.td
                Nom : ".$_POST["nom"]."
                Email : ".$_POST["email"]."
                Objet: ".$_POST["objet"]."
                Message : ".$_POST["message"];
                $retour=mail("infocnas.td", $_POST["objet"],
                $message="From:infocnas.td"."\r\n"."Reply-to" . $_POST
                ["email"]);{
                  echo "<p>L'email a été bien envoyé.<\p>";
                }
              }
              ?>
            </div>
          </div>
          <!-- End Left contact -->
        </div>
      </div>
    </div>
    </div>
  </div>
  @endsection