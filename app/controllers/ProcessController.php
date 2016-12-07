<?php

class ProcessController extends \BaseController {

    public function index() {
        
    }

    public function payment() {
        Conekta::setApiKey("key_yVL2GZrKn87qN2rE");
        try {
            $charge = Conekta_Charge::create(array(
            "amount" => 5000,
            "currency" => "MXN",
            "description" => "CPMX5 Payment",
            "reference_id"=> "orden_de_id_interno",
            "card" => $_POST['conektaTokenId'] //"tok_a4Ff0dD2xYZZq82d9"
            'details'=> array(
                'name'=> 'Arnulfo Quimare',
                'phone'=> '403-342-0642',
                'email'=> 'logan@x-men.org',
                'line_items'=> array(
                  array(
                    'name'=> 'Box of Cohiba S1s',
                    'description'=> 'Imported From Mex.',
                    'unit_price'=> 20000,
                    'quantity'=> 1,
                    'sku'=> 'cohb_s1',
                    'type'=> 'food'
                  )
                ),
                'shipment'=> array(
                  'carrier'=> 'estafeta',
                  'service'=> 'international',
                  'price'=> 20000,
                  'address'=> array(
                    'street1'=> '250 Alexis St',
                    'street2'=> null,
                    'street3'=> null,
                    'city'=> 'Red Deer',
                    'state'=> 'Alberta',
                    'zip'=> 'T4N 0B8',
                    'country'=> 'Canada'
                  )
                )
              )
            ));
        } catch (Conekta_Error $e) {
           return View::make('payment',array('message'=>$e->getMessage()));
        }
        
        return View::make('payment',array('message'=>$charge->status));
        
    }

}
