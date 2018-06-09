$('[data-fancybox-video]').fancybox({
  afterShow: function() {
    const video = document.querySelector(this.src);
    video.play();
  },
  beforeClose: function() {
    const video = document.querySelector(this.src);
    video.pause();
  }
});
