@extends('layouts.master')
@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>COMMANDES</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('Accueil')}}">ACCUEIL</a></li>
              <li class="breadcrumb-item active">COMMANDES</li>
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
                <h3 class="card-title " >DETAILS COMMANDES
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">MODIFIER <i class="fas fa-plus"></i></button>

                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>N*</th>
                    <th>DATE</th>
                    <th>REFERENCE</th>
                    <th>PRODUIT</th>
                    <th>QTE</th>
                    <th>PRIX ACHAT</th>
                    <th>MONTANT</th>
                    {{-- <th>ETAT</th> --}}
                  </tr>
                  </thead>
                  <tbody>
                    
                    @foreach ($commandes as $key=>$commande )
                        
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{date('d-m-Y à H:i', strtotime($commande->commande->Date))}} </td>
                        <td> {{$commande->Reference}} </td>
                        <td> {{$commande->produit->Designation}} </td>
                        <td> {{$commande->Qte}} </td>
                        <td>{{$commande->prixachat}}</td>
                        <td>{{$commande->prixachat * $commande->Qte}}</td>
                        {{-- <td> {{$commande->Etat}}</td> --}}
                       
                    </tr>
                    
                    @endforeach
                    <tr>
                    <td > <span style="color: red">TOTAL</span> </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><span style="color: red; font-size:bold;"> {{$command->Montant}} </span></td>
                  </tr>
                  </tbody>
                  {{-- <tfoot>
                  </tfoot> --}}
                  
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
              <h5 class="modal-title" id="exampleModalLabel">MODIFIER LA COMMANDE</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <div class="modal-body">
        	<form  class="form-horizontal style-form" enctype="multipart/form-data"  action="{{route('Commandes.update',$command->id )}}" method="POST">
            @csrf
            @method('PUT')
                    <section class="content">
                 
                     <div class="row">
                        <div class="col-md-12">
                         <!-- general form elements -->
                         <div class="box box-primary">
                           <div class="box-header" align="center">
                             <h3 class="box-title" ></h3>
                            
                           </div><!-- /.box-header -->
                           <!-- form start -->
            
                             <div class="row col-md-12">
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="conducteur">Fournisseur</label>
                                   <select name="fourniss" class="form-control" id="">
                                    <option value="">Fournisseur</option>
                                    @foreach ($fournisseurs  as $fournisse )
                                    <option {{$command->fournisseur_id === $fournisse->id ? 'selected': "" }} value="{{$fournisse->id}}">{{$fournisse->Nom}} {{$fournisse->Contact}}</option>
                                      
                                    @endforeach
                                   </select>
                                </div>

                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="date_vit">Date</label>
                                      <input type="date" class="form-control"  value="{{$command->Date}}" placeholder="" name="date" required>
                                    </div>
                                
                               
                        </div>
                            
                    </div>
                    <div class="col-md-12">
                      <table id="commandetbl" class=" table-responsive">
    
                        <tr>
                        <th >Produit</th>
                        <th >Qte Commande</th>
                        <th >Qte Aprovisionnement</th>
                        <th >Prix Achat</th>
                        </tr>
                        @foreach ($commandes as $key=>$commande )
                        <tr > 
                          <td  id="col0">
                            <select id="produit" name="produit[]" class="form-control" id="">
                              <option value="">Produit</option>
                              @foreach ($produits  as $produit )
                              <option {{$commande->produit_id === $produit->id ? 'selected': ""}} value="{{$produit->id}}">{{$produit->Designation}}</option>
                                
                              @endforeach
                             </select>
                            
                           </td>
                          <td  id="col1"> <input type="number" value="{{$commande->Qte}}" onclick="calculTotalcmd()" onkeyup="calculTotalcmd()" id="qtecmd" class="form-control" name="qtecmd[]" > </td>
                          <td  id="col2"> <input type="number"  id="qteapro" onkeyup="calculTotalcmd()" onclick="calculTotalcmd()" value="{{$commande->QteApro}}" class="form-control" name="qteapro[]" > </td>
                          <td  id="col3"> <input type="number" onkeyup="calculTotalcmd()" onclick="calculTotalcmd()" value="{{$commande->prixachat}}" id="prixachat" class="form-control" name="prixachat[]" > </td>
                                
                        </tr>  
                        @endforeach
                      </table> 
                      <br>
                              <table class="table table-bordered"> 
                                <tr> 
                                  <td><input type="button" class="btn btn-success" value="+ LIGNE" onclick="addRows()" /></td> 
                                  <td><label for="">Montant Total Commande</label> <input type="number" value="{{$command->Montant}}" readonly id="montantcmd" class="form-control" name="montantcmd" ></td> 
                                  <td><label for="">Montant Total Commande</label> <input type="number" value="{{$montantapro}}" readonly id="montantapro" class="form-control" name="montantapro" ></td> 
                                  <td ><input type="button" class="btn btn-warning float-right" value="- LIGNE" onclick="deleteRows()" /></td> 
                                </tr>  
                              </table> 
                    </div>
                    <div class="form-group" style="text-align: center;">
                   <button type="submit"  class="btn btn-primary"  >Enregistrer</button>
                 </div>
                     </div>
                
                     
                </div>
                
                
               
           
                   </section><!-- /.content -->
                   </form>
      </div>
    </div>
  </div>
  </div>
@endsection