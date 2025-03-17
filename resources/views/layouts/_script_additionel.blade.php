
{{-- Sweet alerte --}}

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
<script>



    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

 // alerte pour suppression
    $('.sa-delete').on('click', function(){
        let form_id = $(this).data('form-id');
       
      console.log(form_id);
        swal({
                title: "Etre vous sur de supprimer cet enregistrement ?",
                text: "La suppression d'un element est defitive",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                  $('#'+form_id).submit();
                }
                });
    })

    @if(Session::has('success'))
  		toastr.success("{{ Session::get('success') }}");
  @endif
    </script>

  {{-- password visibilite --}}
<script>
 $(".toggle-password").click(function() {

$(this).toggleClass("fa-eye fa-eye-slash");
var input = $($(this).attr("toggle"));
if (input.attr("type") == "password") {
  input.attr("type", "text");
} else {
  input.attr("type", "password");
}
});

const pwd = document.getElementById("pwd");
const chk = document.getElementById("chk");

chk.onchange = function(e){
  pwd.type = chk.checked ? "text": "password";

}
  // prevent form submit
 
</script>
<script>
 $(".toggle-passwordck").click(function() {

$(this).toggleClass("fa-eye fa-eye-slash");
var input = $($(this).attr("toggle"));
if (input.attr("type") == "password") {
  input.attr("type", "text");
} else {
  input.attr("type", "password");
}
});

const pwdck = document.getElementById("pwdck");
const chkck = document.getElementById("chkck");

chkck.onchange = function(e){
  pwdck.type = chkck.checked ? "text": "password";

}
  // prevent form submit
 
</script>

<script>
  $(document).ready(function() {

       $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('#swalDefaultSuccess').click(function() {
      console.log('test');
      
      Toast.fire({
        icon: 'success',
        title: 'Le produit a été ajouté au panier.'
      })
    });
   
  });
      content0 = " ";
      content1 = " ";
