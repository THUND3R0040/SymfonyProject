const html = document.documentElement;
const body = document.body;
const menuLinks = document.querySelectorAll(".admin-menu a");
const collapseBtn = document.querySelector(".admin-menu .collapse-btn");
const toggleMobileMenu = document.querySelector(".toggle-mob-menu");
const switchInput = document.querySelector(".switch input");
const switchLabel = document.querySelector(".switch label");
const switchLabelText = switchLabel.querySelector("span:last-child");
const collapsedClass = "collapsed";
const lightModeClass = "light-mode";

/*TOGGLE HEADER STATE*/
collapseBtn.addEventListener("click", function () {
    body.classList.toggle(collapsedClass);
    this.getAttribute("aria-expanded") == "true"
        ? this.setAttribute("aria-expanded", "false")
        : this.setAttribute("aria-expanded", "true");
    this.getAttribute("aria-label") == "collapse menu"
        ? this.setAttribute("aria-label", "expand menu")
        : this.setAttribute("aria-label", "collapse menu");
});

/*TOGGLE MOBILE MENU*/
toggleMobileMenu.addEventListener("click", function () {
    body.classList.toggle("mob-menu-opened");
    this.getAttribute("aria-expanded") == "true"
        ? this.setAttribute("aria-expanded", "false")
        : this.setAttribute("aria-expanded", "true");
    this.getAttribute("aria-label") == "open menu"
        ? this.setAttribute("aria-label", "close menu")
        : this.setAttribute("aria-label", "open menu");
});

/*SHOW TOOLTIP ON MENU LINK HOVER*/
for (const link of menuLinks) {
    link.addEventListener("mouseenter", function () {
        if (
            body.classList.contains(collapsedClass) &&
            window.matchMedia("(min-width: 768px)").matches
        ) {
            const tooltip = this.querySelector("span").textContent;
            this.setAttribute("title", tooltip);
        } else {
            this.removeAttribute("title");
        }
    });
}

/*TOGGLE LIGHT/DARK MODE*/
if (localStorage.getItem("dark-mode") === "false") {
    html.classList.add(lightModeClass);
    switchInput.checked = false;
    switchLabelText.textContent = "Light";
}

switchInput.addEventListener("input", function () {
    html.classList.toggle(lightModeClass);
    if (html.classList.contains(lightModeClass)) {
        switchLabelText.textContent = "Light";
        localStorage.setItem("dark-mode", "false");
    } else {
        switchLabelText.textContent = "Dark";
        localStorage.setItem("dark-mode", "true");
    }
});

let title = document.querySelector(".title");
let container = document.getElementsByClassName("grid");

let dashboard = document.getElementById("dashboard");
dashboard.addEventListener("click", () => {
    title.textContent = "AdminDashboard";
    title.style.textAlign = "start";
    UpdatePage("/dashboardQueries");
});

let users = document.getElementById("user");
users.addEventListener("click", () => {
    console.log("users");
    title.textContent = "Users";
    title.style.textAlign = "center";
    container[0].innerHTML =
        "<article class='stats'>  <div class='swiper mySwiper'><div class='swiper-wrapper'></div></div></article>";
    UpdatePage("/usersQueries");
});

let sales = document.getElementById("sales");
sales.addEventListener("click", () => {
    title.style.textAlign = "start";
    title.textContent = "Sales";
    console.log("sales");
    UpdatePage("/salesQueries");
});

let products = document.getElementById("products");
products.addEventListener("click", () => {
    title.textContent = "Products";
    title.style.textAlign = "center";
    console.log("products");
    container[0].innerHTML =
        "<article class='stats'>  <div class='swiper mySwiper'><div class='swiper-wrapper'></div></div></article>";
    UpdatePage("/productsQueries");
});

let comments = document.getElementById("comments");
comments.addEventListener("click", () => {
    title.textContent = "Comments";
    title.style.textAlign = "start";
    UpdatePage("/commentsQueries");
});

//xmlhttprequest

