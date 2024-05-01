

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
    var src = "../mainPage/index.php";
    var a = $("<a/>").attr("href", src);
    $(".logo2").wrap(a);
});


$(document).ready(function () {
    var src1 = "../mainPage/index.php";
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



let a3;
let b = 0;
let grey2 = document.querySelector(".grey2");
let cart_close = document.querySelector("#cart_close")
let cart = document.querySelector(".cart");




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
            not_found.style.display = "none";
            cart.style.width = "0vw";


            grey2.style.display = "none";
            cart_close.style.display = "none";
            cart_full.style.display = "none";
            cart_full.style.display = "none";
            nbr.style.display = "none";
            // total.style.display="none";
        }
    })


}







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






$(function () {
    $("#accordion").accordion();
});














let not_found = document.querySelector(".not_found");
let cart_full = document.querySelector(".cart_full");
let nbr = document.querySelector(".nbr");
let checkout = document.querySelector(".checkout");



 checkout.addEventListener("click", () => {
    let price = document.querySelector(".money").innerHTML;
    let nbItems = document.querySelector(".num").innerHTML;
    window.location.href = `checkout.php?price=${price}&nbItems=${nbItems}`;
});



const sendXmlHttpRequest = (name) => {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'removeFromCart.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            if (xhr.responseText == "u need to login") {
                window.location.href = "../login/login.php";
            }
        }
    };
    let data = "productName=" + name;
    xhr.send(data);
}





setInterval(() => {
    let remove_item = document.querySelectorAll(".remove-btn");
    let cart_items = document.querySelectorAll(".cart_items");
    let cartNames = document.querySelectorAll(".cart-price");
    for (let t = 0; t < remove_item.length; t++) {
        remove_item[t].addEventListener("click", () => {
            cart_items[t].remove();
            sendXmlHttpRequest(cartNames[t].innerHTML);
        })
    }
}, 10)




setInterval(function () {
    let remove_item = document.querySelectorAll(".remove-btn");
    let total = document.querySelector(".total");
    let numb = remove_item.length;
    let num = document.querySelector(".num");
    num.innerHTML = numb;
    if (numb == 0) {
        total.style.display = "none";
        checkout.style.display = "none";
    }
    else {
        total.style.display = "flex";
        checkout.style.display = "flex";
    }
}, 1);


setInterval(function () {
    let money = document.querySelector(".money");
    let cart_price = document.querySelectorAll(".cart-quantity");
    let total = 0;
    for (let i = 0; i < cart_price.length; i++) {
        total += parseInt(cart_price[i].innerHTML);


    }

    money.innerHTML = `${total}$`;


}, 1);

let prices;
let btn;
let names;


let kidClicked = 0;
let manClicked = 0;
let womenClicked = 0;
let everyoneClicked = 1;




const get = () => {


    kid.click(function () {
        man.fadeOut();
        women.fadeOut();
        kidClicked = 1;
        manClicked = 0;
        womenClicked = 0;
        everyoneClicked = 0;
        cartUi();
    });


    man.click(function () {
        kid.fadeOut();
        women.fadeOut();
        manClicked = 1;
        kidClicked = 0;
        womenClicked = 0;
        everyoneClicked = 0;
        cartUi();
    });

    women.click(function () {
        man.fadeOut();
        kid.fadeOut();
        womenClicked = 1;
        kidClicked = 0;
        manClicked = 0;
        everyoneClicked = 0;
        cartUi();
    });


    let everyone = document.querySelector(".typed");
    let inpt = document.querySelector(".inpt");



    everyone.addEventListener("click", () => {
        everyoneClicked = 1;
        kidClicked = 0;
        manClicked = 0;
        womenClicked = 0;
        man.fadeIn();
        women.fadeIn();
        kid.fadeIn();
        cartUi();

    });




    inpt.addEventListener("change", () => {
        cartUi();
    });



    cartUi();


}

function renderProducts() {
    return new Promise(resolve => {
        let genre = "everyone";
        if (kidClicked == 1) {
            genre = "kid";
        } else if (manClicked == 1) {
            genre = "man";
        } else if (womenClicked == 1) {
            genre = "women";
        }

        let inptValue = inpt.value;
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'filter.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                container1.innerHTML = this.response;
                resolve();
            }
        };
        let data = "filter=" + inptValue + "&genre=" + genre;
        xhr.send(data);
    });
}




let span3;
let container1 = document.querySelector(".container1");


let kid = $(".kid");
let man = $(".man");
let women = $(".women");







const cartUi = async () => {
    await renderProducts();
    btn = document.querySelectorAll(".glow-on-hover");


    for (let i = 0; i < btn.length; i++) {
        btn[i].addEventListener('click', (e) => {
            addToCart(e.target.parentElement.childNodes[5].innerHTML);
            let span1 = document.createElement("img");
            let div = document.createElement("div");
            let span2 = document.createElement("span");
            let span5 = document.createElement("span");
            let span3 = document.createElement("span");
            let span4 = document.createElement("button");
            let icon = document.createElement("i");
            icon.classList = "fas";
            div.classList = "c-div";
            span5.classList = "c-note";
            icon.classList.add("fa-trash-alt");
            span3.innerHTML = `${e.target.parentElement.childNodes[7].innerHTML}`;
            span2.innerHTML = `${e.target.parentElement.childNodes[5].innerHTML}`;
            span5.innerHTML = `${e.target.parentElement.childNodes[15].value}`;
            span1.src = `${e.target.parentElement.childNodes[13].value}`;
            span1.classList = "cart-item";
            span2.classList = "cart-price";
            span3.classList = "cart-quantity";
            span4.appendChild(icon);
            span4.classList = "remove-btn";
            let cart_item = document.createElement("div");
            cart_item.appendChild(span1);
            div.appendChild(span2);
            div.appendChild(span5);
            div.appendChild(span3);
            cart_item.appendChild(div);
            cart_item.appendChild(span4);
            cart_full.appendChild(cart_item);
            cart_item.classList = "cart_items";
        }
        );
    }


};


get();




function addToCart(id) {
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure the AJAX request
    xhr.open('POST', 'cart.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            // Request was successful, handle response if needed
            if (xhr.responseText == "u need to login") {
                window.location.href = "../login/login.php";

            }
            console.log(xhr.status);
        } else {
            // Request failed
            console.error('Request failed with status ' + xhr.status);
        }
    };

    // Prepare the data to send
    let data = 'product_id=' + id;
    // Send the AJAX request
    xhr.send(data);
}












let swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    spaceBetween: 30,
    effect: "fade",
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    loop: true,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
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

btt.addEventListener("click", topFunction);
