<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';




class common_library
{ 
    public function option_count($product_id)
    {
    	$CI =   &get_instance();
    	$CI->db->select('id');
    	$CI->db->from('tag_options');
        $CI->db->where('product_id',$product_id);
    	$CI->db->where('status',1);
        $CI->db->where('is_deleted',0);
    	$query = $CI->db->get();
     	return $query->result();
    }

    public function product_data($product_id)
    {
        $CI =   &get_instance();
        $CI->db->select('*');
        $CI->db->from('products');
        $CI->db->where('id',$product_id);
        $query = $CI->db->get();

        return $query->result();
    }

    public function fetch_product_tags($pid)
    {
        $CI =   &get_instance();
        $CI->db->select('*');
        $CI->db->from('tag_options');
        $CI->db->where('product_id',$pid);
        $CI->db->where('status','1');
        $CI->db->where('is_deleted','0');
        $query = $CI->db->get();
        return $query->result();
    }

    public function fetch_review($pid)
    {
        $CI =   &get_instance();
        $CI->db->select('*');
        $CI->db->from('rating');
        $CI->db->where('product_id',$pid);
        $CI->db->where('status','1');
        $CI->db->where('is_deleted','0');
        $query = $CI->db->get();
        return $query->result();
    }

    public function fetch_product_img($pid)
    {
        $CI =   &get_instance();
        $CI->db->select('images');
        $CI->db->from('product_images');
        $CI->db->where('product_id',$pid);
        $CI->db->where('status','1');
        $CI->db->where('is_deleted','0');
        $CI->db->order_by('priority','asc');
        $CI->db->limit(1);
        $query = $CI->db->get();
        return $query->result();
    }

    public function fetch_user_address($id)
    {
        $CI =   &get_instance();
        $CI->db->select('*');
        $CI->db->from('user_address');
        $CI->db->where('id',$id);
        $query = $CI->db->get();
        return $query->result();
    }

    public function fetch_order_details($id)
    {
        $CI =   &get_instance();
        $CI->db->select('*');
        $CI->db->from('order_details');
        $CI->db->where('order_id',$id);
        $query = $CI->db->get();
        return $query->result();
    }

    public function fetch_tag_data($id)
    {
        $CI =   &get_instance();
        $CI->db->select('*');
        $CI->db->from('selected_tags');
        $CI->db->where('order_details_id',$id);
        $query = $CI->db->get();
        return $query->result();
    }

    public function fetch_product($pid)
    {
        $CI =   &get_instance();
        $CI->db->select('images');
        $CI->db->from('product_images');
        $CI->db->where('product_id',$pid);
        $CI->db->where('status','1');
        $CI->db->where('is_deleted','0');
        $CI->db->order_by('priority','asc');
        $query = $CI->db->get();
        return $query->result();
    }

    public function fetch_product_rating($pid)
    {
        $CI =   &get_instance();
        $CI->db->select('rating.*,avg(rating) as count');
        $CI->db->from('rating');
        $CI->db->where('product_id',$pid);
        $CI->db->where('status','1');
        $CI->db->where('is_deleted','0');
        $query = $CI->db->get();
        return $query->result();
    }
    
    public function fetch_product_rating_count($pid)
    {
        $CI =   &get_instance();
        $CI->db->select('*');
        $CI->db->from('rating');
        $CI->db->where('product_id',$pid);
        $CI->db->where('status','1');
        $CI->db->where('is_deleted','0');
        $query = $CI->db->get();
        return $query->result();
    }

    public function fetch_product_variants($pid)
    {
        $CI =   &get_instance();
        $CI->db->select('*');
        $CI->db->from('product_variants');
        $CI->db->where('product_id',$pid);
        $CI->db->where('status','1');
        $CI->db->where('is_deleted','0');
        $query = $CI->db->get();
        return $query->result();
    }
    

    public function fetch_paid_amount($id)
    {
        $CI =   &get_instance();
        $CI->db->select('paid_amount');
        $CI->db->from('orders');
        $CI->db->where('id',$id);
        $query = $CI->db->get();
        return $query->result();
    }
    

