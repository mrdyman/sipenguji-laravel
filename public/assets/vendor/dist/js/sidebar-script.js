//sidebar Dashboard
var title = $("#title").html();
if (title == "SIPENGUJI | Dashboard") {
  $(".side-title-home").addClass("active");
} else if (title == "SIPENGUJI | Polyline") {
  $(".side-title-polyline").addClass("active");
} else if ((title = "SIPENGUJI | Floyd Warshall")) {
  $(".side-title-floyd-warshall").addClass("active");
}

// sidebar mahasiswa
var title = $("#title").html();
if (title == "SIPENGUJI | Mahasiswa") {
  $(".side-title-data-mahasiswa").addClass("active");
  $(".side-title-floyd-warshall").removeClass("active");
  $(".side-title-polyline").removeClass("active");
  $(".side-title-home").removeClass("active");
  $(".dashboard").removeClass("menu-open");
} else if (title == "SIPENGUJI | Biodata") {
  $(".side-title-biodata").addClass("active");
  $(".side-title-floyd-warshall").removeClass("active");
  $(".side-title-polyline").removeClass("active");
  $(".side-title-home").removeClass("active");
  $(".dashboard").removeClass("menu-open");
}
