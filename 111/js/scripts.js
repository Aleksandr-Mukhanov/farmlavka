$(document).ready(function(){
  // количество
  $('.counter__minus').click(function(){
    counter__numer = $(this).parent().find('.counter__numer');
    qnt = counter__numer.text();
    if (qnt > 1) qnt--;
    counter__numer.text(qnt);
  });
  $('.counter__plus').click(function(){
    counter__numer = $(this).parent().find('.counter__numer');
    qnt = counter__numer.text();
    qnt++;
    counter__numer.text(qnt);
  });

  // в корзину
  $('.button.counter__butten').click(function(){
    header__basket = $('.header__basket span');
    qnt = header__basket.text();
    qnt++;
    header__basket.text(qnt);
  });

  $('.pp-button-block__link').click(function(){
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
  });

  $('.b-order__delete').click(function(){
    $(this).parent().parent().slideUp();
  });

  $('.b-order__clear').click(function(){
    $('.b-main__left__items').slideUp();
  });
});
