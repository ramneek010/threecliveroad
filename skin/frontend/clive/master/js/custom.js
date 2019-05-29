var winheight;
var winwidth;
jQuery(document).ready(function() {
	'use strict';
    
    var wWidth = jQuery(window).width();
    var wHeight = jQuery(window).height();
    changeImagesForMobile();
	
	jQuery(document).click(function(){
		jQuery('.custom_size:visible').slideUp();
	});
	
	winwidthhome();
	function winwidthhome(){
		winwidth = jQuery(window).outerWidth();
		
	}
	
	winwidth = jQuery(window).width();
	
	if(winwidth > 768){
	
		var NavigationTop = jQuery( '.navigation' );	
		var offset = NavigationTop.offset();
		jQuery('.slider-caption').css('left', offset.left + 20);
		//console.log( "left: " + offset.left );
	
	}
	
	if(winwidth == 768){
	
		var NavigationTop = jQuery( '.mobile-navigation' );	
		var offset = NavigationTop.offset();
		jQuery('.slider-caption').css('left', offset.left);
		//console.log( "left: " + offset.left );
	
	}
	
	
	
	
	jQuery('.product-view .product-img-box .more-views li:eq(0) a').addClass('slideactive');
	
	jQuery('.cart-clouse').click(function(){
		jQuery('.addedproductmessage').hide();
	});
//home page
jQuery('.header-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
		 responsive: [
			{
		  breakpoint: 767,
		  settings: {
			slidesToShow: 1,
			arrows : false,
			autoplay: true,
			slidesToScroll: 1
		  }
		}
		// You can unslick at a given breakpoint now by adding:
		// settings: "unslick"
		// instead of a settings object
  ]

    });

//slider height
homeheight();
function homeheight(){
	winheight = jQuery(window).outerHeight();
	jQuery('.header-slider .slick-slide').css('height', winheight);
}

//image from background banner
    /*
var i=1;
	jQuery('.header-slider div.item img').each(function(){
		jQuery('.home-slider div.item img').css('display','none');
		var imgone = jQuery(this).closest('img').attr('src');
		jQuery(this).parent().css('background-image', 'url(' + imgone + ')');
		i++;
});
    
 */   
    
    
jQuery('.mainImage').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  asNavFor: '.more-views-thumb'
});

jQuery('.more-views-thumb').slick({
  asNavFor: '.mainImage',
    slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: false,
    focusOnSelect: true,
});
    
    
    // Remove active class from all thumbnail slides
 jQuery('.more-views-thumb .slick-slide').removeClass('slick-active');

 // Set active class to first thumbnail slides
 jQuery('.more-views-thumb .slick-slide').eq(0).addClass('slick-active');

 // On before slide change match active thumbnail to current slide
 jQuery('.mainImage').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
 	var mySlideNumber = nextSlide;
     console.log(mySlideNumber);
 	jQuery('.more-views-thumb .slick-slide').removeClass('slick-active');
 	jQuery('.more-views-thumb .slick-slide').eq(mySlideNumber).addClass('slick-active');
});
    
 /*   
if(jQuery('.more-views-thumb .item').size()>3){
	
jQuery('.more-views-thumb').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: false,
  autoplaySpeed: 4000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    }
  ]
});
	
}*/
jQuery('.product-view .product-img-box .more-views li:eq(0) a').addClass('slideactive');
jQuery('.product-view .product-img-box .more-views li a').click(function(){			
	jQuery('.product-view .product-img-box .more-views li a').removeClass('slideactive');
	jQuery(this).addClass('slideactive');
		
});

jQuery('.mobile-filter').click(function(){
	jQuery('.col-left.sidebar.col-left-first').animate({'left':'0px'});
});
jQuery('.remove-filter a').click(function(){
	jQuery('.col-left.sidebar.col-left-first').animate({'left':'-200px'});
});


//footer open-close
jQuery('.col.f_span3 label, .col.f_span4 label, .col.f_span5 > label, a.openfooter, .footer-clickable').click(function() {
	jQuery('.openfooter').toggleClass('closefooter');
	//jQuery( "#newsletter" ).focus();	
	var footerheight = parseInt(jQuery('footer').height());
	var footervalue = parseInt(jQuery('footer').css('bottom'));
	if(footervalue < 0){	
    jQuery('footer').stop().animate({'bottom':'0'});
	}else{
		jQuery('footer').stop().animate({'bottom':-(footerheight-40)});
		//jQuery( "#newsletter" ).focus();	
	}
});

