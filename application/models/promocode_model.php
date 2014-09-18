<?php

class Promocode_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public static $TYPE_VALUE = 'V';
    public static $TYPE_PERCENT = 'P';
    
    /**
     * 
     * @param type $type
     * @param type $value
     * @param type $cus_id NULL if not associate with customer
     * @param type $amount_threshold
     * @param type $valid_days
     */
    public function create($type, $value, $cus_id = NULL, $amount_threshold = 0, $valid_days = NULL)
    {
//        $salt = $this->generateRandomString(10);
//        $data = $cus_id.'-'.$type.'-'.$value.'-'.$amount_threshold;
//        $hashed = hash('sha512', $data.$salt);
//        $code = substr($hashed, 0, 13);
//        
//        $desc = 'ส่วนลด ';
//        if($type == Promocode_model::$TYPE_PERCENT)
//        {
//            $desc .= $value.'%';
//        }
//        else
//        {
//            $desc .= $value .' บาท';
//        }
//        if($amount_threshold > 0)
//        {
//            $desc .= ' เมื่อซื้อสินค้าครบ ' .$amount_threshold .' บาท';
//        }
//        
//        $expired = new DateTime();
//        if(!empty($valid_days))
//        {
//            date_add($expired,date_interval_create_from_date_string($valid_days." days"));
//        }
//        else
//        {
//            date_add($expired,date_interval_create_from_date_string("30 days"));
//        }
//        
//        $pcode = array(
//                'code' => $code,
//                'desc' => $desc,
//                'type' => $type,
//                'value' => $value,
//                'amount_threshold', $amount_threshold,
//                'expired_datetime' => $expired->format('Y-m-d H:i:s'),
//        );
//        if(!empty($cus_id))
//        {
//            $pcode['customer_id'] = $cus_id;
//        }
        
//        $this->db->insert('promocode', $pcode);
//        $id = $this->db->insert_id();
//        $code .= $id;
//        $this->db->where('promocode', $id);
//        $this->db->update('promocode', array('code' => $code)); 
        return $code;
    }
            
    /**
     * Check if the user can use this promocode
     * @param type $code
     * @param type $cus_id
     * @param type $buy_amount
     * @return 
     */
    public function check_code($code, $cus_id, $buy_amount)
    {
        $result = $this->db->get_where('promocode', array('code' => $code))->result();
        if(count($result) != 1)
        {
            return array(
                'success' => FALSE,
                'error' => 'รหัสโปรโมชันไม่ถูกต้อง'
            );
        }
        
        $pcode = $result[0];
        if(!empty($pcode->customer_id) && $pcode->customer_id != $cus_id)
        {
            return array(
                'success' => FALSE,
                'error' => 'รหัสโปรโมชันไม่ถูกต้อง'
            );
        }
        if(!empty($pcode->expire_datetime) && date_create($pcode->expire_datetime) < new DateTime())
        {
            return array(
                'success' => FALSE,
                'error' => 'รหัสโปรโมชันหมดอายุ'
            );
        }
        if(!empty($pcode->used_datetime))
        {
            return array(
                'success' => FALSE,
                'error' => 'รหัสโปรโมชันนี้ถูกใช้แล้ว',
            );
        }
        if($pcode->amount_threshold > 0 && $pcode->amount_threshold > $buy_amount)
        {
            return array(
                'success' => FALSE,
                'error' => 'ต้องมียอดขั้นต่ำ '.$pcode->amount_threshold.' บาทจึงจะใช้รหัสโปรโมชันได้',
            );
        }
        
        
        if($pcode->type == Promocode_model::$TYPE_PERCENT)
        {
            $discount = $pcode->value/100*$buy_amount;
        }
        else
        {
            $discount = $pcode->value;
        }
        
        return array(
            'success' => TRUE,
            'pcode' => $pcode,
            'discount' => $discount,
        );
    }
    
    public function get_code_from_id($code_id)
    {
        $result = $this->db->get_where('promocode', array('id' => $code_id))->result();
        if(count($result) > 0)
        {
            return $result[0];
        }
        else
        {
            return FALSE;
        }
    }
    
    public function use_code($code_id)
    {
        $this->db->where('promocode', $code_id);
        $this->db->update('promocode', array('used_datetime' => date('Y-m-d H:i:s'))); 
    }
    
    public function get_promocodes()
    {
        return $this->db->get('promocode')->result_array();
    }
    
    private function generateRandomString($length = 10) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }
}
    