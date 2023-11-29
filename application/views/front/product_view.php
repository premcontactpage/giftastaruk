
<?php include 'layouts/header.php'; ?>


<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/review.css">
<style>
.slick-next
{
    right:0px!important;
}
    .secure-img {
    padding: 0px;
    width: 65%;
    margin: auto;
    display: block;
    margin-top: 10px;
}
.secure-img li{
    display: inline-block;
    list-style: none;
    width: 25%;
    float: left;
    text-align: center;
}
.secure-img li img {
    width: 75px;
}
@media only screen and (max-width: 480px) {
  .secure-img {
    padding: 0px;
    width: 100%;
    margin: auto;
    display: flex;
    margin-bottom: 15px;
    clear: both;
}
}

.exzoom_nav
{
    margin-left: -28px;
}
.exzoom_img_ul_outer
{
    width: 530px!important;
    height: 530px;
    margin-left: -46px;
}
.sweet-alert h2
{
    font-size: 18px!important;
    margin: 0px 0px!important;
}

.sweet-alert button {
    background-color: #8cd4f5;
    color: white;
    border: 0;
    box-shadow: none;
    font-size: 17px;
    font-weight: 500;
    -webkit-border-radius: 4px;
    border-radius: 5px;
    padding: 3px 32px!important;
    margin: 0px 5px 0 5px!important;
    cursor: pointer;
}
a, a:hover, a:active, a:visited, a:focus {
    text-decoration:none;
}

.glyphicon-chevron-left:before {
    content: "\e079";
    color: #fff;
    background: black;
    padding: 5px;
    border-radius: 5px;
    
}

