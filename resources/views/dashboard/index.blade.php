@extends('layouts.master')
@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">TABLEAU DE BORD</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('Accueil')}}">ACCUEIL</a></li>
            <li class="breadcrumb-item active">Tableau de Bord</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-credit-card"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">COMMANDES</span>
              <span class="info-box-number">
                
                {{$commande}}
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cart-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">VENTES</span>
              <span class="info-box-number"> {{$vente}}</span>
            </div>
           
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        {{-- <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div> --}}
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">FOURNISSEURS</span>
              <span class="info-box-number">{{$fournisseur}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-server"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PRODUITS</span>
              <span class="info-box-number">{{$produit}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="#" style="display:flex; flex-direction:row; margin-left:50px">
        <div class="col-lg-3 col-md-4 col-6 table-responsive p-0">
        <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="#">
          {!! csrf_field() !!} 
          <?php $years = range(2013, strftime("%Y", time())); ?>
           
              <select type="text" name="annee"  id="annee" class="form-control anneegf">
              <option value="" > Année @if(Session::get('annee') !=null){{Session::get('annee')}}@else {{date('Y')}}@endif </option>
          <?php foreach($years as $year) : ?>
            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
          <?php endforeach; ?>
              </select>
            </form>
          </div>
        </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card-body">
          <!-- STACKED BAR CHART -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">GRAPHE DES VENTES PAR MOIS</h3>
             
              {{-- <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div> --}}
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="myChart" style="min-height: 300px; height: 500px; max-height: 400px; max-width: 100%; background-color:white"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
     
      <!-- /.row -->
      <!-- /.row -->
   
      <!-- /.row -->

      <!-- Main row -->
      
      <!-- /.row -->
    </div><!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>


    @endsection