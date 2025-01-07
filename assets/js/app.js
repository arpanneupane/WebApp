document.addEventListener('DOMContentLoaded', () => {
  const videos = document.querySelectorAll('.video');
  const options = {
    root: null,
    rootMargin: '0px',
    threshold: 0.5
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        stopAllVideos();
        entry.target.play();
      } else {
        entry.target.pause();
      }
    });
  }, options);

  videos.forEach(video => {
    observer.observe(video);
  });

  function stopAllVideos() {
    videos.forEach(video => video.pause());
  }
});
