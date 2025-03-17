const tl = gsap.timeline();


tl.to(".login-container", {
    opacity: 1,
    duration: 0.2,
})

tl.to(".header", {
    opacity: 1,
    duration: 0.1,
}, "+=1")

tl.to(".username-area", {
    opacity: 1,
    duration: 0.1,
}, "+=0.5")
tl.to(".email-area", {
    opacity: 1,
    duration: 0.1,
},"+=0.5")
tl.to(".password-area", {
    opacity: 1,
    duration: 0.1,
}, "+=0.5")

tl.to(".remember-me-area", {
    opacity: 1,
    duration: 0.1,
}, "+=0.5")

tl.to(".button-area", {
    opacity: 1,
    duration: 0.1,
}, "+=0.5")

tl.to(".forgot-password-area", {
    opacity: 1,
    duration: 0.1,
}, "+=0.5")

tl.to(".sign-up-area", {
    opacity: 1,
    duration: 0.1,
}, "+=0.5");

