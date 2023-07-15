<?php
function getSliderImages($directory) {
    $files = scandir($directory);
    foreach ($files as $file) {
        if (is_file($directory . "/" . $file)) {
            echo '<img src="' . $directory . "/" . $file . '" alt="">';
        }
    }
}
?>

<div class="slider-contain">
    <div class="slider">
        <?php getSliderImages($directory); ?>
    </div>
    <button class="prev-button slider-button"><i class="fa-solid fa-chevron-left"></i></button>
    <button class="next-button slider-button"><i class="fa-solid fa-chevron-right"></i></button>
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
        timer = setInterval(showNextSlide, 5000);
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
