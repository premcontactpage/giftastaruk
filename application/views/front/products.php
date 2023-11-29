<?php include 'layouts/header.php'; ?>
<style type="text/css">
	.box {
  
  position: relative;
  
}
.ribbon {
  position: absolute;
    left: 12px;
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


</style>

	<main>
		
		<div class="inner-banner">
			<div class="container">
				<p>Products</p>
			</div>
		</div>
		
		<div class="page-sec" >
			<div class="container">
				<div class="row">

				<?php 
				   $seller = 1;
				   if(count($products)>0){ foreach($products as $pr){ 
                   
                   $img = $this->common_library->fetch_product_img($pr->id);
				?>
					<div class="col-md-3 product-block box">
					    <?php if($seller==1 || $seller==2){ ?>
					    <div class="ribbon"><span>Best seller</span></div>
					    <?php } $seller++; ?>
						<?php if($pr->url_name!=""){ $product_url = str_replace(' ', '-', strtolower($pr->url_name)); ?>
						<a href="<?=base_url().'product/'.$product_url?>">
					    <?php }else{ $product_url = str_replace(' ', '-', strtolower($pr->product_name)); ?>
					    <a href="<?=base_url().'product/'.$product_url?>">
				        <?php } ?>
							<div class="pro-box">
							    <?php $text ='';$style='style="margin-bottom: 26px;"'; if($pr->id==6){ $text = '<span style="font-size: 13px;color: #0cce0c;">Get free gift worth Rs.999</span>';$style='style="margin-bottom: 0px;"';  } ?>
							
							    
								<?php if($device=='mobile'){ ?>
								<img src="<?=base_url()?>assets/uploads/product/<?=$img[0]->images?>" style="height: 320px;">
								<h6 <?=$style?> title="<?=$pr->product_name?>" class="pro-name"><?=mb_strimwidth(ucfirst($pr->product_name), 0, 30, "...")?></h6>
								<?php }else{ ?>
								<img src="<?=base_url()?>assets/uploads/product/<?=$img[0]->images?>" style="height: 275px;">
								<h6 <?=$style?> title="<?=$pr->product_name?>" class="pro-name"><?=mb_strimwidth(ucfirst($pr->product_name), 0, 20, "...")?></h6>
								<?php } echo $text ; ?>
								
								
								<ul class="price-list">
									<?php if($pr->offer_price>0){ ?>
										<li class="rs"><?=number_format($pr->offer_price)?></li>
										<li class="strike"><span style='color:#867e7e'><?= CURRENCY_SYMBOL ?></span>
										    <strike style='color:#867e7e'><span style='color:#867e7e'><?=number_format($pr->price)?><span></strike>
										</li>
										<!-- <li class="offer">(50%) Off</li> -->
									<?php }else{ ?>
										<li class="rs"><?=number_format($pr->price)?></li>
									<?php } ?>
									
								</ul>
								<?php
								$rating  = $this->common_library->fetch_product_rating($pr->id);
								$reviews = $this->common_library->fetch_product_rating_count($pr->id);
								
								$avg = explode('.',$rating[0]->count);
								
								?>
								<ul class="rating">
								    
								    <?php for($c=1;$c<=5;$c++){ if($avg[0] >= $c){ ?>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <?php }else{ ?>
                            <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                            <?php } } ?>
								    
								    <?php if(count($reviews)>0){ ?>
									<li class="r-text"><?=count($reviews)?> Reviews</li>
									<?php } ?>
								</ul>
							</div>
						</a>
					</div>
				<?php } } ?>
					
				</div>
			</div>
		</div>
		
		
	
	</main>
	<?php include 'layouts/footer.php'; ?>




















