@extends('layouts.master')
@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>VENTES</h1>
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

            <div class="col-md-8" style="overflow-y:auto;height:auto;">
              <div class="row">
                 
      
                  <div class="col-md-6">
                      <input type="text" id="recherchedesip" placeholder="rechercher produit" required
                          class="form-control"><br>
                  </div>
                  <div class="col-md-12">
                      <h1>Produits</h1>
                      <hr>
                      <div class="col-md-12 row" id="produit"></div>
                  </div>
      
              </div>
          </div>

          <!-- /.card -->
        </div>
        <!-- debut commande -->
  <div class="col-md-12" style="overflow-y:auto;height:300px;">
    <form role="form" method="POST" enctype="multipart/form-data"  action="{{route('Fiche-Ventes.store')}}" enctype="multipart/form-data">
	
      {!! csrf_field() !!}
    <div class="row">
        <div class="col-md-6">
            <label for="checkin">Client</label>
            <input type="text" id="nomclient" name="nomclient" required class="form-control">
        </div>

        <div class="col-md-6">
            <label for="checkin">Contact</label>
            <input type="text" id="numero" name="numeroclient" class="form-control"><br>
        </div>

        <div class="col-md-12">
            <table border="1" cellpadding="1" cellspacing="1" class="table table-responsive" style="width:100%;">
                <thead>
                    <tr">
                        <th class=" text-center" style="font-size:16px;width:40%;">Désignation</th>
                        <th class="text-center" style="font-size:16px;width:15%;">Prix</th>
                        <th class="text-center" style="font-size:16px;width:10%;">Stock</th>
                        <th class="text-center" style="font-size:16px;width:10%;">Qte</th>
                        <th class="text-center" style="font-size:16px;width:20%;">Total</th>
                        <th class="text-center" style="font-size:16px;width:5%;"></th>
                    </tr>

                </thead>
                <tbody class="contenu">


                </tbody>
            </table>
            <hr>
            <div class="row">

                <div class="col-md-4">
                    <label for="checkin">Total HT</label>
                    <input type="text" id="vue_totalht"  readonly class="form-control">
                    <input type="hidden" id="totalht" name="totalht">
                </div>
                <div class="col-md-4">
                    <label for="checkin">Remise</label>
                    <input type="text" id="remise" name="remise" onkeyup="remises()" onclick="remises()" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="checkin">TVA</label>
                    <select type="text" id="tva" name="tva" class="form-control taxetva">
                        <option value="0.0">0%</option>
                        <option value="0.18">18%</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="checkin">Total TTC</label>
                    <input type="text" id="vue_totalttc" readonly class="form-control">
                    <input type="hidden" id="totalttc" name="totalttc">
                </div>

                <div class="col-md-4">
                    <label for="checkin">Montant versé</label>
                    <input type="text" id="avance" name="avance" onkeyup="avances()" onclick="avances()" required
                        class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="checkin">Solde</label>
                    <input type="text" id="vue_solde" readonly class="form-control">
                    <input type="hidden" id="solde" name="solde">
                </div>

                <div class="col-md-12">
                    <table style="width:100%;">
                        <tr>

                            <td style="background-color:#00688f;color:#fff;width:25%;"><label
                                    class="checkbox-inline on"><input type="radio" name="paiement"
                                        value="ESPECE">ESPECE</label></td>
                            <td style="background-color:#00688f;color:#fff;width:25%;"><label
                                    class="checkbox-inline on"><input type="radio" id="CHEQUE" onclick="addMoreRowschq(this.form);" name="paiement"
                                        value="CHEQUE">CH&Egrave;QUE</label></td>
                            <td style="background-color:#00688f;color:#fff;width:25%;"><label
                                    class="checkbox-inline on"><input type="radio" onclick="addMoreRowsmob(this.form);" name="paiement"
                                        value="CARTE/MOBILE MONEY">CARTE / MOBILE MONEY</label></td>
                            <td style="background-color:#00688f;color:#fff;width:25%;"><label
                                    class="checkbox-inline off"><input type="radio" name="paiement"
                                        value="WAVE">WAVE</label> </td>
                        
                                        
                        </tr>
                        <tr><td style="width:30%;"><label>Numéro(MOBILE MONEY)</label>
                                    <input type="text" id="nummobile" name="nummobile" class="form-control">
                                         </td>
                        <td style="width:30%;"><label>Numéro ch&egrave;que</label>
                                    <input type="text" id="numcheque" name="numcheque" class="form-control">
                                         </td>
                        <td style="width:30%;"><label>Banque</label>
                                    <input type="text" id="banque" name="banque" class="form-control">
                                         </td>
                        {{-- <td style="width:25%;"><label>Date Echeance</label>
                                    <input type="date" id="date_echeance" value="<?PHP echo date("Y-m-d"); ?>" name="date_echeance" class="form-control">
                                         </td> --}}
                                        
                        </tr>
                       
                    </table>
                </div>
                <div class="col-md-12">
                <div class="" id="addedRows" style="display:none;">
                </div>
                </div>
                
                <div class="col-md-4">
                  <hr><button class="btn btn-success btn-block" style="background:#f00f0f; margin:10px"
                  onClick="javascript:window.location.reload()">ANNULER</button>
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                    <hr><button class="btn btn-success btn-block" style="background:#046b1e; margin:10px" id="direct" onclick="direct()">
                        ENREGISTRER</button>
                </div>

            </div>

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