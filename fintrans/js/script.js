let navbar = document.querySelector('.header .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
}

window.onscroll = () =>{
    navbar.classList.remove('active');
}

document.querySelectorAll('input[type="number"]').forEach(inputNumber =>{
  inputNumber.oninput = () =>{
    if(inputNumber. value.length > inputNumber.maxLength) inputNumber.Value
    = inputNumber.Value.slice(0, inputNumber.maxLength);
};
});