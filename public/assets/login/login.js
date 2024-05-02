//scroll thingy
window.addEventListener('scroll', function () {
    let header = document.querySelector('header');
    let bar = document.querySelector(".fa-bars");
    let img = document.querySelector("#img");
    let img2 = document.querySelector("#img2");

    let windowPosition = window.scrollY > 0;
    header.classList.toggle('scrolling-active', windowPosition);
    bar.classList.toggle('black', windowPosition);
    
    if (windowPosition) {
        img.src = "assets/logos/logo.png";
        img2.src = "assets/logos/logo.png";
    }
    if (!windowPosition) {
        img.src = "assets/logos/basketv3.png";
        img2.src = "assets/logos/basketv3.png";
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
let a = 0;
let grey = document.querySelector(".grey");

//reload page when click on logo
$(document).ready(function () {
    var src = "../mainPage";
    var a = $("<a/>").attr("href", src);
    $(".logo2").wrap(a);
});


$(document).ready(function () {
    var src1 = "../mainPage";
    var a1 = $("<a/>").attr("href", src1);
    $(".logo").wrap(a1);
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
        grey.style.display = "block";
        a = 1;
    }
})

//hide it

let x = 0;
console.log(x);

close.addEventListener("click", function () {
    if (a == 1) {
        a = 0;
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
        href4.style.display = "none";
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








function myFunction(media) {
    if (media.matches) { // If media query matches
        a = 0;
        phone.style.width = "0vw";
        close.style.display = "none";
        href1.style.display = "none";
        href2.style.display = "none";
        href4.style.display = "none";
        bar.style.display = "block";
        header.style.pointerEvents = "auto";
        grey.style.display = "none";
        

    }
}

var media1 = window.matchMedia("(min-width: 831px)")
myFunction(media1) // Call listener function at run time
media1.addListener(myFunction)








$(function () {
    $("#accordion").accordion();
});





let signin = document.querySelector(".sign-in");
let h1 = document.querySelector(".fr2 h1");
let inp = document.querySelectorAll(".inputWithIcon");
let no = document.querySelector(".sign-up");
let test = 0;


    
   

signin.addEventListener("click",()=>{
    if(test==0){
    h1.innerHTML="Login";
    inp[0].style.display="none";
    signin.innerHTML="Sign Up";
    no.innerHTML="Sign In";
    no.setAttribute("name","signin");
    no.style.marginTop="20px";
    test=1;
}
    
    


else{
    
        h1.innerHTML = "Create Account";
        inp[0].style.display = "block";
        signin.innerHTML = "Sign In";
        no.innerHTML = "Sign Up";
        no.style.marginTop = "10px";
        test=0;
        no.setAttribute("name","signup");

}
});
    

   





let btt = document.querySelector(".btt");


window.onscroll = function () { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
        btt.classList.add("show");
    } else {
        btt.classList.remove("show");
    }
}

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

btt.addEventListener("click",topFunction);





let sm = document.querySelectorAll(".sm");
let dd = document.querySelectorAll(".dd");

for (let i = 0; i < dd.length; i++) {
    $(document).ready(function () {
        $(sm[i]).mouseover(function () {
            $(dd[i]).css("color", "black");
            $(dd[i]).css("font-size", "30px");
        });
    });

    $(document).ready(function () {
        $(sm[i]).mouseout(function () {
            $(dd[i]).css("color", "white");
            $(dd[i]).css("font-size", "26px");
        });
    });
}



let activation_alert =  document.querySelector('.activation-alert');
let notActiveAlert = document.querySelector('.notActiveAlert');
let invalidMailOrPassword = document.querySelector('.invalidMailOrPassword');