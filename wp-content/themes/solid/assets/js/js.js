jQuery(function($) {
  //Loader

  setTimeout(function (){
    $('.loader').fadeOut(400);
  },500)

  //Window width

  let winWid = $(window).width();

  $(window).on('resize', function (){
    winWid = $(window).width();
  })

  // Lazy load

  $('.lazy').lazy();

  //SCROLL MENU

  $('#primary-menu li a').addClass('scroll-to');

  $(document).on('click', '.scroll-to', function (e) {
    e.preventDefault();

    let href = $(this).attr('href');

    $('html, body').animate({
      scrollTop: $(href).offset().top
    }, 1000);

  });

  //Fixed Menu

  $(document).scroll(function() {

    let y = $(this).scrollTop();

    if (y > 1) {
      $('header').addClass('fixed');
    } else {
      $('header').removeClass('fixed');
    }
  });

  let positionScrolHeader = $(window).scrollTop();

  $(window).scroll(function() {

    let scroll = $(window).scrollTop();

    if(scroll > positionScrolHeader) {

      if ( $('.main-nav.open-menu').length ){
        $('header').addClass('fixed-vis');
      }else{
        $('header').removeClass('fixed-vis');
      }


    } else {
      $('header').addClass('fixed-vis');

    }

    positionScrolHeader = scroll;
  });

  //Curses Menu

  if ( $('.header-courses').length ){
    $('#mob-btn').on('click', function (e){
      e.preventDefault();

      $(this).toggleClass('active');

      $('.header-courses nav').toggleClass('active');

      $('html').toggleClass("fixedPosition");

    })

    $('.header-courses nav a').on('click', function (){
      $('.header-courses nav').removeClass('active');
      $('#mob-btn').removeClass('active');
      $('html').removeClass("fixedPosition");
    })
  }

  //Info circle

  if ( $('.courses-info .white-part').length ){
    let circleH = $('.courses-info .white-part')
  }
  // Teacher Slider

  if ( $('.teachers').length ){

    $('.teachers').each(function (){

      let thisTeachers = $(this);

      let thisTeacherSlider = thisTeachers.find('.teachers-slider');
      let thisTeacherPrevSlider = thisTeachers.find('.teacher-previews-slider');

      let btnTeacherPrev = thisTeachers.find('.teachers-slider-wrapper .control.prev');
      let btnTeacherNext = thisTeachers.find('.teachers-slider-wrapper .control.next');

      let btnMore = thisTeacherSlider.find('.description-list .toggle-content');
      let moreContainer = thisTeacherSlider.find('.description-list .more-wrapper');

      thisTeacherSlider.slick({
        autoplay: false,
        autoplaySpeed: 5000,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        adaptiveHeight: true,
        asNavFor: thisTeacherPrevSlider

      });

      thisTeacherPrevSlider.slick({
        autoplay: false,
        autoplaySpeed: 5000,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: false,
        vertical: true,
        focusOnSelect: true,
        verticalSwiping: true,
        asNavFor: thisTeacherSlider,
        responsive: [
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 1,
              verticalSwiping: false,
              vertical: false,
              fade: true,
            }
          }
        ]

      });

      btnTeacherPrev.click(function(e){
        e.preventDefault();

        thisTeacherSlider.slick('slickPrev');
        thisTeacherPrevSlider.slick('slickPrev');
      });

      btnTeacherNext.click(function(e){
        e.preventDefault();

        thisTeacherSlider.slick('slickNext');
        thisTeacherPrevSlider.slick('slickNext');
      });

      btnMore.on('click', function (e){
        e.preventDefault();

        btnMore.fadeOut(400);

        setTimeout(function (){
          moreContainer.slideDown(400);
        }, 500)


      })
    })
  }

  //Infographic Slider

  if ( $('#infographic-slider').length ){


    /*$('.odometer').html(123)*/

    /*let counters = $(".infographic-slider .item .name");
    let countersQuantity = counters.length;
    let counter = [];

    for (let i = 0; i < countersQuantity; i++) {
      counter[i] = parseInt(counters[i].innerHTML);
    }

    let count = function(start, value, id) {
      let localStart = start;
      setInterval(function() {
        if (localStart < value) {
          localStart++;
          counters[id].innerHTML = localStart;
        }
      }, 10);
    }

    for (let j = 0; j < countersQuantity; j++) {
      count(0, counter[j], j);
    }*/

    if( winWid > 767 ){
      $('#infographic-slider').slick({
        autoplay: false,
        autoplaySpeed: 5000,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        responsive: [
          {
            breakpoint: 767,
            settings: {
              adaptiveHeight: true,
            }
          }
        ]

      });

      $('.infographic-wrapper .prev').click(function(e){
        e.preventDefault();

        $('#infographic-slider').slick('slickPrev');
      });

      $('.infographic-wrapper .next').click(function(e){
        e.preventDefault();

        $('#infographic-slider').slick('slickNext');
      });
    }
  }

  //Main Course Slider

  if ( $('.team-slider').length ){

    $('.team-slider').slick({
      autoplay: true,
      infinite: true,
      autoplaySpeed: 5000,
      slidesToShow: 3,
      waitForAnimate: false,
      cssEase: 'linear',
      speed: 100,
      variableWidth: true,
      pauseOnFocus: false,
      pauseOnHover: false,
      arrows: false,
      asNavFor: '.team-slider-navigation, .prev-slide',
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 1,
            variableWidth: false,
            fade: true,
          }
        }
      ]
    });

    $('.team-slider-navigation').slick({
      autoplay: true,
      infinite: true,
      autoplaySpeed: 5000,
      slidesToShow: 4,
      speed: 100,
      slidesToScroll: 1,
      focusOnSelect: true,
      pauseOnFocus: false,
      pauseOnHover: false,
      arrows: false,
      asNavFor: '.team-slider, .prev-slide'
    });

    $('.team-slider-navigation-wrapper .prev').click(function(e){
      e.preventDefault();

      $('.team-slider').slick('slickPrev');
      $('.team-slider-navigation').slick('slickPrev');
    });

    $('.team-slider-navigation-wrapper .next').click(function(e){
      e.preventDefault();

      $('.team-slider').slick('slickNext');
      $('.team-slider-navigation').slick('slickNext');
    });

  }

  //Free Class Slider

  if( $('.free-class-slider').length ){

    if( winWid < 769 ){
      $('.free-class .info').each(function (){
        $(this).removeClass('second-up, third-up, fourth-up, fifth-up, animate')
      })
      $('.free-class-slider').each(function (){

        let thisSlider = $(this);

        thisSlider.slick({
          autoplay: false,
          autoplaySpeed: 5000,
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: true,
          arrows: false,
          adaptiveHeight: true,
          fade: false
        });

      })
    }

  }

  //Course Info Slider & Advanced Slider

  if ( $('.courses-info').length ){

    if ( winWid < 515 ){

      $('.courses-info').each(function (){

        let thisInfo = $(this);

        let thisInfoSlider = thisInfo.find('.mono-list');

        let btnInfoPrev = thisInfo.find('.content .inner .control.prev');
        let btnInfoNext = thisInfo.find('.content .inner .control.next');

        thisInfoSlider.slick({
          autoplay: false,
          autoplaySpeed: 5000,
          slidesToShow: 1,
          slidesToScroll: 1,
          rows: 3,
          dots: true,
          arrows: false,
          adaptiveHeight: true,
          fade: true
        });

        btnInfoPrev.click(function(e){
          e.preventDefault();

          thisInfoSlider.slick('slickPrev');
        });

        btnInfoNext.click(function(e){
          e.preventDefault();

          thisInfoSlider.slick('slickNext');
        });

        let dotInfoWid = thisInfo.find('.content .inner .slick-dots').width();

        dotInfoWid = dotInfoWid + 30;

        btnInfoPrev.css({'transform' : 'translateX('+(-dotInfoWid/2)+'px)'});
        btnInfoNext.css({'transform' : 'translateX('+(dotInfoWid/2)+'px)'});

      })
    }

    if ( winWid < 481 ){

      $('.courses-info').each(function (){

        let thisInfo = $(this);

        let thisAdvancedSlider = thisInfo.find('.advanced-slider');

        let btnAdvancedPrev = thisInfo.find('.color-part .control.prev');
        let btnAdvancedNext = thisInfo.find('.color-part .control.next');

        thisAdvancedSlider.slick({
          autoplay: false,
          autoplaySpeed: 5000,
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: true,
          arrows: false,
          adaptiveHeight: true,
          fade: true
        });

        btnAdvancedPrev.click(function(e){
          e.preventDefault();

          thisAdvancedSlider.slick('slickPrev');
        });

        btnAdvancedNext.click(function(e){
          e.preventDefault();

          thisAdvancedSlider.slick('slickNext');
        });

        let dotAdvancedWid = thisInfo.find('.content .inner .slick-dots').width();

        dotAdvancedWid = dotAdvancedWid + 30;

        btnAdvancedPrev.css({'transform' : 'translateX('+(-dotAdvancedWid/2)+'px)'});
        btnAdvancedNext.css({'transform' : 'translateX('+(dotAdvancedWid/2)+'px)'});

      })

    }
  }

  //Topic Slider

  if ( $('.course-topics').length ){

    function courseTopicsSlider(){
      $('.course-topics').each(function (){

        let thisTopic = $(this);

        let thisSlider = thisTopic.find('.topic-list');

        let btnPrev = thisTopic.find('.control.prev');
        let btnNext = thisTopic.find('.control.next');

        thisSlider.slick({
          autoplay: false,
          autoplaySpeed: 5000,
          slidesToShow: 1,
          slidesToScroll: 1,
          rows: 5,
          dots: true,
          arrows: false,
          adaptiveHeight: true,
          fade: true
        });

        btnPrev.click(function(e){
          e.preventDefault();

          thisSlider.slick('slickPrev');
        });

        btnNext.click(function(e){
          e.preventDefault();

          thisSlider.slick('slickNext');
        });

        let dotWid = thisTopic.find('.slick-dots').width();

        dotWid = dotWid + 30;

        btnPrev.css({'transform' : 'translateX('+(-dotWid/2)+'px)'});
        btnNext.css({'transform' : 'translateX('+(dotWid/2)+'px)'});

      })
    }

    if ( winWid < 769 ){

      courseTopicsSlider();
    }
  }

  //Reviews Slider

  if ( $('.reviews').length ){

    $('#reviews-prev-slider').slick({
      autoplay: true,
      autoplaySpeed: 15000,
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows: false,
      vertical: true,
      focusOnSelect: true,
      verticalSwiping: true,
      asNavFor: '#reviews-slider',
      responsive: [
        {
          breakpoint: 992,
          settings: {
            vertical: false,
            verticalSwiping: false,
          }
        }
      ]

    });

    $('#reviews-slider').slick({
      autoplay: true,
      autoplaySpeed: 15000,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      asNavFor: '#reviews-prev-slider',
      responsive: [
        {
          breakpoint: 767,
          settings: {
            adaptiveHeight: true,
          }
        }
      ]

    });

    $('.reviews-prev-slider-wrapper .prev').click(function(e){
      e.preventDefault();

      $('#reviews-slider').slick('slickPrev');
      $('#reviews-prev-slider').slick('slickPrev');
    });

    $('.reviews-prev-slider-wrapper .next').click(function(e){
      e.preventDefault();

      $('#reviews-slider').slick('slickNext');
      $('#reviews-prev-slider').slick('slickNext');
    });

  }

  //Custom Footer Bg Color

  if ( $('.contacts').length ){
    let footerBgColor = $('.contacts').css('backgroundColor');

    $('.site-footer').css({'background-color' : footerBgColor});
  }

  //Custom Header Bg Color

  if ( $('.course-main-screen').length ){
    let headerBgColor = $('.course-main-screen').css('backgroundColor');

    /*console.log(headerBgColor);*/

    if ( headerBgColor != 'rgba(0, 0, 0, 0)' ){
      $('.header-courses').css({'background-color' : headerBgColor});
    }


  }

  //Video Modal

  $('.play-btn').on('click', function (e) {
    e.preventDefault();

    let youVideoId = $(this).attr('data-vidioid');
    let videoUrl = $(this).attr('data-videourl');

    $('#videoModal').modal("show");

    $('#videoModal .video').html('<iframe src="https://www.youtube-nocookie.com/embed/'+youVideoId+'?rel=0&autoplay=1&autohide=1&border=0&wmode=opaque&enablejsapi=1"></iframe>');


  $('#videoModal').on('show.bs.modal', function (e) {

    $("iframe").each(function() {
      jQuery(this)[0].contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*')
    });
  });

  $('#videoModal').on('hidden.bs.modal', function (e) {
    $("#videoModal iframe").each(function() {
      $(this)[0].contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*')});
    $('#videoModal .video').html('');
  });



  if (videoUrl != ''){
    $('#videoModal .video').html('<video src="'+videoUrl+'" controls></video>');
    $('#videoModal .video video').get(0).play();
  }

  });



  // PHONE MASK



  const themeUrl = window.location.href;

  $('input[type=tel]').each(function (){
    const thisTelInput = $(this);

    thisTelInput.intlTelInput({
      utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.3/build/js/utils.js",
      /*utilsScript: themeUrl+'wp-content/themes/solid/assets/js/utils.js',*/
      preferredCountries: ["ua"],
      separateDialCode: true,
      hiddenInput: true,
    });

    $.fn.forceNumbericOnly = function() {
      return this.each(function() {
        $(this).keydown(function(e) {
          var key = e.charCode || e.keyCode || 0;
          return (key == 8 || key == 9 || key == 46 || (key >= 37 && key <= 40) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 107 || key == 109 || key == 173 || key == 61);
        });
      });
    };

    thisTelInput.attr('maxlength', 9);

    /*let thisPlaceholder = '';

    function phoneConversion(){

      setTimeout(() =>{

        thisPlaceholder = thisTelInput.attr('placeholder').replaceAll(' ', '').length;

        if ( thisPlaceholder < 10 || thisPlaceholder > 10 ){
          thisTelInput.attr('maxlength', thisPlaceholder);
        }

      },800);
    }*/

    /*phoneConversion();*/


    /*thisTelInput.prev().on('click', function (){
      thisTelInput.attr('maxlength', 10);
    })*/

    thisTelInput.on('countrychange', function(e, countryData) {

      thisTelInput.val('');
      /*thisPlaceholder = thisTelInput.attr('placeholder').replaceAll(' ', '').length;

      thisTelInput.attr('maxlength', thisPlaceholder);

      console.log(thisPlaceholder);*/
      /*phoneConversion();*/

    });

    thisTelInput.on('focus', function (){
      $(this).val('');
    })

    thisTelInput.on('blur', function (){
      let phoneNumber = $(this).val();

      let thisDiaCode = $(this).parent('.separate-dial-code').find('.selected-dial-code').text();

     /* if ( phoneNumber != '' ){
        $(this).val(thisDiaCode+phoneNumber);
      }*/

      /*$(this).parent('form').find('input[name=crm-phone]').val(thisDiaCode+phoneNumber);*/


     $(this).parent().parent().parent().parent().find('input[name=crm-phone]').val(thisDiaCode+phoneNumber);


    })

    thisTelInput.forceNumbericOnly();



  })


  $('.site-form').on('submit', function (e){
    e.preventDefault();

    let data = $(this).serialize();

    let currentLang = $(this).find('input[name=form-lang]').val();
    let siteUrl = $(this).find('input[name=home-url]').val();
    let customThxPage = $(this).find('input[name=thx-link]').val();

    let test = $(this).find('input[name=crm-phone]').val();

    console.log(data);

    /*let location = '';

    if( customThxPage != '' ){
      location = customThxPage;
    }else {
      if ( currentLang == 'uk' ){
        location = siteUrl+'/thx-ua';
      }

      if ( currentLang == 'ru-RU' ){
        location = siteUrl+'/thx-ru';
      }
    }

    const dataTest = {
      action: 'form_integration_test'
    }*/

   /* console.log(data);*/

    // $.post( myajax.url, data, function(response) {
    //   window.location.href = location;
    // });

    /*jQuery.post( myajax.url,data, function(response) {
      console.log(response);

      window.location.href = location;
    });*/


  });

  /*$('input[type=tel]').intlTelInput({
    preferredCountries: ["ua"],
    autoPlaceholder:"polite",
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.3/build/js/utils.js",
  });

  let currentDiaCode = '';

  $('input[type=tel]').on('countrychange', function(e, countryData) {
    $(this).val('');

  });

  $('input[type=tel]').on('focus', function () {

    currentDiaCode = $(this).parent('.flag-container .selected-dial-code').text();

  });

  $.fn.forceNumbericOnly = function() {
    return this.each(function() {
      $(this).keydown(function(e) {
        var key = e.charCode || e.keyCode || 0;
        return (key == 8 || key == 9 || key == 46 || (key >= 37 && key <= 40) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 107 || key == 109 || key == 173 || key == 61);
      });
    });
  };

  $('input[type=tel]').forceNumbericOnly();

  $('form').on('submit', function (e){
    e.preventDefault();

    var full_number = $(this).find('.intl-tel-input input').getNumber(intlTelInputUtils.numberFormat.E164);

    console.log(full_number);
  })*/

  // UTM

  function getQueryVariable(variable) {
      var query = window.location.search.substring(1);
      var vars = query.split('&');
      for (var i = 0; i < vars.length; i++) {
          var pair = vars[i].split('=');
          if (decodeURIComponent(pair[0]) == variable) {
              return decodeURIComponent(pair[1]);
          }
      }
  }
  utm_source = getQueryVariable('utm_source') ? getQueryVariable('utm_source') : "";
  utm_medium = getQueryVariable('utm_medium') ? getQueryVariable('utm_medium') : "";
  utm_campaign = getQueryVariable('utm_campaign') ? getQueryVariable('utm_campaign') : "";
  utm_term = getQueryVariable('utm_term') ? getQueryVariable('utm_term') : "";
  utm_content = getQueryVariable('utm_content') ? getQueryVariable('utm_content') : "";

  var forms = $('form');
  $.each(forms, function (index, form) {
      jQueryform = $(form);
      jQueryform.append('<input type="hidden" name="utm_source" value="' + utm_source + '">');
      jQueryform.append('<input type="hidden" name="utm_medium" value="' + utm_medium + '">');
      jQueryform.append('<input type="hidden" name="utm_campaign" value="' + utm_campaign + '">');
      jQueryform.append('<input type="hidden" name="utm_term" value="' + utm_term + '">');
      jQueryform.append('<input type="hidden" name="utm_content" value="' + utm_content + '">');
  });

  //Basic Animation

  const basicAnimationTarget = $('.animate-target');

  const startAnimationDelay = 200;

  basicAnimationTarget.each(function (){

    let thisAnimationBlock = $(this);

    thisAnimationBlock.viewportChecker({

      offset: startAnimationDelay,

      callbackFunction: function (elem, action) {

        $('.visible .first-up').addClass('animate');

        setTimeout(function () {
          $('.visible .second-up').addClass('animate');

        }, 500);

        setTimeout(function () {
          $('.visible .third-up').addClass('animate');
        }, 700);

        setTimeout(function () {
          $('.visible .fourth-up').addClass('animate');
        }, 900);

        setTimeout(function () {
          $('.visible .fifth-up').addClass('animate');
        }, 1100);

      }
    });

  })

  $('.infographics').viewportChecker({

    offset: 300,

    callbackFunction: function (elem, action) {

      setTimeout(function (){
        $(".visible .infographic-slider .item").each(function (){
          let thisData = $(this).find('.name').data('number');
          $(this).find('.odometer').html(thisData);

        })
      },200)

    }
  });

  //Sava UTM in links

  const siteUtmStr = document.location.search;

  $('.lang-list li').each(function (){
    let currentItem = $(this).find('a');
    let currentLink = currentItem.attr('href');

    currentItem.attr('href', currentLink + siteUtmStr);
  })

  let headerLogo = $('.header-courses .contact-logo');
  let headerLogoLink = headerLogo.attr('href');

  headerLogo.attr('href', headerLogoLink + siteUtmStr);

  let footerLogo = $('.contacts .logo');
  let footerLogoLink = headerLogo.attr('href');

  footerLogo.attr('href', footerLogoLink + siteUtmStr);

  if ( $('.call-quiz').length ){
    $('.call-quiz').each(function (){
      let thisBtn = $(this).find('.button');
      let btnLink = thisBtn.attr('href');

      thisBtn.attr('href', btnLink + siteUtmStr);
    })
  }

  //Pixel events

  /*$('form').on('submit', function (){
    fbq('track', 'Lead');
  })*/

  //Mob Menu

  /*jQuery('#mob-menu').on('click', function (e) {
    e.preventDefault();

    jQuery(this).toggleClass('active');
    jQuery('header').toggleClass('active-menu');
    jQuery('header nav').toggleClass('open-menu');
    jQuery('html').toggleClass("fixedPosition");

  });*/



  //Смена категории курсов

  /*jQuery('.page-template-template-home .curses-cat-wrapper .cat').on('click', function (e) {
    e.preventDefault();

    jQuery('.page-template-template-home .curses-cat-wrapper .cat').removeClass('active-cat');

    jQuery(this).addClass('active-cat');

    var subCatId = jQuery(this).data('subcatid');

    var allCat = jQuery(this).data('allcat');

    var currentLang = jQuery(this).data('lang');

    var pageCatNavWrapper = jQuery('#mor-curses-dtn-wrap');

    var allCatPosts = Number(jQuery(this).attr('data-allposts'));

    pageCatNavWrapper.attr('data-allposts', allCatPosts);

    var targetAllPosts = Number(pageCatNavWrapper.attr('data-allposts'));

    if ( targetAllPosts <= 6 ){
      pageCatNavWrapper.addClass('d-none');
    }else{
      pageCatNavWrapper.removeClass('d-none');
    }

    let data = {

      action: 'change_curses_category',
      allCat: allCat,
      currentLang: currentLang,
      subCatId: subCatId
    };

    jQuery.post( myajax.url, data, function(response) {

      if(jQuery.trim(response) !== ''){

        jQuery('#curses-list').html(response);
      }
    });

  });*/

  //Вывод больше курсов

  /*if ( jQuery('.page-template-template-home').length ){

    var activeCat = jQuery('.curses-cat-wrapper .cat.active-cat');
    var allPosts = Number(activeCat.attr('data-allposts'));

    jQuery('#mor-curses-dtn-wrap').attr('data-allposts', allPosts);

    var targetAllPosts = Number(jQuery('#mor-curses-dtn-wrap').attr('data-allposts'));

    var btnMore = jQuery('#more-curses');

    btnMore.attr('data-currentcat', activeCat.attr('data-subcatid'));
    btnMore.attr('data-allcat', activeCat.attr('data-allcat'));

    btnMore.on('click', function (e) {
      e.preventDefault();

      var curseLeng = jQuery(this).attr('data-lang');
      var curseCurrentCat = Number(jQuery(this).attr('data-currentcat'));
      var curseAllCat = Number(jQuery(this).attr('data-allcat'));

      var moreCurses = {
        action: 'more_curses',
        currentLang: curseLeng,
        allCat: curseAllCat,
        currentCat: curseCurrentCat
      };

      jQuery.post( myajax.url, moreCurses, function(response) {

        if(jQuery.trim(response) !== ''){

          jQuery('#curses-list').append(response);
        }
      });

      jQuery('#mor-curses-dtn-wrap').addClass('d-none');

    });

  }*/

  //Fancybox Init

  /*jQuery('[data-fancybox]').fancybox({
    protect: true,
    loop : true,
    fullScreen : true,
    scrolling : 'yes',
    image : {
      preload : "auto",
      protect : true
    },
    buttons: [
      "zoom",
      "slideShow",
      "fullScreen",
      "close"
    ]

  });*/

  //Webinar Countdown Timer

  /*if ( jQuery('.courses-template-template-webinar-page').length ){

    let startData = Number(jQuery('#timer').data('start'));

    const date = new Date(startData*1000);

    startData = new Date(date).getTime();

    // Update the count down every 1 second
    let dataTimer = setInterval(function() {

      // Get today's date and time
      let getDate = new Date().getTime();

      // Find the distance between now and the count down date
      let distance = startData - getDate;

      // Time calculations for days, hours, minutes and seconds
      let days = Math.floor(distance / (1000 * 60 * 60 * 24));
      let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      let seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Display the result in the element with id="demo"

      jQuery('#timer .day .date').text(days);
      jQuery('#timer .hour .date').text(hours);
      jQuery('#timer .minute .date').text(minutes);
      jQuery('#timer .second .date').text(seconds);


      // If the count down is finished, write some text
      if (distance < 0) {
        clearInterval(dataTimer);

      }
    }, 1000);

  }*/
    // MAP INIT

    /*function initMap() {
        var location = {
            lat: 48.268376,
            lng: 25.9301257
        };

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: location,
            scrollwheel: false
        });

        var marker = new google.maps.Marker({
            position: location,
            map: map
        });

        var marker = new google.maps.Marker({ // кастомный марекр + подпись
            position: location,
            title:"Город, Улица, \n" +
            "Дом, Квартира",
            map: map,
            icon: {
                url: ('img/marker.svg'),
                scaledSize: new google.maps.Size(141, 128)
            }
        });

        jQuery.getJSON("map-style_dark.json", function(data) { // подключения стиля для гугл карты
            map.setOptions({styles: data});
        });

    }

    initMap();*/

    // MOB-MENU

    /*jQuery('#menu-btn').on('click', function (e) {
       e.preventDefault();

       jQuery('#mob-menu').toggleClass('active-menu');
       jQuery(this).toggleClass('open-menu');
    });

    jQuery('#mob-menu a').on('click', function (e) {
        e.preventDefault();

        jQuery('#mob-menu').removeClass('active-menu');
        jQuery('#menu-btn').removeClass('open-menu');
    });*/


    //SCROLL MENU

    /*jQuery(document).on('click', '.scroll-to', function (e) {
        e.preventDefault();

        var href = jQuery(this).attr('href');

        jQuery('html, body').animate({
            scrollTop: jQuery(href).offset().top
        }, 1000);

    });*/

    // CASTOME SLIDER ARROWS

    /*jQuery('.mein-slider').slick({
        autoplay: false,
        autoplaySpeed: 5000,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true

    });

    jQuery('.main-page .arrow-left').click(function(e){
        e.preventDefault();

        jQuery('.mein-slider').slick('slickPrev');
    });

    jQuery('.main-page .arrow-right').click(function(e){
        e.preventDefault();

        jQuery('.mein-slider').slick('slickNext');
    });*/

    // PHONE MASK

    /*jQuery("input[type=tel]").mask("+38(999) 999-99-99");*/

    // DTA VALUE REPLACE

    /*jQuery('.open-form').on('click', function (e) {
        e.preventDefault();
        var type = jQuery(this).data('type');
        jQuery('#type-form').find('input[name=type]').val(type);
    });*/

    // FORM LABEL FOCUS UP

    /*jQuery('.form-control').on('focus', function() {
        jQuery(this).closest('.form-control').find('label').addClass('active');
    });

    jQuery('.form-control').on('blur', function() {
        var jQuerythis = jQuery(this);
        if (jQuerythis.val() == '') {
            jQuerythis.closest('.form-control').find('label').removeClass('active');
        }
    });*/

    // SCROLL TOP.

    /*jQuery(document).on('click', '.up-btn', function() {
        jQuery('html, body').animate({
            scrollTop: 0
        }, 300);
    });*/

    // SHOW SCROLL TOP BUTTON.

    /*jQuery(document).scroll(function() {
        var y = jQuery(this).scrollTop();

        if (y > 800) {
            jQuery('.up-btn').fadeIn();
        } else {
            jQuery('.up-btn').fadeOut();
        }
    });*/



});

// PRELOADER

/*jQuery(window).on('load', function () {

    jQuery('#loader').fadeOut(400);
});*/
