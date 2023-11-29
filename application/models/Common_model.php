<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model
{
   public function do_login($username,$password,$role)
   {
      $this->db->select('*');
      $this->db->from('administration');
      $this->db->where('password',$password);
      $this->db->where('(mobile="'.$username.'" OR email="'.$username.'")');
      $this->db->where('role',$role);
      return $this->db->get()->result();
   }

   public function fetch_data($tbl,$where,$orderby='',$limit='')
   {
   	  $this->db->select('*');
   	  $this->db->from($tbl);
   	  $this->db->where($where);
      if($orderby!="")
      {
        $data = explode('__', $orderby);
        $this->db->order_by($data[0],$data[1]);
      }
      
      if($limit!="")
      {
        $this->db->limit($limit);
      }
   	  return  $this->db->get()->result();
   }

   public function create($tbl,$post)
   {
            $this->db->insert($tbl,$post);
   	 return $this->db->insert_id(); 
   }

   public function fetch_by_id($tbl,$id)
   {
   	 $this->db->select('*');
   	 $this->db->from($tbl);
   	 $this->db->where('id',$id);
   	 return $this->db->get()->result();
   }	

   public function update($tbl,$post,$where)
   {
   	        $this->db->where($where);
   	 return $this->db->update($tbl,$post);
   }

   public function fetch_product_data($pname)
   {
     $this->db->select('*');
     $this->db->from('products');
     $this->db->where('product_name="'.$pname.'" OR url_name="'.$pname.'"');
     $this->db->where('status','1');
     $this->db->where('is_deleted','0');
     return $this->db->get()->result();
   }

   public function fetch_orders($status)
   {
     $this->db->select('orders.*,user_address.user_fname,user_address.user_lname,user_address.alt_mobile,user_address.user_email');
     $this->db->from('orders');
     $this->db->join('user_address','user_address.id=orders.address_id','LEFT');
     if($status!="all")
     {
         $this->db->where('orders.order_status',$status);
     }
     
     $this->db->where('orders.order_number!=','');
     $this->db->order_by('orders.order_number','desc');
     
     return $this->db->get()->result();
   }
}