<?php
namespace Certify\Certify\core;

require_once $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";
session_start();

// use flourist\shop\models\Orders;
// use flourist\shop\models\Users;
// use flourist\shop\models\Cart;


class Api{

    function __construct(){
        if(!isset($_SESSION['email']))
            $this->sendResponse(401, '401 Unauthorized');
        $this->user  = new Users();
        $this->order = new Orders();
        $this->cart = new Cart();
        $this->user_id = $this->user->getUser($_SESSION['email'])['id'];
        $func = key($_REQUEST);
        if(method_exists($this, $func)){
            $this->$func();
        }else{
            $this->sendResponse(405, 'method not found');
        }
    }

    private function add_order(){
        // $user_id, $product_id, $quantity, $wrapping_color_id_1, $wrapping_color_id_2,
        // $chocolate_id, $toys_id, $balloon_id, $message_card_id, $card_message,
        // $flower_color_id, $product_type_id, $total_price, $shipping_address, $order_status,
        // $payment_method, $shipping_method

        $req_field = [
            'pid',
            'qty',
            'wc1',
            'wc2',
            'ci',
            'ti',
            'bi',
            'mci',
            'cm',
            'fci',
            'pti',
            'tp',
            'os',
            'pm',
            'sm'
        ];
        if($this->checkReqField($req_field)){
            $res = $this->order->create(
                                    $this->user_id, 
                                    $_REQUEST['pid'], 
                                    $_REQUEST['qty'],
                                    $_REQUEST['wc1'],
                                    $_REQUEST['wc2'],
                                    $_REQUEST['ci'],
                                    $_REQUEST['ti'],
                                    $_REQUEST['bi'],
                                    $_REQUEST['mci'],
                                    $_REQUEST['cm'],
                                    $_REQUEST['fci'],
                                    $_REQUEST['pti'],
                                    $_REQUEST['tp'],
                                    $_REQUEST['sa'],
                                    $_REQUEST['os'],
                                    $_REQUEST['pm'],
                                    $_REQUEST['sm']
                                );
            
            $res['result'] ? $this->sendResponse(200, "success") : $this->sendResponse(500, "failed".$res['message']);
                
        }else
            $this->sendResponse(400, 'bad request');
    }

    private function add_cart(){
        // $product_id, $user_id, $total_price, $wrapping_color_id_1, $wrapping_color_id_2,
        // $chocolate_id, $toys_id, $balloon_id, $message_card_id, $card_message,
        // $flower_color_id, $product_type_id, $quantity = 1
        $req_field = [
            'pid',
            'tp',
            'wc1',
            'wc2',
            'ci',
            'ti',
            'bi',
            'mci',
            'cm',
            'fci',
            'pti',
            'qty'
        ];
        if($this->checkReqField($req_field)){
            $res = $this->cart->create(
                                $_REQUEST['pid'],
                                $this->user_id,
                                $_REQUEST['tp'],
                                $_REQUEST['wc1'],
                                $_REQUEST['wc2'],
                                $_REQUEST['ci'],
                                $_REQUEST['ti'],
                                $_REQUEST['bi'],
                                $_REQUEST['mci'],
                                $_REQUEST['cm'],
                                $_REQUEST['fci'],
                                $_REQUEST['pti'],
                                $_REQUEST['qty']
                            );
            $res['result'] ? $this->sendResponse(200, "success") : $this->sendResponse(500, "failed".$res['message']);
        }else 
            $this->sendResponse(400, 'bad request');
    }

    private function del_cart(){
        if(isset($_REQUEST['product_id'])){
           $res = $this->cart->remove_overridden($_REQUEST['product_id'], $this->user_id);
           $res['result'] ? $this->sendResponse(200, "success") : $this->sendResponse(500, "failed");
        }else 
            $this->sendResponse(400, 'bad request');
    }

    private function del_order(){
        // $order_id, $user_id
        if(isset($_REQUEST['order_id'])){
            $res = $this->order->remove($_REQUEST['order_id'], $this->user_id);
            $res['result'] ? $this->sendResponse(200, "success") : $this->sendResponse(500, "failed".$res['message']);
        }else
            $this->sendResponse(400, 'bad request'); 
    }

    private function Cart_to_order(){
         // $user_id, $product_id, $quantity, $wrapping_color_id_1, $wrapping_color_id_2,
        // $chocolate_id, $toys_id, $balloon_id, $message_card_id, $card_message,
        // $flower_color_id, $product_type_id, $total_price, $shipping_address, $order_status,
        // $payment_method, $shipping_method
        $req_field = [
            'sa',
            'qty',
            'pm',
            'sm',
            'tp'
        ];
        $result = true;
        if($this->checkReqField($req_field)){
            $tmp = 0;
            $totalprice = explode(',', $_REQUEST['tp']);
            // die(var_dump($totalprice));
            $qty = explode(',',$_REQUEST['qty']);
            $cart_items = $this->cart->getAllForUser($this->user_id);
            foreach($cart_items as $i){
                $res = $this->order->create(
                                $this->user_id,
                                $i['product_id'],
                                $qty[$tmp],
                                $i['wrapping_color_id_1'],
                                $i['wrapping_color_id_2'],
                                $i['chocolate_id'],
                                $i['toys_id'],
                                $i['balloon_id'],
                                $i['message_card_id'],
                                $i['card_message'],
                                $i['flower_color_id'],
                                $i['product_type_id'],
                                $totalprice[$tmp],
                                $_REQUEST['sa'],
                                'pending',
                                $_REQUEST['pm'],
                                $_REQUEST['sm']
                            );
                
                $result = $res['result'] ? true : false;
                $tmp++;

                if($result){
                    $this->cart->remove_overridden($i['product_id'], $this->user_id);
                }
            }

            $result ? $this->sendResponse(200, "success") : $this->sendResponse(500, "failed".$res['message']);
        }else
            $this->sendResponse(400, 'bad request'); 
        
    }

    private function add_rating(){
        // $user_id, $product_id, $rating
        if(isset($_REQUEST['pid']) and isset($_REQUEST['r']) and isset($_REQUEST['cmt'])){
            $func = (new ProductRating)->getUserRatingForProduct($this->user_id, $_REQUEST['pid']) ? 'update' : 'create';
            $res = (new ProductRating)->$func($this->user_id, $_REQUEST['pid'], $_REQUEST['r'], $_REQUEST['cmt']);
            $res['result'] ? $this->sendResponse(200, "success") : $this->sendResponse(500, "failed".$res['message']);
        }else
            $this->sendResponse(400, 'bad request'); 
    }

    private function  checkReqField($req_field){ 
        foreach($req_field as $field){
            if(!isset($_REQUEST[$field])){
                return false;
            }
        }

        return true;
    }

    public function sendResponse($code, $msg){
        header('Content-type: application/json');
        echo json_encode(["code"=>$code, "msg"=>$msg]);
        exit();
    }

}

$obj = new Api();

?>