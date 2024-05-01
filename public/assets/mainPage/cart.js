
// buy stuff
let prix = document.querySelectorAll(".prix");
let total = document.querySelector(".total");
let names = document.querySelectorAll(".name");
let pros = document.querySelectorAll(".pro");
let note = document.querySelectorAll(".note");
let btn = document.querySelectorAll(".button");
let not_found = document.querySelector(".not_found");
let cart_full = document.querySelector(".cart_full");
let nbr = document.querySelector(".nbr");
let checkout = document.querySelector(".checkout");



/*
for(let i = 0;i < btn.length;i++){
    console.log(i);
    btn[i].addEventListener("click",()=>{
        console.log(i);
        
        let span1 = document.createElement("img");
        let div = document.createElement("div");
        let span2 = document.createElement("span");
        let span5 = document.createElement("span");
        let span3 = document.createElement("span");
        let span4 = document.createElement("button");
        let icon = document.createElement("i");
        icon.classList = "fas";
        div.classList="c-div";
        span5.classList="c-note";
        icon.classList.add("fa-trash-alt");
        span3.innerHTML=`${prix[i].innerHTML}$`;
        span2.innerHTML = `${names[i].innerHTML}`;
        span5.innerHTML = `${note[i].innerHTML}`;
        span1.src = `${pros[i].src}`;
        span1.classList ="cart-item";
        span2.classList ="cart-price";
        span3.classList ="cart-quantity";
        span4.appendChild(icon);
        span4.classList="remove-btn";
        let cart_item = document.createElement("div");
        cart_item.appendChild(span1);
        div.appendChild(span2);
        div.appendChild(span5);
        div.appendChild(span3);
        cart_item.appendChild(div);
        cart_item.appendChild(span4);
        cart_full.appendChild(cart_item);
        cart_item.classList="cart_items";
        let remove_item = document.querySelectorAll(".remove-btn");
        let cart_items = document.querySelectorAll(".cart_items");
        for (let i = 0; i < remove_item.length; i++) {
            remove_item[i].addEventListener("click", () => {
                cart_items[i].remove();
            })

        }

       
        
    })

}*/
// fix el faza mte3 kif tenzel 3la zouz last items matejjemch t3awed tenzel 3al 1st item using 
// foreach . and create arrays with the items and then use only the index u need without the for loop
function ft(i) {
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
    span3.innerHTML = `${prix[i].innerHTML}$`;
    span2.innerHTML = `${names[i].innerHTML}`;
    span5.innerHTML = `${note[i].innerHTML}`;
    span1.src = `${pros[i].src}`;
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

    console.log(i);

}

setInterval(() => {
    let remove_item = document.querySelectorAll(".remove-btn");
    let cart_items = document.querySelectorAll(".cart_items");
    for (let t = 0; t < remove_item.length; t++) {
        remove_item[t].addEventListener("click", () => {
            cart_items[t].remove();
        })
    }
}, 10)




setInterval(function () {
    let remove_item = document.querySelectorAll(".remove-btn");
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

    money.innerHTML = `${total} $`;


}, 1);






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
