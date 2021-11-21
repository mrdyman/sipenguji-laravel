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
      console.log(data);
    },
    error: function () {
      console.log("Error 404");
    },
  });
}
