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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">AJOUTER <i class="fas fa-plus"></i></button>

                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>N*</th>
                    <th>Date</th>
                    <th>Beneficiaire</th>
                    <th>Type</th>
                    <th>Nature</th>
                    <th>Rublique</th>
                    <th>Montant</th>
                    <th>Mode Paiement</th>
                    <th>Réferences</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($caisses as $key=>$caisse )
                        
                    <tr>
                      <td>{{++$key}}</td>
                      <td>{{$caisse->Date ? date('d-m-Y', strtotime($caisse->Date)) : ""}}</td>
                      <td>
                        @if($caisse->TypeBeneficier =="Membre")
                        {{$caisse->membre->Name}}  ({{$caisse->membre->Contact}})
                        @else
                        {{$caisse->Beneficiaire}}
                        @endif
                      </td>
                      <td>{{$caisse->TypeMouvement}}</td>
                      
                      <td>{{$caisse->ressource->nature->Nature}}</td>
                    
                      <td>{{$caisse->ressource->Rubrique}}</td>
                      <td>{{$caisse->Montant}}</td>
                      <td>{{$caisse->modePaiement}}</td>
                      <td>{{$caisse->Numero}}</td>
                        <td>
                          <div  style="display:flex; flex-direction:row; ">
                            {{-- <button type="button" class="btn btn-success btn-xs m-1" data-toggle="modal" data-target=".modifiassurance{{$caisse->id}}"> <i class="fas fa-edit"></i>Modifier</button> --}}
                            <a href="{{route('Caisses.show',$caisse->id)}}" class="btn btn-xs btn-primary" >
                              <i class="fa fa-eye"></i> Détail 
                          </a> 
                           
                          </div>
                          </td>
                    </tr>
                   
                    @endforeach
                  </tbody>
                  
                </table>
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
  
  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">AJOUTER</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <div class="modal-body">
          <form action="{{route('Caisses.store')}}" enctype="multipart/form-data" method="POST">
            @csrf
         
                    <section class="content">
                 
                    
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
                                      <option value="">Ajouter Beneficiaire</option>
                                      @foreach ( $employers as $membre )
                                      <option value="{{$membre->id}}">{{$membre->name}} ({{$membre->Contact}})</option>
                                      @endforeach
                                      </select>
                               
                              </div>
                          </div>
                          <div class="col-md-3">
                              <label for="checkin">Type de mouvement</label>
                              <div class="">
                                  <select type="text" id="type_mouvement" name="type_mouvement" required
                                      class="form-control type_mouvement">
                                      <option value="">Type de mouvement</option>
                                      <option value="SORTIE DE CAISSE">SORTIE DE CAISSE</option>
                                      <option value="ENTREE EN CAISSE">ENTREE EN CAISSE</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <label for="checkin">Nature du Mouvement</label>
                              <div class="naturemvmt">
                                 <select type="text" id="naturemvmt" name="nature_mouvement" required class="form-control naturemvmt">
                                  <option value="">Ajouter Nature</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <label for="checkin">Rubrique</label>
                              <div class="">
                                  <select type="text" id="rubrique_mouvement" name="rubrique_mouvement" required class="form-control">
                                    <option value="">Ajouter la Rublique</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <label for="checkin">Montant du Mouvement</label>
                              <div class="">
                                  <input type="number" id="montant" name="montant" onkeyup="montants($(this))"
                                      required class="form-control">
                              </div>
                          </div>
                          <div class="col-md-4">
                              <label for="checkin">Date du Mouvement</label>
                              <div class="">
                                  <input type="date" id="date" name="date" value="<?php date('Y-m-d') ?>"
                                      class="form-control">
                              </div>
                          </div>
                          <div class="col-md-12">
                              <table style="width:100%;">
                                  <tr>
                                      <td style="background-color:#00688f;color:#fff;width:15%;"><label
                                              class="checkbox-inline on"><input type="radio" id="cash" onclick="cash()" name="paiement"
                                                  value="ESPECE">ESPECE</label></td>
                                                  
                                      <td style="background-color:#00688f;color:#fff;width:15%;"><label
                                              class="checkbox-inline on "><input type="radio" onclick="virement()" id="virement" name="paiement"
                                                  value="VIREMENT" >VIREMENT</label></td>
                                      <td style="background-color:#00688f;color:#fff;width:15%;"><label
                                              class="checkbox-inline on cheque"><input type="radio" onclick="cheque()" class="cheque" id="cheque" name="paiement"
                                                  value="CHEQUE" >CH&Egrave;QUE</label></td>
                                      <td style="background-color:#00688f;color:#fff;width:15%;"><label
                                              class="checkbox-inline on"><input type="radio" onclick="carte()" id="carte" name="paiement"
                                                  value="MOBILE MONEY">MOBILE MONEY</label></td>
          
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
                          <label for="checkin" >Numéro Virement/Ch&egrave;que</label>
                              <div class="">
                                  <input type="text"  name="cheque" 
                                      class="form-control">
                              </div>
                          </div>
                          <div class="col-md-3">
                              <label for="checkin">Pièce Justificatif 1
                                <span style="color:red">
                                </span>
                              </label>
                              <div class="">
                                  <input type="file" id="decharge" name="decharge"
                                      class="form-control">
                              </div>
                              
                          </div>
                          <div class="col-md-3">
                              <label for="checkin">Pièce Justificatif 2
                                <span style="color:red">
                                </span>
                              </label>
                              <div class="">
                                  <input type="file" id="decharge2" name="decharge2"
                                      class="form-control">
                              </div>
                              
                          </div>
                          
                          <div class="col-md-6">
                              <label for="checkin">Ajouter plus de détails</label>
                              <div class="">
                                  <textarea name="commentaire" class="form-control" id="commentairetest"></textarea><br>
                              </div>
                          </div>
                          
                          <div class="col-md-8"></div>
          
                          <div class="col-md-6">
                              <button class="btn btn-success btn-block" style="background:#252b38;"
                                  onClick="javascript:window.location.reload()">Annuler</button>
                          </div>
                          <div class="col-md-6">
                              <button class="btn btn-success btn-block" style="background:#252b38;" id="valider" type="submit">Valider</button>
                          </div>
          
                      </div>
          
                   </section><!-- /.content -->
                   </form>
      </div>
    </div>
  </div>
  </div>
@endsection