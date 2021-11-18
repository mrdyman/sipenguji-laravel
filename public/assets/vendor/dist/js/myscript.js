$(document).ready(function () {
  // tambah data gedung
  $(".tambah-gedung").on("click", function () {
    $("#detailModal").modal("show");
    $("#detailModalLabel").html("Tambah Data Gedung");

    //hide form edit
    $(".edit-modal-gedung").hide();
    $(".modal-tambah-ruangan").hide();
    $(".modal-edit-ruangan").hide();
    $(".modal-tambah-gedung").show();
  });
  // --/ tambah data gedung

  // edit data gedung
  $(".edit-gedung").on("click", function () {
    $("#detailModal").modal("show");
    $("#detailModalLabel").html("Edit Data Gedung");

    $(".alamat-label").html("Alamat");

    $("#Nama_modal").prop("disabled", false);
    $("#alamat_modal").prop("disabled", false);
    $(".btn-simpan-gedung").prop("disabled", false);

    //hide form tambah
    $(".modal-tambah-gedung").hide();
    $(".modal-tambah-ruangan").hide();
    $(".modal-edit-ruangan").hide();

    $(".edit-modal-gedung").show();

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

  // tambah data ruangan
  $(".tambah-ruangan").on("click", function () {
    $("#detailModal").modal("show");
    $("#detailModalLabel").html("Tambah Data Ruangan");

    $(".edit-modal-gedung").hide();
    $(".modal-tambah-gedung").hide();
    $(".modal-edit-ruangan").hide();

    $(".modal-tambah-ruangan").show();

    //get data gedung yang akan dijadikan alamat ruangan
    var link_gedung = location.href + "getgedung";
    $.ajax({
      url: link_gedung,
      method: "get",
      dataType: "json",
      success: function (data) {
        $(".select-ruangan").empty();
        for (var i = 0; i < data.length; i++) {
          $(".select-ruangan").append(
            `<option value="` +
              data[i].id +
              `">` +
              data[i].nama_gedung +
              `</option>`
          );
        }
      },
    });

    // display map
    var mapOptions = {
      center: { lat: -0.836261, lng: 119.893715 },
      zoom: 17,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
    };

    map = new google.maps.Map(
      document.getElementById("map_ruangan"),
      mapOptions
    );

    var marker;
    google.maps.event.addListener(map, "click", function (event) {
      let latitude = event.latLng.lat();
      let longitude = event.latLng.lng();
      $("#latitude-ruangan").val(latitude);
      $("#longitude-ruangan").val(longitude);

      if (marker) {
        marker.setMap(null);
      }

      marker = new google.maps.Marker({
        position: event.latLng,
        map: map,
        icon: icon,
      });
    });
  });
  // --/ tambah data ruangan

  // edit data ruangan
  $(".edit-ruangan").on("click", function () {
    $("#detailModal").modal("show");
    $("#detailModalLabel").html("Edit Data Ruangan");

    $(".modal-tambah-gedung").hide();
    $(".edit-modal-gedung").hide();
    $(".modal-tambah-ruangan").hide();
    $(".modal-edit-ruangan").show();

    var id = $(this).attr("id");
    var link = location.href + "ruangan/" + id;

    $(".modal-body form").attr("action", link);

    $.ajax({
      url: link,
      method: "get",
      dataType: "json",
      success: function (data) {
        $("#nama_ruangan_edit").val(data.nama_ruangan);
        $(".select-ruangan-edit").val(data.nama_gedung);
        $("#latitude-ruangan-edit").val(data.latitude);
        $("#longitude-ruangan-edit").val(data.longitude);
      },
    });

    //get data gedung yang akan dijadikan alamat ruangan
    var link_gedung = location.href + "getgedung";
    $.ajax({
      url: link_gedung,
      method: "get",
      dataType: "json",
      success: function (data) {
        $(".select-ruangan-edit").empty();
        for (var i = 0; i < data.length; i++) {
          $(".select-ruangan-edit").append(
            `<option value="` +
              data[i].id +
              `">` +
              data[i].nama_gedung +
              `</option>`
          );
        }
      },
    });

    // display map
    var mapOptions = {
      center: { lat: -0.836261, lng: 119.893715 },
      zoom: 17,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
    };

    map = new google.maps.Map(
      document.getElementById("map_ruangan_edit"),
      mapOptions
    );

    var marker;
    google.maps.event.addListener(map, "click", function (event) {
      let latitude = event.latLng.lat();
      let longitude = event.latLng.lng();
      $("#latitude-ruangan-edit").val(latitude);
      $("#longitude-ruangan-edit").val(longitude);

      if (marker) {
        marker.setMap(null);
      }

      marker = new google.maps.Marker({
        position: event.latLng,
        map: map,
        icon: icon,
      });
    });
  });
  // --/ edit data ruangan

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
    $(".btn-simpan-gedung").prop("disabled", true);

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

// hapus data ruangan
$(".hapus-ruangan").on("click", function (e) {
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
        url: location.href + "ruangan/" + id,
        type: "delete",
        success: function () {
          Swal.fire("Terhapus!", "data ruangan berhasil dihapus.", "success");
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
