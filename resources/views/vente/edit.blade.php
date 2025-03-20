@extends('layouts.master')
@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Modification de la vente</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('Accueil')}}">ACCUEIL</a></li>
              <li class="breadcrumb-item active">VENTES</li>
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

            {{-- <div class="col-md-8" style="overflow-y:auto;height:auto;">
              <div class="row">
                 
                  <div class="col-md-12">
                      <h5>Modification de la vente</h5>
                      <hr>
                      <div class="col-md-12 row" id="produit"></div>
                  </div>
      
              </div>
          </div> --}}

          <!-- /.card -->
        </div>
        <!-- debut commande -->

        <div class="col-md-12">
            <form  class="form-horizontal style-form" enctype="multipart/form-data"  action="{{route('Fiche-Ventes.update',$ventes->id )}}" method="POST">
                @csrf
                @method('PUT')
            <div class="row">
        
                    <div class="col-md-12">
                            <input type="hidden" id="idvente" style="background:#ffca08;color:#fff;" value="{{$ventes->id}}" readonly class="form-control">
                           
                    </div>
                    <div class="col-md-12">
                        <select id="informations" style="display:none;" class="form-control">
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="checkin">Client</label>
                            <input type="text" id="client" name="client" value="{{$ventes->Client}}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="checkin">Contact</label>
                            <input type="text" id="contact" name="contant" value="{{$ventes->Contact}}"  class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="checkin">Date</label>
                            <input type="text" id="date_operation" value="{{$ventes->created_at}}" readonly
                                class="form-control">
                    </div>
        
                    <div class="col-md-12">
                        <button class="btn btn-success"  style="background:#252b38;color:#fff;float:right;" onclick="addMoreRows(this.form);">Ajouter
                            Produit  <i class="fa fa-plus"></i></button>
                    </div>
        
                    <div class="col-md-12">
                        <div class="" id="addedRows" style="display:none;">
                           
                        </div><br>
                    </div>
                    <div class="col-md-3">
                        <label for="checkin">Montant Brut</label>
                            <input type="text" value="{{$ventes->Tht}}" id="vue_totalht" readonly class="form-control">
                            <input type="hidden" name="totalht" value="{{$ventes->Tht}}"  id="totalht">
                    </div>
                    <div class="col-md-3">
                        <label for="checkin">Remise</label>
                            <input type="text" name="remise" value="{{$ventes->Remise}}" id="remise" onkeyup="mremises()" onclick="mremises()" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label for="checkin">TVA</label>
                            <select type="text" name="tva" id="tva" class="form-control taxetva">
                            <option value="{{$ventes->Tva}}">{{$ventes->Tva}}%</option>
                            <option value="0.18">18%</option>
                            <option value="0.0">0%</option>
                            </select>
                    </div>
                    <div class="col-md-4">
                        <label for="checkin">Total TTC</label>
                            <input type="text" value="{{$ventes->Montant}}" id="vue_totalttc" readonly class="form-control">
                            <input type="hidden" name="totalttc" value="{{$ventes->Montant}}" id="totalttc">
                    </div>
        
                    <div class="col-md-6">
                        <label for="checkin">Montant avance</label>
                            <input type="text" onkeyup="mavances()" onclick="mavances()"  value="{{$ventes->Avance}}" id="vue_avance"  class="form-control">
                            <input type="hidden" name="avance" value="{{$ventes->Avance}}" id="avance">
                    </div>
                    <div class="col-md-6">
                        <label for="checkin">Solde</label>
                            <input type="text" value="{{$ventes->Solde}}" id="vue_solde" readonly class="form-control">
                            <input type="hidden" name="solde" value="{{$ventes->Solde}}" id="solde">
                    </div>
        
                    <div class="col-md-6">
                        <br><button class="btn btn-success btn-block" style="background:#252b38;" id="modifachat" type="submit">Modifier Achat</button>
                    </div>
                    <div class="col-md-6">
                        <br><button class="btn btn-success btn-block" style="background:#252b38;"
                            onClick="javascript:window.location.reload()">Annuler</button>
                    </div>
        
            </div>
            </form>
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