const tooltipTriggerList = document.querySelectorAll(
  '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
  (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);

//  Bannar Image Show
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#Blogbanner_1').attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}

// Thumbnails Show
function showPreview(event) {
  if (event.target.files.length > 0) {
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("file-ip-1-preview");
    preview.src = src;
    preview.style.display = "block";
  }
}



$("document").ready(function () {
  'use strict';
  
  $(".toggle-icon").on('click', function () {
    $(".menu-items").addClass("open");
    $(this).hide();
    $(".crose-icon").show();
  })
  $(".crose-icon").on('click', function () {
    $(".menu-items").removeClass("open");
    $(this).hide();
    $(".toggle-icon").show();
  })
});
