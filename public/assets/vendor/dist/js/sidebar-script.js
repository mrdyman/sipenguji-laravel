var title = $("#title").html();
if (title == "SIPENGUJI | Dashboard") {
  $(".side-title-home").addClass("active");
} else if (title == "SIPENGUJI | Polyline") {
  $(".side-title-polyline").addClass("active");
} else if ((title = "SIPENGUJI | Floyd Warshall")) {
  $(".side-title-floyd-warshall").addClass("active");
}