const UpdatePage = (str) => {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", str,true);
    xhr.onload = function () {
        if (this.status === 200) {
            let response = JSON.parse(this.responseText);
            if(response['msg']==='dashboard'){
                console.log(response);
                container[0].innerHTML = response['html'];
                showCharts(response['income'],response['nbOrders']);
            }
            else if(response['msg']==="users"){
                console.log(response);
                document.querySelector(".swiper-wrapper").innerHTML = response['html'];
                showSwiper();
                selectDelete();
                showForm();
            }
            else if(response["msg"] === "sales"){
                container[0].innerHTML = response["html"];
                deleteSales();
            }
            else if(response["msg"] === "products"){
                document.querySelector(".swiper-wrapper").innerHTML = response["html"];
                showSwiper();
                productDeleteShow();
                productEditShow();
            }
            else if(response["msg"] === "comments"){
                container[0].innerHTML = response["html"];
                deleteComments();
            }
        }


        else{
            console.log("error");
        }
        }
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.send();
}



const deleteComments = () => {
    let deleteBtns = document.querySelectorAll(".deleteComment");
    deleteBtns.forEach((btn) => {
        btn.addEventListener("click", (e) => {
            let id =
                e.target.parentElement.parentElement.childNodes[1].childNodes[1]
                    .textContent;
            deleteComment(id);
        });
    });
};

const deleteComment = (id) => {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/admin/deleteComment", true);
    xhr.onload = function () {
        if (this.status === 200) {
            if (this.responseText === "success") {
                UpdatePage("comments");
            }
        } else {
            console.log("error");
        }
    };
    xhr.setRequestHeader("Content-type", "application/json");
    let msg = "id=" + id;
    xhr.send(msg);
};

let hiddenName = document.getElementById("hiddenName");
let updateProduct = document.querySelector(".editProductPopup");
const productEditShow = () => {
    let editBtns = document.querySelectorAll(".editProduct");
    editBtns.forEach((btn) => {
        btn.addEventListener("click", (e) => {
            let productName =
                e.target.nextElementSibling.childNodes[3].childNodes[1].textContent;
            hiddenName.value = productName;
            updateProduct.style.display = "flex";
        });
    });
};

let cancelProduct = document.querySelector(".cancelP");

cancelProduct.addEventListener("click", () => {
    updateProduct.style.display = "none";
    hiddenName.value = "";
    document.getElementById("nameP").value = "";
    document.getElementById("price").value = "";
    document.getElementById("type").value = "";
});

let saveProduct = document.querySelector(".saveP");

saveProduct.addEventListener("click", () => {
    let name = hiddenName.value;
    let newName = document.getElementById("nameP").value;
    let newPrice = document.getElementById("price").value;
    let newType = document.getElementById("type").value;
    updateProductInfo(name, newName, newPrice, newType);
    updateProduct.style.display = "none";
    hiddenName.value = "";
    document.getElementById("nameP").value = "";
    document.getElementById("price").value = "";
    document.getElementById("type").value = "";
});

const updateProductInfo = (name, newName, newPrice, newType) => {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/admin/updateProduct", true);
    xhr.onload = function () {
        if (this.status === 200) {
            if (this.responseText === "success") {
                UpdatePage("products");
            }
        } else {
            console.log("error");
        }
    };
    xhr.setRequestHeader("Content-type", "application/json");
    let msg =
        "name=" +
        name +
        "&newName=" +
        newName +
        "&newPrice=" +
        newPrice +
        "&newType=" +
        newType;
    xhr.send(msg);
};

const productDeleteShow = () => {
    let deleteBtns = document.querySelectorAll(".deleteProduct");
    deleteBtns.forEach((btn) => {
        btn.addEventListener("click", (e) => {
            let id =
                e.target.parentElement.previousElementSibling.childNodes[3]
                    .childNodes[1].textContent;
            deleteProduct(id);
        });
    });
};

const deleteProduct = (id) => {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/admin/deleteProduct", true);
    xhr.onload = function () {
        if (this.status === 200) {
            if (this.responseText === "success") {
                UpdatePage("products");
            }
        } else {
            console.log("error");
        }
    };
    xhr.setRequestHeader("Content-type", "application/json");
    let msg = "id=" + id;
    xhr.send(msg);
};

