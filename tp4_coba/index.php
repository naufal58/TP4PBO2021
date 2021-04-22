<?php

/******************************************
PRAKTIKUM RPL
******************************************/

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

// Memanggil method getTask di kelas Task
$otask->getTask();

// Proses mengisi tabel dengan data
$data = null;
$no = 1;

while (list($id, $tnama, $tdetail, $ttipe, $trt, $ttgl, $tstatus) = $otask->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	if($tstatus == "Sudah"){
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tnama . "</td>
		<td>" . $tdetail . "</td>
		<td>" . $ttipe . "</td>
		<td>" . $trt . "</td>
		<td>" . $ttgl . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}

	// Tampilan jika status task nya belum dikerjakan
	else{
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tnama . "</td>
		<td>" . $tdetail . "</td>
		<td>" . $ttipe . "</td>
		<td>" . $trt . "</td>
		<td>" . $ttgl . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' ><a href='index.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Selesai</a></button>
		</td>
		</tr>";
		$no++;
	}
}


// Menutup koneksi database
$otask->close();

if(isset($_POST['add'])) {
    $tnama = $_POST['tnama'];
    $tdetail = $_POST['tdetail'];
    $ttipe = $_POST['ttipe'];
    $trt = $_POST['trt'];
	$ttgl = $_POST['ttgl'];

    $otask->open();
    $otask->addTask($tnama,$tdetail,$ttipe,$trt,$ttgl);
    $otask->close();
}


if(isset($_GET['id_hapus'])){
	$otask->open();
	$otask->delTask($_GET['id_hapus']);
	$otask->close();
}

if(isset($_GET['id_status'])){
	$otask->open();
	$otask->updateTask($_GET['id_status']);
	$otask->close();
}

// Membaca template skin.html
$tpl = new Template("templates/skin.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();