.glyphicon-chevron-right:before {
    content: "\e080";
    color: #fff;
    background: black;
    padding: 5px;
    border-radius: 5px;
}
</style>
<div id="cover-spin"></div>
      <main>
         <div class="inner-banner">
            <div class="container">
               <p>Product View</p>
            </div>
         </div>
         
         <div class="page-sec" style="overflow:hidden;">
            <div class="container">
               <div class="row">
                  <div class="col-md-6">
                     <?php 
                        $img = $this->common_library->fetch_product($product[0]->id); 
                        $tag = $this->common_library->fetch_product_tags($product[0]->id);
                        $rev = $this->common_library->fetch_product_rating_count($product[0]->id);
                        
                        $rating  = $this->common_library->fetch_product_rating($product[0]->id);
                        $reviews = $this->common_library->fetch_product_rating_count($product[0]->id);
                        $variants = $this->common_library->fetch_product_variants($product[0]->id); 
                
                        $avg = explode('.',$rating[0]->count);
              
                     ?>
                     
                     
                     
                     <div class="product-img" style="height:auto;">
                         <div id="myCarousel" class="carousel slide" data-ride="carousel">
  

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
      <?php $i=1; if(count($img)>0){ foreach($img as $ig){ if($i==1){ $class="active";}else{ $class=""; } ?>
    <div class="item <?=$class?>">
      <img src="<?=base_url()?>assets/uploads/product/<?=$ig->images?>" alt="Los Angeles">
    </div>
    <?php  $i++; } } ?>

    
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
                     </div>
                     <!-- ****************************** Gallery START ******************************** -->
                     <div class="exzoom hidden" id="exzoom">
                         <div class="exzoom_nav"></div>
                        <div class="exzoom_img_box">
                          
                           <ul class='exzoom_img_ul'>
                              <?php if(count($img)>0){ foreach($img as $ig){ ?>
                              <li><img src="<?=base_url()?>assets/uploads/product/<?=$ig->images?>"></li>
                              <?php } } ?>
                            
                           </ul>
                        </div>
                        
                        <!-- <p class="exzoom_btn">
                           <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                           <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                           </p> -->
                     </div>
                     <?php if($device=='mobile'){ ?> 
                     <ul class="secure-img">
                     <?php }else{ ?>
                     <ul class="secure-img">
                     <?php } ?>
                     
                    <!--<li><img src="<?=base_url()?>assets/secure/Artboard 1-8.png"></li>-->
                    <li><img src="<?=base_url()?>assets/secure/checkout.png"></li>
                    <li><img src="<?=base_url()?>assets/secure/24x7.png"></li>
                    <li><img src="<?=base_url()?>assets/secure/Satisfaction.jpg"></li>
                    <li><img src="<?=base_url()?>assets/secure/Validity.jpg"></li>
                  </ul>
                     <!-- ****************************** Gallery END ******************************** -->
                  </div>
                  
                  <div class="col-md-6">
                     <div class="pro-desc">
                        
                        <?php if($product[0]->id==6){ ?>
                        <h1 style="font-size: 30px;margin-bottom:0px;color: black;font-weight: 600;"><?=ucfirst($product[0]->product_name)?></h1>
                        <span style="font-size: 15px;color: #0cce0c;">Get free gift worth Rs.999</span>
                        <?php }else{ ?>
                        <h1 style="font-size: 30px;color: black;font-weight: 600;"><?=ucfirst($product[0]->product_name)?></h1>
                        <?php } ?>
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
                        <ul class="price-list1">
                          <?php $a_price = '0.00'; if($product[0]->offer_price>0){ $a_price = number_format($product[0]->offer_price,2); ?>
                            <li class="rs" style="margin-right: 4px;"><?=number_format($product[0]->offer_price)?></li>
                            <li class="strike" style="margin-right: 4px;"><span style='color:#867e7e'>₹</span>
                        <strike style='color:#867e7e'><span style='color:#867e7e'><?=number_format($product[0]->price)?><span></strike></li>
                            <!-- <li class="offer">(50%) Off</li> -->
                          <?php }else{ $a_price = number_format($product[0]->price,2); ?>
                            <li class="rs"><?=number_format($product[0]->price)?></li>
                          <?php } ?>
                        </ul>
                        <?php $colors_status='no'; if(count($variants)>0){ $colors_status='yes'; ?>
                        <div class="container">              
                          <div class="row">
                            <label class="labels" style="margin-bottom: -10px;margin-top: 20px;font-size:18px;">Select certificate color</label> 
                           <ul style="list-style:none;display:flex;" id="colors" class="product-list-image-test medium-9 columns" data-ga-category="MainContent">
                            <?php foreach($variants as $v){ ?>
                                  <li class="variantItem selectedVariant" color-data="<?=$v->color?>">
                                   <figure>
                                    <img class="productimg colors" style="border: 1px solid #0c0b0b80;" src="<?=base_url()?>assets/uploads/variants/<?=$v->image?>" alt="Mixed Roses Romantic Bunch">
                                    <figcaption style="text-align:center;">
                                     <span class="h-listprice webprice"><?=$v->color?></span>
                                   </figcaption>
                                 </figure>
                               </li>
                            <?php }  ?>
                        
                          </ul>
                         <div class="medium-3 columns">&nbsp;</div>
                       </div>
                     </div>
                     <?php }  ?>
                        
                        <h3 class="product-sub-title">
                        Enter Details</h3>  
                        <form method="post" id="myform" enctype="multipart/form-data">
                        <div class="small-form">
                        <?php if(count($tag)>0){ foreach($tag as $tg){ ?>
                           <label class="labels"><?=$tg->name?></label> 
                           <?php if($tg->tag=='text'){  ?>
                           <input type="text" name="<?=$tg->tag.'_'.$tg->id?>" <?php if(strtolower($tg->name)=='name for free gift'){ ?> maxlength="8" id="name_to_be"  <?php } ?> class="input-box" required>
                           <?php }elseif($tg->tag=='textarea'){ ?>
                           <textarea name="<?=$tg->tag.'_'.$tg->id?>" class="input-box" required></textarea>
                           <?php }elseif($tg->tag=='date'){ ?>  
                           <input type="text" id="datepicker" readonly placeholder="YYYY-MM-DD"  name="<?=$tg->tag.'_'.$tg->id?>" class="input-box" required>
                           <?php }elseif($tg->tag=='file'){ $id="";$errr=""; if(strtolower($tg->name)=='photos for magnet'){ $id="image"; }else{ $id="image1";$errr="<p style='color: #df1616;font-size: 14px;margin-top: -8px'>Note: Each letter one photo required. Maximum 8 photos.</p>"; } ?>
                            <input type="file" name="file_<?=$tg->tag.'_'.$tg->id?>[]" id="<?=$id?>" class="input-box" accept="image/x-png,image/gif,image/jpeg" multiple required>
                           <?php echo $errr; } } } ?>
                        </div>
                        <input type="hidden" name="type" id="type">
                        <input type="hidden" name="pid" value="<?=$product[0]->id?>">
                        <input type="hidden" name="color" value="">
                        <?php if($device=='desk'){ ?>
                        <input type="submit" id="add_to_cart" class="btn shop e-b" value="Add to cart">
                        <input type="submit" id="buy_now" class="btn pay e-b" value="Buy now">
                        <?php } ?>
                        </form>
                        <div class="product-info" style="height: 300px;overflow-y: scroll;">
                           <h3 class="product-sub-title">
                           Description</h3>
                           <p><?=$product[0]->description?></p>
                           <h3 class="product-sub-title">
                           Delivery Information</h3>
                           <p><?=$product[0]->delivery_info?></p>
                           <h3 class="product-sub-title">Find your star</h3>
                           <p><?=$product[0]->care_instructions?></p>
                        </div>
                        <div class="mob-tabs">
                           <!-- Tab links -->
                           <div class="tab">
                              <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">Product description</button>
                              <button class="tablinks" onclick="openCity(event, 'Paris')">Delivery Information</button>
                              <button class="tablinks" onclick="openCity(event, 'Tokyo')">Find your star</button>
                           </div>
                           <!-- Tab content -->
                           <div id="London" class="tabcontent">
                              <p><?=$product[0]->description?></p>
                           </div>
                           <div id="Paris" class="tabcontent">
                              <p><?=$product[0]->delivery_info?></p>
                           </div>
                           <div id="Tokyo" class="tabcontent">
                              <p><?=$product[0]->care_instructions?></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="page-sec review-write">
            <div class="container">
   <div class="row">
       <?php $rate_by_rating=0; for($rr=5;$rr>=1;$rr--){ $r_count = $this->common_library->fetch_rating_by_rate($product[0]->id,$rr); $rate_by_rating += $rr*count($r_count); } $final_rate = $rate_by_rating/count($rev); ?>
      <?php if($device=='desk'){ ?>
      
      
      <div class="col-sm-2">
         <div class="rating-block" >
            <h2 class="bold padding-bottom-7"><?=bcdiv($final_rate, 1, 1); ?> <i class="glyphicon glyphicon-star" style="font-size: 22px;"></i><br><span style="font-size: 15px;font-weight: 100;"><?=count($rev)?> reviews</span></h2>
         </div>
      </div>
    
      <div class="col-sm-4">
          <?php for($rr=5;$rr>=1;$rr--){ $r_count = $this->common_library->fetch_rating_by_rate($product[0]->id,$rr); ?>
          <?php $percentage = round( ( count($r_count) / count($rev) ) * 100 );  ?>
          <?php  if($rr=='1'){ $csss= 'margin-left: 4px;'; }else{ $csss=''; } ?>
         <div class="pull-left">
            <div class="pull-left" style="width:35px; line-height:1;">
               <div style="height:9px; margin:5px 0;<?=$csss?>"><?=$rr?> <span class="glyphicon glyphicon-star"></span></div>
            </div>
            <div class="pull-left" style="width:180px;">
                
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
      <div class="col-sm-6">
      </div>
      <?php }else{ ?>
      
      <h3 style="margin-left: 15px;margin-bottom: 15px;">Rating & Review</h3>
      <div class="col-sm-3" style="float: left;">
         <div class="rating-block">
            <h2 class="bold"><?=bcdiv($final_rate, 1, 1); ?>&nbsp;<i class="glyphicon glyphicon-star" style="font-size: 18px;"></i><br><span style="font-size: 15px;font-weight: 100;"><?=count($rev)?> reviews</span></h2>
         </div>
      </div>
    
      <div class="col-sm-3">
         
         <?php for($rr=5;$rr>=1;$rr--){ $r_count = $this->common_library->fetch_rating_by_rate($product[0]->id,$rr); ?>
         <?php $percentage = round( ( count($r_count) / count($rev) ) * 100 );  ?>
         <?php  if($rr==1){ $csss= 'margin-left: 4px;'; }else{ $csss=''; } ?>
         <div class="pull-left">
            <div class="pull-left" style="width:35px; line-height:1;">
               <div style="height:9px; margin:5px 0;<?=$csss?>"><?=$rr?> <span class="glyphicon glyphicon-star"></span></div>
            </div>
            
            <div class="pull-left" style="width:180px;">
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
      <div class="col-sm-6">
      </div>
      <?php } ?>
   </div>
   <div class="row">
       <?php if($device=='desk'){ if(count($rev)>0){ $rc=1; foreach($rev as $r){ if($rc <= 4){ ?>
      <div class="col-sm-3">
         <hr/>
         <div class="review-block" style="height: 300px;">
            <div class="row">
               <div class="col-sm-12">
                  <div class="review-block-rate">
                     <?php for($c=1;$c<=5;$c++){ if($r->rating >= $c){ ?>
                        <span class="glyphicon glyphicon-star stars" aria-hidden="true"></span>
                     <?php }else{ ?>
                        <span class="glyphicon glyphicon-star" style="font-size: 18px;" aria-hidden="true"></span>
                     <?php } } ?>
                  </div>
                  <div class="review-block-title"><?=mb_strimwidth(ucfirst($r->title), 0, 20, "...")?></div>
                  <div class="review-block-description" style="text-align:justify;line-height: 20px;"><?=$r->review?></div>
                  <br>
                  
                      
                  
               </div>
            </div>
            
         </div>
         <div class="row" style="margin-top: -45px;margin-left: 10px;">
                        <div class="col-sm-6 float-left" style="font-size:13px;"><?=ucfirst($r->user_name)?></div>
                        <div class="col-sm-6 float-right" style="font-size:13px;"><?=date('M d, Y',strtotime($r->date))?></div>
                      </div>
      </div>
      <?php  } $rc++; } } if(count($rev)>4){ ?>
        <div style="text-align: center;">
           <a href="<?=base_url()?>review/<?=$product_name?>" style="margin-top: 20px;background: #fff;color: black;font-weight: 600;" class="btn">See more reviews</a>
        </div> 
      <?php } }else{ if(count($rev)>0){ $rc=1; foreach($rev as $r){ if($rc <= 4){ ?>
      <div class="col-sm-3">
         <hr/>
         <div class="review-block" style="box-shadow: 0px 1px 5px #00000047;">
            <div class="row">
               <div class="col-sm-12">
                  <div class="review-block-rate">
                      <?php for($c=1;$c<=5;$c++){ if($r->rating >= $c){ ?>
                            <span class="glyphicon glyphicon-star stars" aria-hidden="true"></span>
                            <?php }else{ ?>
                            <span class="glyphicon glyphicon-star" style="font-size: 18px;" aria-hidden="true"></span>
                            <?php } } ?>
                     
                     
                  </div>
                  <div class="review-block-title" style="font-size:16px;"><?=ucfirst($r->title)?></div>
                  <div class="review-block-description" style="font-size:15px;"><?=$r->review?></div>
                  <br>
                  
                      <div class="row">
                        <div class="col-sm-12 float-left"><span style="float: left;"><?=ucfirst($r->user_name)?></span><span style="float: right;"><?=date('M d, Y',strtotime($r->date))?></span></div>
                      </div>
                  
               </div>
            </div>
         </div>
      </div>
      <?php  } $rc++; } }  if(count($rev)>4){ ?>
      <a style="margin-left:15px;" href="<?=base_url()?>review/<?=$product_name?>">See all <?=count($rev)?> reviews  ></a>
      <?php } } ?>
   </div>
</div>
         </div>
      </main>
      <?php include 'layouts/footer.php'; ?>
      
      <div class="mob-btns">
         <a href="javascript:void[0]" id="add_to_cart_m" class="mob-btn">Add to cart</a>
         <a href="javascript:void[0]" id="buy_now_m" class="mob-btn btn-two">Buy now</a>
      </div>
      <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
      <script src="<?=base_url()?>assets/web/js/main.js"></script>  
      <script>
         function openCity(evt, cityName) {
           var i, tabcontent, tablinks;
           tabcontent = document.getElementsByClassName("tabcontent");
           for (i = 0; i < tabcontent.length; i++) {
             tabcontent[i].style.display = "none";
           }
           tablinks = document.getElementsByClassName("tablinks");
           for (i = 0; i < tablinks.length; i++) {
             tablinks[i].className = tablinks[i].className.replace(" active", "");
           }
           document.getElementById(cityName).style.display = "block";
           evt.currentTarget.className += " active";
         }
         
         // Get the element with id="defaultOpen" and click on it
         document.getElementById("defaultOpen").click();
      </script>
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
      </script>
      <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
      <script src="<?=base_url()?>assets/web/js/src/jquery.exzoom.js"></script>
      <script type="text/javascript">
         $('.container').imagesLoaded( function() {
          $("#exzoom").exzoom({
          autoPlay: false,
         });
          $("#exzoom").removeClass('hidden')
         });

        
        $('#add_to_cart').click(function(){
          $('#type').val('add_to_cart');
          
        })

        $('#buy_now').click(function(){
          $('#type').val('buy_now');
        })
        
        $('#add_to_cart_m').click(function(){
          $('#type').val('add_to_cart');
          $("form").submit();
          
        })

        $('#buy_now_m').click(function(){
          $('#type').val('buy_now');
          $("form").submit();
        })


         $("form").submit(function(e) {
             
            var has_empty = 'false';

           $(this).find( 'input[type!="hidden"]' ).each(function () {

              if ( ! $(this).val() ) { has_empty = 'true'; }
           });
           
           if(has_empty=='true')
           {
               swal("Please eneter all details");return false;
           }
           
           <?php if($colors_status=='yes'){ ?>
             var color = $('input[name=color]').val();
             if(color=='')
             {
                 swal("Please choose certificate color");return false;
             }
           <?php } ?>
           
             
          $('#cover-spin').show();
          
          e.preventDefault();
          var form = $("#myform");

          var formData = new FormData(form[0]);
          $.ajax({
            type: "POST",
            url: '<?=base_url()?>add-to-cart',
            //dataType: 'json', //not sure but works for me without this
            data: formData,
            contentType: false, //this is requireded please see answers above
            processData: false, //this is requireded please see answers above
            //cache: false, //not sure but works for me without this
            success: function(data) 
            {
                <?php 
                   $a_price = explode('.',$a_price);
                   $real_integer = filter_var($a_price[0], FILTER_SANITIZE_NUMBER_INT);
                ?>
                var type = $('#type').val();
                
                fbq('track', 'AddToCart', {
                content_name: '<?=ucfirst($product[0]->product_name)?>', 
                content_category: 'Star registration',
                content_ids: ['<?=$product[0]->id?>'],
                content_type: 'product',
                value: '<?=$real_integer?>',
                currency: 'INR' 
                });
               
                if(type=='buy_now')
                {
                    window.location.href="<?=base_url()?>checkout";
                }
                else
                {
                    $('#cover-spin').hide();
                  $("#myform")[0].reset();
                  cart();
                  $('.cd-panel').addClass('cd-panel--is-visible');
                }
              
            }, //You missed this
            error: function() 
            {
                  swal("Warning", "Something went wrong", "error");
                  $('#cover-spin').hide();
            }
            });
         });
         
         
         $('#colors li').click(function(){
             $('.colors').css('border','1px solid #0c0b0b80');
             var color = $(this).attr('color-data');
             var c = 'blue';
             if(color=='Pink')
             {
                c = '#f740b7';
             }
             $(this).children().children('img').css('border','2px solid '+c);
             $('input[name=color]').val(color);
         })
         
        
         
      </script> 
      
 
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '1945:'+(new Date).getFullYear()
    });
  } );
  
  
  $("#image1").on("change", function() {
    if ($("#image1")[0].files.length >= 11) {
        swal("Warning", "You can only upload upto 10 images", "error"); $("#image1").val(null);return false;
    } 
});

$("#image2").on("change", function() {
    if ($("#image2")[0].files.length >= 3) {
        swal("Warning", "You can only upload upto Two images", "error"); $("#image2").val(null);return false;
    } 
});



$("#name_to_be").on("keyup paste", function() {
  var $this, limit, val;
  limit = 8;
  $this = $(this);
  val = $this.val();
  $this.val(val.substring(0, limit));
  return $('#name_to_be').text(limit - $this.val().length);
});
 
  </script>
   </body>
</html>