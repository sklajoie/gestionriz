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
                <h3 class="card-title " >LISTE DES COMMANDES
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">AJOUTER <i class="fas fa-plus"></i></button>

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
                    <th>MONTANT</th>
                    <th>ETAT</th>
                    <th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($commandes as $key=>$commande )
                        
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{date('d-m-Y à H:i', strtotime($commande->Date))}} </td>
                        <td> {{$commande->Reference}} </td>
                        <td>{{$commande->Montant}}</td>
                        <td> {{$commande->Etat}}</td>
                        <td>
                          <div  style="display:flex; flex-direction:row; ">
                            {{-- <button type="button" class="btn btn-success btn-xs m-1" data-toggle="modal" data-target=".modifiassurance{{$commande->id}}"> <i class="fas fa-edit"></i>Modifier</button> --}}
                            <a href="{{route('Commandes.show',$commande->id)}}" class="btn btn-xs btn-success m-1" >
                              <i class="fa fa-edit"></i> Détail 
                          </a> 
                            <a href="{{route('Facture-Commande',$commande->id)}}" target="_blank" class="btn btn-xs btn-info m-1" >
                              <i class="fa fa-eye"></i> Facture 
                          </a> 
                            {{-- <a href="javascript:;" class="btn btn-xs btn-danger sa-delete m-1" data-form-id="category-delete-{{$commande->id}}">
                              <i class="fa fa-trash"></i> Supprimer
                          </a>  --}}
      
                          <form id="category-delete-{{$commande->id}}" action="{{route('Commandes.destroy', $commande->id)}}" method="POST"> 
                          @csrf 
                          @method('DELETE') 
      
                          </form>
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
              <h5 class="modal-title" id="exampleModalLabel">AJOUTER UNE COMMANDE</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <div class="modal-body">
        	<form role="form" method="POST" enctype="multipart/form-data"  action="{{route('Commandes.store')}}" enctype="multipart/form-data">
	
                {!! csrf_field() !!}
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
                                    <option value="{{$fournisse->id}}">{{$fournisse->Nom}} {{$fournisse->Contact}}</option>
                                      
                                    @endforeach
                                   </select>
                                </div>

                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="date_vit">Date</label>
                                      <input type="date" class="form-control"  placeholder="" name="date" required>
                                    </div>
                                
                               
                        </div>
                            
                    </div>
                    <div class="col-md-12">
                      <table id="commandetbl" class=" table-responsive">
    
                        <tr>
                        <th >Produit</th>
                        <th >Qte Commande</th>
                        <th ></th>
                        <th >Prix Achat</th>
                        </tr>
                        <tr > 
                          <td  id="col0">
                             <select id="cproduit" name="produit[]" class="cproduit form-control">
                              <option value="">Choix du Produit</option>
                              @foreach ($produits as $produit )
                              <option value="{{$produit->id}}">{{$produit->Designation}}</option>
                              @endforeach
                             </select>
                            
                           </td>
                          <td  id="col1"> <input type="number" onkeyup="calculTotalcmd()" onclick="calculTotalcmd()"id="qtecmd" class="form-control" name="qtecmd[]" > </td>
                          <td  id="col2"> <input type="hidden"  id="qteapro" onkeyup="calculTotalcmd()" onclick="calculTotalcmd()" value="0" class="form-control" name="qteapro[]" > </td>
                          <td  id="col3"> <input type="number" onkeyup="calculTotalcmd()" onclick="calculTotalcmd()" id="prixachat" class="form-control" name="prixachat[]" > </td>
                                
                        </tr>  
                      </table> 
                      <br>
                              <table class="table table-bordered"> 
                                <tr> 
                                  <td><input type="button" class="btn btn-success" value="+ LIGNE" onclick="addRows()" /></td> 
                                  <td><label for="">Montant Commande</label> <input type="number" readonly id="montantcmd" class="form-control" name="montantcmd" ></td> 
                                  <td><label for="">Total Quantité</label> <input type="number" readonly id="ttqtecmmd" class="form-control" name="ttqtecmmd" ></td> 
                                  <td ><input type="button" class="btn btn-warning float-right" value="- LIGNE" onclick="deleteRows(),calculTotalcmd()" /></td> 
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