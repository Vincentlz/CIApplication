<?php 
class CheckDevMod extends CI_Model {

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
		$this->load->database();
	}
	
	//获取没有盘点的设备
	function getNoCheckDevs(){
		$queryString = 'select a.id,a.device_name,a.model,a.theNum,a.borrower,a.owner,a.borrow_time,
				b.path from devices a,dev_imgs b where a.id=b.device_id and check_dev="0"';
		$query = $this->db->query($queryString);
		$arr = $query->result();
		return $arr;
	}
	
	//获取已经盘点过的设备
	function getCheckedDevs(){
		$queryString = 'select a.id,a.device_name,a.model,a.theNum,a.borrower,a.owner,a.borrow_time,
				b.path from devices a,dev_imgs b where a.id=b.device_id and check_dev="1"';
		$query = $this->db->query($queryString);
		$arr = $query->result();
		return $arr;
	}
	
	//获取所有设备
	function getAllDevs(){
		$queryString = 'select a.id,a.device_name,a.model,a.theNum,a.borrower,a.owner,a.borrow_time,
				b.path from devices a,dev_imgs b where a.id=b.device_id';
		$query = $this->db->query($queryString);
		$arr = $query->result();
		return $arr;
	}
	
	//获取丢失的设备
	function getLostDevs(){
		$queryString = 'select a.id,a.device_name,a.model,a.theNum,a.borrower,a.owner,a.borrow_time,
				b.path from devices a,dev_imgs b where a.id=b.device_id and check_dev="2"';
		$query = $this->db->query($queryString);
		$arr = $query->result();
		return $arr;
	}
	
	//重置设备状态
	function initializeDevs(){
		
		$data = array(
				"check_dev" => "0"
		);
		$this->db->update("devices",$data);
		return "scuess";
		/**
		$queryString = 'select a.id,a.device_name,a.model,a.theNum,a.borrower,a.owner,a.borrow_time,
				b.path from devices a,dev_imgs b where a.id=b.device_id and check_dev="0"';
		$query = $this->db->query($queryString);
		$arr = $query->result();
		return $arr;
		*/
	}
	
	//修改设备状态为已盘点
	function setDevStatusToAt($id){
		$data = array(
				"check_dev" => "1"
		);
		$this->db->where("id",$id);
		$this->db->update("devices",$data);
		return "scuess";
	}
	
	
	//修改设备状态为丢失
	function setDevStatusToLost($id){
		$data = array(
				"check_dev" => "2"
		);
		$this->db->where("id",$id);
		$this->db->update("devices",$data);
		return "scuess";
	}
	
	//修改设备状态为初始状态
	function setDevStatusToInitial($id){
		$data = array(
				"check_dev" => "0"
		);
		$this->db->where("id",$id);
		$this->db->update("devices",$data);
		return "scuess";
	}
	
}



?>