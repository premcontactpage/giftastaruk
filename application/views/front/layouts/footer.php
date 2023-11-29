<?php $combo = 1; ?>

<style type="text/css">
	#payment_method li
	{
		margin-bottom: 5px;
	}
	
	ul.list {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
}

ul.list li {
  float: left;
}

ul.list li a {
  display: block;
  padding: 4px;
  
}
</style>
<footer class="footer">
		<div class="container">
			<div class="">
				<div class="fc-3">
					<h3 class="footer-title">About Us</h3>
					<p>Joyfulsurprises designs and sells star on premium quality. We are the official partners star-registry.com. Secure online payment via Razorpay. 24*7 customer support.</p>
				    <br>
				    
				    <?php if($device=='mobile'){ ?>
				    <img style="margin-bottom: 25px;" src="<?=base_url()?>assets/web/img/js-logo-brand.png" class="logo">
				    <?php }else{ ?>
				    <img  src="<?=base_url()?>assets/web/img/js-logo-brand.png" class="logo">
				    <?php } ?>
				    
				</div>
				<div class="fc-1">
					<h3 class="footer-title">Information</h3>
					<ul class="info-list">
						<li><a href="<?=base_url()?>privacy-policy">Privacy Policy</a></li>
						<li><a href="<?=base_url()?>terms-of-service">Terms of Service</a></li>
						<li><a href="<?=base_url()?>refund-policy">Refund Policy</a></li>
						<li><a href="<?=base_url()?>shipping-policy">Shipping Policy</a></li>
						<li><a href="<?=base_url()?>contact-us">Contact Us</a></li>
					</ul>
				</div>
				<div class="fc-2">
					<h3 class="footer-title">Quick Links</h3>
					<ul class="info-list">
						<li><a href="<?=base_url()?>">Home</a></li>
						<li><a href="<?=base_url()?>all-products">Products</a></li>
						<li><a href="<?=base_url()?>find-your-star">Find Your Star</a></li>
					</ul>
				</div>
				
				<div class="fc-4">
					<h3 class="footer-title">Follow Us on</h3>
					<ul class="social-icons">
						<li><a target="_blank" href="https://www.facebook.com/giftastaruk"><i class="fa fa-facebook"></i></a></li>
						<li><a target="_blank" href="https://www.instagram.com/giftastar.uk"><i class="fa fa-instagram"></i></a></li>
						<!-- <li><a href="#"><i class="fa fa-linkedin"></i></a></li>-->
					</ul>
				</div>
				<div class="fc-4">
					<h3 class="footer-title">Payment Methods</h3>
					<ul class="social-icons" id="payment_method">
						<li><img src="<?=base_url()?>assets/image/pay1.jpg"></li>
						<li><img src="<?=base_url()?>assets/image/pay2.jpg"></li>
						<li><img src="<?=base_url()?>assets/image/pay4.jpg"></li>
						<li><img src="<?=base_url()?>assets/image/stripe.jpg"></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<div class="copy-right">
		<div class="container">
			<div class="copy-text">
				<p>© <?=date('Y')?> Joyfulsurprises.</p>
			</div>
		</div>	
	</div>
	
	<?php if($device=='mobile' && $actual_link==base_url().'checkout'){ ?>
	<div class="container" style="border-top: 1px solid #808080ad;">
	<ul class="list">
						<li><a href="<?=base_url()?>privacy-policy">Privacy Policy</a></li>
						<li style="margin-left: 25px;"><a href="<?=base_url()?>terms-of-service">Terms of Service</a></li>
						<li><a href="<?=base_url()?>refund-policy">Refund Policy</a></li>
						<li style="margin-left: 25px;"><a href="<?=base_url()?>shipping-policy">Shipping Policy</a></li>
						
	</ul>
					
	</div>
	<?php } ?>

	<a href="https://api.whatsapp.com/send?phone=+447415873228&text=Hi Gift A Star" class="float" target="_blank">
		<i class="fa fa-whatsapp my-float"></i>
	</a>
	
	<?php if($combo==1){ ?>
        <div class="container">
          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog" style="width:380px;text-align: center;">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-body" >
                  <a href="javascript:void[0]"><img src="<?=base_url()?>assets/uploads/product/1643283113_6831.jpg" style="width:350px;"></a>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>
	<?php } ?>
	
	
	
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
	<script src="<?=base_url()?>assets/web/slick/slick.js" type="text/javascript" charset="utf-8"></script>
	 <script type="text/javascript">
    $(document).on('ready', function() {
      $(".center").slick({
        dots: true,
        infinite: true,
        <!-- centerMode: true, -->
        slidesToShow: 4,
        slidesToScroll: 3,
		
		responsive: [
		{
			breakpoint: 1200,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			}
		},
		{
			breakpoint: 800,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			}
		},
		{
			breakpoint: 600,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			}
			// settings: "unslick"
		}
]
      });
      $(".lazy").slick({
        lazyLoad: 'ondemand', 
        infinite: true
      });
	  
	  
	
	  
    });
    
         cart();
         function cart()
         {
         	$.post('<?=base_url()?>cart-data',{cart:'yes'},function(respo){
         		$('#cart_data').html(respo);
         	})
         }
         
    <?php if($actual_link==base_url().'checkout'){ ?>
       $('.float').hide();
	<?php } ?>
	
	<?php if($device=='mobile' && $actual_link==base_url().'checkout'){ ?> $('.footer,.copy-right').hide();<?php } ?>
	</script>
	<script type="text/javascript">
	$(window).on('load', function(){ 
        $('#myModal').modal('show');
	});
    </script>
	
		
</body>
</html>