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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">AJOUTER <i class="fas fa-plus"></i></button>

                </h3>
              </div>
              <div style="margin-left: 5px">
             
                <form action="{{route('Recherche-Registre')}}" method="GET">
                   {!! csrf_field() !!} 
                  <div class=" row col-sm-12 d-flex">
                    
                    <div class=" col-sm-4  flex-grow-1 mr-2 form-group">
                    <label for="">DU</label>
                      <input type="date" required  class="form-control" id="exampleFirstName" value="{{request()->date1}}" name="date1" >
                    </div>
                    <div class="col-sm-4  flex-grow-1 mr-2 form-group">
                    <label for="">AU</label>
                    <input type="date" required class="form-control"  id="exampleInputPassword" name="date2" value="{{request()->date2}}">
                    </div>
                    <div class="col-sm-3">
                    <div class="form-group" style="margin-top:25px" >
                    <input class="btn btn-primary" type="submit" name="submit" value="RECHERCHE" />
                    </div>
                    </div>
                  </div>
                  </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>N*</th>
                    <th>DESIGNATION</th>
                    <th>QUANTITE</th>
                    <th>PRIX UNITAIRE</th>
                    <th>MONTANT</th>
                    <th>DATE</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php $mtt =0; @endphp
                    @foreach ($detailsv as $key=>$details)
                        @php $mtt += $details->MontantVente @endphp
                    <tr>
                        <td>{{++$key}}</td>
                        <td> {{$details->produit->Designation}} </td>
                        <td> {{$details->QteVente}} </td>
                        <td> {{$details->PrixVente}} </td>
                        <td> {{$details->MontantVente}}</td>
                        <td> {{date('d-m-Y à H:i', strtotime($details->created_at))}}</td>
                       
                    </tr>
                    
                    @endforeach
                    <tr>
                      <td >MONTANT TOTAL</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>{{$mtt}}</td>
                      <td></td>
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
  
 
@endsection