const deleteSale = (id) => {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/admin/deleteSale", true);
    xhr.onload = function () {
        if (this.status === 200) {
            if (this.responseText === "success") {
                UpdatePage("sales");
            }
        } else {
            console.log("error");
        }
    };
    xhr.setRequestHeader("Content-type", "application/json");
    let msg = "id=" + id;
    xhr.send(msg);
};

const deleteSales = () => {
    let salesDelete = document.querySelectorAll(".deleteSales");
    salesDelete.forEach((btn) => {
        btn.addEventListener("click", (e) => {
            let id =
                e.target.parentElement.parentElement.childNodes[1].childNodes[1].textContent.substr(
                    1
                );
            deleteSale(id);
        });
    });
};

let hidden = document.getElementById("hiddenEmail");

const showForm = () => {
    let updateBtns = document.querySelectorAll(".edit");
    updateBtns.forEach((btn) => {
        btn.addEventListener("click", (e) => {
            let email =
                e.target.nextElementSibling.childNodes[3].childNodes[3].textContent;
            hidden.value = email;
            updateForm.style.display = "flex";
        });
    });
};

let save = document.querySelector(".save");

save.addEventListener("click", () => {
    let email = hidden.value;
    let newEmail = document.getElementById("email").value;
    let newRole = document.getElementById("role").value;
    let newName = document.getElementById("name").value;
    updateUser(email, newEmail, newRole, newName);
    updateForm.style.display = "none";
    hidden.value = "";
    document.getElementById("email").value = "";
    document.getElementById("role").value = "";
    document.getElementById("name").value = "";
});

const deleteUser = (id) => {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/deleteUser", true);
    xhr.onload = function () {
        if (this.status === 200) {
                UpdatePage('/usersQueries');
        } else {
            console.log("error");
        }
    };
    xhr.setRequestHeader("Content-type", "application/json");
    let msg = JSON.stringify({
        userEmail:id
    });
    xhr.send(msg);
};

const selectDelete = () => {
    let deleteBtns = document.querySelectorAll(".delete");
    deleteBtns.forEach((btn) => {
        btn.addEventListener("click", (e) => {
            let id =
                e.target.parentElement.previousElementSibling.childNodes[3]
                    .childNodes[3].textContent;
            deleteUser(id);
        });
    });
};

let updateForm = document.querySelector(".popup");

let cancel = document.querySelector(".cancel");
cancel.addEventListener("click", () => {
    updateForm.style.display = "none";
    hidden.value = "";
    document.getElementById("email").value = "";
    document.getElementById("role").value = "";
    document.getElementById("name").value = "";
});

//email is not getting true value
const updateUser = (email, newEmail, newRole, newName) => {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/updateUser", true);
    xhr.onload = function () {
        if (this.status === 200) {
                UpdatePage("/usersQueries");
        } else {
            console.log("error");
        }
    };
    xhr.setRequestHeader("Content-type", "application/json");
    let msg = JSON.stringify({
        userEmail:email, newName: newName, newEmail:newEmail, newRole:newRole
    });

    xhr.send(msg);
};

const showCharts = (sales, nbOrders) => {
    const labels = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
    ];

    let ctx1 = document.getElementById("myChart1");

    const ctx = document.getElementById("myChart");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "# of Orders",
                    data: nbOrders,
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top",
                },

                title: {
                    display: true,
                    text: "Number of Orders",
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });

    const data = {
        labels: labels,
        datasets: [
            {
                label: "$ per month",
                data: sales,
                borderColor: "blue",
            },
        ],
    };

    const config = {
        type: "line",
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top",
                },
                title: {
                    display: true,
                    text: "Sales/Revenues",
                },
            },
        },
    };

    new Chart(ctx1, config);
};

const showSwiper = () => {
    const swiper = new Swiper(".mySwiper", {
        grabCursor: true,
        effect: "creative",
        creativeEffect: {
            prev: {
                shadow: true,
                translate: [0, 0, -400],
            },
            next: {
                translate: ["100%", 0, 0],
            },
        },
    });
};
