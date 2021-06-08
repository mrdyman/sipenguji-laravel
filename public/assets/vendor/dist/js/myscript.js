$(document).ready(function () {
  $(".edit-gedung").on("click", function () {
    $("#detailModal").modal("show");
    $("#detailModalLabel").html("Edit Data Gedung");

    var id = $(this).attr("id");

    $.ajax({
      url: location.href + "home/" + id,
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

  const session = $(".session").data("flashmessage");

  if (session) {
    Toast.fire({
      icon: "success",
      title: session,
    });
  }
});
