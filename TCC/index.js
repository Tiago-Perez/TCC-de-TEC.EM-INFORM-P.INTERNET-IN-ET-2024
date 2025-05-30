const showMenu = (toggleId, navId) =>{
    const toggle = document.getElementById(toggleId),
          nav = document.getElementById(navId)
 
    toggle.addEventListener('click', () =>{
        
        nav.classList.toggle('show-menu')

        toggle.classList.toggle('show-icon')
    })
 }
 
 showMenu('nav-toggle','nav-menu')


/*=============== CARROSSEL DE IMAGENS ===============*/

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlides(n) {
    showSlides(slideIndex += n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) { slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for ( i = 0; i < slides.length; i++){
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++){
        dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += "active";

}

/*=============== NOME DA PÁGINA ===============*/

let docTitile = document.title;
window.addEventListener("blur", () =>{
    document.title = "Volte Aqui 😠";
})
window.addEventListener("focus", () =>{
    document.title = docTitile;
})



/*=============== BOTÃO PARA IR PARA AS RECEITAS ===============*/


let irAteReceita = document.querySelector('#irAteReceita');

irAteReceita.addEventListener('click', function(){
    window.location.href = 'receita/receita.php'
})


/*=============== MODAL ===============*/

// Obtém o modal
var modal = document.getElementById("privacy-modal");

// Obtém o botão que abre o modal
var btn = document.getElementById("open-modal");

// Obtém o elemento <span> que fecha o modal
var span = document.getElementsByClassName("modal-close")[0];

// Quando o usuário clicar no botão, abre o modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// Quando o usuário clicar em <span> (x), fecha o modal
span.onclick = function() {
    modal.style.display = "none";
}

// Quando o usuário clicar em qualquer lugar fora do modal, fecha-o
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}