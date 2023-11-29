<?php include 'layouts/header.php'; 
$rev = $this->common_library->fetch_product_rating_count($product[0]->id);
?>

<style>
    @media screen and (max-width: 599px) { .img{display:none;} .prdbar{max-width:110px !important;}  .btn-two{width: 100%!important;text-align:center; color: #fff;text-decoration: none;border: 1px solid #337ab7;padding: 10px;background-color: #337ab7;display:block; } }
    @media screen and (min-width: 600px){ .mob-btn{display:none;} }
    
    .skeleton-brlajzzw3r0:empty {position: relative; box-sizing: content-box; height: 600px; background-color: #ffffff; border-radius: 0px 0px 0px 0px; background-image: linear-gradient( #F5F7F9 6px, transparent 0 ),linear-gradient( #F5F7F9 6px, transparent 0 ),linear-gradient( #F5F7F9 6px, transparent 0 ),linear-gradient( #F5F7F9 6px, transparent 0 ),linear-gradient( #F5F7F9 6px, transparent 0 ),radial-gradient( circle 20px at 20px 20px, #F5F7F9 99%, transparent 0 );background-repeat: repeat-y;background-size: 43% 133px,90% 133px,74% 133px,52px 133px,88px 133px,40px 133px;background-position: 12px 111px,12px 92px,12px 73px,59px 39px,59px 21px,12px 12px;}.skeleton-brlajzzw3r0:empty:before {content: ' '; position: absolute; z-index: 1000; width: 100%; height: 600px;-webkit-mask-image: linear-gradient( 100deg, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.5) 50%, rgba(255, 255, 255, 0) 80% ); -webkit-mask-repeat : repeat-y; -webkit-mask-size : 50px 600px; -webkit-mask-position: -20% 0;background-image: linear-gradient( rgba(102,102,102,1) 6px, transparent 0 ),linear-gradient( rgba(102,102,102,1) 6px, transparent 0 ),linear-gradient( rgba(102,102,102,1) 6px, transparent 0 ),linear-gradient( rgba(102,102,102,1) 6px, transparent 0 ),linear-gradient( rgba(102,102,102,1) 6px, transparent 0 ),radial-gradient( circle 20px at 20px 20px, rgba(102,102,102,1) 99%, transparent 0 );background-repeat: repeat-y;background-size: 43% 133px,90% 133px,74% 133px,52px 133px,88px 133px,40px 133px;background-position: 12px 111px,12px 92px,12px 73px,59px 39px,59px 21px,12px 12px;animation: shineForSkeleton-brlajzzw3r0 2s infinite;}@keyframes shineForSkeleton-brlajzzw3r0 {to {-webkit-mask-position: 120% 0}}
    </style>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/review.css">

<?php $rate_by_rating=0; for($rr=5;$rr>=1;$rr--){ $r_count = $this->common_library->fetch_rating_by_rate($product[0]->id,$rr); $rate_by_rating += $rr*count($r_count); } $final_rate = $rate_by_rating/count($rev); ?>

<main style="background: #f1f3f6">
   <div class="container" style="margin-top: 8px">
      <div class="row" style="margin-top: 20px;">
         <div class="col-md-4">
             <!--<div class="img" style="margin-top: 1px;background: #fff;width: 90%;text-align: center;height: 66%;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">-->
             <div class="img">
             <img src="<?=base_url()?>assets/uploads/product/<?=$img[0]->images?>" style="width:250px;margin-top: 25px;height:300px;">
             <a href="<?=base_url()?>product/<?=$product_name?>" class="btn pay e-b" style="width: 252px;">Buy now</a>
             </div>
         </div>
         <div class="col-md-8" style="background: #fff;margin-bottom: 20px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
            <div class="row" style="margin-bottom: 20px;margin-top: 15px;padding-top:15px;">
               <!--  <div class="col s4 m6 l6 clearfix" style="border-right:1px solid rgb(230,230,230); padding-top: 10px;"> -->
               <div class="col-sm-3 col-xs-5">
                  <div class="rating-block" style="background: #fff;text-align: center;">
                     <h2 class="bold" style="margin-bottom: -5px;margin-top: 25px;"><?=bcdiv($final_rate, 1, 1); ?> <i class="glyphicon glyphicon-star" style="font-size: 22px;"></i><br><span style="font-size: 15px;font-weight: 100;"><?=count($rev)?> reviews</span></h2>
                  </div>
               </div>
               <div class="col-sm-6 col-xs-7">

               	  <?php for($rr=5;$rr>=1;$rr--){ $r_count = $this->common_library->fetch_rating_by_rate($product[0]->id,$rr); ?>
                  <?php $percentage = round( ( count($r_count) / count($rev) ) * 100 );  ?>
                  <?php  if($rr=='1'){ $csss= 'margin-left: 4px;'; }else{ $csss=''; } ?>
                  <div class="pull-left">
                     <div class="pull-left" style="width:35px; line-height:1;">
                        <div style="height:9px; margin:5px 0;<?=$csss?>"><?=$rr?> <span class="glyphicon glyphicon-star"></span></div>
                     </div>
                     <div class="pull-left prdbar" style="width:180px;">
                        <div class="progress" style="height:9px; margin:8px 0;">
                           <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: <?=$percentage?>%">
                              <span class="sr-only">80% Complete (danger)</span>
                           </div>
                        </div>
                     </div>
                     <div class="pull-right" style="margin-left:10px;"><?=count($r_count)?></div>
                  </div>
                   <?php } ?>
                  
               </div>
               <div class="col-sm-3">
               	
               </div>
               <!-- </div> -->
            </div>

            <div class="reviews_section">
               
            </div>
            
         </div>
        
      </div>
      
   </div>
   <div class="mob-btns">
            <a href="<?=base_url()?>product/<?=$product_name?>" class="mob-btn btn-two">Buy now</a>
            </div>
</main>
<?php include 'layouts/footer.php'; ?>

<script type="text/javascript">
	review();
	function review(start=1)
	{
	    $(window).scrollTop(200);
		$('.reviews_section').html('<div class="skeleton-brlajzzw3r0"></div>');
		$.post('<?=base_url()?>fetch-review',{pid:'<?=$product[0]->id?>',start:start},function(respo){
			$('.reviews_section').html(respo);
			
		})
	}
</script>