jQuery(document).on("click", function() {
	var footerheight = parseInt(jQuery('footer').height());
	jQuery('footer').stop().animate({'bottom':-(footerheight-40)});
	//jQuery('footer').animate({'bottom':'-97px'});
});

jQuery('.input-box label').click(function(){
	jQuery( "#newsletter" ).focus();	
});
	
jQuery(document).delegate('footer', 'click', function(event) {
   event.stopPropagation();
});


//Quanatity Dropdown


jQuery('div.customDropdawn > p').click(function(e) {
	jQuery('.custom_size:visible').slideUp();
	jQuery(this).next('ul').stop().slideToggle();
	e.stopPropagation();
});

jQuery('body').on('click','ul.custom_size li a', function() {
	//var currentVal = jQuery(this).clone()+ '<i class="Quantity-icon"></i>';
	var currentVal = jQuery(this).html()+ '<i class="fa fa-angle-down"></i>';
	jQuery(this).parents('.customDropdawn').find('p.activeQuantitiy').html(currentVal);
	jQuery(this).parents('.customDropdawn').find('ul.custom_size').hide();
});

//faq
jQuery('.faq a').click(function(){
	jQuery('p').slideUp(function(){
		jQuery(this).parent().find('a').removeClass('active');
	});		
		
	jQuery(this).next('p:hidden').slideDown(function(){
		jQuery(this).parent().find('a').addClass('active');
	});
	
	//jQuery(this).find('a').addClass('active');
});

/*jQuery('.stockists a').click(function(){
	jQuery('.stockists-block').slideUp(function(){
		jQuery(this).parent().find('a').removeClass('active');
	});		
		
	jQuery(this).next('.stockists-block:hidden').slideDown(function(){
		jQuery(this).parent().find('a').addClass('active');
	});
});*/




jQuery('li i').click(function(event){
	jQuery('.search-cont').slideUp();
	jQuery( "#search" ).focus();		
	jQuery(this).next('.search-cont:hidden').slideDown();
	jQuery( "#search" ).focus();	
	event.stopPropagation();
});

jQuery('body').not('.search-cont, li i').on("click", function () {
	jQuery('.search-cont').slideUp();
	//event.stopPropagation();
});
jQuery('.search-cont, li i').click(function(event){
	event.stopPropagation();
});

//jQuery(".press-fancy").fancybox();

jQuery(".press-fancy").fancybox({
	padding	  : '0',
	scrolling : 'auto',
	preload   : true
});

//window resize function	
jQuery(window).resize(function() {
	homeheight();
	winwidthhome();
	
	var NavigationTop = jQuery( '.navigation' );	
	var offset = NavigationTop.offset();
	jQuery('.slider-caption').css('left', offset.left + 20);
	
	if(window.innerWidth > 768){
		jQuery('.col-left.sidebar.col-left-first').animate({'left':'60px'});
	}
	else{
		jQuery('.col-left.sidebar.col-left-first').animate({'left':'-200px'});
	}
    
    var wWidth = jQuery(window).width();
    var wHeight = jQuery(window).height();
    changeImagesForMobile();
});
    jQuery(window).load(function() {
        var wWidth = jQuery(window).width();
    var wHeight = jQuery(window).height();
    changeImagesForMobile();
    });


//left filter

/*jQuery('.left-filter-category-title').click(function(e){
	
	jQuery('.col-left.sidebar.test').animate({
		
		'left':'0'
		});
		
		e.stopImmediatePropagation();
	});


jQuery('.remove-filter').click(function(e){
	
	jQuery('.col-left.sidebar.test').animate({
		
		'left':'-200'
		});
	e.stopImmediatePropagation();
	});


jQuery(document).click(function(e) {
    
	jQuery('.col-left.sidebar.test').animate({
		
		'left':'-200'
		});
	
});
*/

    
    function changeImagesForMobile() {
        var wWidth = jQuery(window).width();
        var wHeight = jQuery(window).height();
        
        if(wHeight > wWidth){
            jQuery('.header-slider .item').each(function() {
                var mobileSrc = jQuery(this).find('img').attr('data-mobile');
                //var Element = jQuery(this).find('img');
                jQuery(this).find('img').attr('src', mobileSrc);
        });
                                                }
        else{
             jQuery('.header-slider .item').each(function() {
                var desktopSrc = jQuery(this).find('img').attr('data-desktop');
                //var Element = jQuery(this).find('img');
                jQuery(this).find('img').attr('src', desktopSrc);
                 
                 
                 //console.log('desktopSrc '+ desktopSrc);
            })
        }
    }




});



