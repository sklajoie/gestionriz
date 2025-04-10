<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.js')}}"></script>
<script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('assets/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('assets/dist/js/pages/dashboard2.js')}}"></script>

{{-- <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script> --}}
<!-- Bootstrap 4 -->
{{-- <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script> --}}
<!-- DataTables  & Plugins -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->

<!-- CodeMirror -->
<script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })
  $(function () {

  
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

   

    $("#example1").DataTable({
      "responsive": false, "lengthChange": true, "autoWidth": true,
      "buttons": ["csv", "excel", "pdf", "print", "colvis"]
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('.example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  
</script>

<script>
  $(function () {
    // Summernote
    $('.summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })

  function addRows(){ 
    var table = document.getElementById('commandetbl');
    var rowCount = table.rows.length;
    var cellCount = table.rows[0].cells.length; 
    var row = table.insertRow(rowCount);
    for(var i =0; i <= cellCount; i++){
      var cell = 'cell'+i;
      cell = row.insertCell(i);
      var copycel = document.getElementById('col'+i).innerHTML;
      
      cell.innerHTML=copycel;
     
    }
  }


  function deleteRows(){
    var table = document.getElementById('commandetbl');
    var rowCount = table.rows.length;
    if(rowCount > '2'){
      var row = table.deleteRow(rowCount-1);
      rowCount--;
    }
    else{
      alert('Vous ne pouvez pas supprimer cette ligne');
    }
  }

  function calculTotalcmd() {
    let total = 0; // Initialisation du total
    let ttqtecmm = 0; // Initialisation du total
    const table = document.getElementById("commandetbl"); // Référence au tableau principal

    // Parcourir toutes les lignes du tableau à partir de la deuxième ligne (ignorant l'en-tête)
    for (let i = 1; i < table.rows.length; i++) {
        let row = table.rows[i];

        // Récupérer les valeurs de "Prix Achat" et "Quantité Commandée" dans la ligne actuelle
        let prixAchat = parseFloat(row.cells[3].querySelector("input").value);
        let qteCmd = parseFloat(row.cells[1].querySelector("input").value);
        let qteAPro = parseFloat(row.cells[2].querySelector("input").value);

        // Ajouter au total uniquement si les valeurs sont valides
        if (!isNaN(prixAchat) && !isNaN(qteCmd)) {
            total += prixAchat * qteCmd;
        }
        if (!isNaN(qteCmd)) {
          ttqtecmm += qteCmd;
        }
    }

    // Afficher le montant total dans le champ "montant"
    document.getElementById("montantcmd").value = total.toFixed(2); // Formater avec deux décimales
    document.getElementById("ttqtecmmd").value = ttqtecmm.toFixed(2); // Formater avec deux décimales

    console.log("Montant total : " + total);
}


//   function calculTotalappro() {

    

//     let total = 0; // Initialisation du total
//     let qtettkg = 0; // Initialisation du total
//     const table = document.getElementById("commandetbl"); // Référence au tableau principal

//     // Parcourir toutes les lignes du tableau à partir de la deuxième ligne (ignorant l'en-tête)
//     for (let i = 1; i < table.rows.length; i++) {
//         let row = table.rows[i];

//         // Récupérer les valeurs de "Prix Achat" et "Quantité Commandée" dans la ligne actuelle
//         let typesac = parseFloat(row.cells[1].querySelector("input").value);
//         let nbrsac = parseFloat(row.cells[2].querySelector("input").value);
//         // let qtettkg = parseFloat(row.cells[3].querySelector("input").value);
//         var qtekg = typesac * nbrsac;
//         // Ajouter au total uniquement si les valeurs sont valides
//         if ( !isNaN(nbrsac)) {
//             total += nbrsac;
//         }
//         if (!isNaN(qtekg)) {
//           qtettkg += qtekg ;
//         }
//     }
//     $("#qtekg").val(qtekg);
//     // Afficher le montant total dans le champ "montant"
//     document.getElementById("nombrettsac").value = total.toFixed(2); // Formater avec deux décimales
//     document.getElementById("qtettkg").value = qtettkg.toFixed(2); // Formater avec deux décimales

//     // console.log("Montant total : " + total);
// }

function calculTotalappro() {
    let total = 0; // Total des sacs
    let qtettkg = 0; // Quantité totale en Kg

    const table = document.getElementById("commandetbl"); // Référence au tableau principal
    let qtecmmd = document.getElementById("qtecmmd").value; // Référence au tableau principal

    // Parcourir toutes les lignes du tableau à partir de la deuxième ligne (ignorer l'en-tête)
    for (let i = 1; i < table.rows.length; i++) {
        let row = table.rows[i];

        // Récupérer les valeurs de "Type de sac" et "Nombre de sacs" dans la ligne actuelle
        let typesac = parseFloat(row.cells[1].querySelector("input").value) || 0;
        let nbrsac = parseFloat(row.cells[2].querySelector("input").value) || 0;

        // Calculer la quantité en Kg pour la ligne actuelle
        let qtekg = typesac * nbrsac;

        // Ajouter au total si la quantité est valide
        if (!isNaN(nbrsac)) {
            total += nbrsac;
        }
        if (!isNaN(qtekg)) {
            qtettkg += qtekg;

            // Mettre à jour le champ qtekg de la ligne actuelle
            row.cells[3].querySelector("input").value = qtekg.toFixed(2);
        }
        if(qtettkg > qtecmmd)
        {
          alert("La quantite d'approvisinnement est supperieur à la quantite de commande. Merci de bien verrifier!!!");
        }
    }


    // Mettre à jour les champs de totaux dans le tableau des résumés
    document.getElementById("nombrettsac").value = total.toFixed(2);
    document.getElementById("qtettkg").value = qtettkg.toFixed(2);
}




$(".parentContainer").on("change", "#cproduit", function() {

      var idarticle = $(this).val();
      var row = $(this).closest("tr"); // Trouve la ligne parente
      var num = row.index(); // Indice de la ligne (si nécessaire)
      console.log("idart",num,idarticle);

        $.get("/rechercheKgArticle/"+idarticle,function(rep){ 
          
                     console.log("rep",rep);
                     row.find("#typesac").val(rep.rep);
                    //  $("#prixachat"+num).val(rep.rep);
                });
        
            });

  </script>
@include('layouts._script_additionel')

