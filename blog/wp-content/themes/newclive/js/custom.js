$(document).ready(function(){
	"use strict";
    var wWidth = $(window).width();
    var wHeight = $(window).height();
    
    //Home Slider configure
    //$('.homeSlider').slick();
	

	$('.homeSlider').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  centerMode: true,
  variableWidth: true
});
      
    mobileMenu(); //mobile menu
    youtubeVideoResize();//youtube video resize
    
    
    
    //tab
    $('.tab ul li').click(function() {
        var id = $(this).attr('rel'); 
        $('.tab ul li').removeClass('active');
        $(this).addClass('active');
        $('.tabContent').hide();
        
        $('.tabContent#'+id).addClass('active').fadeIn();
    });
    
    //Accordian
    
	$('.accordian li').click(function() {
        
        $('.accordianContent:visible').slideUp(function() {
            $(this).parent().find('i').removeClass('fa-minus');
            $(this).parent().find('i').addClass('fa-plus');
        });
        $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
        $(this).find('.accordianContent:hidden').slideDown();
    });
    
    
    
    
    
	
    
    
    //run when window resize
    $(window).resize(function() {
        var wWidth = $(window).width();
        var wHeight = $(window).height();
        
        mobileMenu(); //mobile menu
        youtubeVideoResize(); //youtube video resize
        sticysidebar();//sticy sidebar
        
    });
    
    
    
    //run when window load
    $(window).load(function() {
        var wWidth = $(window).width();
        var wHeight = $(window).height();
        
        youtubeVideoResize();//youtube video resize
        openPopup(); //open popup
        sticysidebar();//sticy sidebar
        
    });
    
    
    //all image size got automatically height
    $('img').each(function() {
        var $this = jQuery(this);
            getImageSize($this, function(width, height){
            console.log(width + ',' + height);
            $this.parent().css({width:width, height:height, });
        });
    });
    function getImageSize(img, callback) {
        var $img = $(img);
        //return $img;
        console.log($img[0].data);

        var wait = setInterval(function() {
            var w = $img[0].width,
                h = $img[0].height;
            if (w && h) {
                clearInterval(wait);
                callback.apply(this, [w, h]);
            }
        }, 30);
    }
    
    function mobileMenu(){
        var wWidth = $(window).width();
        var wHeight = $(window).height();
        if( wWidth <= 1023 ) {
        //mobile menu icon animation
        $('div#nav-icon3').click(function() {
            var margin = parseInt($('.wrapper').css('margin-left'));
            $('.wrapper').width(wWidth);
            if( margin < 1 ) {
                $(this).addClass('open'); 
                $('.mobileMenu').show();
                $('.wrapper').stop().animate({
                    'margin-left': 250,
                }, 600);
            }
            else{
                $(this).removeClass('open'); 
                $('.wrapper').stop().animate({
                    'margin-left': 0,
                }, 600, function() {
                    $('.mobileMenu').hide();
                });
            }
            
            $('.mobileMenu >ul >li').each(function() {
                if($(this).find('ul.submenu').size() > 0 ){
                    $(this).append('<i class="fa fa-plus plusMinus" aria-hidden="true"></i>');
                } 
                $(this).find('.plusMinus:gt(0)').remove();
            });
            
            $('body').unbind('click')
            $('body').on('click', '.plusMinus', function() {
               $('.submenu:visible').slideUp(function() {
                    $(this).parent().find('.plusMinus').removeClass('fa-minus').addClass('fa-plus');                
               }); 
               $(this).removeClass('fa-plus').addClass('fa-minus')
                  $(this).parent().find('.submenu:hidden').slideDown();
            });
            
           
        });
        
        
            $('nav#mainMenu > ul').appendTo('.mobileMenu');
            $('.wrapper').width(wWidth);
        }
        else{
            $('.mobileMenu > ul ').appendTo('nav#mainMenu');
            $('.wrapper').css({'margin-left': 0, width: '100%'});
            $('#nav-icon3').removeClass('open'); 
            $('.plusMinus').remove();
            $('.submenu:visible').slideUp();
        }
    }
    
    
    
    //resize youtube video automatically.
    function youtubeVideoResize() {
        var $this = jQuery('#video');
        $this.height((9/16)*$this.width());
    }
    
    
  function openPopup() {
        
        var subsCribed = sessionStorage.getItem('subscribed');
        
        
        
            
        
        if(subsCribed !== 'yes') {  
            setTimeout(function() {
                $.fancybox.open({
                    maxWidth	: 800,
                    maxHeight	: 600,
                    fitToView	: false,
                    href        : '#fancyPopup',
                    width		: 'auto',
                    height		: '70%',
                    autoSize	: false,
                    afterClose:function() {
                        sessionStorage.setItem('subscribed', 'yes');
                    }
                });
            }, 3000)
            
        }
  }
        
    
    
  //sticy top bar
    $(window).scroll( function() {
        var currentscroll = $(window).scrollTop();
       if(currentscroll > $('header').height() ){
           $('header, .wrapper').addClass('fixed');
           
       } 
        else{
            $('header, .wrapper').removeClass('fixed');
        }
    });
    
    
    //Sticy sidebar
    function sticysidebar(){
		
		$('.fix').each(function(index, element) {
			
			var itemwidth = $(element).width();
			var itemheight = $(element).height();
			var itempos = $(element).offset().top;
			
			var parentoffset =  ($(element).parents('.fixparent').height() + $(element).parents('.fixparent').offset().top) - $(element).height();
			
			$(element).css({'width':itemwidth+'px', top:0,});
			
			console.log('itempos: '+itempos +','+'itemwidth: '+itemwidth +','+'itemheight: '+itemheight +','+'parentoffset: '+parentoffset);	
			
			
			if(!$(element).parent().hasClass('fixcontainr')){		
				$(element).wrap('<div class="fixcontainr" style="width:'+itemwidth+'px; height:'+itemheight+'px; position:relative"></div>');
			}
			
			
				$(window).scroll(function() {
					var csroll = $(window).scrollTop()+78;
					
					
					
					if(csroll >= itempos && csroll <= parentoffset){
						$(element).css({'position':'fixed', top:78+'px', 'margin-top':0,});
					}
					
					
					else if(csroll < itempos){
						$(element).css({'position':'absolute', 'margin-top':0, top:0+'px',});		
					}
					
					else if(csroll > parentoffset){
						$(element).css({'position':'absolute', 'margin-top':parentoffset-($(element).parents('.fixparent').offset().top+25), top:0+'px'});	
					}
					
					
					
				} );
			
			
				
	});
	
	
}


        
        
    

});
