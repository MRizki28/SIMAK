$('#student-table').DataTable({
  bLengthChange: false,
  language: {
    search: "",
    searchPlaceholder: 'Search...',
    paginate: {
      next: "<i class='ti-arrow-right'></i>",
      previous: "<i class='ti-arrow-left'></i>"
    }
  },
  order: [[ 0, 'asc' ]],
  responsive: true,
  searching: true,
  info: false,
  paging: true
});

$('.dataTables_filter input').addClass('form-control');

function deleteConfirm(url) {
  const csrftoken = $('[name=csrfmiddlewaretoken]').val()
  const request = new Request(url, {
    headers: {
      'X-CSRFToken': csrftoken
    }
  })

  Swal.fire({
    title: 'Yakin ingin menghapus data ini?',
    text: "Menghapus data ini mungkin akan mempengaruhi fitur lain",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Batal',
    confirmButtonText: 'Hapus'
  }).then((result) => {
    if (result.isConfirmed) {
      fetch(request, {
        method: 'POST',
        mode: 'same-origin'
      }).then(function (response) {
        Swal.fire(
          'Terhapus!',
          'Data ini telah di hapus',
          'success'
        ).then(function () {
          window.location.reload();
        })
      });
    }
  })
}