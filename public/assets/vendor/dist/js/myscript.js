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

    var icon = "../assets/vendor/marker.png";
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
  var link = location.href;
  $.ajax({
    url: link + "getmarker",
    method: "get",
    dataType: "json",
    success: function (data) {
      console.log(data);
    },
  });
}

function displayMarker() {}
