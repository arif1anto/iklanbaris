<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

/* Define jenis provider di table tbl_provider */
define("CUSTOMER_ID",1);

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/* Define jenis provider di table tbl_provider */
define("SUPPLIER_ID",2);
define("VENDOR_ID",1);

/*define jenis raw material & support material di tbl_material_categories */
define("RAW_MATERIAL_ID",1);
define("SUPPORT_MATERIAL_ID",2);

/* definisi gudang yang di pakai di table tbl_warehouse */
define("GUDANG_UTAMA",4);

/* mendefinisi katagori material */
define("ACCOUNTING_LPB","PR");
define("ACCOUNTING_ISSUE","GI");
define("ACCOUNTING_PACKED","GR");
define("ACCOUNTING_SHIPMENT","SI");
define("ACCOUNTING_HARGA_POKOK","CG");
define("ACCOUNTING_PENERIMAAN_KAS","CR");
define("ACCOUNTING_PENGELUARAN_KAS","CD");
define("ACCOUNTING_UMUM","GJ");

/* type accounting */
define("GROUP_RAW_BODY_ID",10);
define("GROUP_COMMON_ID", 9);
define("GROUP_JOK_ID",8);
define("GROUP_ASSEMBLY_ID",7);
define("GROUP_AKSESORIS_ID",6);
define("GROUP_PACKING_ID",5);
define("GROUP_FINISHING_WATERBASED_ID",4);
define("GROUP_FINISHING_GLAZE_ID",3);
define("GROUP_LIQUID_ID",2);
define("GROUP_OTHER_ID",1);

// AKUNTANSI DAN KEUANGAN
define("TERIMA_KAS_PIUTANG_DETAIL","12002");
define("TERIMA_KAS_DEPOSIT_DETAIL","23001");
define("TERIMA_KAS_DEPOSIT_UTAMA",
	'[
	{"COA_ID":"11003","COA_NAME":"KAS DITANGAN USD","COA_STATUS":"Umum","COA_KURS":"USD"},
	{"COA_ID":"11102","COA_NAME":"BANK MEGA USD","COA_STATUS":"Umum","COA_KURS":"USD"},
	{"COA_ID":"11105","COA_NAME":"BANK MANDIRI 7476 USD","COA_STATUS":"Umum","COA_KURS":"USD"}
	]');


// ini salah
define("TERIMA_KAS_UMUM_UTAMA",
	'[
	{"COA_ID":"11001","COA_NAME":"PETTY CASH","COA_STATUS":"Umum","COA_KURS":"IDR"},
	{"COA_ID":"11002","COA_NAME":"KAS DITANGAN IDR","COA_STATUS":"Umum","COA_KURS":"IDR"},
	{"COA_ID":"11003","COA_NAME":"KAS DITANGAN USD","COA_STATUS":"Umum","COA_KURS":"USD"},
	{"COA_ID":"11101","COA_NAME":"BANK MEGA IDR","COA_STATUS":"Umum","COA_KURS":"IDR"},
	{"COA_ID":"11102","COA_NAME":"BANK MEGA USD","COA_STATUS":"Umum","COA_KURS":"USD"},
	{"COA_ID":"11103","COA_NAME":"BANK MANDIRI 9891 IDR","COA_STATUS":"Umum","COA_KURS":"IDR"},
	{"COA_ID":"11104","COA_NAME":"BANK MANDIRI 9909 IDR","COA_STATUS":"Umum","COA_KURS":"IDR"},
	{"COA_ID":"11105","COA_NAME":"BANK MANDIRI 7476 USD","COA_STATUS":"Umum","COA_KURS":"USD"},
	{"COA_ID":"11106","COA_NAME":"BANK MANDIRI 7476 7419","COA_STATUS":"Umum","COA_KURS":"IDR"},
	{"COA_ID":"11107","COA_NAME":"BANK MANDIRI 2620 IDR","COA_STATUS":"Umum","COA_KURS":"IDR"},
	{"COA_ID":"11108","COA_NAME":"BANK MANDIRI 3961 IDR","COA_STATUS":"Umum","COA_KURS":"IDR"}
	]');
