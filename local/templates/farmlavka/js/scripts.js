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

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector(this.getAttribute('href')).scrollIntoView({ behavior: 'smooth' });
  });
});

$(document).ready(function(){

  // кнопка вверх
  $('.wrapper-top__block').on('click', function(event){
  	event.preventDefault();
  	$('body,html').animate({
  		scrollTop: 0,
  		}, 700
  	);
  });

  // кнопка вниз
  $('.vector-bottom').on('click', function(event){
  	event.preventDefault();
  	$('body,html').animate({
  		scrollTop: $(document).height() - $(window).height(),
  		}, 700
  	);
  });

  // маска на телефон
  $('.phoneMask').mask('+7 (999) 999-99-99');

  // клик по поиску в шапке
  // $('.header__search__input-svg').click(function(){
  //   searchInputVal = $('.header__search__input').val();
  //   if (searchInputVal){
  //     formActive = $(this).parent().parent();
  //     if (formActive.hasClass('active')) $('.header__search__input__block').submit();
  //   }
  // });

  // фиксированная шапка
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100)
      $('.header').addClass('header_fixed');
    else
      $('.header').removeClass('header_fixed');
  });

  // отображение отзывов
  $('.reviewStars').change(function(){
    stars = $(this).val();
    $('.cnt_stars_'+stars).slideToggle();
  });

  // показать текст
  // $('.reviews__href').click(function(){
  //   event.preventDefault();
  //   $(this).parent().parent().find('.block_hide').slideToggle();
  // });

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
          // console.log(result);
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

  // восстановить пароль
  $(".formRestore").submit(function() {
    event.preventDefault();
		var form = $(this);
    login = form.find('input[name="phone"]').val();

    $.ajax({
        url: '/local/ajax/sendForm.php',
        type: 'post',
        data: { action: 'sendRestore', login: login },
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
    qnt = parseInt($('#basketCNT').val());
    qnt++;
    $('#basketCNT').val(qnt);
    $('.header__basket span').text(qnt);

    productID = $(this).attr('data-id');
    quantity = $(this).parent().find('.counter__numer').text();
    $(this).css({'background-color':'red'});

    // console.log(productID + ' ' + quantity);

    $.ajax({
        url: '/local/ajax/order.php',
        type: 'post',
        data: { action: 'cart_add', productID: productID, quantity: quantity },
        success: function (result) {
          console.log(result);
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
          setTimeout(() => {
            form.parent().find('.popup__close').trigger('click');
          }, 3000)
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
    text = form.find('textarea[name="text"]').val();
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
    productType = $(this).attr('data-type');

    if (productType == 'productCard') { // если карточка
      title = $('h1.main-title').text();
      image = $('.product-page .img-bl__big-img__block img').attr('src');
      price = $('.product-page .product-card__price').html();
    } else { // каталог
      productCard = $(this).parents('.product-card');
      title = productCard.find('.product-card__title').text();
      image = productCard.find('.product-card__img a img').attr('src');
      price = productCard.find('.product-card__price').html();
    }

    // заполним
    $('.buyOneSend').attr('data-id',productID);
    $('.buyOneSend').attr('data-price',productPrice);
    $('#oneClickName').text(title);
    $('#oneClickIMG').attr('src',image);
    $('#oneClickPrice').html(price);
    $.ajax({
        url: '/local/ajax/getInfo.php',
        type: 'post',
        data: { action: 'infoProduct', productID: productID },
        success: function (result) {
          // console.log(result)
          arResult = JSON.parse(result);
          // $('.buyOneSend').attr('data-id',productID);
          // $('.buyOneSend').attr('data-price',productPrice);
          // $('#oneClickName').text(arResult.NAME);
          // $('#oneClickIMG').attr('src',arResult.PICTURE);
          $('#oneClickRating').html(arResult.RATING);
          // $('#oneClickPrice').html(price);
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
        url: '/local/ajax/sendForm.php',
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
          blockResult.html(result);
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
  $('.menu_open').click(function(){
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
      $('.menu_open').removeClass('hover');
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
    $(this).hide().parent().find('.address__td__block__tell').css({'max-width':'100%'});
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

  // выбор аптеки
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

  // показ платежной системы при выборе склада
  var cityName = $('#cityName').val();
  var paySystemTetra = $('#paySystem_4');
  var paySystemSaidana = $('#paySystem_5');

  function paySystemShow(paySystem){
    if (paySystem == 2) {
      paySystemTetra.prop('checked', false).parent().hide();
      paySystemSaidana.parent().show();
    } else {
      paySystemSaidana.prop('checked', false).parent().hide();
      paySystemTetra.parent().show();
    }
  }

  if (cityName == 'Егорьевск')
    paySystemShow(2);
  else
    paySystemShow(1);

  $('input[name=STORE]').change(function(){
    // storeVal = $(this).val(); // console.log(storeVal);
    storeName = $(this).attr('data-name'); // console.log(storeName);
    switch(storeName){
      case 'Зелинского 6': paySystem = 2; break;
      case 'Коломенская 5В': paySystem = 2; break;
      case 'Ломоносова 107Б': paySystem = 2; break;
      case 'Менделеева 5': paySystem = 2; break;
      case 'Мкр.5-ый 16': paySystem = 2; break;
      case 'Победы 12': paySystem = 2; break;
      case 'Центральная 9А': paySystem = 2; break;
      default: paySystem = 1; break;
    }
    paySystemShow(paySystem);
  });
});

// переключение в модалке авторизации
$(document).on('click', '.btnAuth', function() {
  block = $(this).attr('data-block');
  $(this).parents('.popup-new__body').slideUp();
  $('#'+block).slideDown();
  console.log('click auth');
});

// показ пароля
$(document).on('click', '.password-control', function(){
  ourInput = $(this).parent().find('input');
  if (ourInput.attr('type') == 'password'){
    $(this).addClass('view');
    ourInput.attr('type', 'text');
  } else {
    $(this).removeClass('view');
    ourInput.attr('type', 'password');
  }
});

// выбор города в выпадающем списке
$(document).on('click', '.regions_vars', function(){
  $('.submitCity').trigger('click');
});

// клик по подсказкам поиска
$(document).on('click', '.search-popup-row-active', function()
{
  // elementText = $(this).find('.search-popup-el-name').text();
  header__search = $('.header__search');
  header__search_mobile = $('.header-mobile__menu');

  if (header__search.hasClass('active')) {
    // header__search.find('input[type=search]').val(elementText);
    header__search.find('.searchSend').trigger('click');
  }
  else if (header__search_mobile.hasClass('active')){
    // header__search_mobile.find('input[type=search]').val(elementText);
    header__search_mobile.find('.searchSend').trigger('click');
  }
});
