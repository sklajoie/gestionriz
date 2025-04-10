<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{config('app.name')}}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
</head>
<body>
<div class="wrapper" style="margin: 5%">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          {{-- <i class="fas fa-globe"></i> AdminLTE, Inc. --}}
          <small class="float-right">{{date('d-m-Y')}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-5 invoice-col">
      
        <address>
          Fournisseur: <strong>{{$commande->fournisseur->Nom}}</strong><br>
          Contact: <strong>{{$commande->fournisseur->Contact}}</strong><br>
          Reference: <strong>{{$commande->Reference}}</strong><br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-2 invoice-col">
        {{-- To
        <address>
          <strong>John Doe</strong><br>
          795 Folsom Ave, Suite 600<br>
          San Francisco, CA 94107<br>
          Phone: (555) 539-1037<br>
          Email: john.doe@example.com
        </address> --}}
      </div>
      <!-- /.col -->
      <div class="col-sm-5 invoice-col">
        <b>Facture: #{{$approvi->Reference}}</b><br>
        <b>Date: {{date('d-m-Y', strtotime($approvi->created_at))}}</b><br>
        <br>
        {{-- <b>Order ID:</b> 4F3S8J<br>
        <b>Payment Due:</b> 2/22/2014<br>
        <b>Account:</b> 968-34567 --}}
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <h4 style="text-align: center">INFORMATION COMMANDE</h4>
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>N*</th>
              <th>DATE</th>
              <th>REFERENCE</th>
              <th>PRODUIT</th>
              <th>QUANTITE</th>
              <th>PRIX ACHAT</th>
              <th>MONTANT</th>
              {{-- <th>ETAT</th> --}}
            </tr>
          </thead>
          <tbody>
            @foreach ($detacommande as $key=>$detacomm )
                        
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{date('d-m-Y à H:i', strtotime($detacomm->created_at))}} </td>
                        <td> {{$detacomm->Reference}} </td>
                        <td> {{$detacomm->produit->Designation}} </td>
                        <td> {{$detacomm->Qte}} </td>
                        <td>{{$detacomm->prixachat}}</td>
                        <td>{{$detacomm->prixachat * $detacomm->Qte}}</td>
                        {{-- <td> {{$commande->Etat}}</td> --}}
                       
                    </tr>
                    
                    @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <hr>
    <h4 style="text-align: center">INFORMATION APPROVISIONNEMENT</h4>
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
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

            @php $mttappro=0; @endphp
            @foreach ($detailapprovi as $key=>$detailApprovis )
                        
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{date('d-m-Y à H:i', strtotime($detailApprovis->created_at))}} </td>
                        <td> {{$detailApprovis->Reference}} </td>
                        <td> {{$detailApprovis->produit->Designation}} </td>
                        <td> {{$detailApprovis->NombreSac}} </td>
                        <td>{{$detailApprovis->produit->qtesac * $detailApprovis->NombreSac}}</td>
                        {{-- <td> {{$commande->Etat}}</td> --}}
                       
                    </tr>
                    @php $mttappro=$detailApprovis->NombreSac * $detailApprovis->produit->Prix ; @endphp
                    @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        {{-- <p class="lead">Payment Methods:</p>
        <img src="../../dist/img/credit/visa.png" alt="Visa">
        <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
        <img src="../../dist/img/credit/american-express.png" alt="American Express">
        <img src="../../dist/img/credit/paypal2.png" alt="Paypal"> --}}

        {{-- <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr
          jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
        </p> --}}
      </div>
      <!-- /.col -->
      <hr>
      <div class="col-6">
        <p class="lead">Date: {{date('d-m-Y', strtotime($approvi->created_at)) }}</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Quantité Total Commande:</th>
              <td>{{$commande->qtecmmd}} Kg</td>
            </tr>
            <tr>
              <th style="width:50%">Montant Total Commande:</th>
              <td>{{$commande->Montant}} Fcfa </td>
            </tr>
            <tr>
              <th style="width:50%">Nombre Total Sac Approvision:</th>
              <td>{{$approvi->NbrTotalSac}} </td>
            </tr>
            <tr>
              <th style="width:50%">Quantité Total Approvision:</th>
              <td>{{$approvi->qteTotalkg}} Kg </td>
            </tr>
            <tr>
              <th style="width:50%">Montant Total Approvision:</th>
              <td>{{$mttappro}} Fcfa </td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
