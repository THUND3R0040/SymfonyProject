

//reload page when click on logo
logo.addEventListener("click", () => {
    location.reload();
});

logo2.addEventListener("click", () => {
    location.reload();
});


//slider

var swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    centeredSlides: true,
    spaceBetween: 0,
    loop: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});





// type thing
let typed = new Typed('.second', {
    strings: ["Explore our new arrivals"],
    typeSpeed: 100,
    startDelay: 0,
    showCursor: false,

});






//faq section
const questions = document.querySelectorAll(".accordion_item");
questions.forEach(question => question.addEventListener("click", () => {
    const currentAnswer = question.querySelector(".answer");
    if (currentAnswer.classList.contains("openAnswer")) {
        currentAnswer.classList.remove("openAnswer");

    }
    else {
        let open = document.querySelectorAll(".openAnswer");
        if (open.length !== 0) {
            open[0].classList.remove("openAnswer");
        }
        currentAnswer.classList.add("openAnswer");
    }
}));
