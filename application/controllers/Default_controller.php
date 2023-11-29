<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

date_default_timezone_set("Asia/Kolkata");

class Default_controller extends CI_Controller 
{
    function __construct() {
		parent::__construct();
		$this->load->model('common_model');
	}

    /* front section */
	public function index()
	{
        $data['products'] = $this->common_model->fetch_data('products',array('status'=>'1','is_deleted'=>'0','home'=>1),'priority__asc','3');
        $data['reviews']  = $this->common_model->fetch_data('rating',array('status'=>'1','is_deleted'=>'0'),'id__desc');
		$this->load->view('front/index',$data);
	}

    public function checkouts()
    {
        $this->load->view('front/checkout/index');
    }

    // public function pay_now()
    // {
    //     unset($_SESSION['coupon']);
    //     $this->load->view('front/checkout/pay');
    // }
    public function payment(){
        // print_r($_SESSION['address_id']);exit;
        if(!isset($_SESSION['order_id']) && empty($_SESSION['order_id']))
        {
        header('location'.base_url());
        exit;
        }

        $paid_amount = '';
        $shipping = SHIPPING_AMOUNT;
        $payment = $this->common_library->fetch_paid_amount($_SESSION['order_id']);
        if($payment[0]->paid_amount>0)
        {
            $paid_amount = $payment[0]->paid_amount+$shipping;
        }
        

        // print_r($_SESSION);exit;
        // Array ( [__ci_last_regenerate] => 1700918084 [shopping_cart] => Array ( [0] => Array ( [item_id] => 11 ) ) [shopping_cart_details] => Array ( [0] => Array ( [text_41] => shiv [date_42] => 2023-11-01 [textarea_43] => sas [type] => buy_now [pid] => 11 [color] => Blue [quantity] => 1 ) ) [order_id] => 957 )
        unset($_SESSION['coupon']);
        
        try{
            require_once("application/libraries/vendor/stripe/stripe-php/init.php");
            
        // require_once '/path/to/stripe-php/init.php';
        // echo 'stripe called in default controller';exit;
        $stripe = new \Stripe\StripeClient(STRIPE_SECRET);

        $customer = $stripe->customers->create([
        'name' => $_SESSION['user_info']['user_fname'],
        'email' => $_SESSION['user_info']['user_email'],
        ]);
        // 'shipping'=>[
        //     'name'=>'test user',
        //     'address'=>[
        //         'city'=>'Leeds',
        //         'postal_code'=>'LS1 3DA',
        //         'line1'=>'leeds town1',
        //         'line2'=>'leeds town2',
        //         'state'=>'Leeds'
        //     ]
        // ],
        $_SESSION['customer_id'] = $customer->id;
        \Stripe\Stripe::setApiKey(STRIPE_SECRET);
        $amount = $paid_amount * 100;
        $checkout_session = $stripe->checkout->sessions->create([
        'line_items' => [[
            
            'price_data' => [
            'currency' => 'gbp',
            'product_data' => [
                'name' => 'Star Certificate',
            ],
            'unit_amount' => $amount,
            ],
            'quantity' => 1,
        ]],
        
        'customer'=>$customer->id,
        
        'mode' => 'payment',
        'payment_method_types'=>['card'],
        'success_url' => base_url() . 'verify',
        'cancel_url' => base_url() . 'payment-failed',
        ]);
        $_SESSION['session_id'] = $checkout_session->id;
        
           
        redirect($checkout_session->url);
        
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    
    public function verify()
    {
        $this->load->view('front/checkout/verify');
    }

    public function product_view($pname)
    {
        $productname = str_replace('-', ' ', $pname);
        $data['product'] = $this->common_model->fetch_product_data($productname);
        $data['product_name'] = $pname;
        $this->load->view('front/product_view',$data);
    }

    public function all_products()
    {
        $data['products'] = $this->common_model->fetch_data('products',array('status'=>'1','is_deleted'=>'0'),'priority__asc');
        $this->load->view('front/products',$data);
    }

    public function checkout()
    {
        $data['state'] = $this->common_model->fetch_data('state',array('status'=>'0'));
        $this->load->view('front/check_out',$data);
    }

    public function add_to_cart()
    {
        
        if(isset($_POST) && !empty($_POST))
        {

                $check_file = $this->common_model->fetch_data('tag_options',array('status'=>'1','is_deleted'=>'0','product_id'=>$_POST['pid'],'tag'=>'file'));

                if(count($check_file)>0)
                {
                    foreach($check_file as $files)
                    {
                        if($files->tag=='file')
                        {
                            if(isset($_FILES) && !empty($_FILES['file_'.$files->tag.'_'.$files->id]['name'][0]))
                            {
                                for($i=0;$i<count($_FILES['file_'.$files->tag.'_'.$files->id]['name']);$i++)
                                {
                                    $file_name = $_FILES['file_'.$files->tag.'_'.$files->id]['name'][$i];
                                    $file_temp = $_FILES['file_'.$files->tag.'_'.$files->id]['tmp_name'][$i];
                                    $extension = pathinfo($file_name, PATHINFO_EXTENSION);
                                    $name = 'file_'.$files->tag.'_'.$files->id.'_'.rand(10,9999).'_'.rand(10,9999).'.'.$extension;
                                    if(move_uploaded_file($file_temp, "assets/uploads/user_uploads/".$name))
                                    {
                                        
                                    }
                                    $_POST['tagImg'.$files->tag.'_'.$files->id][$i] = $name;
                                }
                            }
                        }
                    }
                }
               
             
                if(isset($_SESSION["shopping_cart"]) && !empty($_SESSION["shopping_cart"]))
                {
                    $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
                    if(!in_array($_POST["pid"], $item_array_id))
                    {
                        $_POST['quantity'] = 1;
                        $count = count($_SESSION["shopping_cart"]);
                        $item_array = array('item_id' => $_POST["pid"] );
                        $_SESSION["shopping_cart"][$count] = $item_array;
                        $_SESSION['shopping_cart_details'][$count] = $_POST;

                        echo 'added';
                    }
                    else
                    {
                        echo 'added already';
                    }
                }
                else
                {
                    
                    $_POST['quantity'] = 1;
                    $count = (isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"]))?count($_SESSION["shopping_cart"]):0;
                    $item_array = array('item_id' => $_POST["pid"] );
                    $_SESSION["shopping_cart"][$count] = $item_array;
                    $_SESSION['shopping_cart_details'][$count] = $_POST;

                    echo 'added';
                }
                
        }
    }

    public function remove_from_cart()
    {
        if(isset($_POST) && !empty($_POST))
        {
            if(isset($_SESSION["shopping_cart_details"]) && !empty($_SESSION["shopping_cart_details"]))
            {
                foreach($_SESSION["shopping_cart_details"] as $keys => $values)
                {
                    if($values["pid"] == $_POST["pid"])
                    {
                        unset($_SESSION["shopping_cart"][$keys]);
                        unset($_SESSION['shopping_cart_details'][$keys]);
                        echo "yes";
                        exit;
                    }
                }
            }
            else
            {
                 unset($_SESSION["shopping_cart"][$keys]);
                 unset($_SESSION['shopping_cart_details'][$keys]);
                 echo "yes";
                 exit;
            }
        }
    }

    public function cart_data()
    {
        $html = '';
       
        if(isset($_SESSION['shopping_cart_details']) && !empty($_SESSION['shopping_cart_details']))
        { 
                foreach($_SESSION['shopping_cart_details'] as $keys => $values)
                {
                    
                         $product = $this->common_model->fetch_data('products',array('id'=>$values['pid']));
                         $img = $this->common_model->fetch_data('product_images',array('product_id'=>$values['pid'],'status'=>'1','is_deleted'=>'0'),'priority__asc','1');
                        
                        
                         $html .='<div class="row">
                            <div class="col-md-6 res-half">
                               <img src="'.base_url().'assets/uploads/product/'.$img[0]->images.'" class="cart-img">
                            </div>
                            <div class="col-md-6 res-half">
                               <h5 class="cp-title">'.mb_strimwidth(ucfirst($product[0]->product_name), 0, 20, "...").'</h5>
                               <ul class="price-list">';
                                if($product[0]->offer_price>0)
                                {
                                  $html .='<li class="rs">'.number_format($product[0]->offer_price).'</li>';
                                }
                                else
                                {
                                  $html .='<li class="rs">'.number_format($product[0]->price).'</li>';
                                }
                                
                                $rating  = $this->common_library->fetch_product_rating($values['pid']);
						        $reviews = $this->common_library->fetch_product_rating_count($values['pid']);
								
						        $avg = explode('.',$rating[0]->count);
						        
						        $html .='</ul>
                               <ul class="rating">';
						        
						        for($ra=1;$ra<=5;$ra++)
						        { 
						            if($avg[0] >= $ra)
						            {
						                $html .='<li><i class="fa fa-star" aria-hidden="true"></i></li>';
						            }
						            else
						            {
						                $html .='<li><i class="fa fa-star-o" aria-hidden="true"></i></li>';
						            }
						        }

                               
                               $html .='</ul>
                               <a class="remove-text" onclick="remove_cart('.$values['pid'].')">Remove</a>    
                            </div>
                         </div>
                         <div class="line"></div>';
                        
                } 
            
        }
        else
        {
            $html .= '<div style="text-align: center;margin-top: 50%;">Your cart is empty</div>';
        }
        echo $html;
    }

    public function checkout_data()
    {
        $amount = 0;
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
        
        if($amount==0)
        {
            echo "empty";exit;
        }
        
        if(isset($_POST) && !empty($_POST))
        {
            $this->db->insert('user_address',$_POST);
            $address_id = $this->db->insert_id();
            // line added
            $_SESSION['user_info'] = $_POST;
            $_SESSION['address_id'] = $address_id;
            if($address_id)
            {
                $amount = 0;
               if(isset($_SESSION['shopping_cart_details']) && !empty($_SESSION['shopping_cart_details']))
               { 
                       for($c=0;$c<count($_SESSION['shopping_cart_details']);$c++)
                       {
                            $product = $this->common_model->fetch_data('products',array('status'=>'1','is_deleted'=>'0','id'=>$_SESSION['shopping_cart_details'][$c]['pid'])); 
                            if($product[0]->offer_price>0)
                            {
                                $product_price = $product[0]->offer_price;
                            }
                            else
                            {
                                $product_price = $product[0]->price;
                            }
                            $amount  += (int)$product_price;
                       }
                       
                        $desc = 0;
                        if(isset($_SESSION['coupon']) && !empty($_SESSION['coupon']))
                        {
                            $desc = $_SESSION['coupon'];
                        }

                            $orders['total_amount'] = $amount;
                            $orders['paid_amount']  = $amount-$desc;
                            $orders['address_id']   = $address_id;
                            $orders['order_status'] = 'New';
                            $orders['discount_amount'] = $desc;

                            $this->db->insert('orders',$orders);
                            $order_id = $this->db->insert_id();
                            $_SESSION['order_id'] = $order_id;

                            if($order_id)
                            {
                                for($c=0;$c<count($_SESSION['shopping_cart_details']);$c++)
                                {
                                    $product = $this->common_model->fetch_data('products',array('status'=>'1','is_deleted'=>'0','id'=>$_SESSION['shopping_cart_details'][$c]['pid'])); 
                                    if($product[0]->offer_price>0)
                                    {
                                        $product_price = $product[0]->offer_price;
                                    }
                                    else
                                    {
                                        $product_price = $product[0]->price;
                                    }
                                    $order_details['product_price']  = $product_price;
                                    $order_details['order_id']     = $order_id;
                                    $order_details['product_id']   = $product[0]->id;
                                    $order_details['product_name'] = $product[0]->product_name;
                                    $order_details['quantity']     = 1;
                                    if(isset($_SESSION['shopping_cart_details'][$c]['color']) && !empty($_SESSION['shopping_cart_details'][$c]['color']))
                                    {
                                        $order_details['color']        = $_SESSION['shopping_cart_details'][$c]['color'];
                                    }
                                    

                                    $this->db->insert('order_details',$order_details);
                                    $order_data_id = $this->db->insert_id();

                                    
                                    
                                    $product_tags = $this->common_model->fetch_data('tag_options',array('status'=>'1','is_deleted'=>'0','product_id'=>$_SESSION['shopping_cart_details'][$c]['pid']));
                                    if(count($product_tags)>0)
                                    {
                                        foreach($product_tags as $pt)
                                        {
                                            if($pt->tag=='file')
                                            {
                                                if(isset($_SESSION['shopping_cart_details'][$c]['tagImg'.$pt->tag.'_'.$pt->id]) && !empty($_SESSION['shopping_cart_details'][$c]['tagImg'.$pt->tag.'_'.$pt->id]))
                                                {
                                                    $imgs = '';
                                                    foreach($_SESSION['shopping_cart_details'][$c]['tagImg'.$pt->tag.'_'.$pt->id] as $tagImg)
                                                    {
                                                       $imgs .= $tagImg.',';
                                                    }

                                                    $imgs = rtrim($imgs,',');
                                                }

                                                $tag_data['order_details_id'] = $order_data_id;
                                                $tag_data['tag_option_id'] = $pt->id;
                                                $tag_data['tag_name'] = $pt->name;
                                                $tag_data['tag_data'] = $imgs;
                                                $tag_data['tag'] = $pt->tag;
                                            }
                                            else
                                            {
                                                $tag_data['order_details_id'] = $order_data_id;
                                                $tag_data['tag_option_id'] = $pt->id;
                                                $tag_data['tag_name'] = $pt->name;
                                                $tag_data['tag_data'] = $_SESSION['shopping_cart_details'][$c][$pt->tag.'_'.$pt->id];
                                                $tag_data['tag'] = $pt->tag;
                                            }
                                            $this->db->insert('selected_tags',$tag_data);
                                            
                                        }
                                    }
                                }
                            }
                   
               }
               echo "success";
            }
        }
    }

    public function success()
    {
        $data['order'] = $this->common_model->fetch_data('orders',array('txn_id'=>$_SESSION['txn_id']));
        unset($_SESSION);
        $this->load->view('front/success',$data);
    }

    public function privacy()
    {
        $this->load->view('front/privacy');
    }

    public function terms()
    {
        $this->load->view('front/terms');
    }

    public function refund()
    {
        $this->load->view('front/refund');
    }

    public function shipping()
    {
        $this->load->view('front/shipping');
    }

    public function contact()
    {
        $this->load->view('front/contact');
    }

    public function find_star()
    {
        $this->load->view('front/find_star');
    }
    
    public function check_cart()
    {
        if(isset($_SESSION['shopping_cart_details']) && !empty($_SESSION['shopping_cart_details']))
        {
        	if(count($_SESSION['shopping_cart_details'])>0)
        	{
        	    echo "yes";
        	}
        	else
        	{
        	    echo "yes";
        	}
        }
        else
        {
            echo "empty";
        }
    }

	/* front section */

	/* admin section */

	public function admin()
	{
		if(!isset($_SESSION['userdata']) && empty($_SESSION['userdata']))
		{
			$this->load->view('admin/login');
		}
		else
		{
			return redirect('dashboard');
		}
	}

	public function do_login()
	{
		if(isset($_POST) && !empty($_POST))
		{
			$username = $_POST['username'];
			$password = base64_encode($_POST['password']);
			$check_user = $this->common_model->do_login($username,$password,'super_admin');

			if(count($check_user)>0)
			{
				 $_SESSION['userdata'] = $check_user;
                 return redirect('dashboard');
			}
			else
			{
				$this->session->set_flashdata('error','Username or Password incorrect.Please try again.');
				return redirect('admin');
			}
		}
	}

	public function dashboard()
	{
		$this->check_login();
		
		$data['new'] = $this->db->select('id')->from('orders')->where(array('order_status'=>'New','txn_id!='=>'','order_number!='=>''))->get()->result();
		$data['disputed'] = $this->db->select('id')->from('orders')->where(array('order_status'=>'Disputed','txn_id!='=>'','order_number!='=>''))->get()->result();

		$this->load->view('admin/includes/header');
		$this->load->view('admin/dashboard',$data);
		$this->load->view('admin/includes/footer');
	}
    
    public function products()
    {
    	$this->check_login();

        $data['data'] = $this->common_model->fetch_data('products',array('is_deleted'=>0),'created_datetime__desc');
		$this->load->view('admin/includes/header');
		$this->load->view('admin/Products/index',$data);
		$this->load->view('admin/includes/footer');
    }

    public function create_product()
    {
    	$this->check_login();

    	if(isset($_POST) && !empty($_POST))
    	{
			$insert_id = $this->common_model->create('products',$_POST);
			if($insert_id)
			{
				if(isset($_FILES) && !empty($_FILES['images']['name'][0]))
				{
					for($i=0;$i<count($_FILES['images']['name']);$i++)
					{
						$file_name = $_FILES['images']['name'][$i];
						$file_temp = $_FILES['images']['tmp_name'][$i];
						$extension = pathinfo($file_name, PATHINFO_EXTENSION);
						$name = time().'_'.rand(10,9999).'.'.$extension;
						if(move_uploaded_file($file_temp, "assets/uploads/product/".$name))
						{
							$postimage['images'] = $name;
						}
						else
						{
							$postimage['images'] = '';
						}
						$postimage['product_id'] = $insert_id;
						$status = $this->common_model->create('product_images',$postimage);
					}
				}

				$this->session->set_flashdata('success','Created Successfully');
				return redirect($_SERVER['HTTP_REFERER']);
			}    		
    	}
    	else
    	{
    		$this->load->view('admin/includes/header');
    		$this->load->view('admin/Products/create');
    		$this->load->view('admin/includes/footer');
    	}
    }

    public function edit_product($product_id)
    {
    	$this->check_login();

    	if(isset($_POST) && !empty($_POST))
    	{
    		if(isset($_POST['id']) && !empty($_POST['id']))
    		{
                $update = $this->common_model->update('products',$_POST,array('id'=>$_POST['id']));
                if($update)
                {
                	if(isset($_FILES) && !empty($_FILES['images']['name'][0]))
                	{
                		for($i=0;$i<count($_FILES['images']['name']);$i++)
                		{
                			$file_name = $_FILES['images']['name'][$i];
                			$file_temp = $_FILES['images']['tmp_name'][$i];
                			$extension = pathinfo($file_name, PATHINFO_EXTENSION);
                			$name = time().'_'.rand(10,9999).'.'.$extension;
                			if(move_uploaded_file($file_temp, "assets/uploads/product/".$name))
                			{
                				$postimage['images'] = $name;
                			}
                			else
                			{
                				$postimage['images'] = '';
                			}
                			$postimage['product_id'] = $_POST['id'];
                			$status = $this->common_model->create('product_images',$postimage);
                		}
                	}

                	$this->session->set_flashdata('success','Updated Successfully');
    				return redirect($_SERVER['HTTP_REFERER']);
                }
    		}
    	}
    	else
    	{
    		$data['data']   = $this->common_model->fetch_data('products',array('id'=>$product_id));
    		$data['images'] = $this->common_model->fetch_data('product_images',array('product_id'=>$product_id,'status'=>1,'is_deleted'=>0),'priority__ACS');

    		$this->load->view('admin/includes/header');
    		$this->load->view('admin/Products/edit',$data);
    		$this->load->view('admin/includes/footer');
    	}
    }

    public function shipping_rates()
    {
    	$this->check_login();

    	if(isset($_POST) && !empty($_POST))
    	{
            if(isset($_POST['id']) && !empty($_POST['id']))
            {
               $status = $this->common_model->update('shipping_rates',$_POST,array('id'=>$_POST['id']));
               if($status)
               {
               	$this->session->set_flashdata('success','Updated Successfully');
               }
            }
            else
            {
            	$status = $this->common_model->create('shipping_rates',$_POST);
            	if($status)
            	{
            		$this->session->set_flashdata('success','Added Successfully');
            	}
            }
            return redirect($_SERVER['HTTP_REFERER']);
    	}
    	else
    	{
    		$data['data']   = $this->common_model->fetch_data('shipping_rates',array('is_deleted'=>0));
    		$this->load->view('admin/includes/header');
    		$this->load->view('admin/shipping_rates/index',$data);
    		$this->load->view('admin/includes/footer');
    	}
    }

    public function options()
    {
    	$this->check_login();

    	$data['data']   = $this->common_model->fetch_data('products',array('is_deleted'=>0));
    	$this->load->view('admin/includes/header');
    	$this->load->view('admin/options/index',$data);
    	$this->load->view('admin/includes/footer');
    }

    public function add_tags($product_id)
    {
    	$this->check_login();

    	if(isset($_POST) && !empty($_POST))
    	{
            if($_POST['status']=='add')
            {
               if(count($_POST['name'])>0)
               {
               	  for($i=0;$i<count($_POST['name']);$i++)
               	  {
               	  	 $adddata['product_id'] = $_POST['product_id'];
               	  	 $adddata['name']       = $_POST['name'][$i];
               	  	 $adddata['tag']        = $_POST['tag'][$i];

               	  	 $status = $this->common_model->create('tag_options',$adddata);
               	  }
               }
            }
            else
            {
               if(count($_POST['id'])>0)
               {
               	  for($i=0;$i<count($_POST['id']);$i++)
               	  {
               	  	 $updatedata['name']       = $_POST['edit_name'][$i];
               	  	 $updatedata['tag']        = $_POST['edit_tag'][$i];
                               
               	  	 $status = $this->common_model->update('tag_options',$updatedata,array('id'=>$_POST['id'][$i]));
               	  }
               }
               
               	if(count($_POST['name'])>0)
               	{
               		for($j=0;$j<count($_POST['name']);$j++)
               		{
               			$adddata['product_id'] = $_POST['product_id'];
               			$adddata['name']       = $_POST['name'][$j];
               			$adddata['tag']        = $_POST['tag'][$j];

               			$status = $this->common_model->create('tag_options',$adddata);
               		}
               	}
            }
            $this->session->set_flashdata('success','Updated Successfully');
            return redirect($_SERVER['HTTP_REFERER']);
    	}
    	else
    	{
    		$data['data']   = $this->common_model->fetch_data('tag_options',array('is_deleted'=>0,'product_id'=>$product_id));
    		$data['product_id'] = $product_id;
    		$this->load->view('admin/includes/header');
    		$this->load->view('admin/options/add_tags',$data);
    		$this->load->view('admin/includes/footer');
    	}
    }

    public function reviews()
    {
    	$this->check_login();

    	if(isset($_POST) && !empty($_POST))
    	{
            if(isset($_POST['id']) && !empty($_POST['id']))
            {
                $status = $this->common_model->update('rating',$_POST,array('id'=>$_POST['id']));
                if($status)
            	{
            		$this->session->set_flashdata('success','Updated Successfully');
            	}
            }
            else
            {
            	$status = $this->common_model->create('rating',$_POST);
            	if($status)
            	{
            		$this->session->set_flashdata('success','Added Successfully');
            	}
            }
            return redirect($_SERVER['HTTP_REFERER']);
    	}
    	else
    	{
    		$data['data']   = $this->common_model->fetch_data('products',array('is_deleted'=>0,'status'=>1));
    		$data['review'] = $this->common_model->fetch_data('rating',array('is_deleted'=>0),'datetime__desc');
    		$this->load->view('admin/includes/header');
    		$this->load->view('admin/reviews/index',$data);
    		$this->load->view('admin/includes/footer');
    	}
    }

    public function orders($status)
    {
        $this->check_login();
        $data['orders'] = $this->common_model->fetch_orders($status);
        $data['status'] = $status;
        $this->load->view('admin/includes/header');
        $this->load->view('admin/Orders/index',$data);
        $this->load->view('admin/includes/footer');
    }

    public function new_orders()
    {
        if(!isset($_SESSION['userdata']) && empty($_SESSION['userdata']))
		{
			echo "00";exit;
		}
		else
		{
		    $data = $this->common_model->fetch_data('orders',array('order_status'=>'New','order_number!='=>''));
            echo count($data);
		}
    }

    public function view_order($order)
    {
        $this->check_login();
        $data['order'] = $this->common_model->fetch_data('orders',array('id'=>$order));
        $this->load->view('admin/includes/header');
        $this->load->view('admin/Orders/order_details',$data);
        $this->load->view('admin/includes/footer');
    }

    public function print_order($order)
    {
        $this->check_login();
        $data['order'] = $this->common_model->fetch_data('orders',array('id'=>$order));
        $this->load->view('admin/Orders/print',$data);
    }
    
    public function variants($pid)
    {
        $this->check_login();


        if(isset($_POST) && !empty($_POST))
        {
            if($_POST['status']=='add')
            {
               if(count($_POST['color'])>0)
               {
                  for($i=0;$i<count($_POST['color']);$i++)
                  {
                     $adddata['product_id'] = $_POST['product_id'];
                     $adddata['color']      = $_POST['color'][$i];
                     $adddata['price']      = $_POST['price'][$i];

                     if(isset($_FILES) && !empty($_FILES['image']['name'][$i]))
                     {
                        $file_name = $_FILES['image']['name'][$i];
                        $file_temp = $_FILES['image']['tmp_name'][$i];
                        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
                        $name = time().'_'.rand(10,9999).'.'.$extension;
                        if(move_uploaded_file($file_temp, "assets/uploads/variants/".$name))
                        {
                            $adddata['image'] = $name;
                        }
                        else
                        {
                            $adddata['image'] = '';
                        }
                    }

                     $status = $this->common_model->create('product_variants',$adddata);
                  }
               }
            }
            else
            {
               if(count($_POST['id'])>0)
               {
                  for($i=0;$i<count($_POST['id']);$i++)
                  {

                     $updatedata['product_id'] = $_POST['product_id'];
                     $updatedata['color']      = $_POST['edit_color'][$i];
                     $updatedata['price']      = $_POST['edit_price'][$i];

                     if(isset($_FILES) && !empty($_FILES['edit_image']['name'][$i]))
                     {
                        $file_name = $_FILES['edit_image']['name'][$i];
                        $file_temp = $_FILES['edit_image']['tmp_name'][$i];
                        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
                        $name = time().'_'.rand(10,9999).'.'.$extension;
                        if(move_uploaded_file($file_temp, "assets/uploads/variants/".$name))
                        {
                            $updatedata['image'] = $name;
                        }
                        else
                        {
                            $updatedata['image'] = '';
                        }
                    }
                    $status = $this->common_model->update('product_variants',$updatedata,array('id'=>$_POST['id'][$i]));
                  }
               }
               
               if(count($_POST['color'])>0)
               {
                  for($i=0;$i<count($_POST['color']);$i++)
                  {
                     $adddata['product_id'] = $_POST['product_id'];
                     $adddata['color']      = $_POST['color'][$i];
                     $adddata['price']      = $_POST['price'][$i];

                     if(isset($_FILES) && !empty($_FILES['image']['name'][$i]))
                     {
                        $file_name = $_FILES['image']['name'][$i];
                        $file_temp = $_FILES['image']['tmp_name'][$i];
                        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
                        $name = time().'_'.rand(10,9999).'.'.$extension;
                        if(move_uploaded_file($file_temp, "assets/uploads/variants/".$name))
                        {
                            $adddata['image'] = $name;
                        }
                        else
                        {
                            $adddata['image'] = '';
                        }
                    }

                     $status = $this->common_model->create('product_variants',$adddata);
                  }
               }
            }
            $this->session->set_flashdata('success','Updated Successfully');
            return redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            $data['data']   = $this->common_model->fetch_data('product_variants',array('status'=>'1','is_deleted'=>'0','product_id'=>$pid));
            $data['product_id'] = $pid;
            $this->load->view('admin/includes/header');
            $this->load->view('admin/Products/variants',$data);
            $this->load->view('admin/includes/footer');
        }
    }

	
	public function delete($data)
	{
		if($data!="")
		{
			$updatedata['is_deleted'] = 1;
			$updatedata['status'] = 0;
			$cond = explode('__', $data);
			$status = $this->common_model->update($cond[1],$updatedata,array('id'=>$cond[0]));
			if($status)
			{
				$this->session->set_flashdata('success','Deleted Successfully');
				return redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function change_status($data)
	{
		if($data!="")
		{
			$post = explode('__', $data);
			$data1['status'] = $post[0];
			$status = $this->common_model->update($post[2],$data1,array('id'=>$post[1]));
			if($status)
			{
				$this->session->set_flashdata('success','Updated Successfully');
				return redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}

    public function update_order($data)
    {
        if($data!="")
        {
            $data1['order_status'] = 'Disputed';
            $this->db->where('id',$data);
            $status = $this->db->update('orders',$data1);
            if($status)
            {
                $this->session->set_flashdata('success','Updated Successfully');
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

	public function update_password()
	{
		if(isset($_POST) && !empty($_POST))
		{
			$status = $this->common_model->update('administration',array('password'=>base64_encode($_POST['password']),'pwd'=>$_POST['password']),array('id'=>$_SESSION['userdata'][0]->id));
			if($status)
			{
				$this->session->set_flashdata('updated','Updated Successfully');
				return redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function check_login()
	{
		if(!isset($_SESSION['userdata']) && empty($_SESSION['userdata']))
		{
			$this->session->set_flashdata('success','Session closed successfully');
			return redirect('admin');
		}
	}

    public function update_priority()
    {
        if(isset($_POST) && !empty($_POST))
        {
            $this->db->where('id',$_POST['id']);
            $update = $this->db->update('product_images',$_POST);
            if($update)
            {
                $this->session->set_flashdata('updated','Updated Successfully');
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    
    public function update_product_prio()
    {
        if(isset($_POST) && !empty($_POST))
        {
            $post['priority'] = $_POST['priority'];
            $this->db->where('id',$_POST['id']);
            $update = $this->db->update('products',$post);
            if($update)
            {
                $this->session->set_flashdata('updated','Updated Successfully');
                echo "success";
            }
        }
    }

	public function logout()
	{
		unset($_SESSION['userdata']);
		$this->check_login();
	}

	/* admin section */
	
	public function sendIt()
	{
	    if(isset($_POST) && !empty($_POST))
	    {
	       $username = $_POST['username'];
	       $email    = $_POST['email'];
	       $subject  = $_POST['subject'];
	       $message  = $_POST['message'];
	       
	       $status = $this->common_library->send_mail($email,$subject,$message,$username);
	       if($status)
	       {
	           echo "success";
	       }
	    }
	}
	
	public function test()
    {
        $this->load->view('test');
    }
    
    public function product_review($pname)
    {
        $productname = str_replace('-', ' ', $pname);
        $data['product'] = $this->common_model->fetch_product_data($productname);
        
        $this->db->select('images');
        $this->db->from('product_images');
        $this->db->where('product_id',$data['product'][0]->id);
        $this->db->order_by('priority','asc');
        $this->db->limit(1);
        $img = $this->db->get()->result();
        
        $data['img'] = $img;
        $data['product_name'] = $pname;
        $this->load->view('front/product_review',$data);
    }
    
    public function fetch_review()
    {
        $output = '';
        if(isset($_POST) && !empty($_POST))
        {
           $pid = $_POST['pid'];
           $start = $_POST['start'];

           $limit = 10;

           $this->db->select('user_name,title,review,rating,date');
           $this->db->from('rating');
           $this->db->where('product_id',$pid);
           $this->db->where('status',1);
           $this->db->where('is_deleted',0);
           $data_all = $this->db->get()->result();


           
           if($start==1)
           {
              $to    = $limit;
              $from  = $start;
           }
           else
           {
              $to    = $start+$limit;
              $from = $start+1;
           }

           if($start==0)
           {
             $start = 1;
           }
           
           if(count($data_all) < $limit)
           {
               $start = 0;
               $limit = count($data_all);
           }
           


           $this->db->select('user_name,title,review,rating,date');
           $this->db->from('rating');
           $this->db->where('product_id',$pid);
           $this->db->where('status',1);
           $this->db->where('is_deleted',0);
           $this->db->limit($limit,$start);
           $data = $this->db->get()->result();

           if($to >= count($data_all))
           {
              $to = count($data_all);
           }
           
           

           

           if(count($data)>0)
           {
               $output .= '<span data-hook="cr-filter-info-review-count" class="a-size-base">Showing '.$from.' - '.$to.' of '.count($data_all).' reviews</span><div>';
               $i = $start;
               foreach($data as $d)
               {

                   $output .='
                      <div class="col s12">
                         <div style="border-top: 1px solid rgb(230,230,230); padding: 15px 0;">
                            <div style="display:inline-block;font-size: 20px">
                               <span class="stars" data-rating="5"><span class="stars-container stars-100" style="font-size: 15px;">';
                               
                               
                               for($c=1;$c<=5;$c++)
                               { 
                                   if($d->rating >= $c)
                                   {
                                       $output .='<b style="color: #e7711bd1;">★</b>';
                                   }
                                   else
                                   {
                                       $output .='<b>★</b>';
                                   }
                               }
                               
                               $output .='</span></span>
                            </div>
                            <div style="font-size:16px;color:#000000f5;display: inline-block; padding-left:42px;">
                               '.ucfirst($d->title).'
                            </div>
                            <div style="font-size:14px; padding-top: 5px;">
                               '.ucfirst($d->review).'
                            </div>
                            <div style="padding-top:10px; font-size:12px; color:#888;">
                               <div class="truncate" style="display:inline-block; width:120px; overflow: inherit;font-size: 12px;">
                                  '.ucfirst($d->user_name).'
                               </div>
                               <div style="padding-left: 5px; display:inline-block;font-size: 12px;">
                                  '.date('M d, Y',strtotime($d->date)).'
                               </div>
                            </div>
                         </div>
                      </div>';

                      $i++;
                }


               $output .= '</div><span data-hook="cr-filter-info-review-count" class="a-size-base">';
               
               if($start==1 || $start==0)
               {
                  $output .='<a href="javascript:void[0]" style="color:grey;cursor:not-allowed;"><< Prev</a>';
               }
               else
               {
                  $start = $start-$limit;
                  $output .='<a href="javascript:void[0]" style="color:blue;" onclick="review(\''.$start.'\')"><< Prev</a>';
               }
               

               $output .= '&nbsp;&nbsp;&nbsp;'; 

               if($to >= count($data_all))
               {
                  $output .='<a href="javascript:void[0]" style="color:grey;cursor:not-allowed;">Next >></a></span>';
               }
               else
               {
                  $output .='<a onclick="review(\''.$to.'\')" style="color:blue;" href="javascript:void[0]" >Next >></a></span>';
               }

               
           }
        }

        echo $output;
    }
    
    public function apply_coupon()
    {
        
       
        if(isset($_POST['code']) && !empty($_POST['code']))
        {
            if(strtoupper($_POST['code'])=='TRFBLIYHNHGGT456987')
            {
                    $shipping = SHIPPING_AMOUNT;
                    $subtotal = $_POST['subtotal'];
                    $disc = 100;
                    $disc = round($disc);
                    $disc1 = round($disc);
                    
                    $ttl = $subtotal-$disc;
                    $ttl = $ttl+$shipping;
                    $_SESSION['coupon'] = $disc1;
                    
                    echo json_encode(array('result'=>'success','total'=>$ttl, 'dicount'=>$disc1));
                    
            }
            else
            {
                $shipping = SHIPPING_AMOUNT;
                unset($_SESSION['coupon']);
                echo json_encode(array('result'=>'error','total'=>$_POST['subtotal']+$shipping, 'dicount'=>0));
            }
        }
        else
        {
            unset($_SESSION['coupon']);
            echo json_encode(array('result'=>'error'));
        }
    }
    
    public function fetch_order_details_ajax()
    {
        $output = '';
        if(isset($_POST) && !empty($_POST))
        {
            $order_details = $this->common_library->fetch_order_details($_POST['order_id']);
            
            
            
            if(count($order_details))
            { 
                foreach($order_details as $or)
                { 
                    $tag = $this->common_library->fetch_tag_data($or->id);
                    if(count($tag)>0)
                    { 
                        foreach($tag as $tt)
                        {
                           $output.= '<tr><td>'.$or->product_name.'</td><td>'.$tt->tag_name.'</td>';
                           
                           if($tt->tag=='file')
                           {
                               $output.=' <td>'; 
                               
                                    $ig = explode(',', $tt->tag_data); 
                                    foreach($ig as $img)
                                    {
                                       $output.='<img width="50" height="50" style="cursor: pointer;margin-left: 5px;" data="src" src="'.base_url().'assets/uploads/user_uploads/'.$img.'">';
                                    }
                                       $output .='</td>';
                           }
                           else
                           {
                              $output.='<td>'.$tt->tag_data.'</td>';
                           }
                              $output.='</tr>';
                        } 
                        
                    } 
                    
                } 
                
            }
        }
        
        echo $output;
    }
	
}
