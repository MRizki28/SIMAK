function modalUpdateFormHistory(id){
  let modal = $("#modalEditHistory")
  $.ajax({
    data: {'id': id},
    url: "/scholarship/loadHistory/",
    context: document.body,
    error: function(response, error) {
        alert(error);
    }
  }).done(function(response) {
      modal.html(response).modal("show")
  });
}

function deleteConfirm(url) {
  const csrftoken = $('[name=csrfmiddlewaretoken]').val()
  const request   = new Request(url,{headers: {'X-CSRFToken': csrftoken}})

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
      }).then(function(response) {
        Swal.fire(
          'Terhapus!',
          'Data ini telah di hapus',
          'success'
        ).then(function() {
          window.location.reload();
        })
      });
    }
  })
}