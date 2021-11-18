$(document).ready(function () {
  // tambah data gedung
  $(".tambah-gedung").on("click", function () {
    $("#detailModal").modal("show");
    $("#detailModalLabel").html("Tambah Data Gedung");

    //hide form edit
    $(".edit-modal").hide();
    $(".modal-tambah").show();
  });
  // --/ tambah data gedung

  // edit data gedung
  $(".edit-gedung").on("click", function () {
    $("#detailModal").modal("show");
    $("#detailModalLabel").html("Edit Data Gedung");

    $(".alamat-label").html("Alamat");

    $("#Nama_modal").prop("disabled", false);
    $("#alamat_modal").prop("disabled", false);
    $(".btn-simpan").prop("disabled", false);

    //hide form tambah
    $(".modal-tambah").hide();

    $(".edit-modal").show();

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
    $(".btn-simpan").prop("disabled", true);

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

        $(".longitude-input").empty();

        $(".longitude-input").append(`
          <label class="col-sm-2 col-form-label col-form-label-sm">Lokasi</label>
          <div class="col-sm-10">
            <select class="custom-select" id="lokasi">
              <option selected>Pilih lokasi...</option>
              <option value="1">One</option>
            </select>
          </div>
        `);
      },
    });
  });
});

// hapus data gedung
$(".hapus-gedung").on("click", function (e) {
  e.preventDefault();
  var id = $(this).attr("id");

  Swal.fire({
    title: "Anda yakin?",
    text: "Data tidak dapat dikembalikan!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya, hapus data!",
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
          Swal.fire("Terhapus!", "data gedung berhasil dihapus.", "success");
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
