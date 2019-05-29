jQuery(document).ready(function($){
	"use strict";
    var wWidth = $(window).width();
    var wHeight = $(window).height();
    
	
jQuery('.homeSlider').slick({
  centerMode: true,
  centerPadding: '0px',
  slidesToShow: 3,
  useTransform: true,
  adaptiveHeight: true,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '0px',
        slidesToShow: 3,
        adaptiveHeight: true,
        useTransform: true,
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1,
        adaptiveHeight: true,
        useTransform: true,
      }
    }
  ]
});
    
   
    
        
        
    

});


