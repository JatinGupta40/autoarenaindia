(function ($, Drupal) {
    Drupal.behaviors.autoplayvideo = {
      attach: function (context, settings) {
        let sideFirstVideo = document.querySelector(".news_video_left video");
        sideFirstVideo.muted="true";
        sideFirstVideo.play();
      },
    };
})(jQuery, Drupal);