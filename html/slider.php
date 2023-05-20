<div class="slider-contain">
    <div class="slider">
        <img src="../img/jpg/bg-desenfocado.webp" alt="">
        <img src="../img/jpg/bg-miscelanea.jpg" alt="">
        <img src="../img/jpg/seccion-comics.jpg" alt="">
    </div>
    <button class="prev-button slider-button">&lt;</button>
    <button class="next-button slider-button">&gt;</button>
</div>

<script>
    const slider = document.querySelector(".slider");
    const slides = Array.from(slider.getElementsByTagName("img"));
    const prevButton = document.querySelector(".prev-button");
    const nextButton = document.querySelector(".next-button");

    let currentSlideIndex = 0;
    let timer;

    function showNextSlide() {
        slides[currentSlideIndex].classList.remove("active");
        currentSlideIndex = (currentSlideIndex + 1) % slides.length;
        slides[currentSlideIndex].classList.add("active");
    }

    function showPreviousSlide() {
        slides[currentSlideIndex].classList.remove("active");
        currentSlideIndex = (currentSlideIndex - 1 + slides.length) % slides.length;
        slides[currentSlideIndex].classList.add("active");
    }

    function startSlider() {
        timer = setInterval(showNextSlide, 2000);
    }

    function stopSlider() {
        clearInterval(timer);
    }

    nextButton.addEventListener("click", () => {
        stopSlider();
        showNextSlide();
        startSlider();
    });

    prevButton.addEventListener("click", () => {
        stopSlider();
        showPreviousSlide();
        startSlider();
    })
    
    startSlider();

</script>