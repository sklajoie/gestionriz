@extends('layouts.master')
@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>CAISSE</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('Accueil')}}">ACCUEIL</a></li>
              <li class="breadcrumb-item active">CAISSE</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            @if ($message = Session::get('success'))
                        <div class="alert alert-success  alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>  
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
            @if ($message = Session::get('danger'))
                        <div class="alert alert-danger  alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>  
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card">
              <div class="card-header" style="text-align:center; !important">
                <h3 class="card-title " >GESTION DE CAISSE
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">AJOUTER <i class="fas fa-plus"></i></button> --}}

                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{route('Caisses.update',$caisses->id)}}" enctype="multipart/form-data" method="POST">
                  @csrf
                  @method('PUT')
               
                <div class="row">
    
                    <div class="col-md-2" id="clikmembrebeni">
                        <label for="checkin">Type</label>
                        <div class="">
                         <select class="form-control type_benef" name="type_benef" id="type_benef" >
                          <option value="Membre">Membre</option>
                          <option value="Autre">Autre</option>
                         </select>
                        </div>
                    </div>
                   
                    <div class="col-md-4" id="voirmembrebenif">
                        <label for="checkin">Beneficiaire</label>
                        <div class="Type_benefificiaire" id="Type_benefificiaire">
                         {{-- <input type="text" id="beneficiare" name="beneficiare" required class="form-control"> --}}
                                <select class="form-control" name="beneficiare" id="beneficiare">
                                @if($caisses->TypeBeneficier =="Membre")
                                <option value="{{$caisses->Beneficiaire}}">{{$caisses->membre->name}}  {{$caisses->membre->Contact}}</option>
                                    @else
                                    <option value="{{$caisses->Beneficiaire}}">{{$caisses->Beneficiaire}}</option>
                                    @endif
                                @foreach ( $employers as $membre )
                                <option value="{{$membre->id}}">{{$membre->name}} ({{$membre->Contact}})</option>
                                @endforeach
                                </select>
                         
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="checkin">Type</label>
                        <div class="">
                            <select type="text" id="type_mouvement" name="type_mouvement" required
                                class="form-control type_mouvement">
                                <option value="{{$caisses->TypeMouvement}}">{{$caisses->TypeMouvement }}</option>
                                <option value="SORTIE DE CAISSE">SORTIE DE CAISSE</option>
                                <option value="ENTREE EN CAISSE">ENTREE EN CAISSE</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="checkin">Nature</label>
                        <div class="naturemvmt">
                           <select type="text" id="naturemvmt" name="naturemouvement" required class="form-control naturemvmt">
                            <option value="{{$caisses->ressource->nature->id}}">{{$caisses->ressource->nature->Nature }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="checkin">Rubrique</label>
                        <div class="">
                            <select type="text" id="rubrique_mouvement" name="rubrique_mouvement" required class="form-control">
                              <option value="{{$caisses->ressource_id}}">{{$caisses->ressource->Rubrique }}</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="checkin">Montant du Mouvement</label>
                        <div class="">
                            <input type="number" id="montant" @if(Auth::user()->fonction != 'SUPERADMIN') readonly @endif value="{{$caisses->Montant }}" name="montant" onkeyup="montants($(this))"
                                required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="checkin">Date du Mouvement</label>
                        <div class="">
                            <input type="date" id="date" value="{{$caisses->Date}}" name="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table style="width:100%;">
                            <tr>
                                <td style="background-color:#00688f;color:#fff;width:20%;"><label
                                        class="checkbox-inline on"><input type="radio" id="cash" onclick="cash()" name="paiement"
                                            value="ESPECE">ESPECE</label></td>
                                
                                <td style="background-color:#00688f;color:#fff;width:20%;"><label
                                        class="checkbox-inline on cheque"><input type="radio" onclick="virement()" class="virement" id="virement" name="paiement"
                                            value="VIREMENT" >VIREMENT</label></td>
                                <td style="background-color:#00688f;color:#fff;width:20%;"><label
                                        class="checkbox-inline on cheque"><input type="radio" onclick="cheque()" class="cheque" id="cheque" name="paiement"
                                            value="CHEQUE" >CH&Egrave;QUE</label></td>
                                <td style="background-color:#00688f;color:#fff;width:25%;"><label
                                        class="checkbox-inline on"><input type="radio" onclick="carte()" id="carte" name="paiement"
                                            value="MOBILE MONEY">MOBILE MONEY</label>
                                            <input type="hidden" onclick="carte()" id="carte" name="modepaiement"
                                            value="{{$caisses->modePaiement}}">
                                            </td>
    
                            </tr><br>
                        </table><br>
                    </div>
                        <div class="col-md-6" id="nummobile">
                    <label for="checkin" >Numéro Mobile (MOBILE MONEY)</label>
                        <div class="">
                            <input type="text"  name="nummobile"
                                class="form-control">
                        </div>
                    </div>
                        <div class="col-md-6" id="banque">
                    <label for="checkin" id="banque">Banque</label>
                        <div class="">
                            <input type="text"  name="banque"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6" id="numcheque">
                    <label for="checkin" >Numéro Ch&egrave;que/Virement</label>
                        <div class="">
                            <input type="text"  name="cheque" 
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="checkin">Pièce Justificatif 1
                        </label>
                        <div class="">
                            <input type="file" id="decharge" name="decharge"
                                class="form-control">
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <label for="checkin">Pièce Justificatif 2
                        </label>
                        <div class="">
                            <input type="file" id="decharge2" name="decharge2"
                                class="form-control">
                        </div>
                        
                    </div>
                    
                    <div class="col-md-6">
                        <label for="checkin">Commentaire</label>
                        <div class="">
                            <textarea name="commentaire" class="form-control" id="">{{$caisses->Detail }}</textarea><br>
                        </div>
                    </div>
                    
                    <div class="col-md-3" style="margin-top:25px">
                        <a href="/images/Compta/{{$caisses->Decharche}}" target="_blank" >  <img src="/MAMUTUELLE/images/Compta/{{$caisses->Decharche}}" width="70" height="80" alt=""></a>
                    </div>
                    <div class="col-md-3" style="margin-top:25px">
                        <a href="/images/Compta/{{$caisses->AutreDoc}}" target="_blank" >  <img src="/MAMUTUELLE/images/Compta/{{$caisses->AutreDoc}}" width="70" height="80" alt=""></a>
                    </div>
    
                    <div class="row col-md-12">
                    <div class="col-md-6">
                        <button class="btn btn-success btn-block" style="background:#252b38;"
                            onClick="javascript:window.location.reload()">Annuler</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-success btn-block" style="background:#252b38;" id="valider" type="submit">Valider</button>
                    </div>
                    </div>
    
                </div>
    
            </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
@endsection