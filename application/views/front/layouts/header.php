<?php

$device = 'desk';                   
if(isset($_SERVER['HTTP_USER_AGENT']) and !empty($_SERVER['HTTP_USER_AGENT']))
{
    $user_ag = $_SERVER['HTTP_USER_AGENT'];
    if(preg_match('/(Mobile|Android|Tablet|GoBrowser|[0-9]x[0-9]*|uZardWeb\/|Mini|Doris\/|Skyfire\/|iPhone|Fennec\/|Maemo|Iris\/|CLDC\-|Mobi\/)/uis',$user_ag))
    {
        $device = 'mobile';
    }
    else
    {
        $device = 'desk';
    }
}
else
{
    $device = 'desk';    
}


$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$mobile_number = '9014343695';
?>
<html>
<head>
		<title>Welcome to Star Registration</title>
		<link rel="icon" type="image/x-icon" href="<?=base_url()?>assets/web/offers/favicon.ico" size="32x32">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="facebook-domain-verification" content="8fbwzueglt9nx9jwdvsbq0jtkftacb" />
		<meta property="og:image" content="https://joyfulsurprises.in/assets/web/img/js-logo-brand.png">
        <meta property="og:image:type" content="image/jpeg">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

      <link rel="stylesheet" href="<?=base_url()?>assets/web/css/style.css">
      <link rel="stylesheet" href="<?=base_url()?>assets/web/icon-font/font/flaticon.css">
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet"> -->

      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">

      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@600&display=swap" rel="stylesheet">

      <link rel="stylesheet" href="<?=base_url()?>assets/web/css/flyout.css">
      <!-- Slider css -->
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/web/slick/slick.css">
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/web/slick/slick-theme.css">
      <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
      <link href="<?=base_url()?>assets/web/js/src/jquery.exzoom.css" rel="stylesheet" type="text/css"/>
      <link rel="stylesheet" href="<?=base_url()?>assets/web/css/responsive-style.css">
      
      
      <!---sweet alerts-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
      <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KRZ8HWZ');</script>
<!-- End Google Tag Manager -->
      
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		 
		<!-- owl carousel -->
		<!-- <link href="js/owl.transitions.css" rel="stylesheet">
		<link href="js/owl.carousel.css" rel="stylesheet"> -->

<style>
		 ul.product-list-image-test.medium-9.columns {
    margin-top: 18px;
    margin-left: -42px;
    margin-bottom: -20px;
}
		 li.variantItem.selectedVariant {
    
    list-style-type: none;
    cursor: pointer;
    margin-right: 25px;
}
		 
		 <?php if($device=='mobile'){ ?>
.bottom-head
{
    margin: auto;
    width: 220px;
    margin-bottom: 50px;
    display: block;

}
h1
		 {
		     margin-bottom:10px;
		 }
<?php }else{ ?>
.bottom-head
{
    margin: auto;
    width: 320px;
    margin-bottom: 50px;
    display: block;

}
h1
		 {
		     margin-bottom:15px;
		 }
<?php } ?>
      	#exzoom {
      		width: 600px;
      		/*height: 400px;*/
      		
      	}
      	.hidden { display: none; }


      	#cover-spin {
      		position:fixed;
      		width:100%;
      		left:0;right:0;top:0;bottom:0;
      		background-color: rgba(255,255,255,0.7);
      		z-index:9999;
      		display:none;
      	}

      	@-webkit-keyframes spin {
      		from {-webkit-transform:rotate(0deg);}
      		to {-webkit-transform:rotate(360deg);}
      	}

      	@keyframes spin {
      		from {transform:rotate(0deg);}
      		to {transform:rotate(360deg);}
      	}

      	#cover-spin::after {
      		content:'';
      		display:block;
      		position:absolute;
      		left:48%;top:40%;
      		width:40px;height:40px;
      		border-style:solid;
      		border-color:black;
      		border-top-color:transparent;
      		border-width: 4px;
      		border-radius:50%;
      		-webkit-animation: spin .8s linear infinite;
      		animation: spin .8s linear infinite;
      	}
      	
      	<?php if($device=='mobile'){ ?> 
      	li[role="presentation"] button {
    display: none;
}
      	<?php } ?>
      	
  a:hover, a:visited, a:link, a:active
{
    text-decoration: none;
}    	
</style>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-ZVCH0XPYX7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-ZVCH0XPYX7');
</script>

<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '2941887766103885');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=2941887766103885&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->


<!-- Global site tag (gtag.js) - Google Ads: 380930794 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-380930794"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-380930794');
</script>

