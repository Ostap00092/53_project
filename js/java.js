// ====WORK ANIMATION====
var slides = document.querySelectorAll('#mainHeaderImg .slide')
var currentSlide = 0;
var slideInterval = setInterval(nextSlide,4500);
function nextSlide() {
    slides[currentSlide].className = 'slide';
    currentSlide = (currentSlide+1)%slides.length;
    slides[currentSlide].className = 'slide showing';
}