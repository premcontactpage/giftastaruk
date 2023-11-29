<?php include 'layouts/header.php'; ?>

<style type="text/css">
	.box {
  
  position: relative;
  
}
.ribbon {
  position: absolute;
    left: 20px;
    top: -5px;
    z-index: 1;
    overflow: hidden;
    width: 75px;
    height: 75px;
    text-align: right;
    transform: rotate(
-90deg
);
}
.ribbon span {
  font-size: 10px;
  font-weight: bold;
  color: #FFF;
  text-transform: uppercase;
  text-align: center;
  line-height: 20px;
  transform: rotate(45deg);
  -webkit-transform: rotate(45deg);
  width: 100px;
  display: block;
  background: #79A70A;
  background: linear-gradient(#9BC90D 0%, #79A70A 100%);
  box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
  position: absolute;
  top: 19px; right: -21px;
}
.ribbon span::before {
  content: "";
  position: absolute; left: 0px; top: 100%;
  z-index: -1;
  border-left: 3px solid #79A70A;
  border-right: 3px solid transparent;
  border-bottom: 3px solid transparent;
  border-top: 3px solid #79A70A;
}
.ribbon span::after {
  content: "";
  position: absolute; right: 0px; top: 100%;
  z-index: -1;
  border-left: 3px solid transparent;
  border-right: 3px solid #79A70A;
  border-bottom: 3px solid transparent;
  border-top: 3px solid #79A70A;
}

.slick-dots
{
    display:none !important;
}
</style>

<main>
		<div class="banner-sec">
			<?php if($device=='mobile'){ ?>
			    <a href="<?=base_url()?>all-products"><img src="<?=base_url()?>assets/web/img/Banner-final-mobile (1).jpg"></a>
		    <?php }else{ ?>
		    	<a href="<?=base_url()?>all-products"><img src="<?=base_url()?>assets/web/img/Banner-Final-Desktop.jpg"></a>
		    <?php } ?>
			<div class="container">
				
			</div>
			<!--<svg class="bottom-curve" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1800 110">-->
   <!--           <path d="M0,99.3c249.7-45,553.6-80.5,899.7-80.8c346.4-0.3,650.4,34.8,900.3,79.5c0-32.7,0-65.3,0-98C1200,0,600,0,0,0 C0,33.1,0,66.2,0,99.3z"></path>-->
   <!--       </svg>-->
		</div>
		
		  
		  
		<div class="home-sec star-sec">
			<div class="container">
				<h1>Buy a Star</h1>
				<img class="bottom-head" src="<?=base_url()?>assets/web/img/Underline.png">
				<div class="row">
					<?php $i=1; if(count($products)>0){ foreach($products as $pr){ ?>
					<div class="col-md-4 buy-block box">
					    <?php if($i==1){ ?>
					    <div class="ribbon"><span>Best seller</span></div>
					    <?php } ?>
						<div class="star-box">
						    
						    <?php if($i==1){ ?>
						    <img src="<?=base_url()?>assets/web/home/star_img.jpg"> 
						    <?php }else{ ?>
							<img src="<?=base_url()?>assets/web/home/star_pdf<?=$i?>.jpg"> 
							<?php } ?>
							<div class="star-box-text" style="box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0">
								<h3><?=ucfirst($pr->product_name)?></h3>

								<?php if($pr->offer_price>0){ ?>
								<p class="price"><?= CURRENCY_SYMBOL.' '. number_format($pr->offer_price)?></p>
							    <?php }else{ ?>
							    	<p class="price"><?= CURRENCY_SYMBOL.' '. number_format($pr->price)?></p>
							    <?php } ?>
                                
                                <?php if($i==1){ ?> 
                                <p>Name a guaranteed visible star. Visible throughout the whole year. Star certificate along with the map will be placed in a frame & packed in a box will be deliverd. <br>Delivery all over India.</p> 
                                
                                <?php }elseif($i==2){ ?>
                                <p>Name a guaranteed visible star. Visible throughout the whole year. Star certificate along with the map will be sent directly to your phone. <br>Can be delivered anywhere in the world.</p>
								
								<?php }elseif($i==3){ ?>
								 <p>Name a guaranteed visible star. Visible throughout the whole year. Star certificate along with the map will be sent directly to your delivery address. <br>Delivery all over India.</p> 
								<?php } ?>

								<?php if($pr->url_name!=""){ $product_url = str_replace(' ', '-', strtolower($pr->url_name)); ?>
									<a class="buy-btn" href="<?=base_url().'product/'.$product_url?>">Buy now</a>
								<?php }else{ $product_url = str_replace(' ', '-', strtolower($pr->product_name)); ?>
								<a class="buy-btn" href="<?=base_url().'product/'.$product_url?>">Buy now</a>
							    <?php } ?>
							</div>
						</div>
					</div>
					<?php $i++; } } ?>
				</div>
			</div>
		</div>
		
		<div class="home-sec work-sec" style="display: none;">
			<div class="container">
				<h1 style="color: #fff;">How does it works</h1>
				<div class="row">
					<div class="col-md-6 res-half">
						<div>
							<img src="<?=base_url()?>assets/web/img/work.jpg" class="work-flow-img">
						</div>
					</div>
					
					<div class="col-md-6 res-half">
						<div class="work-text">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
							<div class="video-box">
								<div class="thepassion-grid-video grid-video-1001438 img-radius hidden-animate" data-animated="bounceInLeft" data-color="#fff" data-bg="#000">
								<a target="_blank" href="#" id="video-1001438" class="thepassion-video-box-layout" data-lity="">
									<img src="<?=base_url()?>assets/web/img/star1.jpg" class="video-img">
									<div class="thepassion-video-blockbox-caption">
										<div class="thepassion-video-blockbox-caption-content"><img src="<?=base_url()?>assets/web/http://posimyththemes.com/thepassion/the-musician/wp-content/themes/thepassion/images/round.png" alt="image-rounded"></div>
									</div>
								</a>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
		
		<div class="home-sec" style="background: #f6fbff">
			<div class="container">
				<h1>About Star Registration</h1>
				<img class="bottom-head" src="<?=base_url()?>assets/web/img/Underline.png">
				<div class="row">
					<div class="col-md-6 res-half">
						<div class="icon-box">
							<div class="circle-star">
								<i class="fa fa-star"></i>
							</div>
						</div>
						<div class="icon-text">
							<h2>Only visible stars</h2>
							<p>We only name stars that are clearly visible from any place on earth throughout the year! If you do not like the star we have named for you, or on the rare occasion that you're dissatisfied with our service, we will name another star for you or refund the full purchase price.</p>
						</div>
					</div>
					
					<div class="col-md-6 res-half">
						<div class="icon-box">
							<div class="circle-star">
								<i class="fa fa-registered"></i>
							</div>
						</div>
						<div class="icon-text">
							<h2>The Star Register</h2>
							<p>We have officially partnered with Star-Register.com, the worldwide leading Star Platform, which regularly audits us for quality, reliability and data safety. If you buy a star it gets recorded in the registry and, thus, can be retrieved at any time by using their unique iOS and Android App.</p>
						</div>
					</div>
					
					<div class="mt-100"></div>
					
					<div class="col-md-6 res-half">
						<div class="icon-box">
							<div class="circle-star">
								<i class="fa fa-rocket"></i>
							</div>
						</div>
						<div class="icon-text">
							<h2>Fast Processing</h2>
							<p>Due to our many years of experience and good connections at the Star-naming Registry, we can name your star and ship your documents within 2-3 hours. In urgent cases, we can also initially send you the documents by E-Mail.</p>
						</div>
					</div>
					
					<div class="col-md-6 res-half">
						<div class="icon-box">
							<div class="circle-star">
								<i class="fa fa-headphones"></i>
							</div>
						</div>
						<div class="icon-text">
							<h2>Customer Care</h2>
							<p>If you name a star with us, we will assist you before and after the purchase. You can contact us anytime on our 24/7 Livechat or by E-Mail. We will answer your questions about naming stars and will be glad to provide you with further help.</p>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="home-sec offer-sec">
			<div class="container">
			    <?php if($device=='mobile'){ ?>
			    <h1 style="color: #fff;margin-bottom: -20px;">All Our Offers Include</h1>
			    <?php }else{ ?>
			    <h1 style="color: #fff;">All Our Offers Include</h1>
			    <?php } ?>
				
				<div class="row">
					<div class="col-md-4 buy-block">
						<div class="offer-box">
							<div class="offer-box-text">
								<img src="<?=base_url()?>assets/web/offers/offer1.png" class="offer-img">
								
								<h2><i class="flaticon-winner"></i>Certificate</h2>
								<p>Your certificate will be printed on high-quality premium paper so it's the perfect gift. Consequently, we guarantee that your certificate will remain imperishable and brightly colored for a lifetime.</p>
							</div>
							
						</div>
					</div>
					
					<div class="col-md-4 buy-block">
						<div class="offer-box">
							<div class="offer-box-text">
								<img src="<?=base_url()?>assets/web/offers/offerr3.png" class="offer-img">
								
								<h2><i class="flaticon-location"></i>Celestial Map</h2>
								<p>You will receive an individual star chart prepared just for you. By using this star chart, you will be able to effortlessly orient yourself to the night sky and locate your star within seconds.</p>
							</div>
							
						</div>
					</div>
					
					<div class="col-md-4 buy-block">
						<div class="offer-box">
							<div class="offer-box-text">
								<img src="<?=base_url()?>assets/web/offers/offerr2.png" class="offer-img">
								
								<h2><i class="flaticon-registration"></i>Registration</h2>
								<p>Your star will be registered in the Registry. Through a unique naming number, which will also appear in your certificate, you can retrieve your record anywhere in the world, at any time.</p>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="home-sec review-sec">
			<div class="container">
				<h1>Customer Reviews</h1>
				<img class="bottom-head" src="<?=base_url()?>assets/web/img/Underline.png">
				
				<section class="center slider">

					<?php if(count($reviews)>0){ foreach($reviews as $r){ ?>
					<div>
					  <div class="review-card" style="width: 100%;box-shadow: rgb(60 64 67 / 4%) 0px 1px 2px 0px, rgb(60 64 67 / 25%) 0px 2px 6px 2px;">
						<ul class="rating">
							<?php for($c=1;$c<=5;$c++){ if($r->rating >= $c){ ?>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <?php }else{ ?>
                            <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                            <?php } } ?>
							<!-- <li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li> -->
						</ul>
						<h6 style="font-size: 16px;"><?=mb_strimwidth(ucfirst($r->title), 0, 18, "...")?></h6>
						<p class="review-text" style="margin-bottom: 40px;font-size: 14px;height: 75px;"><?=mb_strimwidth($r->review, 0, 100, "...")?></p>
						<div class="review-details" style="font-size: 11px;">
							<p class="c-name"><?=mb_strimwidth(ucfirst($r->user_name), 0, 18, "...")?></p>
							<p class="date"><?=date('M d, Y',strtotime($r->date))?></p>
						</div>
					  </div>
					</div>
				   <?php } } ?>
					
					</div>
				</section>
				
				
				<div id="myCarousel" class="carousel slide" data-ride="carousel" style="display: none;">
					<!-- Indicators -->
					<ol class="carousel-indicators">
					  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					  <li data-target="#myCarousel" data-slide-to="1"></li>
					  <li data-target="#myCarousel" data-slide-to="2"></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner">
					  <div class="item active">
						<div class="row">
							<div class="col-md-6 res-half">
								<div class="review-box">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
									<h5 class="name">Hema</h5>
								</div>
							</div>
							<div class="col-md-6 res-half">
								<div class="review-box">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
									<h5 class="name">Prudhvi</h5>
								</div>
							</div>
						</div>
					  </div>

					  <div class="item">
						<div class="row">
							<div class="col-md-6">
								<div class="review-box res-half">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
									<h5 class="name">Hema</h5>
								</div>
							</div>
							<div class="col-md-6 res-half">
								<div class="review-box">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
									<h5 class="name">Prudhvi</h5>
								</div>
							</div>
						</div>
					  </div>
					
					  <div class="item">
						<div class="row">
							<div class="col-md-6 res-half">
								<div class="review-box">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
									<h5 class="name">Hema</h5>
								</div>
							</div>
							<div class="col-md-6 res-half">
								<div class="review-box">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
									<h5 class="name">Prudhvi</h5>
								</div>
							</div>
						</div>
					  </div>
					</div>
				</div>
			</div>	
		</div>
	</main>
	<?php include 'layouts/footer.php'; ?>