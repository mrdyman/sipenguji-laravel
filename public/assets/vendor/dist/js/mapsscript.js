var icon = "../assets/vendor/marker.png";

function initMap() {
  // display map
  var mapOptions = {
    center: { lat: -0.836261, lng: 119.893715 },
    zoom: 17,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
  };

  map = new google.maps.Map(document.getElementById("map"), mapOptions);

  google.maps.event.addListener(map, "click", function (event) {
    let latitude = event.latLng.lat();
    let longitude = event.latLng.lng();
    $("#latitude").val(latitude);
    $("#longitude").val(longitude);

    var marker = new google.maps.Marker({
      position: event.latLng,
      map: map,
      icon: icon,
    });
  });

  // getMarker
  getMarker();
}

function getMarker() {
  var link = "/";
  $.ajax({
    url: link + "getmarker",
    method: "get",
    dataType: "json",
    success: function (data) {
      for (var i = 0; i < data.length; i++) {
        displayMarker(data[i]);
      }
    },
  });
}

function displayMarker(data) {
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

  google.maps.event.addListener(marker, "click", function (event) {
    infowindow.setContent(content);
    infowindow.open(map, marker);
  });
}
