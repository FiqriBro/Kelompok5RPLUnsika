<?php 
$conn = mysqli_connect("localhost","root","","db_todo");

function daftar($post){
	global $conn;
	$username = strtolower(stripslashes($post['username']));
	$namadepan = ucfirst(strtolower(htmlspecialchars($post['namadepan'])));
	$namabelakang  = ucfirst(strtolower(htmlspecialchars($post['namabelakang'])));
	$password1 = mysqli_real_escape_string($conn, $post['password1']);
	$password2 = mysqli_real_escape_string($conn, $post['password2']);

	// ada spasi di username
	if ($username == trim($username) && strpos($username, ' ') !== false) {
    	echo "<div class='alert alert-danger mb-2' role='alert' autofocus>
			  Username tidak boleh menggunakan spasi!
			</div> ";
			return false;
	}

	// password1 dan password 2 tidak sama
	if (strcmp($password1, $password2) !== 0) {
		echo "<div class='alert alert-danger mb-2' role='alert' autofocus>
			  Konfirmasikan passwordmu dengan benar!
			</div> ";
			return false;
	}

		
	
	// enkripsi password
	$password1 = password_hash($password1, PASSWORD_DEFAULT);
	$result = mysqli_query($conn, "INSERT INTO tb_user VALUES ('$username','$password1','$namadepan','$namabelakang','')");
	if ($result) {
		echo "<div class='alert alert-success mb-2' role='alert' autofocus>
			  Kamu berhasil daftar! <a href='index.php' class='alert-link'>Klik disini untuk login</a>
			</div> ";
			return true;
	}else{
		echo "<div class='alert alert-danger mb-2' role='alert' autofocus>
			  Username sudah terdaftar!
			</div> ";
			return false;
	}



}

function login($post){
	global $conn;
	$username = strtolower($post['username']);
	$password = $post['password'];
	// CEK KETERSEDIAAN USERNAME
	$cekusername = mysqli_query($conn, "SELECT * FROM tb_user WHERE col_username_user = '$username'");
	if(mysqli_num_rows($cekusername) === 1){
		$row = mysqli_fetch_assoc($cekusername);
		$cekpassword = password_verify($password, $row['col_password_user']);
		if ($cekpassword) {
			$_SESSION['username'] = $post['username'];
			$permission = $_SESSION['username'];
			echo "<script>window.location.href= 'todo.php'</script>";
			exit();
		}
		
	}
	echo "<div class='alert alert-danger mb-2' role='alert' autofocus>
			  Username atau password salah!
			</div> ";
	return false;
}

function query($session){
	global $conn;
	$username = $session;
	$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE col_username_user = '$username'");
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows = $row;
	}
	return $rows;
}

function inputaktivitas($post, $session){
	global $conn;
	$namaaktivitas = $post['namaaktivitas'];
	$deskripsi = $post['deskripsi'];
	$waktupelaksanaan = $post['waktupelaksanaan'];
	$username = $session;
	$result = mysqli_query($conn, "INSERT INTO tb_activity VALUES('','$namaaktivitas','$deskripsi','$username','$waktupelaksanaan')");
	if ($result) {
		echo "<div class='alert alert-success mb-2 slide-in-top' role='alert' autofocus>
			  Aktivitas baru telah masuk, semangat ya!, <a href='index.php' class='alert-link'>Klik disini!</a>
			</div>";
		return true;
	}
}

function aktivitas($session){
	global $conn;
	$username = $session;
	$result = mysqli_query($conn, "SELECT * FROM tb_activity WHERE col_username_user = '$username' ORDER BY col_date_activity");
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	// var_dump($rows);
	return $rows;
}

function edit($get,$session){
	global $conn;
	$id = $get;
	$username= $session;
	$result = mysqli_query($conn, "SELECT * FROM tb_activity WHERE col_id_activity = '$id' AND col_username_user = '$session'");
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows = $row;
	}

	return $rows;
}

function hapus($get, $session){
	global $conn;
	$username = $session;
	$id = $get;
	$result = mysqli_query($conn, "DELETE FROM tb_activity WHERE col_id_activity = '$id' AND col_username_user = '$username'");
	echo mysqli_error($conn);
	return true;
}

function editdata($get, $session, $post){
	global $conn;
	$id = $get;
	$username = $session;
	$namaaktivitas = $post['namaaktivitas'];
	$deskripsi = $post['deskripsi'];
	$waktupelaksanaan = $post['waktupelaksanaan'];

	$result = mysqli_query($conn, "UPDATE tb_activity SET col_name_activity = '$namaaktivitas', col_description_activity = '$deskripsi', col_date_activity = '$waktupelaksanaan' WHERE col_id_activity = '$id' AND col_username_user = '$username'");
	if ($result) {
		echo "<div class='alert alert-success slide-in-top' role='alert' autofocus>
			  Aktivitas berhasil diubah, semangat ya!, <a href='index.php' class='alert-link'>Klik disini!</a>
			</div>";
		header('Location: index.php');
		return true;
	}
}

	function ambilpassword($session,$post){
		global $conn;
		$username = $session;
		$password = $post;
		$result = mysqli_query($conn, "SELECT col_password_user FROM tb_user WHERE col_username_user = '$username'");
		$result = mysqli_fetch_assoc($result);
		$result = $result['col_password_user'];
		$cekpassword = password_verify($password,$result);
		if($cekpassword){
			echo "<div class='alert alert-success slide-in-top' role='alert' autofocus>
				Password berhasil di ubah, jangan lupa ya!
			</div>";
			return true;
		}else{
			echo "<div class='alert alert-danger slide-in-top' role='alert' autofocus>
				Coba ingat kembali password anda yang sekarang!
			</div>";
			return false;
		}
	}

 ?>
