@extends('layouts_admin/layouts')
@section('content')
<br><br><br><br><br>
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
   @foreach($directions as $direction)
        <div class="col-md-8">
            <div class="card">
                <div class="invoice p-5">
                    <h2>Les differentes directions</h2>
                                       <span class="font-weight-bold d-block mt-4"></span><h3>{{ $direction->titre }} </h3>
                    <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                @if ($direction)
                            <tr><td>
                                    <div class="py-2"> <span class="d-block text-muted">Date de la creation:</span> <span>{{ $direction->created_at }}</span> </div>
                                </td>
                                <td>
                                    <div class="py-2"> <span class="d-block text-muted">Décret de la creation: <br></span> <span>{{ $direction->description }}</span> </div>
                                </td>
                            </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="product border-bottom table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                            {{-- <tr>
                                <td width="20%"> <img src="https://i.imgur.com/u11K1qd.jpg" width="90"> </td>
                                <td width="60%"> <span class="font-weight-bold">Men's Sports cap</span>
                                    <div class="product-qty"> <span class="d-block">Quantity:1</span> <span>Color:Dark</span> </div>
                                </td>
                                <td width="20%">
                                    <div class="text-right"> <span class="font-weight-bold">$67.50</span> </div>
                                </td>
                            </tr> --}}
                            <tr>
                                <td width="50%"> <img src="{{url('images/directions/'.$direction->image)}}" width="300"></td>
                                <td width="3000%"> <span class="font-weight-bold"></span>
                                    <div class="product-product-qty"><span class="d-block">Noms:{{ $direction->description}}</span></div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row d-flex justify-content-end">
                        <div class="col-md-5">
                            <table class="table table-borderless">
                                <tbody class="totals">
                                <tr>
                                    {{-- <td>
                                        <div class="text-left"> <span class="text-muted">Subtotal</span> </div>
                                    </td>
                                    <td>
                                        <div class="text-right"> <span>$168.50</span> </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="text-left"> <span class="text-muted">Shipping Fee</span> </div>
                                    </td>
                                    <td>
                                        <div class="text-right"> <span>$22</span> </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="text-left"> <span class="text-muted">Tax Fee</span> </div>
                                    </td>
                                    <td>
                                        <div class="text-right"> <span>$7.65</span> </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="text-left"> <span class="text-muted">Discount</span> </div>
                                    </td>
                                    <td>
                                        <div class="text-right"> <span class="text-success">$168.50</span> </div>
                                    </td>
                                </tr>
                                <tr class="border-top border-bottom">
                                    <td> --}}
                                       {{--  <div class="text-left"> <span class="font-weight-bold">Total</span> {{ $commande->prix*$commande->quantite }}</div>
                                    </td> --}}
                                    <td>
                                        <div class="text-right"> <span class="font-weight-bold"></span> </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p>{{ $direction->detail}}</p>{{-- 
                    <p class="font-weight-bold mb-0">{{ $direction->details}}</p> --}}
                </div>
                </div>
        </div>
        @endforeach
    </div>
</div> 
@endsection