    public function update_order($id,$txn_id,$shipping_fee)
    {
        
        date_default_timezone_set("Asia/Kolkata");
        $date = date('Y-m-d H:i:s');
        
        $CI =   &get_instance();

        $CI->db->select('order_number');
        $CI->db->from('orders');
        $CI->db->order_by('order_number','desc');
        $CI->db->limit(1);
        $query = $CI->db->get();
        $check_order = $query->result();

        if(count($check_order)>0)
        {
           $code = str_replace('ORD','',$check_order[0]->order_number);
           $number = (int)$code+1;
        }
        else
        {
           $number = 1;
        }

        
        $assign_code['order_number'] = 'ORD'.sprintf("%'.05d\n", $number);
        $assign_code['txn_id'] = $txn_id;
        $assign_code['created_datetime']   = $date;
        $assign_code['shipping_fee']   = $shipping_fee;
        $CI->db->where('id',$id);
        $CI->db->update('orders',$assign_code);

        $CI->db->select('*');
        $CI->db->from('orders');
        $CI->db->where('id',$id);
        $orders = $CI->db->get()->result();

        $CI->db->select('*');
        $CI->db->from('user_address');
        $CI->db->where('id',$orders[0]->address_id);
        $userdata = $CI->db->get()->result();

        $email = $userdata[0]->user_email;
        $name  = ucfirst($userdata[0]->user_fname.' '.$userdata[0]->user_lname);
        $ordernumber = $orders[0]->order_number;
        $paid_amount = $orders[0]->paid_amount+$orders[0]->shipping_fee;
        $mobile = $userdata[0]->alt_mobile;

        $address = $userdata[0]->user_address.', '.$userdata[0]->user_landmark.', '.$userdata[0]->city.', '.$userdata[0]->state.', India - '.$userdata[0]->pincode;

        $CI->db->select('*');
        $CI->db->from('order_details');
        $CI->db->where('order_id',$orders[0]->id);
        $order_data = $CI->db->get()->result();

        $message = '<html>

<body style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
  <table style="max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px green;">
    <thead>
      <tr>
        <th style="text-align:left;">Joyfulsuprises</th>
        <th style="text-align:right;font-weight:400;">'.date('d M, Y h:i A').'</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="height:35px;"></td>
      </tr>
      <tr>
        <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
          <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">Order status</span><b style="color:green;font-weight:normal;margin:0">Success</b></p>
          <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Order ID</span> '.$ordernumber.'</p>
          <p style="font-size:14px;margin:0 0 0 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Order amount</span> Rs. '.$paid_amount.'</p>
        </td>
      </tr>
      <tr>
        <td style="height:35px;"></td>
      </tr>
      <tr>
        <td style="width:50%;padding:20px;vertical-align:top">
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px">Name</span> '.$name.'</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Email</span> '.$email.'</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Phone</span> +91-'.$mobile.'</p>
        </td>
        <td style="width:50%;padding:20px;vertical-align:top">
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Address</span> '.$address.'</p>
         
        </td>
      </tr>
      <tr>
        <td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Items</td>
      </tr>
      <tr>
        <td colspan="2" style="padding:15px;">';

        foreach($order_data as $od)
        {
          $message .='<p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
            <span style="display:block;font-size:13px;font-weight:normal;">'.$od->product_name.'</span> Rs. '.$od->product_price.'
          </p>';
        }
          
       $message .=' </td>
      </tr>
    </tbody>
    <tfooter>
      <tr>
        <td colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">
        <strong style="display:block;margin:0 0 10px 0;">If any queries please contact on : </strong>
          <b>Phone:</b> +91 9966558383<br>
          <b>Email:</b> joyfulsuprises@gmail.com
        </td>
      </tr>
    </tfooter>
  </table>
</body>

</html>';
 $subject = 'Order Confirmation from Joyfulsurprises';

    $status = $this->send_mail($email,$subject,$message,$name);
    if($status)
    {
        $_SESSION['coupon'] = '';
        return true;
    }


        
    }


    /* send mail default function  */

   public function send_mail_old($to,$subject,$message,$username)
   {
        $mail = new PHPMailer();
        //$mail->IsSMTP(true);
        $mail->isHTML(true);
        $mail->Host = 'smtp.gmail.com'; // not ssl://smtp.gmail.com
        $mail->SMTPAuth= true;
        $mail->Username='joyfulsuprises@gmail.com';
        $mail->Password='Manasvi@97';
        $mail->Port = 465; // not 587 for ssl 
        $mail->SMTPDebug = 2; 
        $mail->SMTPSecure = 'ssl';
        $mail->SetFrom('joyfulsuprises@gmail.com', 'Joyfulsuprises');
        $mail->AddAddress($to, $username);
    
        
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = "";

        if($mail->Send()) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
   }
   
   public function send_mail($to,$subject,$message,$username)
   {
       $headers = "MIME-Version: 1.0" . "\r\n";
       $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

       // More headers
       $headers .= 'From: <joyfulsuprises@gmail.com>' . "\r\n";
       $status = mail($to,$subject,$message,$headers);
        if($status) 
        {
            $admin = 'joyfulsuprises@gmail.com';
            if(mail($admin,$subject,$message,$headers))
            {
              return true;
            }
           
        } 
        else 
        {
            return false;
        }
   }
   
   public function fetch_rating_by_rate($pid,$rate)
    {
        $CI =   &get_instance();
        $CI->db->select('id');
        $CI->db->from('rating');
        $CI->db->where('product_id',$pid);
        $CI->db->where('rating',$rate);
        $CI->db->where('status',1);
        $CI->db->where('is_deleted',0);
        $query = $CI->db->get();
        return $query->result();
    }
    
    
}