<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
<script type="text/javascript">
function word() {
 
   if (!window.Blob) {
      alert('Your legacy browser does not support this action.');
      return;
   }

   var html, link, blob, url, css;
   css = (
     '<style>' +
     '@page WordSection{size: 841.95pt 595.35pt;mso-page-orientation: landscape;}' +
     'div.WordSection {page: WordSection;}' +
     'table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}td, th {border: 1px solid #dddddd;text-align: left;padding: 8px;}tr:nth-child(even) {  background-color: #dddddd;}'+'</style>'
   );
   
   html = window.docx.innerHTML;
   blob = new Blob(['\ufeff', css + html], {
     type: 'application/msword'
   });
   url = URL.createObjectURL(blob);
   link = document.createElement('A');
   link.href = url;
   // Set default file name. 
   // Word will append file extension - do not add an extension here.
   link.download = 'Bimbingan Mahasiswa.doc';   
   document.body.appendChild(link);
   if (navigator.msSaveOrOpenBlob ) navigator.msSaveOrOpenBlob( blob, 'Document.doc'); // IE10-11
      else link.click();  // other browsers
   document.body.removeChild(link);
 }

$(document).ready(function() {
    $('#table1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
$(document).ready(function() {
    $('#table2').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
$(document).ready(function() {
    $('#table3').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
$(document).ready(function(){
    var x = document.getElementsByClassName("card-body");
    x[0].setAttribute("id", "docx");
    var x = document.getElementsByClassName("table-responsive");
    x[0].setAttribute("class", "WordSection table-responsive");
    $('.dt-buttons').append('<button id="export" onclick="word()" class="btn btn-secondary">WORD</button>');
  });
</script>

<script src="<?php echo base_url(); ?>assets/js/core/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/core/bootstrap-material-design.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
