   $('.slick').slick({
        dots: true,
        infinite: true,
        autoplay: true,
        speed: 1000,
        dotsClass: 'slider-dots',
        fade: true,
        swipeToSlide:true,
        autoplaySpeed: 5000,
        arrows: false,
    })
    $('.slick-feedback').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        speed: 2000,
        prevArrow: `<div class="feedback-prev">
        <svg width="19" height="33" viewBox="0 0 19 33" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M17 30.0571L3 16.0571L17 2.05713" stroke-width="4" stroke-linecap="round"/>
        </svg>
        </div>`,
        nextArrow: `<div class="feedback-next">
        <svg width="19" height="33" viewBox="0 0 19 33" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M2 2.05713L16 16.0571L2 30.0571" stroke-width="4" stroke-linecap="round"/>
        </svg>
        </div>`,
    });
    const cartButton = document.querySelector('.shopping-cart');
    const offcanvas = document.getElementById('cartOffcanvas');
    cartButton.addEventListener('click', function() {
        
        offcanvas.classList.add('active');
    });
    const cartbtnclose=document.querySelector('.btn-close')
    cartbtnclose.addEventListener('click', function() {
        offcanvas.classList.toggle('active');
   });
   function increase() {
    var element = document.getElementById("amount");
    var value = parseInt(element.textContent);
    element.textContent = value + 1;
}

function decrease() {
    var element = document.getElementById("amount");
    var value = parseInt(element.textContent);
    if(value >0){
    element.textContent = value - 1;}
}



// Lấy đối tượng ô Liên hệ

