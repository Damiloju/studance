<!-- Required datatable js -->
<script src="/template/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/template/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="/template/assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="/template/assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="/template/assets/plugins/datatables/jszip.min.js"></script>
<script src="/template/assets/plugins/datatables/pdfmake.min.js"></script>
<script src="/template/assets/plugins/datatables/vfs_fonts.js"></script>
<script src="/template/assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="/template/assets/plugins/datatables/buttons.print.min.js"></script>
<!-- Responsive examples -->
<script src="/template/assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="/template/assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#datatable').DataTable();

    //Buttons examples
    var table = $('#datatable-buttons').DataTable({
      lengthChange: false,
      buttons: ['copy', 'excel', 'pdf']
    });

    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
  } );

</script>