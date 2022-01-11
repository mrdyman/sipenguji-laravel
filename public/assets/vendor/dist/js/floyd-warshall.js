//get data ruangan untuk dijadikan titik awal dan tujuan
$.ajax({
  url: "/getruangan",
  method: "get",
  dataType: "json",
  success: function (data) {
    $(".select-ruangan-source").empty();
    $(".select-ruangan-destination").empty();

    $(".select-ruangan-source").append(
      `<option>--- Pilih Titik Awal ---</option>`
    );
    $(".select-ruangan-destination").append(
      `<option>--- Pilih Titik Tujuan ---</option>`
    );

    for (var i = 0; i < data.length; i++) {
      $(".select-ruangan-source").append(
        `<option value="` +
          data[i].id +
          `" id=" ` +
          data[i].id +
          ` ">` +
          data[i].nama_ruangan +
          `</option>`
      );
      $(".select-ruangan-destination").append(
        `<option value="` +
          data[i].id +
          `" id="` +
          data[i].id +
          `">` +
          data[i].nama_ruangan +
          `</option>`
      );
    }
  },
});

//ajax saat button hitung di klik
function floyd_Warshall() {
  source = $(".select-ruangan-source :selected").attr("id");
  destination = $(".select-ruangan-destination :selected").attr("id");

  var titik_awal = document.getElementById("select-ruangan-source").value;
  var titik_tujuan = document.getElementById(
    "select-ruangan-destination"
  ).value;

  if (source == null) {
    alert("Tentukan titik awal");
  } else if (destination == null) {
    alert("Tentukan titik tujuan");
  } else if (titik_awal == titik_tujuan) {
    alert("Titik tidak boleh sama!");
  } else {
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    });
    $.ajax({
      url: "/floyd-warshall/calculate",
      method: "post",
      data: {
        source: source,
        destination: destination,
      },
      dataType: "json",
      success: function (data) {
        $("#rute").val(data.data.rute);
        $("#jarak").val(data.data.jarak + " Meter");
        drawRoutes();

        // buat marker titik awal dan titik tujuan
        var mAwal = new google.maps.LatLng(
          data.data.marker_awal.latitude_awal,
          data.data.marker_awal.longitude_awal
        );
        var marker_awal = new google.maps.Marker({
          map: map,
          position: mAwal,
          label: {
            text: "Start",
            color: "white",
            fontWeight: "bold",
          },
        });

        var mTujuan = new google.maps.LatLng(
          data.data.marker_tujuan.latitude_tujuan,
          data.data.marker_tujuan.longitude_tujuan
        );
        var marker_tujuan = new google.maps.Marker({
          map: map,
          position: mTujuan,
          label: {
            text: "End",
            color: "white",
            fontWeight: "bold",
          },
        });
      },
      error: function () {
        console.log("Error 404");
      },
    });
  }
}

function drawRoutes() {
  $.ajax({
    url: "/floyd-warshall/hasil",
    method: "post",
    dataType: "json",
    success: function (data) {
      var koor = data.data;
      i = 0;
      var latitude = [];
      var longitude = [];

      $.each(koor, function (key1, value1) {
        $.each(value1, function (key2, value2) {
          $.each(value2, function () {
            latitude[i] = koor[key1][key2]["lat"];
            longitude[i] = koor[key1][key2]["lng"];
            i++;
          });
        });
      });

      $.each(latitude, function (key1, value1) {
        var poly = [];
        $.each(value1, function (key2) {
          var pos = new google.maps.LatLng(
            latitude[key1][key2],
            longitude[key1][key2]
          );
          poly.push(pos);
          var route = new google.maps.Polyline({
            path: poly,
            strokeColor: "#FF00AA",
            strokeWeight: 5,
          });
          route.setMap(map);
        });
      });
    },
    error: function () {
      console.log("Error 404");
    },
  });
}
