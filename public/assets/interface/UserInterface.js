let p = document.querySelectorAll('.options p');
let inpt1 = document.querySelector('.inpt1');
let inpt2 = document.querySelector('.inpt2');
let inpt3 = document.querySelector('.inpt3');
let array = [1,0,0];


p[0].addEventListener('click', function(){
    if(array[0] == 0){
        array[0] = 1;
        array[1] = 0;
        array[2] = 0;
        p[0].style.backgroundColor = '#ffffff';
        p[1].style.backgroundColor = 'inherit';
        p[2].style.backgroundColor = 'inherit';
        inpt1.style.display = 'block';
        inpt2.style.display = 'none';
        inpt3.style.display = 'none';
    }
});


p[1].addEventListener('click', function(){
    if(array[1] == 0){
        array[0] = 0;
        array[1] = 1;
        array[2] = 0;
        p[0].style.backgroundColor = 'inherit';
        p[1].style.backgroundColor = '#ffffff';
        p[2].style.backgroundColor = 'inherit';
        inpt1.style.display = 'none';
        inpt2.style.display = 'block';
        inpt3.style.display = 'none';
    }
});


p[2].addEventListener('click', function(){
    if(array[2] == 0){
        array[0] = 0;
        array[1] = 0;
        array[2] = 1;
        p[0].style.backgroundColor = 'inherit';
        p[1].style.backgroundColor = 'inherit';
        p[2].style.backgroundColor = '#ffffff';
        inpt1.style.display = 'none';
        inpt2.style.display = 'none';
        inpt3.style.display = 'block';
    }
});



document.querySelector('.svg').addEventListener('click', function(){
    window.history.back();
});





let activation_alert =  document.querySelector('.activation-alert');