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
                <div style="margin-left: 5px">
             
                  <form action="{{route('Recherche-Registre-Approvision')}}" method="GET">
                     {!! csrf_field() !!} 
                    <div class=" row col-sm-10 d-flex">
                      
                      <div class=" col-sm-4  flex-grow-1 mr-2 form-group">
                      <label for="">DU</label>
                        <input type="date" required  class="form-control" id="exampleFirstName" value="{{request()->date1}}" name="date1" >
                      </div>
                      <div class="col-sm-4  flex-grow-1 mr-2 form-group">
                      <label for="">AU</label>
                      <input type="date" required class="form-control"  id="exampleInputPassword" name="date2" value="{{request()->date2}}">
                      </div>
                      <div class="col-sm-2">
                      <div class="form-group" style="margin-top:30px" >
                      <input class="btn btn-primary" type="submit" name="submit" value="RECHERCHE" />
                      </div>
                      </div>
                    </div>
                  </form>
                    </div>
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
                    <th>TYPE SAC</th>
                    <th>NOMBRE DE SAC</th>
                    <th>QTE/KG</th>
                    {{-- <th>ETAT</th> --}}
                  </tr>
                  </thead>
                  <tbody>
                    @php $qtett =0; $nmbresac=0; @endphp
                    @foreach ($registreAppro as $key=>$detailApprovis )
                        
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{date('d-m-Y à H:i', strtotime($detailApprovis->created_at))}} </td>
                        <td> {{$detailApprovis->Reference}} </td>
                        <td> {{$detailApprovis->produit->Designation}} </td>
                        <td> {{$detailApprovis->produit->qtesac}} </td>
                        <td> {{$detailApprovis->NombreSac}} </td>
                        <td>{{$detailApprovis->produit->qtesac * $detailApprovis->NombreSac}}</td>
                        {{-- <td> {{$commande->Etat}}</td> --}}
                       
                    </tr>
                    @php $nmbresac += $detailApprovis->NombreSac; $qtett +=$detailApprovis->produit->qtesac * $detailApprovis->NombreSac; @endphp
                    @endforeach
                    <tr>
                    <td > <span style="color: red">TOTAL</span> </td>
                    <td></td>
                    <td><span style="color: red; font-size:bold;"></span></td>
                    <td></td>
                    <td><span style="color: red; font-size:bold;"></span></td>
                    <td><span style="color: red; font-size:bold;">{{$nmbresac}} </span></td>
                    <td><span style="color: red; font-size:bold;"> {{$qtett}} Kg </span></td>
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