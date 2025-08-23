const sideVideo = document.querySelectorAll(".exclusive-videos");
  sideVideo.forEach((video) => {
    video.addEventListener("mousemove", (e) => {
      let source = video.src.replace("autoplay=0","autoplay=1");
      let newSource = source.replace("start=0&rel=0","mute=1&enablejsapi=1") 
      video.src = newSource;
//      console.log(source);
    });
    
    video.addEventListener("mouseout", (e) => {
      let source = video.src.replace("autoplay=1","autoplay=0");
      video.src = source
    })
  });