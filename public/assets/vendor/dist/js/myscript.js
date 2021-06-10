$(document).ready(function () {
  // edit data gedung
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
        $("#Nama_modal").val(data.nama_gedung);
        $("#alamat_modal").val(data.alamat);
        $("#jumlah-ruangan_modal").val(data.jumlah_ruangan);
        $("#latitude_modal").val(data.latitude);
        $("#longitude_modal").val(data.longitude);
      },
    });
  });
  // --/ edit data gedung

  // detail ruangan
  $(".detail-ruangan").on("click", function () {
    $("#detailModal").modal("show");
    $("#detailModalLabel").html("Detail Data Ruangan");
    $(".alamat-label").html("Jumlah Peserta");
    $(".jumlah-ruangan-label").html("Nomor Peserta");
    $(".latitude-label").html("Jadwal");
    $(".longitude-label").html("Lokasi");

    $("#Nama_modal").prop("disabled", true);
    $("#alamat_modal").prop("disabled", true);
    $("#jumlah-ruangan_modal").prop("disabled", true);
    $("#latitude_modal").prop("disabled", true);
    $("#longitude_modal").prop("disabled", true);

    var id = $(this).attr("id");
    var link_ruangan = location.href + "ruangan/" + id;

    $(".modal-body form").attr("action", link_ruangan);

    $.ajax({
      url: link_ruangan,
      method: "get",
      dataType: "json",
      success: function (data) {
        $("#Nama_modal").val(data.nama_ruangan);
        $("#alamat_modal").val(data.jumlah_peserta);
        $("#jumlah-ruangan_modal").val(data.nomor_peserta);
        $("#latitude_modal").val(data.jadwal);
        $("#longitude_modal").val(data.alamat);
      },
    });
  });
});

// hapus data gedung
$(".hapus-gedung").on("click", function (e) {
  e.preventDefault();
  var id = $(this).attr("id");

  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      });
      $.ajax({
        url: location.href + "home/" + id,
        type: "delete",
        success: function () {
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
          location.href = "/";
        },
      });
    }
  });
});

// alert edit gedung
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
// /---!