<!-- Event snippet for Website sale conversion page -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-380930794/vTE0CPDzsowCEOqV0rUB',
      'transaction_id': ''
  });
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-195155516-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-195155516-1');
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-C8BJ72LBE1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-C8BJ72LBE1');
</script>
		<meta name="facebook-domain-verification" content="sw3x5d2xawr3sis4woumm8k0pxpqeo" />
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KRZ8HWZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<header>
	    <div id="cover-spin"></div>
		<div class="top-nav">
			<div class="container">
				<div class="row">
					<!--<div class="col-md-3">-->
					<!--	<div><p class="top-text" style="font-size: 14px;"><b></b></p></div>-->
					<!--</div>-->
					<div class="col-md-3">
						<div><p class="top-text" style="font-size: 15px;">100% Satisfaction Guarantee.</p></div>
					</div>
					<div class="col-md-3">
						<div><p class="top-text" style="font-size: 15px;">Delivery Time 5-6 days</p></div>
					</div>
					<div class="col-md-6">
						<ul class="top-icons">
						    
							<!--<li><i class="fa fa-phone"></i> <a href="tel:<?=$mobile_number?>">+91 <?=$mobile_number?></a></li>-->
							<li class="desk"><i class="fa fa-envelope"></i><a href="mailto:giftastaruk@gmail.com">giftastaruk@gmail.com</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container">  
		<div class="menu_main_full">
			<nav class="navbar navbar-default">
				<div class="menu-line">
				  <div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
					<a class="navbar-brand" href="<?=base_url()?>"><img src="<?=base_url()?>assets/web/img/js-logo-brand.png" class="logo"></a> </div>
				  <div class="collapse navbar-collapse" id="myNavbar">
					
					<ul class="nav navbar-nav navbar-right" id="urls">
					  <li><a href="<?=base_url()?>">Home</a></li>
					  <li><a href="<?=base_url()?>all-products">Products</a></li>
					  <li><a href="<?=base_url()?>find-your-star">Find Your Star</a></li>
					  <!-- <li><a href="#" class="woo"><i class="fa fa-user-circle-o"></i> My Account</a></li>
					  <li><a href="#" class="woo cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a></li> -->
					</ul>
					
				  </div>
				  
				</div>
			</nav>
		</div>
		
		<div class="menu_rlinks">
			<div class="shop-block">
				<ul>
					<!-- <li><a href="#" class="woo"><i class="fa fa-user-circle-o"></i> <span class="acc-text">My Account</span></a></li> -->
					<li><a href="javascript:void[0]" class="cd-btn js-cd-panel-trigger woo cart" data-panel="main"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="acc-text">Cart</span></a></li>
				</ul>
			</div>
		</div>
		</div>
	 
		
		
	</header>
	<!-- ***************************************** -->
         <div class="left-menu">
            <div class="cd-panel cd-panel--from-left js-cd-panel-main">
               <header class="cd-panel__header">
                  <h1>Cart</h1>
                  <a href="javascript:void[0]" class="cd-panel__close js-cd-close close">Close</a>
               </header>
               <div class="cd-panel__container" >
                  <div class="cd-panel__content" id="cart_data">
                  	
                     <!-- <div class="line"></div>
                     <div class="row">
                        <div class="col-md-6 res-half">
                           <img src="<?=base_url()?>assets/web/img/star1.jpg" class="cart-img">
                        </div>
                        <div class="col-md-6 res-half">
                           <h5 class="cp-title">Product Title Here </h5>
                           <ul class="price-list">
                              <li class="rs">2000</li>
                           </ul>
                           <ul class="rating">
                              <li><i class="fa fa-star" aria-hidden="true"></i></li>
                              <li><i class="fa fa-star" aria-hidden="true"></i></li>
                              <li><i class="fa fa-star" aria-hidden="true"></i></li>
                              <li><i class="fa fa-star" aria-hidden="true"></i></li>
                              <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           </ul>
                           <a class="remove-text last-remove">Remove</a>	
                        </div>
                     </div> -->
                  </div>
                  <!-- cd-panel__content -->
                  <div class="cd-bottom">
                     <a href="javascript:void[0]" id="checkout" class="btn pay">Continue Payment</a>
                  </div>
               </div>
               <!-- cd-panel__container -->
            </div>
            <!-- cd-panel -->
         </div>
         <!-- ***************************************** -->
         <script>
             $('.cart').click(function(){
                 cart();
                 $('.cd-panel').addClass('cd-panel--is-visible');
             })
             
             $('.close').click(function(){
                 cart();
                 $('.cd-panel').removeClass('cd-panel--is-visible');
             })
             
         function remove_cart(pid)
         {
            
         	if(confirm('Are you sure want to remove this product from cart..?'))
         	{
         	     $('#cover-spin').show();
         		$.post('<?=base_url()?>remove-cart',{pid:pid},function(data){
         			cart();
         			$('#cover-spin').hide();
         		})
         	}
         }
         
         $('#checkout').click(function(){
             $('#cover-spin').show();
             $.post('<?=base_url()?>check-cart',{check:'yes'},function(data){
                 if(data=='yes')
                 {
                     window.location.href="<?=base_url()?>checkout";
                 }
                 else
                 {
                     swal("Ooops..!", "Your cart is empty.", "error");
                 }
                 $('#cover-spin').hide();
             })
         })
         
         $('#urls li a').each(function(){
             var url = $(this).attr('href');
             var tar = $(this);
             if(url=='<?=$actual_link?>')
             {
                 tar.parent().addClass('active');
             }
         })
         </script>