//console.log('text');
      $.get("./recuperations", {
         
      }, function(data) {
          var tables = data;

          console.log("tablesglobe", tables);

          for (var i = 0; i < tables.length; i++) {

              var noms = tables[i]["Designation"];
              var prixs = tables[i]["Prix"];
              var idproduit = tables[i]["id"];
              var qtess = tables[i]["Stock"];
              console.log("nom", noms);

              content0 += `<div class="col-md-4"><div class="card-body">` +
                  `<div style="background-color:#545857;border-radius:10px;padding:5px;margin-bottom:7px;">` +
                  `<h5 style="font-size:12px;color:white;font-weight: bold;">${noms}</h5>` +
                  `<h6 style="font-size:11px;color:white;">${prixs}</h6>` +
                  `<h6 style="font-size:11px;color:white;">Stock: ${qtess}</h6>` +
                  `<button style="background:#ffca08;color:#fff;" class="btn btn-xs swalDefaultSuccess" id='num${idproduit}' onClick='admin("${idproduit}", "${noms}", "${prixs}", "${qtess}")' type="button"` +
                  ` myDataId='${idproduit}' ` +
                  ` myDataNom='${noms}' ` +
                  `myDataPrix='${prixs}'` +
                  `myDataQte='${qtess}' ` +
                  `ident="${idproduit}"><i class="fa fa-cart-plus" aria-hidden="true"></i>+ Ajouter </button>` +
                  `</div></div></div>`;
          };
          $("#produit").html(content0);
      });


  });


  $("#recherchedesip").keyup(function() {
      var designation = $("#recherchedesip").val();
      var content2 = "";

      if (designation != null || designation != "") {
          $.post("./recuperations", {
              designation: designation,
              identreprise: identreprise,
              idagence: idagence
          }, function(data) {
              var tables = JSON.parse(data);
              console.log("tab", tables);
              for (var i = 0; i < tables.length; i++) {

                  var noms = tables[i]["Designation"].replace('"'," ");
                  var prixs = tables[i]["Prix"];
                  var idproduit = tables[i]["id"];
                  var qtess = tables[i]["Stock"];
                  

                  content2 += `<div class="col-md-4"><div class="card-body">` +
                      `<div style="background-color:#545857;border-radius:10px;padding:5px;margin-bottom:7px;">` +
                      `<h5 style="font-size:12px;color:white;font-weight: bold;">${noms}</h5>` +
                      `<h6 style="font-size:11px;color:white;">${prixs}</h6>` +
                      `<h6 style="font-size:11px;color:white;">Stock: ${qtess}</h6>` +
                      `<button style="background:#ffca08;color:#fff;"  type="button" class="btn swalDefaultSuccess " id='num${idproduit}' onClick='admin("${idproduit}", "${noms}", "${prixs}", "${qtess}")'` +
                      ` myDataId='${idproduit}' ` +
                      ` myDataNom='${noms}' ` +
                      `myDataPrix='${prixs}'` +
                      `myDataQte='${qtess}' ` +
                      `ident="${idproduit}"><i class="fa fa-cart-plus" aria-hidden="true"></i>+ Ajouter </button>` +
                      `</div></div></div>`;
              };
              $("#produit").html(content2);

          });
      }

  })

  var ind = 0;
    var compte = 0;
    var tabData = [];
    var tabData = [];
    var tabverif = [];
    var tabData = [];
    
  function admin(idproduit, noms, prixs, qtess) {

var verif = false;
console.log("click boom !!", idproduit, noms, prixs, qtess);

myDataId = idproduit;
myDataNom = noms;
myDataPrix = prixs;
myDataQte = qtess;

tabverif.forEach(function(value) {
    if (myDataId == value) {
        verif = true;
    }
    console.log("salut", value);
})
if (verif == false) {
    ind++;
    compte = ind;
    $('.contenu').append('<tr  style="color:black;width:100%;" id="ind' + ind + '">' +
        '<td align="center" style="display: none; width:0px;"><input type="text" id="myDataId' +
        ind + '" name="ind[]" value="' + myDataId + '"><span class="idn_' +
        ind + '">' + myDataId + '</span></td>' +
        '<td align="center" style="width:40%;"><input type="hidden" id="myDataNom' +
        ind + '" name=" myDataNom[]" value="' + myDataNom + '">' + myDataNom + '</td>' +
        '<td align="center" style="width:15%;"><input type="hidden" id="myDataPrix' +
        ind + '" name="myDataPrix[]" value="' + myDataPrix + '">' + myDataPrix + '</td>' +
        '<td align="center" style="width:10%;"><input type="hidden" name="myDataQte[]" id="myDataQte' +
        ind + '" value="' + myDataQte + '"/>' + myDataQte + '</td>' +
        '<td align="center" style="width:10%;"><input style="width:80px;" class="form-control" type="number" name="nqte[]" id="nqte' +
        ind + '" onclick="calculTotal(' + ind + ')" onkeyup="calculTotal(' +
        ind + ')" required/></td>' +
        '<td align="center" style="width:20%;"><input style="width:120px;" type="number" class="form-control" name="total[]" id="total' +
        ind + '" readonly/></td>' +
        '<td align="center" ><a style="width:10%;color:red;" href="javascript:void(0);" onclick="removeRow(' +
        ind + ',' + myDataId +
        ');" ><span class="fa fa-trash"></span></a></td>' +
        '</tr>');
    tabData.push(myDataId);

    last = document.getElementById('total' + ind).value;
    document.getElementById('total' + ind).value = parseFloat(document
        .getElementById('myDataPrix' + ind).value * document.getElementById(
            'nqte' + ind).value);
    diff = parseFloat(document.getElementById('total' + ind).value) - last;

    tabverif.push(myDataId);
};

content0 = " ";
      content1 = " ";
//console.log('text');
      $.get("./recuperations", {
         
      }, function(data) {
          var tables = data;

          console.log("tablesglobe", tables);

          for (var i = 0; i < tables.length; i++) {

              var noms = tables[i]["Designation"];
              var prixs = tables[i]["Prix"];
              var idproduit = tables[i]["id"];
              var qtess = tables[i]["Stock"];
              console.log("nom", noms);

              content0 += `<div class="col-md-4"><div class="card-body">` +
                  `<div style="background-color:#545857;border-radius:10px;padding:5px;margin-bottom:7px;">` +
                  `<h5 style="font-size:12px;color:white;font-weight: bold;">${noms}</h5>` +
                  `<h6 style="font-size:11px;color:white;">${prixs}</h6>` +
                  `<h6 style="font-size:11px;color:white;">Stock: ${qtess}</h6>` +
                  `<button style="background:#ffca08;color:#fff;" class="btn btn-xs swalDefaultSuccess" id='num${idproduit}' onClick='admin("${idproduit}", "${noms}", "${prixs}", "${qtess}")' type="button"` +
                  ` myDataId='${idproduit}' ` +
                  ` myDataNom='${noms}' ` +
                  `myDataPrix='${prixs}'` +
                  `myDataQte='${qtess}' ` +
                  `ident="${idproduit}"><i class="fa fa-cart-plus" aria-hidden="true"></i>+ Ajouter </button>` +
                  `</div></div></div>`;
          };
          $("#produit").html(content0);
      });

  }
  </script>

