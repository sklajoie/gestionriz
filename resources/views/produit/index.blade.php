@extends('layouts.master')
@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>PRODUITS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('Accueil')}}">ACCUEIL</a></li>
              <li class="breadcrumb-item active">PRODUITS</li>
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
                <h3 class="card-title " >LISTE DES PRODUITS
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">AJOUTER <i class="fas fa-plus"></i></button>

                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>N*</th>
                    <th>DESIGNATION</th>
                    <th>KG/SAC</th>
                    <th>QTE</th>
                    <th>PRIX</th>
                    <th>DATE</th>
                    <th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($produits as $key=>$produit )
                        
                    <tr>
                        <td>{{++$key}}</td>
                        <td> {{$produit->Designation}} </td>
                        <td>{{$produit->qtesac}}</td>
                        <td>{{$produit->Stock}}</td>
                        <td> {{$produit->Prix}}</td>
                        <td>{{date('d-m-Y à H:i', strtotime($produit->created_at))}} </td>
                        <td>
                          <div  style="display:flex; flex-direction:row; ">
                            <button type="button" class="btn btn-success btn-xs m-1" data-toggle="modal" data-target=".modifiassurance{{$produit->id}}"> <i class="fas fa-edit"></i>Modifier</button>
                            {{-- <a href="javascript:;" class="btn btn-xs btn-danger sa-delete m-1" data-form-id="category-delete-{{$produit->id}}">
                              <i class="fa fa-trash"></i> Supprimer
                          </a>  --}}
      
                          <form id="category-delete-{{$produit->id}}" action="{{route('Produits.destroy', $produit->id)}}" method="POST"> 
                          @csrf 
                          @method('DELETE') 
      
                          </form>
                          </div>
                          </td>
                    </tr>
                    <div class="modal fade modifiassurance{{$produit->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">MODIFIER LE PRODUIT</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                            <div class="modal-body">
                            <form  class="form-horizontal style-form" enctype="multipart/form-data"  action="{{route('Produits.update',$produit->id )}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="conducteur">Désignation</label>
                                            <input type="text" class="form-control" value="{{$produit->Designation}}"  placeholder="" name="designation" required>
                                        </div>
    
                                        <div class="form-group">
                                            <label for="date_vit">Qte en Kg/sac</label>
                                            <input type="number" class="form-control" value="{{$produit->qtesac}}"  placeholder="" name="qtesac" required>
                                          </div>
                                          </div>
                                          <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date_fin_vit">Prix</label>
                                            <input type="number" class="form-control" value="{{$produit->Prix}}"  placeholder="" name="prix" >
                                          </div>
                                          <div class="form-group d-flex flex-row justify-content-around" > 
                                            <label style="margin-top: 20px" for="cmmd">Soumis aux Commandes ?  </label> 
                                            <div class="col-md-4" style="margin-top: 20px">
                                            <input type="checkbox" id="cmmd" {{$produit->soumisCommande ? 'checked' : ""}} value="1" class="form-control" placeholder="" name="cmmd" >
                                          
                                          </div>
                                          </div>
                                       
                                </div>
                               
                            </div>
                            {{-- <input type="hidden" class="form-control"  placeholder="" name="idvehecule" > --}}
                         
                             <div class="form-group" style="text-align: center;">
                            <button type="submit"  class="btn btn-danger"  >Modifier</button>
                          </div>
                                       </form>
                          </div>
                        </div>
                      </div>
                      </div>
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
              <h5 class="modal-title" id="exampleModalLabel">AJOUTER UN PRODUIT</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <div class="modal-body">
        	<form role="form" method="POST" enctype="multipart/form-data"  action="{{route('Produits.store')}}" enctype="multipart/form-data">
	
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
                                    <label for="conducteur">Designation</label>
                                    <input type="text" class="form-control"   placeholder="" name="designation" required>
                                </div>

                                <div class="form-group">
                                    <label for="">Qte en Kg/sac</label>
                                    <input type="number" class="form-control" value="0"  placeholder="" name="qtesac" readonly>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Prix</label>
                                    <input type="text"  class="form-control" placeholder="" name="prix" >
                                  </div>
                                <div class="form-group d-flex flex-row justify-content-around" > 
                                  <label style="margin-top: 20px" for="cmmd">Soumis aux Commandes ?  </label> 
                                  <div class="col-md-4" style="margin-top: 20px">
                                  <input type="checkbox" value="1" id="cmmd" class="form-control" placeholder="" name="cmmd" >
                                
                                </div>
                                </div>
                               
                        </div>
                            
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