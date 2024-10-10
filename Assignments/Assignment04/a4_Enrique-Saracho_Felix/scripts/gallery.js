$(function () {
  let gallery = $("#image-gallery");

  for (let i = 0; i < 8; i++) {
    let random = Math.round(Math.random() * 16);
    let image = $("<img>")
      .attr("src", "images/photo" + random + ".jpg")
      .attr("tabindex", "0")
      .attr("aria-haspopup", "true")
      .attr("aria-controls", "expand");
    gallery.append(image);
  }
  let images = $("#image-gallery img");
  console.log(images);

  $("#image-gallery img").on("click", function (event) {
    var clickedImage = $(event.target).attr("src");
    $(".expand").append($('<img src="' + clickedImage + '"/>'));
    $(".expand").fadeIn();
  });

  $("#image-gallery img").on("keydown", function (event) {
    if (event.key === "Enter") {
      if (!$(".expand").is(":visible")) {
        var clickedImage = $(event.target).attr("src");
        $(".expand").append($('<img src="' + clickedImage + '"/>'));
        $(".expand").fadeIn();
      } else {
        $(".expand").fadeOut();
        $(".expand").children().first().remove();
      }
    }
  });

  $(".expand").on("click", function () {
    $(".expand").fadeOut();
    $(".expand").children().first().remove();
  });

  $("#image-gallery img").on("keydown", function (event) {
    let i = images.index(this);
    if (event.key === "ArrowRight") {
      images.eq((i + 1) % 8).focus();
   }
   if (event.key === "ArrowLeft") {
      images.eq((i - 1) % 8).focus();
    }
  });
});
