function initMap() {
  var mapOptions = {
    center: { lat: -0.836261, lng: 119.893715 },
    zoom: 17,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
  };

  // tampilkan maps
  map = new google.maps.Map(document.getElementById("map"), mapOptions);

  // google.maps.event.addListener(map, "click", function (event) {
  //   if (sambung_titik == true) {
  //     if (tempattitik == 0) {
  //       alert("Tentukan Titik Awal!");
  //     } else {
  //       tempattitik[0] = garisx.getPath();
  //       tempattitik.push(event.latLng);
  //       console.log(tempattitik);

  //       poly.push(event.latLng.lat() + "," + event.latLng.lng());
  //       console.log(poly);
  //     }
  //   } else {
  //     alert("Posisi Kordinat : " + event.latLng);
  //   }
  // });
  var bounds = new google.maps.LatLngBounds();
}
