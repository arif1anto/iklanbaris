<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-Yr9Ti87sclfaEFPwV_VLfhzA', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');	
    }

    public function index()
    {
    	$this->load->view('checkout_snap');
    }

    public function token()
    {
		// var_dump($_POST); die;
		$total = $this->input->post('total');
		$qty_huruf = $this->input->post('qty_huruf');
		$hrg_huruf = $this->input->post('hrg_huruf');
		$hrg_tema = $this->input->post('hrg_tema');
		$nama_tema = $this->input->post('nama_tema');

		// Required
		$transaction_details = array(
		  'order_id' => rand(),
		  'gross_amount' => $total, // no decimal allowed for creditcard
		);

		// Optional
		$item1_details = array(
		  'id' => 'a1',
		  'price' => $hrg_huruf,
		  'quantity' => $qty_huruf,
		  'name' => "Jumlah Huruf"
		);

		// Optional
		$item2_details = array(
		  'id' => 'a2',
		  'price' => $hrg_tema,
		  'quantity' => 1,
		  'name' => $nama_tema
		);

		// Optional
		$item_details = array ($item1_details, $item2_details);

		// Optional
		$customer_details = array(
		  'first_name'    => $this->session->userdata('firstname'),
		  'last_name'     => $this->session->userdata('lastname'),
		  'email'         => $this->input->post('email'),
		  'phone'         => $this->input->post('wa'),
		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'minute', 
            'duration'  => 2
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		// var_dump($transaction_data); die;
		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
    }

    public function finish()
    {
    	$result = json_decode($this->input->post('result_data'));
    	echo 'RESULT <br><pre>';
    	var_dump($result);
    	echo '</pre>' ;

    }
}
