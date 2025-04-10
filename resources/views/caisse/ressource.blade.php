@extends('layouts.master')
@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>RESSOURCES</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('Accueil')}}">ACCUEIL</a></li>
              <li class="breadcrumb-item active">RESSOURCES</li>
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
                <h3 class="card-title " >LISTE DES RESSOURCES
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">AJOUTER <i class="fas fa-plus"></i></button>

                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th></th>
                      <th>DATE ENREGISTRE</th>
                      <th>NATURE</th>
                      <th >RUBRIQUE</th>
                      <th >AUTRE</th>
                      <th >ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ( $ressources as $key=>$ressour )
                          
                      
                    <tr class="gradeX">
                      <td >{{ ++$key }}</td>
                      <td >{{ date('d-m-Y à H:i', strtotime($ressour->created_at ))}}</td>
                      <td>{{$ressour->nature->Nature}}</td>
                      <td>{{$ressour->Rubrique}}</td>
                      <td >{{$ressour->Autre}}</td>
                      <td >
                           <div class="d-flex btn btn-default btn-xs" >
                         
                              <button type="button" class="btn btn-xs btn-primary" style="margin: 1px" data-toggle="modal" data-target="#edditModal{{$ressour->id}}">
                              <i class="fa fa-edit"></i> Modifier
                                  </button>
                          {{-- <a href="{{route('projets.show', $ressour->id)}}" style="margin: 1px" class="btn btn-sm btn-info "> <i class="fa fa-list"></i> </a>
                       --}}
                      <a href="javascript:;" class="btn btn-xs btn-danger sa-delete" data-form-id="category-delete-{{$ressour->id}}">
                          <i class="fa fa-trash"></i> Supprimer
                      </a>
  
                      <form id="category-delete-{{$ressour->id}}" action="{{route('Ressources.destroy', $ressour->id)}}" method="POST">
                      @csrf
                      @method('DELETE')
  
                      </form>
                      </div>
  
                      </td>
                      
                    </tr>
  
  
  <div class="modal fade " id="edditModal{{$ressour->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">MODIFIER LA RESSOURCE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <form  class="form-horizontal style-form" action="{{route('Ressources.update',$ressour->id)}}" method="POST">
                @csrf
              @method('PUT')
                  <div class="form-group">
                    <div class="col-sm-6">
                    <label class=" control-label">NATURE</label>
                      <select name="nature" required class="form-control" id="nature">
                      @foreach ($natures  as $natur )
                        <option {{$ressour->nature_id ===$natur->id ? 'selected': ""}}value="{{$natur->id}}">{{$natur->Nature}}</option>
                      @endforeach
                      </select>
                    </div>
                 
                    <div class="col-sm-6">
                    <label class="control-label">NOM</label>
                      <input type="text" value="{{$ressour->Rubrique}}" class="form-control" name="rubrique">
                    </div>
                    </div>
  
                    <div class="form-group">
                    <div class="col-sm-10" style="margin-bottom: 10">
                    <label class=" control-label">OBSERVATION</label>
                      <textarea type="text"  class="form-control" name="observation"> {{$ressour->Autre}} </textarea>
                    </div>
                    
  
                  </div>
  
                   <div class="form-group" style="text-align: center;">
                      <br>
                 <button type="submit" class=" form-control btn btn-warning">ENREGISTRER</button>
                  <div>
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
              <h5 class="modal-title" id="exampleModalLabel">AJOUTER</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <div class="modal-body">
          <form action="{{route('Ressources.store')}}" enctype="multipart/form-data" method="POST">
            @csrf
         
                    <section class="content">
                        
                         
                              <div class="form-group row">
                                <div class="col-sm-6">
                                <label class=" control-label">NATURE</label>
                                  <select name="nature" required class="form-control" id="nature">
                                    <option value="">Choix de la Nature</option>
                                  @foreach ($natures  as $natur )
                                    <option value="{{$natur->id}}">{{$natur->Nature}}</option>
                                  @endforeach
                                  </select>
                                </div>
                                <div class="col-sm-6">

                                    <label class="control-label">RUBRIQUE</label>
                                      <input type="text" required class="form-control" name="rubrique">
                                </div>
                             
                                
                                
                            </div>
                            <div class="col-sm-12">
                            <label class=" control-label">OBSERVATION</label>
                              <textarea type="text" required class="form-control" name="observation"> </textarea>
                            </div>
              
                               <div class="m-10" style="text-align: center;margin-top:10px">
                             <button type="submit" class=" btn btn-primary">ENREGISTRER</button>
                              <div>
                 
                   </section><!-- /.content -->
                   </form>
      </div>
    </div>
  </div>
  </div>
@endsection