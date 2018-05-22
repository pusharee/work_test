<?php
namespace App\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use OneForge\ForexQuotes\ForexDataClient;

class WorktestController extends AbstractController
{
	/**
     * @Route("/")
     */
  public function homepage()
    {

    $quantityFrom =  isset($_GET['quantityFrom'])? $_GET['quantityFrom'] : 10;
    $currencyFrom =  isset($_GET['currencyFrom'])? $_GET['currencyFrom'] : 'USD';
    $quantityTo =  isset($_GET['quantityTo'])? $_GET['quantityTo']: 0;
    $currencyTo =  isset($_GET['currencyTo'])? $_GET['currencyTo'] : 'EUR';
    $client = new ForexDataClient('EQSnBJo9GkXJRdzzoWGAjxD2b7RwUtsS');
    if($quantityFrom!=0){
		$conversion     = $client->convert($currencyFrom , $currencyTo, $quantityFrom);
		$quantityTo = $conversion['value'];

    }
    $option = array(
            'USD' => 'US Dollar',
            'EUR' => 'Euro',
            'AUD' => 'Australian Dollar',
            'BTC' => 'Bitcoin',
            'THB' => 'Thai Baht'

    );
    $data['textCurrencyFrom'] =$quantityFrom .' '.  $option[$currencyFrom] . " equals"; 
     $data['textCurrencyTo'] = $quantityTo . ' ' . $option[$currencyTo]; 
    $data['famaryCurrency'] =$option; 
    // print_r( $data['famaryCurrency']);
    $data['quantityFrom']=$quantityFrom;
    $data['currencyFrom']= $currencyFrom;
    $data['quantityTo']= $quantityTo;
    $data['currencyTo']= $currencyTo;
  	return $this->render('home.html.twig',$data);
    }
    
}