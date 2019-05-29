<?php do_action( 'fl_content_close' ); ?>

	</div><!-- .fl-page-content -->
	<?php

	do_action( 'fl_after_content' );

	if ( FLTheme::has_footer() ) :

	?>
	<footer class="fl-page-footer-wrap" itemscope="itemscope" itemtype="https://schema.org/WPFooter">
		<?php

		do_action( 'fl_footer_wrap_open' );
		do_action( 'fl_before_footer_widgets' );

		FLTheme::footer_widgets();

		do_action( 'fl_after_footer_widgets' );
		do_action( 'fl_before_footer' );

		FLTheme::footer();

		do_action( 'fl_after_footer' );
		do_action( 'fl_footer_wrap_close' );

		?>
	</footer>
	<?php endif; ?>
	<?php do_action( 'fl_page_close' ); ?>
</div><!-- .fl-page -->
<div class="topsubscription_frm" style="display:none">
<div id="subscription_frm" > 
	<label>SIGN UP FOR NEWS &amp; SPECIAL OFFERS</label>
	<div class="block block-subscribe footernewsletter a">
		<form method="post" id="newsletter-validate-detail">
			<div class="block-content">
				<div class="input-box">
				   <input type="email" autocapitalize="off" autocorrect="off" spellcheck="false" name="email" id="newsletter" title="Sign up for our newsletter" class="input-text required-entry validate-email" placeholder="Email Id">
				   <span id='error'></span>
				   <button type="submit" id="newsletter-subscribe" title="Subscribe" class="button">Submit</button>
				   <span id="thanks" style=" display: block;"></span>
				</div>
			</div>
		</form>
	 </div>
    <div class="form-close">
<p>X</p>    
</div>
</div>
    
</div>    
<script>
	jQuery(document).ready(function(){
		jQuery('#subscription a.fl-button').on('click',function(){
			jQuery(".topsubscription_frm").css('display','block');
		});
        jQuery('.form-close').click(function(){
           jQuery(".topsubscription_frm").css('display','none'); 
        });
        
	});
	
	
        jQuery(document).ready(function() {
			jQuery( "#newsletter" ).mouseenter(function() {
			 jQuery("#error").html('');
			 jQuery('#newsletter-subscribe').css('margin-top','0px');
			  jQuery("#error").fadeout(3000);
			});
            jQuery("#newsletter-subscribe").click(function(event){
				jQuery('#thanks').empty();
				jQuery('#thanks').css("padding-top","5px");
				var emailid = jQuery.trim(jQuery('#newsletter').val());
				var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
					if(emailid == '' ) {
						jQuery('#newsletter').css('border','1px solid red');
						jQuery('#newsletter-subscribe').css('margin-top','7px');
						jQuery("#error").css({"color": "red","position": "absolute","left": "12px","bottom": "49px"});
						jQuery("#error").html('This is a required field.');
						jQuery("#error").fadeIn(3000);
						
						return false;
					} else { 
						if (!filter.test(emailid)) {
							jQuery('#newsletter').css('border','1px solid red');
							jQuery('#newsletter-subscribe').css('margin-top','7px');
							jQuery("#error").css({"color": "red","position": "absolute","left": "12px","bottom": "49px"});
							jQuery("#error").html('Please enter valid email id.');
							jQuery("#error").fadeIn(3000);
							return false;
						} else {
							jQuery('#newsletter').css('border','1px solid #ccc');
						}
					}
					var data = jQuery('#newsletter-validate-detail').serialize();
					data += '&isAjax=1';  
					
					jQuery('.loader').show();
					url = 'http://www.threecliveroad.com/index.php/newsletter/subscriber/new/'; 
					try {
						jQuery.ajax({
							url: url,
							dataType: 'json',
							type : 'post',
							data: data,
							success: function(data){
								jQuery('.loader').hide();
								if(data.success == '1'){
									jQuery('#newsletter-validate-detail')[0].reset();
									jQuery('.messages').empty();
									jQuery('#thanks').css({'color':'green',"padding-top":"5px"});
									jQuery('#thanks').empty().html('<span>Thank you for subscribing to No. 3 Clive Road!</span>');
								}else{
									jQuery('#thanks').css({'color':'red',"padding-top":"5px"});
									jQuery('#thanks').empty().html(data.error);
								}
								
							}
						});
					} catch (e) {
					}	
					return false;
				});
            });
        
	//subscription
</script>
<?php




wp_footer();

do_action( 'fl_body_close' );

FLTheme::footer_code();

?>
<style>
.topsubscription_frm {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
}
.topsubscription_frm:after {
    content: "";
    position: absolute;
    top: 0px;
    background: rgba(0, 0, 0, 0.46);
    width: 100%;
    height: 100%;
    z-index: -9;
}
div#subscription_frm {
    width: 30%;
    margin: 0 auto;
    margin-top: 16%;
    background: #fff;
    padding: 11px;
    position: relative;
}

    div#subscription_frm > label:first-child{
        text-align: center;
        display: block;
    }
    div#subscription_frm input#newsletter {
    border: 1px solid;
    margin-bottom: 11px;
}
    div#subscription_frm button#newsletter-subscribe{
    margin: 0 auto;
    text-align: center;
    width: 150px;
    background: #000;
    border: 1px solid #000;    
    }
    div#subscription_frm .input-box{
        text-align: center;
    }
    div#subscription_frm .input-box label {
    text-align: left !important;
    display: block;
}
.form-close {
    position: absolute;
    top: -14px;
    right: -10px;
    font-size: 17px;
    background: #fff;
    width: 30px;
    height: 30px;
    text-align: center;
    border-radius: 15px;
    cursor: pointer;
    line-height: 31px;
}  
   .form-close p{
        font-family: 'interstatelight';
    }    
</style>
<style>
    .mouseHoverShow{
        display: none;
        position: absolute;
        top: 14px;
    }
    .level0.tea3Hover:hover .mouseHoverShow{
        display: block;
    }
    .level0.tea3Hover:hover .mouseHoverOut{
        opacity: 0;
    }
    img.onlyMobileShow{
        display: none;
    }
    
    @media only screen and (max-width: 770px){
        img.mouseHoverOut,
        img.mouseHoverShow{
            display: none;
        }
       img.onlyMobileShow{
            display: block;
        }
        .level0.nav-6.last.onlyMobile{
            padding: 8px 0px;
        }
        .level0.tea3Hover:hover .mouseHoverShow{
            display: none;
        }
    }
</style>
<style>
    .mouseHoverShow{
        display: none;
        position: absolute;
        top: 14px;
    }
    .level0.tea3Hover:hover .mouseHoverShow{
        display: block;
    }
    .level0.tea3Hover:hover .mouseHoverOut{
        opacity: 0;
    }
    img.onlyMobileShow{
        display: none;
    }
    li.level0.nav-6.last.onlyMobile a {
        padding-left: 10px;
    }
    
    @media only screen and (max-width: 770px){
        img.mouseHoverOut,
        img.mouseHoverShow{
            display: none;
        }
       img.onlyMobileShow{
            display: block;
        }
        .level0.nav-6.last.onlyMobile{
            padding: 8px 0px;
        }
        .level0.tea3Hover:hover .mouseHoverShow{
            display: none;
        }
    }
</style>

</body>
</html>