<script>

$(".taxetva").change(function() {
        console.log("Q");
        mntttc = 0;

        mntttc = parseFloat((document.getElementById('totalht').value - (document.getElementById('remise')
            .value)) + ((document.getElementById('totalht').value - (document.getElementById(
                'remise')
            .value)) * (document.getElementById('tva').value)));

        $("#vue_totalttc").val(Number(mntttc).toLocaleString());
        $("#totalttc").val(mntttc);

        solde = parseFloat((document.getElementById('totalttc').value - (document.getElementById('avance')
            .value)));

        $("#vue_solde").val(Number(solde).toLocaleString());
        $("#solde").val(solde);

        if (solde > 0) {
            $("#direct").attr("disabled", "disabled");
            $("#attente").removeAttr("disabled");
            $("#devis").removeAttr("disabled");
        } else if (solde <= 0) {
            $("#direct").removeAttr("disabled");
            $("#attente").attr("disabled", "disabled");
            $("#devis").attr("disabled", "disabled");
        }

    });

  var somme = 0;

  function calculTotal(pNum) {
      last = document.getElementById('total' + pNum).value;
      console.log("salut");
      document.getElementById('total' + pNum).value = parseFloat(document.getElementById('myDataPrix' + pNum).value *
          document.getElementById('nqte' + pNum).value);
      diff = parseFloat(document.getElementById('total' + pNum).value) - last;

      somme += diff;

      $("#vue_totalht").val(Number(somme).toLocaleString());
      $("#totalht").val(somme);

      mntttc = 0;
      solde = 0;

      mntttc = parseFloat((document.getElementById('totalht').value - (document.getElementById('remise').value)) + ((
          document.getElementById('totalht').value - (document.getElementById('remise').value)) * (
          document.getElementById('tva').value)));

      $("#vue_totalttc").val(Number(mntttc).toLocaleString());
      $("#totalttc").val(mntttc);

      solde = parseFloat((document.getElementById('totalttc').value - (document.getElementById('avance').value)));

      $("#vue_solde").val(Number(solde).toLocaleString());
      $("#solde").val(solde);

      if (solde > 0) {
          $("#direct").attr("disabled", "disabled");
          $("#attente").removeAttr("disabled");
      } else if (solde <= 0) {
          $("#direct").removeAttr("disabled");
          $("#attente").attr("disabled", "disabled");
      }
  }

  function remises() {
      mntttc = 0;

      mntttc = parseFloat((document.getElementById('totalht').value - (document.getElementById('remise').value)) + ((
          document.getElementById('totalht').value - (document.getElementById('remise').value)) * (
          document.getElementById('tva').value)));

      $("#vue_totalttc").val(Number(mntttc).toLocaleString());
      $("#totalttc").val(mntttc);

      solde = parseFloat((document.getElementById('totalttc').value - (document.getElementById('avance').value)));

      $("#vue_solde").val(Number(solde).toLocaleString());
      $("#solde").val(solde);

      if (solde > 0) {
          $("#direct").attr("disabled", "disabled");
          $("#attente").removeAttr("disabled");
      } else if (solde <= 0) {
          $("#direct").removeAttr("disabled");
          $("#attente").attr("disabled", "disabled");
      }
  }

  function avances() {

      solde = parseFloat((document.getElementById('totalttc').value - (document.getElementById('avance').value)));

      $("#vue_solde").val(Number(solde).toLocaleString());
      $("#solde").val(solde);

      if (solde > 0) {
          $("#direct").attr("disabled", "disabled");
          $("#attente").removeAttr("disabled");
      } else if (solde <= 0) {
          $("#direct").removeAttr("disabled");
          $("#attente").attr("disabled", "disabled");
      }
  }


  function removeRow(removeNum, myid) {
      mntttc = 0;

      var recup = [];
      //supprimer element dans tableau syntaxte JS directe
      tabverif.forEach(function(value) {
          if (myid != value) {
              recup.push(value);
          };
      })
      tabverif = recup;

      var total = document.getElementById('total' + removeNum).value;
      somme -= (total ? total : 0);
      mntttc = somme - document.getElementById('remise').value + ((somme - (document.getElementById('remise')
          .value)) * (document.getElementById('tva').value));
      $("#vue_totalht").val(Number(somme).toLocaleString());
      $("#totalht").val(somme);
      $("#vue_totalttc").val(Number(mntttc).toLocaleString());
      $("#totalttc").val(mntttc);

      solde = parseFloat((document.getElementById('totalttc').value - (document.getElementById('avance').value)));

      $("#vue_solde").val(Number(solde).toLocaleString());
      $("#solde").val(solde);

      if (solde > 0) {
          $("#direct").attr("disabled", "disabled");
          $("#attente").removeAttr("disabled");
      } else if (solde <= 0) {
          $("#direct").removeAttr("disabled");
          $("#attente").attr("disabled", "disabled");
      }

      jQuery('#ind' + removeNum).remove();
      removeNum--;

  }


  //////////modification vente

  function mcalculTotal(pNum){
      last=document.getElementById('total'+pNum).value;
      document.getElementById('total'+pNum).value =  parseFloat(document.getElementById('prixachat'+pNum).value * document.getElementById('qteachat'+pNum).value);
      diff = parseFloat(document.getElementById('total'+pNum).value)-last;
   
      somme += diff;
  
      $("#vue_totalht").val(Number(somme).toLocaleString());
      $("#totalht").val(somme);

      mntttc=0;
      solde=0;

      mntttc=  parseFloat((document.getElementById('totalht').value-(document.getElementById('remise').value)) + ((document.getElementById('totalht').value-(document.getElementById('remise').value))*(document.getElementById('tva').value)) ) ;

      $("#vue_totalttc").val(Number(mntttc).toLocaleString());
      $("#totalttc").val(mntttc);

      solde=  parseFloat((document.getElementById('totalttc').value-(document.getElementById('avance').value)) ) ;

      $("#vue_solde").val(Number(solde).toLocaleString());
      $("#solde").val(solde);
    }
    
    function mremises(){
      mntttc=0;

      mntttc=  parseFloat((document.getElementById('totalht').value-(document.getElementById('remise').value)) + ((document.getElementById('totalht').value-(document.getElementById('remise').value))*(document.getElementById('tva').value)) ) ;

      $("#vue_totalttc").val(Number(mntttc).toLocaleString());
      $("#totalttc").val(mntttc);

      solde=  parseFloat((document.getElementById('totalttc').value-(document.getElementById('avance').value)) ) ;

      $("#vue_solde").val(Number(solde).toLocaleString());
      $("#solde").val(solde);
    }


  var somme=0 ;
