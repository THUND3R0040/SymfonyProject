//scroll thingy
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
        img.src = "/assets/mainPage/logo.png";
        img2.src="/assets/mainPage/logo.png";
    }
    if(!windowPosition){
        img.src = "/assets/mainPage/basketv3.png";
        img2.src = "/assets/mainPage/basketv3.png";
    }
    
})





let logo = document.querySelector(".logo");
let logo2 = document.querySelector(".logo2");
let navbar = document.querySelector(".navbar");
let a1 = document.getElementById("a1");
let a2 = document.querySelector("#a2");
let a4 = document.querySelector("#a4")
let phone = document.querySelector(".phone");
let para = document.querySelector(".para");
let bar = document.querySelector("#bar");
let href1 = document.querySelector("#href1");
let href2 = document.querySelector("#href2");
let href4 = document.querySelector("#href4");
let close = document.querySelector("#close");
let header = document.querySelector("header");
let a=0;
let grey = document.querySelector(".grey");

//reload page when click on logo
logo.addEventListener("click",()=>{
    location.reload();
});

logo2.addEventListener("click", () => {
    location.reload();
});

// function of bar to show it and hide it


bar.addEventListener("click", () => {
    if (a == 0) {
      
        phone.style.width = "60vw";
        href1.style.display = "block";
        href2.style.display = "block";
        href4.style.display = "block";
        header.style.pointerEvents = "none";
        bar.style.display = "none";
        close.style.display = "block";
        grey.style.display="block";
        a=1;
    }})
        
    //hide it

close.addEventListener("click", function(){
    if (a == 1) {
        a=0;
        phone.style.width = "0vw";
        close.style.display = "none";
        href1.style.display = "none";
        href2.style.display = "none";
        href4.style.display = "none";
        bar.style.display = "block";
        header.style.pointerEvents = "auto";
        grey.style.display = "none";
    }
       
    })
    

grey.addEventListener("click", () => {
    if (a == 1) {
        a = 0;
        phone.style.width = "0vw";
        close.style.display = "none";
        href1.style.display = "none";
        href2.style.display = "none";
        href4.style.display="none";
        bar.style.display = "block";
        header.style.pointerEvents = "auto";
        grey.style.display = "none";
    }
    else if (a == 0) {
        phone.style.width = "60vw";
        href1.style.display = "block";
        href2.style.display = "block";
        href4.style.display = "block";
        header.style.pointerEvents = "none";
        bar.style.display = "none";
        close.style.display = "block";
        grey.style.display = "block";
        a = 1;
    }
})
    

        
let a3;
let b = 0;
let grey2 = document.querySelector(".grey2");
let cart_close = document.querySelector("#cart_close")
let cart = document.querySelector(".cart");




function myFunction(media) {
    if (media.matches) { // If media query matches
        a=0;
        phone.style.width = "0vw";
        close.style.display = "none";
        href1.style.display = "none";
        href2.style.display = "none";
        href4.style.display = "none";
        bar.style.display = "block";
        header.style.pointerEvents = "auto";
        grey.style.display = "none";
        a3 = document.querySelector("#a3");
        a3.addEventListener("click", () => {
            if (b == 0) {
                b = 1;
                cart.style.width = "80vw";
                grey2.style.display = "block";
                cart_close.style.display = "block";
                not_found.style.display = "block";
                cart_full.style.display = "flex";
                nbr.style.display = "flex";
               // total.style.display = "flex";

            }
        })

        cart_close.addEventListener("click", () => {
            if (b == 1) {
                b = 0;
                cart.style.width = "0vw";
                grey2.style.display = "none";
                cart_close.style.display = "none";
                not_found.style.display = "none";
                cart_full.style.display = "none";
                nbr.style.display = "none";
             //   total.style.display = "none";
            }
        })

        grey2.addEventListener("click", () => {
            if (b == 1) {
                b = 0;
                cart.style.width = "0vw";
                
                grey2.style.display = "none";
                cart_close.style.display = "none";
                not_found.style.display = "none";
                cart_full.style.display = "none";
                nbr.style.display = "none";
              //  total.style.display = "none";
            }
        })


    }
}

