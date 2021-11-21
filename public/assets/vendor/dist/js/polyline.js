var polyline;
var tempPolyline;
var tempKoordinat = [];
var sambung_titik = false;
var selectedMarker = 0;
var polyKoordinat = [];
var srcToDes = [];

function mapListener() {
  $("#btn-start").on("click", function () {
    if (sambung_titik == false) {
      sambung_titik = true;
      document.getElementById("btn-start").innerHTML =
        "Processing... Click to STOP";
    } else {
      if (selectedMarker < 2) {
        alert("Proses belum selesai, refresh untuk reset!");
      } else {
        sambung_titik = false;
        document.getElementById("btn-start").innerHTML = "Start";
        addNewPolyline();
      }
    }
  });
  // display map
  var mapOptions = {
    center: { lat: -0.836261, lng: 119.893715 },
    zoom: 17,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
  };

  map = new google.maps.Map(
    document.getElementById("map_polyline"),
    mapOptions
  );

  var link = location.href;
  $.ajax({
    url: link + "getmarker",
    method: "get",
    dataType: "json",
    success: function (data) {
      for (var i = 0; i < data.length; i++) {
        addMarker(data[i]);
      }
    },
  });

  //maps listener
  google.maps.event.addListener(map, "click", function (event) {
    //masukkan data koordinat kedalam textarea
    $("#polyline_koordinat").val(polyKoordinat);

    var polylineSettings = {
      geodesic: true,
      strokeColor: "rgb(20, 120, 218)",
      strokeOpacity: 1.0,
      strokeWeight: 2,
      editable: true,
    };

    polyline = new google.maps.Polyline(polylineSettings);
    polyline.setMap(map);

    if (sambung_titik == true) {
      if (tempKoordinat == 0) {
        alert("Tentukan Titik Awal!");
      } else {
        tempKoordinat[0] = polyline.getPath();
        tempKoordinat.push(event.latLng);
        polyKoordinat.push(event.latLng.lat() + "," + event.latLng.lng());
      }
    }
  });
}

function displayPolyline() {
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });
  $.ajax({
    url: "/polyline/displayPolyline",
    method: "post",
    dataType: "json",
    success: function (data) {
      var koor = data;
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
          var garis = new google.maps.Polyline({
            path: poly,
            strokeColor: "#FF00AA",
            strokeWeight: 5,
          });
          garis.setMap(map);
        });
      });
    },
    error: function () {
      console.log("Error 404");
    },
  });
}

function addMarker(data) {
  var infowindow = new google.maps.InfoWindow();
  var content =
    '<div class="infoWindow"><strong>' +
    data.nama_ruangan +
    "</strong>" +
    "<br/>" +
    data.latitude +
    "<br/>" +
    data.longitude +
    "</div>";

  var position = new google.maps.LatLng(
    parseFloat(data.latitude),
    parseFloat(data.longitude)
  );

  var marker = new google.maps.Marker({
    map: map,
    icon: icon,
    position: position,
    title: data.name,
  });

  //marker listener
  google.maps.event.addListener(marker, "click", function (event) {
    // setting warna garis untuk menghubungkan 2 titik
    var tempPolylineSettings = {
      geodesic: true,
      strokeColor: "rgb(20, 120, 218)",
      strokeOpacity: 1.0,
      strokeWeight: 2,
      editable: true,
    };
    var indexLength = tempKoordinat.length;
    var indexLast = indexLength - 1;

    if (sambung_titik == true) {
      if (selectedMarker > 2) {
        alert("cuma boleh 2 titik! silahkan sambung ulang titiknya yah.");
        tempKoordinat = [];
      } else {
        selectedMarker += 1;
        srcToDes.push(data.id);
        polyKoordinat.push(event.latLng.lat() + "," + event.latLng.lng());
        if (tempKoordinat != 0) {
          alert("Titik Berhasil Disambuung!");
          tempPolyline = new google.maps.Polyline(tempPolylineSettings);
          tempPolyline.setMap(map);
          tempKoordinat.push(event.latLng);
        } else {
          tempPolyline = new google.maps.Polyline(tempPolylineSettings);
          tempPolyline.setMap(map);
          tempKoordinat = tempPolyline.getPath();
          tempKoordinat.push(event.latLng);
        }
      }
    } else {
      infowindow.setContent(content);
      infowindow.open(map, marker);
    }
  });
}

function addNewPolyline() {
  var polylineSettings = {
    geodesic: true,
    strokeColor: "rgb(20, 120, 218)",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    editable: true,
  };

  polyline = new google.maps.Polyline(polylineSettings);
  polyline.setMap(map);

  var finalPolyline = new google.maps.Polyline({
    path: tempKoordinat,
    strokeColor: "#FF00AA",
    strokeWeight: 5,
  });
  finalPolyline.setMap(map);

  // hitung jarak dari titik awal ke titik tujuan dari polyline yang akan ditambahkan
  // satuan jarak = Meter
  var jarak = google.maps.geometry.spherical.computeLength(
    finalPolyline.getPath()
  );

  // ambil data polyline
  var titik_awal = srcToDes[0];
  var titik_tujuan = srcToDes[1];
  var mJalur = titik_awal + "-" + titik_tujuan;
  var mKoordinat = polyKoordinat;
  var mJarak = jarak;

  // jalankan ajax untuk simpan polyline ke database
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });
  $.ajax({
    url: location.href + "polyline",
    method: "post",
    data: {
      tAwal: titik_awal,
      tTujuan: titik_tujuan,
      jalur: mJalur,
      koordinat: mKoordinat,
      jarak: mJarak,
    },
    dataType: "json",
    success: function (data) {
      console.log(data);
      location.href = "/";
      alert("Polyline berhasil ditambahkan!");
    },
    error: function () {
      console.log("have an error!");
    },
  });

  //? reset variable
  tempKoordinat = [];
  srcToDes = [];
}
