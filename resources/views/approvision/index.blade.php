@extends('layouts.master')
@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>APPROVISIONNEMENT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('Accueil')}}">ACCUEIL</a></li>
              <li class="breadcrumb-item active">APPROVISIONNEMENT</li>
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
                <h3 class="card-title " >LISTE DES APPROVISIONNEMENTS
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
                    <th>NOMBRE SACS</th>
                    <th>QTE TOTALE</th>
                    <th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($approvisions as $key=>$approvision )
                        
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{date('d-m-Y à H:i', strtotime($approvision->created_at))}} </td>
                        <td> {{$approvision->Reference}} </td>
                        <td>{{$approvision->NbrTotalSac}}</td>
                        <td> {{$approvision->qteTotalkg}}</td>
                        <td>
                          <div  style="display:flex; flex-direction:row; ">
                            {{-- <button type="button" class="btn btn-success btn-xs m-1" data-toggle="modal" data-target=".modifiassurance{{$approvision->id}}"> <i class="fas fa-edit"></i>Modifier</button> --}}
                            <a href="{{route('Approvisions.show',$approvision->id)}}" class="btn btn-xs btn-success m-1" >
                              <i class="fa fa-edit"></i> Détail 
                          </a> 
                            <a href="{{route('Facture-approvision',$approvision->id)}}" target="_blank" class="btn btn-xs btn-info m-1" >
                              <i class="fa fa-eye"></i> Facture 
                          </a> 
                            {{-- <a href="javascript:;" class="btn btn-xs btn-danger sa-delete m-1" data-form-id="category-delete-{{$approvision->id}}">
                              <i class="fa fa-trash"></i> Supprimer
                          </a>  --}}
      
                          <form id="category-delete-{{$approvision->id}}" action="{{route('Approvisions.destroy', $approvision->id)}}" method="POST"> 
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
              <h5 class="modal-title" id="exampleModalLabel">AJOUTER UN APPROVISIONNEMENT</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <div class="modal-body">
        	<form role="form" method="POST" enctype="multipart/form-data"  action="{{route('Approvisions.store')}}" enctype="multipart/form-data">
	
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
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label for="conducteur">Reference Commande</label>
                                    <input type="text" class="form-control"  placeholder="" onkeyup="refcmmdappro()" onclick="refcmmdappro()" id="refcmmd" name="refcmmd" required>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="commande">Qte Commande</label>
                                  <input type="number" class="form-control"  placeholder="" id="qtecmmd" name="qtecmmd" required>
                              </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="date_vit">Date</label>
                                      <input type="date" class="form-control"  placeholder="" name="date" required>
                                    </div>
                                
                               
                        </div>
                            
                    </div>
                    <div class="col-md-12">
                      <table id="commandetbl" class="parentContainer table-responsive">
    
                        <tr>
                        <th >Produit</th>
                        <th >Type sac/Kg</th>
                        <th >Nombre de sac</th>
                        <th >Qte en Kg</th>
                        </tr>
                      
                        <tr > 
                          
                          <td id="col0">
                           
                             <select id="cproduit" name="produit[]" class="form-control">
                              <option value="">Choix du Produit</option>
                              @foreach ($produits as $produit )
                              <option value="{{$produit->id}}">{{$produit->Designation}}</option>
                              @endforeach
                             </select>
                           </td>
                          <td  id="col1"> <input type="number"  readonly id="typesac" class="typesac form-control" name="typesac[]" > </td>
                          <td  id="col2"> <input type="number" onkeyup="calculTotalappro()" onclick="calculTotalappro()" id="nbrsac" class="form-control" name="nbrsac[]" > </td>
                          <td  id="col3"> <input type="number" id="qtekg" readonly class="form-control" name="qtekg[]" > </td>
                                
                        </tr>  
                      </table> 
                      <br>
                              <table class="table table-bordered"> 
                                <tr> 
                                  <td><input type="button" class="btn btn-success" value="+ LIGNE" onclick="addRows()" /></td> 
                                  <td><label for="">Nombre Total Sac</label> <input type="number" readonly id="nombrettsac" class="form-control" name="nombrettsac" ></td> 
                                  <td><label for="">Qte Total en Kg</label> <input type="number" readonly id="qtettkg" class="form-control" name="qtettkg" ></td> 
                                  <td >
                                    <input type="button" class="btn btn-warning float-right" value="- LIGNE" onclick="deleteRows(),calculTotalappro()" />
                                  </td> 
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