var media1 = window.matchMedia("(min-width: 831px)")
myFunction(media1) // Call listener function at run time
media1.addListener(myFunction)






function myFunction2(media2) {
    if (media2.matches) { // If media query matches
        a3 = document.querySelector("#mb");
        


        a3.addEventListener("click", () => {
            if (b == 0) {
                b = 1;
                
                cart.style.width = "80vw";
                grey2.style.display = "block";
                cart_close.style.display = "block";
                not_found.style.display = "block";
                cart_full.style.display = "flex";
                nbr.style.display = "flex";
               // total.style.display = "flex";
            }
        })

        cart_close.addEventListener("click", () => {
            if (b == 1) {
                b = 0;
                
                cart.style.width = "0vw";
                grey2.style.display = "none";
                cart_close.style.display = "none";
                cart_full.style.display = "none";
                not_found.style.display = "none";
                nbr.style.display = "none";
               // total.style.display = "none";
            }
        })

        grey2.addEventListener("click", () => {
            if (b == 1) {
                b = 0;
                cart.style.width = "0vw";
                
                grey2.style.display = "none";
                cart_close.style.display = "none";
                cart_full.style.display = "none";
                not_found.style.display = "none";
                nbr.style.display = "none";
               // total.style.display = "none";
            }
        })

}
}
var media2 = window.matchMedia("(max-width: 831px)")
myFunction(media2) // Call listener function at run time
media2.addListener(myFunction2)







if (window.matchMedia("(min-width: 831px)").matches) {
    /* the view port is at least 831 pixels wide */
    a3 = document.querySelector("#a3");
    a3.addEventListener("click", () => {
        if (b == 0) {
            b = 1;
            cart.style.width = "80vw";
            
            not_found.style.display = "block";
            cart_full.style.display = "flex";
            grey2.style.display = "block";
            cart_close.style.display = "block";
            nbr.style.display = "flex";
           // total.style.display = "flex";
        }
    })

    cart_close.addEventListener("click", () => {
        if (b == 1) {
            b = 0;
            cart.style.width = "0vw";
            
            grey2.style.display = "none";
            not_found.style.display = "none";
            cart_close.style.display = "none";
            cart_full.style.display = "none";
            nbr.style.display = "none";
           // total.style.display = "none";
        }
    })

    grey2.addEventListener("click", () => {
        if (b == 1) {
            b = 0;
            cart.style.width = "0vw";
            
            grey2.style.display = "none";
            cart_close.style.display = "none";
            not_found.style.display = "none";
            cart_full.style.display = "none";
            nbr.style.display = "none";
           // total.style.display = "none";
        }
    })


} else {
    /* the view port is less than 831 pixels wide */
    a3 = document.querySelector("#mb");
    
    

    a3.addEventListener("click", () => {
        if (b == 0) {
            b = 1;
            cart.style.width = "80vw";
            
            not_found.style.display = "block";
            grey2.style.display = "block";
            cart_close.style.display = "block";
            cart_full.style.display = "flex";
            nbr.style.display = "flex";
           // total.style.display = "flex";
        }
    })

    cart_close.addEventListener("click", () => {
        if (b == 1) {
            b = 0;
            cart.style.width = "0vw";
            
            grey2.style.display = "none";
            cart_close.style.display = "none";
            not_found.style.display = "none";
            cart_full.style.display = "none";
            nbr.style.display = "none";
           // total.style.display = "none";
        }
    })

    grey2.addEventListener("click", () => {
        if (b == 1) {
            b = 0;
            not_found.style.display="none";
            cart.style.width = "0vw";
            
            
            grey2.style.display = "none";
            cart_close.style.display = "none";
            cart_full.style.display = "none";
            cart_full.style.display = "none";
            nbr.style.display="none";
           // total.style.display="none";
        }
    })


}



 



    






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
