window.addEventListener('scroll', function () {
    let header = document.querySelector('header');
    let bar = document.querySelector(".fa-bars");
    let img = document.querySelector("#img");
    let img2 = document.querySelector("#img2");
    let cart = document.querySelector(".fa-shopping-cart");
    let windowPosition = window.scrollY > 0;
    header.classList.toggle('scrolling-active', windowPosition);
    bar.classList.toggle('black', windowPosition);
    cart.classList.toggle('black', windowPosition);
    if (windowPosition) {
        img.src = "assets/productPage/logos/logo.png";
        img2.src = "assets/productPage/logos/logo.png";
    }
    if (!windowPosition) {
        img.src = "assets/productPage/logos/basketv3.png";
        img2.src = "assets/productPage/logos/basketv3.png";
    }

})