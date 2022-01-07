$(document).ready(function () {
  const table = $('#tableProducts').DataTable({
    ajax: {
      url: 'http://localhost:3000/products',
      dataSrc: '',
    },
    columns: [
      { data: 'id_producto' },
      { data: 'clave_producto' },
      { data: 'nombre' },
      { data: 'precio' },
      {
        data: null,
        defaultContent: `
          <button class="btn btn-sm btn-delete"><i class="far fa-trash-alt"></i></button>
          <button class="btn btn-sm btn-update"><i class="fas fa-pen"></i></button>
        `,
      },
    ],
    language: {
      lengthMenu: 'Mostrando _MENU_ filas por página',
      zeroRecords: 'Sin registros encontrados',
      info: 'Página _PAGE_ de _PAGES_',
      infoEmpty: 'No hay registros disponibles',
      infoFiltered: '(filtrados de _MAX_ registros totales)',
      search: 'Buscar:',
      paginate: {
        next: 'Siguiente',
        previous: 'Anterior',
      },
    },
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'excel',
        text: 'Export to Excel',
        title: 'Productos',
        exportOptions: {
          columns: [0, 1, 2, 3],
        },
      },
    ],
  })
  $('#tableProducts tbody').on('click', '.btn-delete', function () {
    var data = table.row($(this).parents('tr')).data()
    alert(JSON.stringify(data))
  })
  $('#tableProducts tbody').on('click', '.btn-update', function () {
    var data = table.row($(this).parents('tr')).data()
    alert('update')
  })
  // table.ajax.reload()
})
