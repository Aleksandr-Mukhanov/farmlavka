function setCookie(cookieName, elementID, headerID) {
  if ($.cookie(cookieName)) {
    comparison = $.cookie(cookieName);
    arCookie = comparison.split('-');
    var cntHeader = $('#' + headerID).text();
    // console.log(arCookie);
    if ($.inArray(elementID, arCookie) == -1) { // добавление в избранное
      // console.log('add');
      cookieValue = comparison + '-' + elementID;
      cntHeader++;
    } else { // удаление из избранного
      // console.log('del');
      cookieValue = '';
      cntHeader--;
      $.each(arCookie, function (key, val) {
        if (val != elementID) {
          if (cookieValue == '') cookieValue = val;
          else cookieValue = cookieValue + '-' + val;
        }
      });
    }
  } else {
    cookieValue = elementID;
    cntHeader = 1;
  }
  // console.log(cookieValue);
  if (cookieValue != '')
    $.cookie(cookieName, cookieValue, { expires: 30, path: '/' });
  else
    $.removeCookie(cookieName, { path: '/' });

  $('#' + headerID).text(cntHeader); // обновим в шапке
}

$(document).ready(function(){

  // маска на телефон
  $('.phoneMask').mask('+7 (999) 999-99-99');

  // клик по поиску в шапке
  $('.header__search__input-svg').click(function(){
    formActive = $(this).parent().parent();
    if (formActive.hasClass('active')) $('.header__search__input__block').submit();
  });

  // показать текст
  $('.reviews__href').click(function(){
    event.preventDefault();
    $(this).parent().parent().find('.block_hide').slideToggle();
  });

  // отправка промокода
  $(".promo-code__search").submit(function() {
    event.preventDefault();
		var form = $(this);
    promo = form.find('input[name="promo"]').val();

    $.ajax({
        url: '/local/ajax/sendForm.php',
        type: 'post',
        data: { action: 'sendPromo', promo: promo },
        success: function (result) {
          console.log(result);
          arResult = JSON.parse(result);
          if (arResult.result == 'no') alert('Промокод не найден!');
          else location.href = '/basket/';
        }
    });
	});

  // авторизация
  $(".formAuth").submit(function() {
    event.preventDefault();
		var form = $(this);
    login = form.find('input[name="phone"]').val();
    password = form.find('input[name="password"]').val();

    $.ajax({
        url: '/local/ajax/sendForm.php',
        type: 'post',
        data: { action: 'sendAuth', login: login, password: password },
        success: function (result) {
          // console.log(result);
          resultAuth = JSON.parse(result);
          if (resultAuth.TYPE == 'ERROR') alert(resultAuth.MESSAGE);
          else location.reload();
        }
    });
	});

  // регистрация
  $(".formReg").submit(function() {
    event.preventDefault();
		var form = $(this);
    login = form.find('input[name="phone"]').val();
    password = form.find('input[name="password"]').val();
    passwordConfirm = form.find('input[name="password_confirm"]').val();

    $.ajax({
        url: '/local/ajax/sendForm.php',
        type: 'post',
        data: { action: 'sendReg', login: login, password: password, passwordConfirm: passwordConfirm },
        success: function (result) {
          // console.log(result);
          resultAuth = JSON.parse(result);
          if (resultAuth.TYPE == 'ERROR') alert(resultAuth.MESSAGE);
          else location.reload();
        }
    });
	});

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
  $('.cartAdd').click(function(){
    header__basket = $('.header__basket span');
    qnt = header__basket.text();
    qnt++;
    header__basket.text(qnt);

    productID = $(this).attr('data-id');
    quantity = $(this).parent().find('.counter__numer').text();
    $(this).css({'background-color':'red'});

    // console.log(productID + ' ' + quantity);

    $.ajax({
        url: '/local/ajax/order.php',
        type: 'post',
        data: { action: 'cart_add', productID: productID, quantity: quantity },
        success: function (result) {
          // console.log(result);
          // form.html(result);
        }
    });
  });

  // повтор заказа
  $('.orderRepeat').click(function(){
    event.preventDefault();
    arProductID = $(this).attr('data-id').split(',');
    for (var key in arProductID) {
      productID = arProductID[key];
      quantity = 1;
      $.ajax({
        url: '/local/ajax/order.php',
        type: 'post',
        data: { action: 'cart_add', productID: productID, quantity: quantity },
        success: function (result) {
          // console.log(result);
          // form.html(result);
        }
      });
    }
    location.href = '/basket/';
  });

  // отмена заказа
  $('.orderCancel').click(function(){
    event.preventDefault();
    orderID = $(this).attr('data-id');
    $.ajax({
      url: '/local/ajax/order.php',
      type: 'post',
      data: { action: 'orderCancel', orderID: orderID },
      success: function (result) {
        // console.log(result);
        // form.html(result);
      }
    });
    location.href = '/lk/';
  });

  // изменение в корзине
  $('.cartEdit').click(function(){
    action = $(this).attr('data-action');
    productID = $(this).parents('.b-order').attr('data-id');
    quantity = $(this).parent().find('.counter__numer').text();
    $.ajax({
        url: '/local/ajax/order.php',
        type: 'post',
        data: { action: action, productID: productID, quantity: quantity },
        success: function (result) {
          // console.log(result);
          location.reload();
        }
    });
  });

  // открытие видео в блоке
  $('.video_play').click(function(){
    $('.modal_video').fadeIn();
  });

  // отправка формы
  $(".sendForm").submit(function() {
    event.preventDefault();
		var form = $(this);
    title = form.attr('data-title');
    name = form.find('input[name="name"]').val();
    phone = form.find('input[name="phone"]').val();

    topic = form.find('input[name="topic"]').val();
    email = form.find('input[name="email"]').val();
    text = form.find('input[name="text"]').val();

    $.ajax({
        url: '/local/ajax/sendForm.php',
        type: 'post',
        data: {
          action: 'sendForm',
          title: title,
          name: name,
          phone: phone,
          topic: topic,
          email: email,
          text: text
        },
        success: function (result) {
          // console.log(result);
          form.html(result);
        }
    });
	});

  // оценка отзыва
  $('.reviewScore .star-small').click(function(){
    score = $(this).attr('data-id');
    $(".sendReview").find('input[name="score"]').val(score);

    $('.reviewScore .star-small').each(function (index, value) {
      if (index < score) $(this).removeClass('star-big__minus');
      else $(this).addClass('star-big__minus');
    });
  });

  // отправка отзыва
  $(".sendReview").submit(function() {
    event.preventDefault();
		var form = $(this);
    name = form.find('input[name="name"]').val();
    email = form.find('input[name="email"]').val();
    text = form.find('input[name="text"]').val();
    score = form.find('input[name="score"]').val();
    city = form.find('input[name="city"]').val();

    $.ajax({
        url: '/local/ajax/sendForm.php',
        type: 'post',
        data: {
          action: 'sendReview',
          name: name,
          email: email,
          text: text,
          score: score,
          city: city,
        },
        success: function (result) {
          // console.log(result);
          form.html(result);
        }
    });
	});

  // лайк отзыва
  $(".reviewLike").click(function() {
    event.preventDefault();
    id = $(this).parent().attr('data-id');
    type = $(this).attr('data-type');

    $.ajax({
        url: '/local/ajax/sendForm.php',
        type: 'post',
        data: {
          action: 'reviewLike',
          id: id,
          type: type,
        },
        success: function (result) {
          console.log(result);
          location.reload();
          // form.html(result);
        }
    });
	});

  // покупка в один клик
  $('.buyOneClick').click(function(){
    productID = $(this).attr('data-id');
    productPrice = $(this).attr('data-price');
    price = $(this).parents('.product-card').find('.product-card__price').html();
    // console.log(productID);
    $.ajax({
        url: '/local/ajax/getInfo.php',
        type: 'post',
        data: { action: 'infoProduct', productID: productID },
        success: function (result) {
          arResult = JSON.parse(result);
          // console.log(arResult);
          $('.buyOneSend').attr('data-id',productID);
          $('.buyOneSend').attr('data-price',productPrice);
          $('#oneClickName').text(arResult.NAME);
          $('#oneClickIMG').attr('src',arResult.PICTURE);
          $('#oneClickRating').html(arResult.RATING);
          $('#oneClickPrice').html(price);
        }
    });
  });

  $('.buyOneSend').click(function(){
    event.preventDefault();
    productID = $(this).attr('data-id');
    buyOneName = $('#buyOneName').val();
    buyOnePhone = $('#buyOnePhone').val();
    quantity = $('#oneClickQuantity').text();
    oneClickName = $('#oneClickName').text();
    oneClickPrice = $(this).attr('data-price');
    blockResult = $(this).parent().parent();
    $.ajax({
        url: '/local/ajax/order.php',
        type: 'post',
        data: {
          action: 'buyOne',
          productID: productID,
          buyOneName: buyOneName,
          buyOnePhone: buyOnePhone,
          quantity: quantity,
          oneClickName: oneClickName,
          oneClickPrice: oneClickPrice,
        },
        success: function (result) {
          // console.log(result);
          blockResult.text(result);
        }
    });
  });

  // в избранное
  $('.addFavorites').click(function(){
    elementID = $(this).attr('data-id');
    cookieName = $(this).attr('data-cookie');
    setCookie(cookieName, elementID, 'cntFavorites');
    $(this).toggleClass('active');
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

  // показ меню
  $('.header__catalog').click(function(){
    event.preventDefault();

    submenu = $(this).attr('data-submenu');
    $('.submenu-'+submenu).show().siblings().hide();

    if ($(this).hasClass('hover'))
    {
      $(this).removeClass('hover');
      $('.medicine__section').removeClass('hover');
    }
    else
    {
      $('.header__catalog').removeClass('hover');
      $(this).toggleClass('hover');
      $('.medicine__section').addClass('hover');
    }
  });

  // оформление заказа
  $('.ch-delivery__button').click(function(){
    event.preventDefault();
    if(!$(this).hasClass('active'))
    {
      $('.ch-delivery__button').removeClass('active');
      $(this).addClass('active');
      $('.blockDelivery').slideToggle();
      delivery = $(this).attr('data-id');
      $('#deliveryID').val(delivery);

      type = $(this).attr('data-type');
      if (type == 'pickup') $('input[type=submit]').prop('disabled',true);
      else $('input[type=submit]').prop('disabled',false);
    }
  });
  // выбор складов
  $('input[name=STORE]').change(function(){
    if(!$(this).hasClass('store-disabled'))
      $('input[type=submit]').prop('disabled',false);
  });

  // Дополнительная инфомация по адресу
  $('.showAddInfo').click(function(){
    event.preventDefault();
    $('.delivery__add_info').slideToggle();
  });

  // показать номер самовывоза
  $('.address__td-show').click(function(){
    $(this).parent().find('.address__td__block__tell').css({'max-width':'100%'});
  });

  // Наличие в аптеках
  $('.store_avail').click(function(){
    event.preventDefault();
    $(this).siblings().removeClass('active');
    avail = $(this).attr('data-avail');
    if (avail != 'all')
    {
      $('.address__tr__body').slideUp();
      $('.available_'+avail).slideDown();
    }
    else
      $('.address__tr__body').slideDown();
  });

  // выбор апетки
  $('.store-disabled').click(function(){
    arProduct = $(this).attr('data-product').split(',');
    console.log(arProduct);
    $('.store-avail').show();
    arProduct.forEach(function(element, key){
    	console.log(key + ': ' + element);
      $('#store-avail-'+element).hide(); // скроем доступные
    });
    $("html, body").animate({
      "scrollTop": $('.ch-order__table').offset().top
    }, "slow");
    $('#modalOutStock').show();
  });
});

// выбор города в выпадающем списке
$(document).on('click', '.regions_vars', function(){
  $('.submitCity').trigger('click');
});

// клик по результату посика
$(document).on('click', '.search-popup-row-active', function(){
  $('.header__search__input__block').submit();
});
