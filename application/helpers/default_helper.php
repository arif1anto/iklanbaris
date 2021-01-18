<?php

function webservice($port,$url,$parameter){
	$curl = curl_init();
	set_time_limit(0);
	curl_setopt_array($curl, array(
		CURLOPT_PORT => $port,
		CURLOPT_URL => "http://".$url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $parameter,
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"content-type: application/x-www-form-urlencoded"
		),
	)
);
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
		$response = ("Error #:" . $err);
	}
	else
	{
		$response;
	}
	return $response;
}

function cek_akses($akses){
	$ci = & get_instance();
	$user = $ci->session->userdata("user_id");
	$query = $ci->db->query("SELECT u.UsrANo,g.UsrGrpANo,a.UsrGrpAkses AS akses FROM msuserid u 
		LEFT JOIN msusergroup g ON u.UsrGrpANo=g.UsrGrpANo
		LEFT JOIN msuserakses a ON a.UsrGrpANo=g.UsrGrpANo
		WHERE u.UsrANo='$user' AND a.UsrGrpAkses='".$akses."'");
	return ($query->num_rows()>0);
}

//replace first karakter only
function str_replace_first($from, $to, $subject)
{
	$from = '/'.preg_quote($from, '/').'/';
	return preg_replace($from, $to, $subject, 1);
}


function convert_rp($rp) {
	$newrp = str_replace(".", "", $rp);
	if ($newrp=="") {
		$newrp = 0;
	}
	return $newrp;
}	

function coma($rp) {
	$newrp = str_replace(",", ".", $rp);
	return $newrp;
}	

function redirect_java($url)
{
	?>
	<script type="text/javascript">
		window.location = "<?php echo $url ?>";
	</script>
	<?php
}

function rp($value)
{
	if ($value==null) {
		return 0;	
	} else {
		$val = number_format($value,2,",",".");
		$ex = explode(",", $val);
		if ($ex[1]==0) {
			return (doubleval($value)!=0?$ex[0]:0);
		} else {
			return (doubleval($value)!=0?$val:0);
		}
	}
}

function usd_currency($uang,$mata_uang="USD")
{
	$currency = 12000 ; 
	if ( $mata_uang == "IDR" )
	{
		/*convert ke rupiah dulu*/
		$uang = $uang * $currency;
		$value = number_format($uang,0,"",",");
		$x =  "<span class='currency' style='color:#B4B4B4'>IDR</span> <span class='value'>".$value."</span>";
		return $x ; 
	}
	else if  ( $mata_uang == "USD" )
	{
		$uang = number_format($uang, 2); 
		$x =  "<span class='currency' style='color:#B4B4B4'>USD</span> <span class='value'>".$uang."</span>";
		return $x ; 
	}
}

function jam_fromxls($jam)
{
	if (is_numeric($jam)) {
		$jam -= floor($jam);
		$jms = $jam*24*60*60;
		$h = floor($jms/3600);
		$jms -= $h*3600;
		$m = floor($jms/60);
		$jms -= $m*60;
		$s = floor($jms);
		return $h.":".$m.":".$s;
	} else {
		if (trim($jam)!="") {
			return $jam;
		} else {
			return null;
		}
	}
}

function tgl($tgl)
{
	if ($tgl!="") {
		$ex = explode('-', $tgl);
		$tgl_conv = $ex[2]."/".$ex[1]."/".$ex[0]; 
		if ($ex[2]==0 || $ex[1]==0 || $ex[0]==0) {
			return "";
		} else {
			return $tgl_conv; 
		}
	} else {
		return "";
	}
}

function tgl_nama($tgl)
{
	$tgl = explode("/", tgl($tgl));
	$bln = explode(",","Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember");
	return $tgl[0]." ".$bln[$tgl[1]-1]." ".$tgl[2];
}

function tgl_jam($tgl)
{
	$ex = explode(" ", $tgl);
	if (count($ex)>=2) {
		return tgl($ex[0])." Jam ".jam($ex[1]);
	} else {
		return "";
	}
}

function jam($jam,$digit = 2)
{
	if ($jam!="") {
		$ex = explode(":", $jam);
		if ($digit==2) {
			return substr($ex[0], -2).":".$ex[1];
		} else if ($digit==3) {
			return substr($ex[0], -2).":".$ex[1].":".substr($ex[2],0,2);
		}
	}
}

 function durasi($jam,$hari=8) //1hari 8 jam
 {
 	if ($jam!="") {
 		$ex = explode(":", $jam);
 		$h = ""; $m = "";
 		if (intval(abs($ex[0]))>0) {
 			if (intval(abs($ex[0]))>$hari) {
 				$h = floor(intval(abs($ex[0]))/$hari)." Hari";
 				if (intval(abs($ex[0])) % $hari > 0) {
 					$h .= ", ".(intval(abs($ex[0])) % $hari)." Jam";
 				}
 			} else {
 				$h = intval(abs($ex[0]))." Jam";
 			}
 		}
 		$ret = $h;
 		if (intval($ex[1]>0)) {
 			$m = intval($ex[1])." Menit";
 			if ($h!="") {
 				$ret = $h.", ".$m;
 			} else {
 				$ret = $m;
 			}
 		}
 		if ($ret==", ") {
 			return "0 Menit";
 		} else {
 			if (intval($ex[0])<0) {
 				return "-".$ret;
 			} else {
 				return $ret;
 			}
 		}
 	}
 }

 function time_to_second($time='')
 {
 	$str_time = $time;
 	$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
 	sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
 	$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
 	return $time_seconds;
 }

 function second_to_time($seconds) {
 	$t = round($seconds);
 	return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
 }

//170320 1026
 function last_tgl($tanggal)
 {
 	if ($tanggal!="") {
 		$tgl = substr($tanggal, 4,2).'/'.substr($tanggal, 2,2).'/20'.substr($tanggal,0,2)
 		.' '.substr($tanggal,6,2).':'.substr($tanggal,8,2);
 		return $tgl; 
 	} else {
 		return "";
 	}
 }


 function tgl_convert($tgl)
 {
 	if ($tgl!="") {
 		$ex = explode('/', $tgl);
 		if(count($ex)<3){
 			return "";
 		} else {
 			$tgl_conv = $ex[2]."/".$ex[1]."/".$ex[0]; 
 			return $tgl_conv;
 		} 
 	} else {
 		return "";
 	}
 }

 function tgl_convert_xls($tgl)
 {
 	if ($tgl!="") {
 		if (is_numeric(trim($tgl))) {
 			return date("Y/m/d",($tgl-25569)*86400); 
 		} else {
 			return tgl_convert($tgl);
 		}
 	} else {
 		return "";
 	}
 }

 function alpha($str)
 {
 	return ( ! preg_match("/^([a-z])+$/i", $str)) ? FALSE : TRUE;
 }


 function alpha_numeric($str)
 {
 	return ( ! preg_match("/^([a-z0-9])+$/i", $str)) ? FALSE : TRUE;
 }

 function alpha_dash($str)
 {
 	return ( ! preg_match("/^([-a-z0-9_-])+$/i", $str)) ? FALSE : TRUE;
 }

 function is_natural($str)
 {   
 	return (bool)preg_match( '/^[0-9]+$/', $str);
 }

//================================ PAGINATION SECURITY 
// ============================ FOR SECURITY FILTERING INTPUT ===========================
 function pagination_alpha($str)
 {
 	return ( ! preg_match("/^([a-z])+$/i", $str)) ? "" : $str;
 }

 function pagination_alpha_numeric($str)
 {
 	return ( ! preg_match("/^([a-z0-9])+$/i", $str)) ? "" : $str;
 }


 function pagination_alpha_dash($str)
 {
 	return ( ! preg_match("/^([-a-z0-9_-])+$/i", $str)) ? "" : $str;
 }

 function pagination_alpha_all($str)
 {
//	if ( $str != "" & isset($str))
//	{
//		return ( ! preg_match("/^([-a-z0-9_-])+$/i", $str)) ? die("$str not autorize") : $str;
//	}
 	return $str;
 }

 function cek_session(){
 	$ci = & get_instance();
 	$ci->output->set_header("cache-Control: no-store, no-cache, must-revalidate");
 	$ci->output->set_header("cache-Control: post-check=0, pre-check=0", false);
 	$ci->output->set_header("Pragma: no-cache");
 	$ci->output->set_header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
 	
 	$user = $ci->session->userdata("user_id");
 	$loged_in = $ci->session->userdata("logged_in");

	//insert to access log untuk test
 	if ($ci->input->ip_address()!="::1" && $ci->session->userdata('username')!='1') {
 		$ci->load->database();
 		$ci->db->query("INSERT INTO qapp_sr.access_log VALUES 
 			(now(),
 			'".$ci->input->ip_address()."',
 			'".base_url(uri_string())."',
 			'".$user."',
 			'".$ci->session->userdata('username')."',
 			'".$ci->session->userdata('nama')."')");
 	}

 	if ($loged_in!='TRUE' || $user=='') {
 		redirect("login/logout_post"); 
 	}
 }

 function style_yn($a){
 	if ($a=="Y" || $a=="y") {
 		return "<span class='badge label-success'>Ya</span>";
 	} elseif($a=="N" || $a=="n") {
 		return "<span class='badge label-danger'>Tidak</span>";
 	} else {
 		return "";
 	}
 }

 function kurung_rp($dk='D',$nilai)	
 {
 	$n = str_replace(",", "", $nilai);
 	$n = floatval($n);
 	if ($dk=='K') {
 		$n = $n*(-1);
 	}
 	if ($n<0) {
 		return "(".rp(abs($n)).")";
 	} else {
 		return rp(abs($n));
 	}
 }

 function get_foto($UsrANo)
 {
 	$ci =& get_instance();
 	$ci->load->database();
 	$dt = $ci->db->select('foto')
 	->get_where('msuserid',array('UsrANo' => $UsrANo))
 	->row();
 	if (isset($dt->foto) && substr($dt->foto,0,10)=='data:image') {
 		return $dt->foto;
 	} else {
 		return site_url('assets/images/no_photo.jpg');
 	}
 }

 function getconfig($name='')
 {
 	if ($name!='') {
 		$ci =& get_instance();
 		$ci->load->database();
 		$q = $ci->db->get_where('mssetprog',array('setano' => $name));
 		$dt = $q->row();
 		return isset($dt->setchar) ? $dt->setchar : "";
 	} else {
 		return "";
 	}
 }

 function getsaran($sts = null)
 {
 	$ci =& get_instance();
 	$ci->load->database();
 	$usr = $ci->session->userdata('user_id');
 	if ($sts==null) {
 		$kondisi = array('userid' => $usr);
 	} else {
 		$kondisi = "userid = '".$usr."' AND ISNULL(ket)=FALSE";
 	}
 	$q = $ci->db->order_by('waktu','DESC')->get_where('qapp_sr.kotak_saran',$kondisi)->result();

 	return $q;
 }

 function get_accjuoto($kode='')
 {
 	if ($kode!='') {
 		$ci =& get_instance();
 		$ci->load->database();
 		$q = $ci->db->get_where('mssetjuoto',array('sjotrans' => $kode));
 		$dt = $q->row();
 		return isset($dt->AcPKd) ? $dt->AcPKd : "";
 	} else {
 		return "";
 	}
 }

//mencari harga asli dari diskon-diskon
 function hrg_asli($net=0, $ps1=0, $ps2=0, $ps3=0, $rp = 0)
 {
 	$hrp = $net + $rp;
 	$hps3 = ($hrp * 100) / (100 - $ps3);
 	$hps2 = ($hps3 * 100) / (100 - $ps2);
 	$hps1 = ($hps2 * 100) / (100 - $ps1);
 	return $hps1;
 }

 function romawi($number) {
 	$map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
 	$returnValue = '';
 	while ($number > 0) {
 		foreach ($map as $roman => $int) {
 			if($number >= $int) {
 				$number -= $int;
 				$returnValue .= $roman;
 				break;
 			}
 		}
 	}
 	return $returnValue;
 }

 function penyebut($nilai) {
 	$nilai = abs($nilai);
 	$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
 	$temp = "";
 	if ($nilai < 12) {
 		$temp = " ". $huruf[$nilai];
 	} else if ($nilai <20) {
 		$temp = penyebut($nilai - 10). " belas";
 	} else if ($nilai < 100) {
 		$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
 	} else if ($nilai < 200) {
 		$temp = " seratus" . penyebut($nilai - 100);
 	} else if ($nilai < 1000) {
 		$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
 	} else if ($nilai < 2000) {
 		$temp = " seribu" . penyebut($nilai - 1000);
 	} else if ($nilai < 1000000) {
 		$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
 	} else if ($nilai < 1000000000) {
 		$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
 	} else if ($nilai < 1000000000000) {
 		$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
 	} else if ($nilai < 1000000000000000) {
 		$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
 	}     
 	return $temp;
 }
 
 function terbilang($nilai) {
 	if($nilai<0) {
 		$hasil = "minus ". trim(penyebut($nilai));
 	} else {
 		$hasil = trim(penyebut($nilai));
 	}     		
 	return $hasil;
 }

 function lama_bulan($dari, $sampai)
 {
 	$awal  = new DateTime($dari);
 	$akhir = new DateTime($sampai);
 	$akhir = date_add($akhir,date_interval_create_from_date_string("1 day"));
 	$diff  = $awal->diff($akhir);

 	$ret = $diff->y . ' ('.terbilang($diff->y).') tahun ';
 	if ($diff->m!=0) {
 		$ret .= $diff->m . ' ('.terbilang($diff->m).') bulan';
 	}
 	return $ret;
 }

 function bulan($bln)
 {
 	switch ($bln)
 	{
 		case 1:
 		return "Januari";
 		break;
 		case 2:
 		return "Februari";
 		break;
 		case 3:
 		return "Maret";
 		break;
 		case 4:
 		return "April";
 		break;
 		case 5:
 		return "Mei";
 		break;
 		case 6:
 		return "Juni";
 		break;
 		case 7:
 		return "Juli";
 		break;
 		case 8:
 		return "Agustus";
 		break;
 		case 9:
 		return "September";
 		break;
 		case 10:
 		return "Oktober";
 		break;
 		case 11:
 		return "November";
 		break;
 		case 12:
 		return "Desember";
 		break;
 	}
 }

 function bulan_short($bln)
 {
 	switch ($bln)
 	{
 		case 1:
 		return "Jan";
 		break;
 		case 2:
 		return "Feb";
 		break;
 		case 3:
 		return "Mar";
 		break;
 		case 4:
 		return "Apr";
 		break;
 		case 5:
 		return "Mei";
 		break;
 		case 6:
 		return "Jun";
 		break;
 		case 7:
 		return "Jul";
 		break;
 		case 8:
 		return "Agu";
 		break;
 		case 9:
 		return "Sep";
 		break;
 		case 10:
 		return "Okt";
 		break;
 		case 11:
 		return "Nov";
 		break;
 		case 12:
 		return "Des";
 		break;
 	}
 }

 function tgl_indo($date=null)
 {
 	if(isset($date))
 	{
 		$split = explode('-',$date);
 		$tanggal = $split[0];
 		$bulan = bulan($split[1]);
 		$tahun = $split[2];
 	}else
 	{
 		$tanggal = date('d');
 		$bulan = bulan(date('m'));
 		$tahun = date('Y');
 	}
 	return $tanggal.' '.$bulan.' '.$tahun;
 }

 function slug($text)
 {
    // replace non letter or digits by -
 	$text = preg_replace('~[^\\pL\d]+~u', '-', $text);

    // trim
 	$text = trim($text, '-');

    // transliterate
 	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // lowercase
 	$text = strtolower($text);

    // remove unwanted characters
 	$text = preg_replace('~[^-\w]+~', '', $text);

 	if (empty($text))
 	{
 		return 'n-a';
 	}

 	return $text;
 }

 function format_indo($date){
    // array hari dan bulan
 	$Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
 	$Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

    // pemisahan tahun, bulan, hari, dan waktu
 	$tahun = substr($date,0,4);
 	$bulan = substr($date,5,2);
 	$tgl = substr($date,8,2);
 	$waktu = substr($date,11,5);
 	$hari = date("w",strtotime($date));
 	$result = $Bulan[(int)$bulan-1]." ".$tahun."".$waktu;

 	return $result;
 }

 ?>

