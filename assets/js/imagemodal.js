$(document).on("click", ".image-preview", function () {
    var modal = $("#imageModal");
    var modalImg = $("#imgModal");
    var modalCaption = $("#modal-caption");
    modalImg.attr("data-src", this.src);
    modalImg.attr("src", "postimage.php?id=" + $(this).attr("value") + "&placeholder");
    modalImg.removeClass("lazyloaded").addClass('lazyload');
    modalCaption.html("<a href=\"postimage.php?id=" + $(this).attr("value") + "\" target=\"_blank\">Xem ảnh gốc</a>");
    modal.show();
})

$(document).on("click", ".close-img-modal", function () {
    $("#imageModal").hide();
})

$(document).on("click", "#imageModal", function (e) {
    var elem = $(e.target).attr('id');
    if (elem != 'imgModal') {
        $("#imageModal").hide();
    }
});