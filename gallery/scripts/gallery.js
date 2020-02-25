const $modal = $("#modal");
const $bigImage = $("#big-image");

$(".small-image").click(function (e) {
    e.preventDefault();
    $bigImage.attr('src', `img/big/${e.target.getAttribute('alt')}`);
    $modal.fadeIn("slow", function () {
    });
});

$modal.click(function () {
    $modal.fadeOut("fast", function () {
    });
});