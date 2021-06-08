$(document).ready(function () {
  $(".edit-gedung").on("click", function () {
    $("#detailModal").modal("show");
    $("#detailModalLabel").html("Edit Data Gedung");

    var id = $(this).attr("id");
    var link = location.href + "home/" + id;

    $(".modal-body form").attr("action", link);

    $.ajax({
      url: link,
      method: "get",
      dataType: "json",
      success: function (data) {
        $("#Nama_modal").val(data.nama);
        $("#alamat_modal").val(data.alamat);
        $("#jumlah-ruangan_modal").val(data.jumlah_ruangan);
        $("#latitude_modal").val(data.latitude);
        $("#longitude_modal").val(data.longitude);
      },
    });
  });
});

$(function () {
  var Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
  });

  const session_success = $(".session-success").data("flashsuccess");
  const session_error = $(".session-error").data("flasherror");

  if (session_success) {
    Toast.fire({
      icon: "success",
      title: session_success,
    });
  }

  if (session_error) {
    Toast.fire({
      icon: "error",
      title: session_error,
    });
  }
});
