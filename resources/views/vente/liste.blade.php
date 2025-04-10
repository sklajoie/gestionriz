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

            <div class="card">
              <div class="card-header" style="text-align:center; !important">
                <h3 class="card-title " >LISTE VENTES
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">AJOUTER <i class="fas fa-plus"></i></button> --}}

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
                    <th>AVANCE</th>
                    <th>SOLDE</th>
                    <th>CLIENT</th>
                    <th>ETAT</th>
                    <th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                    @foreach ($ventes as $key=>$vente )
                        
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{date('d-m-Y à H:i', strtotime($vente->created_at))}} </td>
                        <td> {{$vente->Reference}} </td>
                        <td> {{$vente->Montant}} </td>
                        <td> {{$vente->Avance}} </td>
                        <td>{{$vente->Solde}}</td>
                        <td>{{$vente->Client}} {{$vente->Contact}}</td>
                        <td>{{$vente->Etat}}</td>
                        <td> 
                          <div  style="display:flex; flex-direction:row; ">
                           <a href="{{route('Fiche-Ventes.show',$vente->id)}}" class="btn btn-xs btn-success m-1">
                              <i class="fa fa-edit"></i> Modifier
                          </a> 
                           <a href="{{route('Facture-Vente',$vente->id)}}" target="_blank" class="btn btn-xs btn-info m-1">
                              <i class="fa fa-eye"></i> Facture
                          </a> 
                        </div>
                        </td>
                       
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
  
 
@endsection