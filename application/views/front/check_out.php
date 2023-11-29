<?php include 'layouts/header.php'; ?>

<style>
    .checkout_form .w-full {
    width: 100%;
}
select.input-box
{
    height:40px;
}

   
</style>


<?php


$amount = 0;
$shipping = SHIPPING_AMOUNT;
if(isset($_SESSION['shopping_cart_details']) && !empty($_SESSION['shopping_cart_details']))
{
	if(count($_SESSION['shopping_cart_details'])>0)
	{
       for($c=0;$c<count($_SESSION['shopping_cart_details']);$c++)
       {
       	  $product = $this->common_library->product_data($_SESSION['shopping_cart_details'][$c]['pid']);
       	  
       	  if($product[0]->offer_price>0)
       	  {
            $product_price = (int)$product[0]->offer_price;
       	  }
       	  else
       	  {
       	  	$product_price = (int)$product[0]->price;
       	  }
       	  
          $amount  += (int)$product_price;
       }
	}
}


?>
<?php if($device=='mobile'){ ?>
	<main>
		
		<div class="inner-banner">
			<div class="container">
				<p>Checkout</p>
			</div>
		</div>
		
		<div class="page-sec">
			<div class="container">
				<div class="row">
					<div class="col-md-7 check-left address">
					<form id="myform" action="post">
						<div class="check-left-box">
							<h2>Contact Information</h3>
							
							<div class="row">
								<div class="col-md-6">
									<input type="text" class="input-box w-full" name="contact_user_name" placeholder="Name">	
								</div>
								<div class="col-md-6">
									<input type="text" class="input-box w-full numbers" name="contact_mobile" placeholder="Mobile number">
								</div>
								<span style="color:blue;font-size:13px;">★ We will contact to this number if there is any issue with the order.</span>
							</div>
							<br>
							
							<h2>Delivery Information</h3>
							
							<input type="email" class="input-box w-full" name="user_email" placeholder="Email address" required="">	
							<div class="row">
								<div class="col-md-6">
									<input type="text" class="input-box w-full" name="user_fname" placeholder="First Name" required="">	
								</div>
								<div class="col-md-6">
									<input type="text" class="input-box w-full" name="user_lname" placeholder="Last Name" required="">
								</div>
								<div class="col-md-12">
									<textarea type="text" class="input-box w-full" name="user_address" placeholder="H.No / street / locality" required=""></textarea>
								</div>
								<div class="col-md-6">
									<input type="text" class="input-box w-full" name="user_landmark" placeholder="Landmark">
								</div>
								
								<div class="col-md-6">
									<input type="text" class="input-box w-full" name="city" placeholder="City" required="">
								</div>
								
								<div class="col-md-4">
									<select class="input-box w-full" name="state" required="">
										<option value="">select state</option>
										<?php if(count($state)>0){ foreach($state as $s){ ?>
											<option value="<?=$s->state_name?>"><?=$s->state_name?></option>
										<?php } } ?>
									</select>
								</div>
								
								<div class="col-md-4">
									<input type="number" class="input-box w-full" name="pincode" required="" placeholder="PIN Code">
								</div>
								<div class="col-md-12">
									<input type="text" class="input-box w-full numbers" pattern="[6789][0-9]{9}" name="alt_mobile" required="" placeholder="Phone Number">
									<!-- <input type="checkbox">&nbsp; Save this information for next time -->
								</div>
							</div>
							<input type="submit" class="btn shop" value="Continue Shipping"><br><br>
							<a href="<?=base_url()?>"> < Return to Home</a>
						</div>	
						</from>
					</div>
				
					
					<div class="col-md-5 check-right coupon" style="display:none;">
						<div class="payment-box" style="background-color: #fff;box-shadow: rgb(100 100 111 / 46%) 0px 7px 29px 0;">
							<h2>Apply Coupon</h2>
							<div class="row">
								<div class="col-md-8">
									<input type="text" class="input-box w-full code" placeholder="Coupon Code">
								</div>
								<div class="col-md-4">
									<button type="button" class="btn-aply apply_code">Apply</button>
								</div>
								
							</div>	
							<div style="text-align:left;"><span class="msg" style="color:green;display:none;">Applied successfully</span></div>
							
							
							<h2 class="mt-10">Payment Details</h2>
							<div class="pay-box">
								<div class="payment-left"><p>Sub total</p></div>
								<div class="payment-right"><p class="rs sub_total"><?=$amount?></p></div>
							</div>
							
							<!--<div class="pay-box">-->
							<!--	<div class="payment-left"><p>Shipping</p></div>-->
							<!--	<div class="payment-right"><p style="color:green"><b>Free</b></p></div>-->
							<!--</div>-->
							
							<!--<div class="pay-box">
								<div class="payment-left"><p>Coupon Amount</p></div>
								<div class="payment-right"><p class="rs">500</p></div>
							</div> -->
							
							<div class="pay-box">
								<div class="payment-left"><p>Shipping charges</p></div>
								<div class="payment-right"><p class="rs shipping"><?=$shipping?></p></div>
							</div>
							<span class="coupon_here"></span>
							
							<div class="pay-box t-amount">
								<div class="payment-left"><p>Total Amount</p></div>
								<div class="payment-right"><p class="rs total"><?=$amount+$shipping?></p></div>
							</div>
							
							<div class="row">
								<div class="col-md-4">
									<button class="btn-aply" id="payment">Continue to payment</button>
									<br>
									<br>
									<a href="javascript:void[0]" id="return" style="margin-left: 55px;">< Return to Information</a>
								</div>
								
							</div>
							
						</div>
						
					</div>					
				</div>
			</div>
		</div>	
		
		
	</main>
	<?php include 'layouts/footer.php'; ?>

	<script type="text/javascript">
		$("form").submit(function(e) {
         	$('#cover-spin').show();
         	e.preventDefault();
         	var form = $("#myform");

         	var formData = new FormData(form[0]);
         	$.ajax({
         	type: "POST",
            url: '<?=base_url()?>checkout_data',
            //dataType: 'json', //not sure but works for me without this
            data: formData,
            contentType: false, //this is requireded please see answers above
            processData: false, //this is requireded please see answers above
            //cache: false, //not sure but works for me without this
            success: function(data) 
            {
            	if(data=='success')
            	{
            	   // $('.code').val('');
            		$('.coupon').show();$('.address').hide();
            		$('#cover-spin').hide();
            	}
            }, //You missed this
            error: function() 
            {
                	alert("Something went wrong");
            }
            });
         });
         
         $('#payment').click(function(){
             window.location.href = '<?=base_url()?>payment';
            //  window.location.href = '<?=base_url()?>pay';
         })
         
         $('#return').click(function(){
             $('.coupon').hide();$('.address').show();
         })
	</script>
	<?php }else{ ?>
	
	<main>
		
		<div class="inner-banner">
			<div class="container">
				<p>Checkout</p>
			</div>
		</div>
		
		<div class="page-sec">
			<div class="container">
				<div class="row">
					<div class="col-md-7 check-left">
					<form id="myform" action="post" class="checkout_form">
						<div class="check-left-box">
							
							
							<h2>Contact Information</h3>
							
							<div class="row">
								<div class="col-md-6">
									<input type="text" class="input-box w-full" name="contact_user_name" placeholder="Name">	
								</div>
								<div class="col-md-6">
									<input type="text" class="input-box w-full numbers" name="contact_mobile" placeholder="Mobile number">
								</div>
								<span style="color:blue;font-size: 15px;margin-left: 17px">★ We will contact to this number if there is any issue with the order.</span>
							</div>
							<br>
							
							<h2>Delivery Information</h3>
							<input type="email" class="input-box w-full" name="user_email" placeholder="Email address" required="">	
							
							<div class="row" style="margin-top:20px;">
								<div class="col-md-6">
									<input type="text" class="input-box w-full" name="user_fname" placeholder="First Name" required="">	
								</div>
								<div class="col-md-6">
									<input type="text" class="input-box w-full" name="user_lname" placeholder="Last Name" required="">
								</div>
								<div class="col-md-12">
									<textarea type="text" class="input-box w-full" name="user_address" placeholder="H.No / street / locality" required=""></textarea>
								</div>
								<div class="col-md-6">
									<input type="text" class="input-box w-full" name="user_landmark" placeholder="Landmark">
								</div>
								<div class="col-md-6">
									<select class="input-box w-full" name="country" readonly>
										<option>United Kindom</option>
									</select>
								</div>
								
								<div class="col-md-4">
									<select class="input-box w-full" name="state" onChange="fetchCities(this.value)" required="">
										<option value="">select state</option>
										<?php if(count($state)>0){ foreach($state as $s){ ?>
											<option value="<?=$s->state_name?>"><?=$s->state_name?></option>
										<?php } } ?>
									</select>
								</div>
								
								
								<div class="col-md-4">
									<select id="cities_list" class="input-box w-full" name="city" required="">
										<option value="">select city</option>
									</select>
								</div>
								<div class="col-md-4">
									<input type="text" class="input-box w-full" name="pincode" required="" placeholder="Zip Code">
								</div>
								<div class="col-md-12">
									<input type="text" class="input-box w-full numbers" name="alt_mobile" pattern="[6789][0-9]{9}" required="" placeholder="Phone Number">
									<!-- <input type="checkbox">&nbsp; Save this information for next time -->
								</div>
							</div>
							<input type="submit" class="btn shop" value="Continue Shipping">
						</div>	
					</div>
				</from>
					
					<div class="col-md-5 check-right">
						<div class="payment-box" style="background-color: #fff;box-shadow: rgb(100 100 111 / 46%) 0px 7px 29px 0;">
							<h2>Apply Coupon</h2>
							<div class="row">
								<div class="col-md-8">
									<input type="text" class="input-box w-full code" placeholder="Coupon Code">
								</div>
								<div class="col-md-4">
									<button class="btn-aply apply_code" type="button">Apply</button>
								</div>
								
							</div>	
							<div style="text-align:left;"><span class="msg" style="color:green;display:none;">Applied successfully</span></div>
							<h2 class="mt-10">Payment Details</h2>
							<div class="pay-box">
								<div class="payment-left"><p>Sub total</p></div>
								<div class="payment-right"><p class="rs sub_total"><?=$amount?></p></div>
							</div>
							<!--<div class="pay-box">-->
							<!--	<div class="payment-left"><p>Shipping</p></div>-->
							<!--	<div class="payment-right"><p style="color:green"><b>Free</b></p></div>-->
							<!--</div>-->
							<!-- <div class="pay-box">
								<div class="payment-left"><p>Discount</p></div>
								<div class="payment-right"><p class="rs">1000</p></div>
							</div>
							
							<div class="pay-box">
								<div class="payment-left"><p>Coupon Amount</p></div>
								<div class="payment-right"><p class="rs">500</p></div>
							</div> -->
							<div class="pay-box">
								<div class="payment-left"><p>Shipping charges</p></div>
								<div class="payment-right"><p class="rs shipping"><?=$shipping?></p></div>
							</div>
							<span class="coupon_here"></span>
							
							<div class="pay-box t-amount">
								<div class="payment-left"><p>Total Amount</p></div>
								<div class="payment-right"><p class="rs total"><?=$amount+$shipping?></p></div>
							</div>
							
						</div>
					</div>					
				</div>
			</div>
		</div>	
	</main>
	<?php include 'layouts/footer.php'; ?>
<script>
	function fetchCities(state){
			const baseURL = "<?php echo base_url();?>";
			$.ajax({
			type: "POST",
			url: baseURL+'fetch-cities',
			data: {state_name:state},
			dataType: "text",
			success: function(response){
				let data = JSON.parse(response);
				if(data.length > 0){
					var output = [];
					$.each(data, function(key, value)
					{
					output.push('<option value="'+ value.city_name +'">'+ value.city_name +'</option>');
					});
			
						$('#cities_list').html(output.join(''));
					}
				}
		});
		}
</script>
	<script type="text/javascript">
		$("form").submit(function(e) {
         	$('#cover-spin').show();
         	e.preventDefault();
         	var form = $("#myform");

         	var formData = new FormData(form[0]);
         	$.ajax({
         	type: "POST",
            url: '<?=base_url()?>checkout_data',
            //dataType: 'json', //not sure but works for me without this
            data: formData,
            contentType: false, //this is requireded please see answers above
            processData: false, //this is requireded please see answers above
            //cache: false, //not sure but works for me without this
            success: function(data) 
            {
            	if(data=='success')
            	{
            		window.location.href = '<?=base_url()?>payment';
            		// window.location.href = '<?=base_url()?>pay';
            	}
            	else
            	{
            	    swal("Ooops..!", "Your cart is empty.", "error");
            	    window.location.href = '<?=base_url()?>';
            	}
            }, //You missed this
            error: function() 
            {
                	swal("Alert", "Something went wrong.", "error");
            }
            });
         });
         
	</script>
	<?php } if($amount==''){ session_destroy() ; ?>
	
	<script type="text/javascript">
	alert('Your cart is empty');
	window.location.href="<?=base_url()?>";
	</script>
	<?php } ?>
	<script>
	    fbq('track', 'InitiateCheckout');
	    
	    $('.apply_code').click(function(){
	        var code = $('.code').val();
	        if(code=='')
	        {
	            $('.msg').hide();
	            swal('Please enter coupon code');return false;
	        }
	        else
	        {
	            $.post('<?=base_url()?>apply',{code:code,subtotal:"<?=$amount?>"},function(data){
	                
	                var respo = JSON.parse(data);
	                
	                if(respo.result=='error')
	                {
	                    $('.msg').hide();
	                    $('.total').text(respo.total);
	                    $('.coupon_here').html('');
	                    swal('Invalid coupon code');return false;
	                }
	                else if(respo.result=='applied')
	                {
	                    $('.msg').show();
	                }
	                else
	                {
	                    $('.total').text(respo.total);
	                    $('.coupon_here').html('<div class="pay-box"><div class="payment-left"><p>Coupon discount(-)</p></div><div class="payment-right"><p class="rs shipping">'+respo.dicount+'</p></div></div>');
	                
	                    $('.msg').show();
	                }
	                
	            })
	        }
	    })
	    
	</script>
