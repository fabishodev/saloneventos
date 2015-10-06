/*  eventos.js
 */
var salon = window.salon || {};
salon.eventos = (function() {
  var base_url = "";
  return {
    tabla_listas: function() {
      $(document).ready(function() {
        $('.tbl-datatable').DataTable({
          'order': [[ 1, "desc" ]],
          pagingType: "bootstrapPager",
          pagerSettings: {
            searchOnEnter: true
          },language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }

        });
      });
    },
    alerta_eliminar: function() {

        $(" .eliminar-fila").click(function (e) {
            if (confirm("¿Estas seguro de realizar esta acción?")) {
              return true;
            } else {
                e.preventDefault();
            }

        });


    }


  }
})();
