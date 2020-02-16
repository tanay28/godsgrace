<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermanagement extends CI_Model {

    public function getUserWalletPoint($userid){

        $sql = "SELECT wallet FROM users 
                WHERE id = '".$userid."'";
        return $this->db->query($sql)->result_array();
    }

    public function updateUserWallet($uid,$wallet){

        $value = array(
            'wallet' => $wallet
        );
        
        $this->db->where(array('id'=>$uid));
        if( $this->db->update('users',$value))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getMyprofileDetails_superadmin($userid){

        $sql = "SELECT * FROM users 
                WHERE userstype = 'SUPERADMIN'
                AND id = '".$userid."'";
        return $this->db->query($sql)->result_array();
    }

    public function validateLogin($email, $password){
        $password = md5($password);
        $this->db->select("*");
        $query = $this->db->get_where("users", array("email" => $email));
        $p = $query->row_array();
        if($query->num_rows() == 1 && $password == $p['password']){
            return $query->row();
        }else{
            /*echo "<pre>";
            var_dump($p);
            die;*/
        }
    }
    public function validateEmail($email){
        
        $this->db->select("*");
        $query = $this->db->get_where("users", array("email" => $email));
        $p = $query->row_array();

        if($query->num_rows() == 1){  
            return $query->result_array(); 
        }else{
            return false;
        }
    }
    public function validateUser($email)
    {
        $this->db->select("*");
        $query = $this->db->get_where("users", array("email" => $email,"userstype" => "AGENT"));
        $p = $query->row_array();
       
        if($query->num_rows() > 0 && isset($p['id']) && $p['id'] != ''){  
            //return true;
            return $p['id'];
        }else{
            return false;
        }   
    } 
    public function resetPassword($email,$new)
    {
        $sql = "UPDATE users SET password = '".md5($new)."' WHERE email = '".$email."'";
        return $this->db->query($sql);
    }
    public function changePassword($uid,$pass)
    {
        $value=array('password'=>md5($pass));
        $this->db->where('id',$uid);
        if( $this->db->update('users',$value))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function getcountries()
    {
        $sql = "SELECT * FROM country ORDER BY country_name";
        return $this->db->query($sql)->result_array();
    }
    public function getcurrency()
    {
        $sql = "SELECT * FROM currency ORDER BY id";
        return $this->db->query($sql)->result_array();
    }
    public function gettimezone()
    {
         $sql = "SELECT * FROM timezone ORDER BY id";
        return $this->db->query($sql)->result_array();
    }
    public function getCities($con)
    {
        $sql = "SELECT * FROM city WHERE country_id = '".$con."'";
        return $this->db->query($sql)->result_array();
    }
    public function insert_user_data($tbl_name,$Arr_users)
    {
        $this->db->insert($tbl_name,$Arr_users);
        return $this->db->insert_id();
    }
    public function is_account_activated($email,$code)
    {
        $sql = "SELECT * FROM users WHERE email = '".$email."' AND activation_code = '".$code."'";
        $rs = $this->db->query($sql)->result_array();
        return $rs;
    }
    public function activate_user_account($email)
    {
        $value=array('status'=> 'ACTIVE');
        $this->db->where('email',$email);
        if( $this->db->update('users',$value))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function get_firstName($id)
    {
        $sql = "SELECT ag.first_name FROM agents ag LEFT JOIN agent_user_mapping ag_map ON ag.id = ag_map.agent_id WHERE ag_map.agent_id = '".$id."'";
        return $this->db->query($sql)->result_array();
    }
    public function log_forgot_password_details($arrData)
    {
        $this->db->insert('forgot_password_log',$arrData);
        return $this->db->insert_id();
    }
    public function validate_urlData($code,$current_date)
    {
        $sql = "SELECT user_id FROM forgot_password_log WHERE user_code = '".md5($code)."' AND status = 'ACTIVE' AND end_date > '".$current_date."' AND start_date < '".$current_date."'";
        $rs = $this->db->query($sql)->result_array();
        if(isset($rs[0]['user_id']) && count($rs)>0)
        {
            return $rs[0]['user_id'];
        }
        else
        {
            return false;
        }
    }
    public function update_status($user_id,$status)
    {
        if($user_id != '')
        {
            $sql = "UPDATE forgot_password_log SET status = '".$status."' WHERE user_id = '".$user_id."'";
            return $this->db->query($sql);
        }
        else
        {
            $sql = "UPDATE forgot_password_log SET status = '".$status."'";
            return $this->db->query($sql);   
        }
    }

    public function insert_logindata($loginData){

        return $this->db->insert('login_details',$loginData);
    }

    public function update_logoutDetails($email){

        $last_id = 0;
        $sql = "SELECT MAX(id) AS id FROM login_details ORDER BY id";
        $rs = $this->db->query($sql)->result_array();
        if(isset($rs[0]['id']) && $rs[0]['id']!=0){
            $last_id = $rs[0]['id'];
            $logoutTime = date('y-m-d H:i:s');
            $sql = "UPDATE login_details SET logout_at = '".$logoutTime."' WHERE email = '".$email."' AND id='".$last_id."'";
            $this->db->query($sql);
            $sql = "DELETE FROM login_details WHERE logout_at = '0000-00-00 00:00:00'";
            $this->db->query($sql);
            return true; 
        }      
    }

    public function is_loggedIn(){

        $sql = "SELECT logout_at FROM login_details WHERE id = (SELECT MAX(id) AS id FROM login_details)";
        $rs = $this->db->query($sql)->result_array();
        if(isset($rs[0]['logout_at']) && $rs[0]['logout_at'] == '0000-00-00 00:00:00'){
            return true;
        }
        return false;
    }
}
?>