define("TERIMA_KAS_UMUM_DETAIL_EXCEPT",
	'[
	{"COA_ID":"12002","COA_NAME":"PIUTANG USAHA","COA_STATUS":"Piutang","COA_KURS":"IDR"},
	{"COA_ID":"13001","COA_NAME":"UANG MUKA KE SUPPLIER","COA_STATUS":"Deposit","COA_KURS":"IDR"},
	{"COA_ID":"23001","COA_NAME":"UANG MUKA DARI CUSTOMER","COA_STATUS":"Deposit","COA_KURS":"IDR"},
	{"COA_ID":"22001","COA_NAME":"HUTANG USAHA","COA_STATUS":"Hutang","COA_KURS":"IDR"}
	]');
define("KAS_KELUAR_UTAMA",
	'[
	{"COA_ID":"11001","COA_NAME":"PETTY CASH","COA_STATUS":"Umum","COA_KURS":"IDR"},
	{"COA_ID":"11002","COA_NAME":"KAS DITANGAN IDR","COA_STATUS":"Umum","COA_KURS":"IDR"},
	{"COA_ID":"11003","COA_NAME":"KAS DITANGAN USD","COA_STATUS":"Umum","COA_KURS":"USD"},
	{"COA_ID":"11101","COA_NAME":"BANK MEGA IDR","COA_STATUS":"Umum","COA_KURS":"IDR"},
	{"COA_ID":"11102","COA_NAME":"BANK MEGA USD","COA_STATUS":"Umum","COA_KURS":"USD"},
	{"COA_ID":"11103","COA_NAME":"BANK MANDIRI 9891 IDR","COA_STATUS":"Umum","COA_KURS":"IDR"},
	{"COA_ID":"11104","COA_NAME":"BANK MANDIRI 9909 IDR","COA_STATUS":"Umum","COA_KURS":"IDR"},
	{"COA_ID":"11105","COA_NAME":"BANK MANDIRI 7476 USD","COA_STATUS":"Umum","COA_KURS":"USD"},
	{"COA_ID":"11106","COA_NAME":"BANK MANDIRI 7476 7419","COA_STATUS":"Umum","COA_KURS":"IDR"},
	{"COA_ID":"11107","COA_NAME":"BANK MANDIRI 2620 IDR","COA_STATUS":"Umum","COA_KURS":"IDR"},
	{"COA_ID":"11108","COA_NAME":"BANK MANDIRI 3961 IDR","COA_STATUS":"Umum","COA_KURS":"IDR"}
	]');
define("KAS_KELUAR_UMUM_DETAIL_EXCEPT",
	'[
	{"COA_ID":"12002","COA_NAME":"PIUTANG USAHA","COA_STATUS":"Piutang","COA_KURS":"IDR"},
	{"COA_ID":"23001","COA_NAME":"UANG MUKA DARI CUSTOMER","COA_STATUS":"Deposit","COA_KURS":"IDR"}
	]');
define("KAS_KELUAR_HUTANG_DETAIL", "22001");
define("KAS_KELUAR_DEPOSIT_DETAIL", "13001");
define("JURNAL_OTOMATIS_LPB_SM_DEBET", "14003");
define("JURNAL_OTOMATIS_LPB_SM_KREDIT", "22001");
define("JURNAL_OTOMATIS_LPB_RAW1_DEBET", "14002");
define("JURNAL_OTOMATIS_LPB_RAW1_KREDIT", "22001");
define("JURNAL_OTOMATIS_LPB_RAW2_DEBET", "52001");
define("JURNAL_OTOMATIS_LPB_RAW2_KREDIT", "14002");
define("JURNAL_OTOMATIS_ISSUE_SM_DEBET", "52002");
define("JURNAL_OTOMATIS_ISSUE_SM_KREDIT", "14003");

/* End of file constants.php */
/* Location: ./application/config/constants.php */