var rowCount = 0;
  $(document).ready(function() {
    var content="";
    
    let idvente=$('#idvente').val();
    
    console.log(idvente );
$.get("/modificationVente/"+idvente, {
  
}, function(datta) {
    var tables = datta;
    console.log("tabless", tables); 

    $('#addedRows').attr("style", "display:block;");

    for ( i = 0; i < tables.length; i++) { 
     rowCount++;
     let idpro = tables[i]["produit_id"];
     //console.log(idpro);
     
     
   content+='<div class="row" style="border:1px solid grey;"  id="rowCount' + rowCount +
            '"><div class="col-md-3"><label for="checkin">Produit</label><select onkeyup="calculTotal('+rowCount+')" onclick="calculTotal('+rowCount+')" type="text" id="libelle' + rowCount +
            '" name="libelle' + rowCount + '" num="'+rowCount+'" required class="form-control  idarticle">' +
            '@foreach($produits as $produit) <option  {{ '+idpro+' === $produit->id ? "selected" : ''}} value="{{$produit->id}}"> {{$produit->Designation}}</option> @endforeach </select></div>' +
            '<div class="col-md-2"><label for="checkin">Qte Achat</label><input type="number" value="' + tables[i]["QteVente"] + '"  id="qteachat' + rowCount + '"  onkeyup="mcalculTotal('+rowCount+')" onclick="mcalculTotal('+rowCount+')"  class="form-control"></div>' +
            '<div class="col-md-3"><label for="checkin">Prix Achat</label><input type="text" readonly value="' + tables[i]["PrixVente"] + '" id="prixachat' + rowCount + '" class="form-control"></div>' +
            '<div class="col-md-3"><label for="checkin">Total</label><input type="number" readonly value="' + tables[i]["MontantVente"] + '" readonly  id="total' + rowCount + '" class="form-control"></div>'+
            '<div class="col-md-1" style="margin-top:35px;" ><a href="javascript:void(0);" onclick="remove(' +
            rowCount + ');">X</a></div></div></div>' +
            '<input type="hidden" name="compteur" value="' + rowCount + '">';
            
            somme+=Number(tables[i]["MontantVente"]);

    };

$("#addedRows").html(content);
});

})
  </script>
