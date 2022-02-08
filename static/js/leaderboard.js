$('#scores').duplifer();

const table = $('#scores').DataTable({
  paging: false,

  fixedHeader: true,

  // Disabled searching and ordering on the first column (SNO)
  columnDefs: [
    {
      searchable: false,
      orderable: false,
      targets: 0,
    },
  ],

  // Order by register number column initially
  order: [[1, 'asc']],

  searchBuilder: true,

  responsive: true,
});

table.searchBuilder.container().prependTo(table.table().container());

// SNO must not change on sorting other columns
table
  .on('order.dt search.dt', () => {
    table
      .column(0, { search: 'applied', order: 'applied' })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1;
      });
  })
  .draw();
