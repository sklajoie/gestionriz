@extends('layouts.master')
@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>FOURNISSUER</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('Accueil')}}">ACCUEIL</a></li>
              <li class="breadcrumb-item active">FOURNISSUER</li>
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
                <h3 class="card-title " >LISTE DES FOURNISSUERS
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">AJOUTER <i class="fas fa-plus"></i></button>

                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>N*</th>
                    <th>NOM</th>
                    <th>CONTACT</th>
                    <th>VILLE</th>
                    <th>ADDRESSE</th>
                    <th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($fourniss as $key=>$fournis )
                        
                    <tr>
                        <td>{{++$key}}</td>
                        <td> {{$fournis->Nom}} </td>
                        <td>{{$fournis->Contact}}</td>
                        <td> {{$fournis->Ville}}</td>
                        <td>{{$fournis->Address}} </td>
                        <td>
                          <div  style="display:flex; flex-direction:row; ">
                            <button type="button" class="btn btn-success btn-xs m-1" data-toggle="modal" data-target=".modifiassurance{{$fournis->id}}"> <i class="fas fa-edit"></i>Modifier</button>
                            <a href="javascript:;" class="btn btn-xs btn-danger sa-delete m-1" data-form-id="category-delete-{{$fournis->id}}">
                              <i class="fa fa-trash"></i> Supprimer
                          </a> 
      
                          <form id="category-delete-{{$fournis->id}}" action="{{route('Fournisseur.destroy', $fournis->id)}}" method="POST"> 
                          @csrf 
                          @method('DELETE') 
      
                          </form>
                          </div>
                          </td>
                    </tr>
                    <div class="modal fade modifiassurance{{$fournis->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">MODIFIER LE FOURNISSEUR</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                            <div class="modal-body">
                            <form  class="form-horizontal style-form" enctype="multipart/form-data"  action="{{route('Fournisseur.update',$fournis->id )}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="conducteur">Nom</label>
                                            <input type="text" class="form-control" value="{{$fournis->Nom}}"  placeholder="" name="nom" required>
                                        </div>
    
                                        <div class="form-group">
                                            <label for="date_vit">Contact</label>
                                            <input type="text" class="form-control" value="{{$fournis->Contact}}"  placeholder="" name="contact" required>
                                          </div>
                                          </div>
                                          <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date_fin_vit">Ville</label>
                                            <input type="text" class="form-control" value="{{$fournis->Ville}}"  placeholder="" name="Ville" >
                                          </div>
                                        <div class="form-group">
                                            <label for="date_fin_vit">Address</label>
                                            <input type="text" class="form-control" value="{{$fournis->Address}}"  placeholder="" name="address" >
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
              <h5 class="modal-title" id="exampleModalLabel">AJOUTER UN FOURNISSEUR</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <div class="modal-body">
        	<form role="form" method="POST" enctype="multipart/form-data"  action="{{route('Fournisseur.store')}}" enctype="multipart/form-data">
	
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
                                    <label for="conducteur">Nom</label>
                                    <input type="text" class="form-control"   placeholder="" name="nom" required>
                                </div>

                                <div class="form-group">
                                    <label for="date_vit">Contact</label>
                                    <input type="text" class="form-control"  placeholder="" name="contact" required>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_fin_vit">Ville</label>
                                    <input type="text" class="form-control" placeholder="" name="ville" >
                                  </div>
                                <div class="form-group">
                                    <label for="date_fin_vit">Address</label>
                                    <input type="text" class="form-control" placeholder="" name="address" >
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