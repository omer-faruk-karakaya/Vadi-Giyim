let animOpening = gsap.timeline();

animOpening.to(".mainPageIntro", {
    y: -900,
    delay: 1,
  });
  
animOpening.to(".inner-div", {
    opacity: 1,
    duration: 2
});
