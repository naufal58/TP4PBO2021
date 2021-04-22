<?php 



class Task extends DB{
	
	// Mengambil data
	function getTask(){
		// Query mysql select data ke list_warga
		$query = "SELECT * FROM list_warga";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function addTask($tnama,$tdetail,$ttipe,$trt,$ttgl) {
        $query = "INSERT INTO list_warga(nama_ketua_td, detail_td, tipe_td, rt_td, tanggal_pembangunan_td, status_td) VALUES('$tnama','$tdetail','$ttipe','$trt','$ttgl','Belum')";
        $this->execute($query); 
    }

	function delTask($id){
		$query = "DELETE FROM list_warga WHERE id = {$id}";
		$this->execute($query);
	}

	function updateTask($id){
		$query = "UPDATE list_warga SET status_td = 'Sudah' WHERE id = {$id}";
		$this->execute($query);
	}

}

?>