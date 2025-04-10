@extends('layouts.master')
@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>APPROVISION</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('Accueil')}}">ACCUEIL</a></li>
              <li class="breadcrumb-item active">APPROVISION</li>
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
                <h3 class="card-title " >DETAILS APPROVISIONNEMENT
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
                    <th>NOMBRE DE SAC</th>
                    <th>TOTAL KG</th>
                    {{-- <th>ETAT</th> --}}
                  </tr>
                  </thead>
                  <tbody>
                    
                    @foreach ($detailApprovision as $key=>$detailApprovis )
                        
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{date('d-m-Y à H:i', strtotime($detailApprovis->created_at))}} </td>
                        <td> {{$detailApprovis->Reference}} </td>
                        <td> {{$detailApprovis->produit->Designation}} </td>
                        <td> {{$detailApprovis->NombreSac}} </td>
                        <td>{{$detailApprovis->produit->qtesac * $detailApprovis->NombreSac}}</td>
                        {{-- <td> {{$commande->Etat}}</td> --}}
                       
                    </tr>
                    
                    @endforeach
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
              <h5 class="modal-title" id="exampleModalLabel">MODIFIER</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <div class="modal-body">
        	<form  class="form-horizontal style-form" enctype="multipart/form-data"  action="{{route('Approvisions.update',$approvision->id )}}" method="POST">
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
                       <div class="col-md-4">
                         <div class="form-group">
                             <label for="conducteur">Reference Commande</label>
                             <input type="text" class="form-control" value="{{$commd->Reference}}"  placeholder="" onkeyup="refcmmdappro()" onclick="refcmmdappro()" id="refcmmd" name="refcmmd" required>
                         </div>
                       </div>
                       <div class="col-md-4">
                         <div class="form-group">
                           <label for="commande">Qte Commande</label>
                           <input type="number" class="form-control" readonly value="{{$commd->Qte}}"   placeholder="" id="qtecmmd" name="qtecmmd" required>
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
               
                 @foreach ($detailApprovision as $detailAppro )
                   

                 <tr > 
                   <td id="col0">
                    
                      <select id="cproduit" name="produit[]" class="form-control">
                       <option value="">Choix du Produit</option>
                       @foreach ($produits as $produit )
                       <option {{$detailAppro->produit_id === $produit->id ? "selected" : ""}} value="{{$produit->id}}">{{$produit->Designation}}</option>
                       @endforeach
                      </select>
                    </td>
                   <td  id="col1"> <input type="number" value="{{$detailAppro->produit->qtesac}}"  readonly id="typesac" class="typesac form-control" name="typesac[]" > </td>
                   <td  id="col2"> <input type="number" value="{{$detailAppro->NombreSac}}" onkeyup="calculTotalappro()" onclick="calculTotalappro()" id="nbrsac" class="form-control" name="nbrsac[]" > </td>
                   <td  id="col3"> <input type="number" id="qtekg" readonly class="form-control" name="qtekg[]" > </td>
                         
                 </tr>  
                 @endforeach
               </table> 
               <br>
                       <table class="table table-bordered"> 
                         <tr> 
                           <td><input type="button" class="btn btn-success" value="+ LIGNE" onclick="addRows()" /></td> 
                           <td><label for="">Nombre Total Sac</label> <input type="number" readonly id="nombrettsac" class="form-control" name="nombrettsac" ></td> 
                           <td><label for="">Qte Total en Kg</label> <input type="number" readonly id="qtettkg" class="form-control" name="qtettkg" ></td> 
                           <td >
                             {{-- <input type="button" class="btn btn-warning float-right" value="- LIGNE" onclick="deleteRows()" /> --}}
                           </td> 
                         </tr>  
                       </table> 
             </div>
             <div class="form-group" style="text-align: center;">
            <button type="submit"  class="btn btn-primary"  >Modifier</button>
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