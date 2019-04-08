<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderHistory;
use App\OrderProduct;
use App\TableLink;
use App\TableLinkSub;
use App\User;
// use App\OrderTotal;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $link_id = $request->input("link_id", 2);

        $cart = $this->getCart($link_id);

        return response()->json(compact("cart"), 200);
    }
    /**
     * function - handle submit shoppingCartList from client side
     *
     * @param Request $request
     * @return Response $cart
     */
    public function store(Request $request)
    {
        $cart = $request->input('cart');

        // transform and calculate data
        $dt = new \DateTime("now", new \DateTimeZone("Australia/Sydney"));
        $today = $dt->format('y-m-d H:i:s');
        $total = $this->calculateTotal($cart);

        $api_token = $request->bearerToken();
        $user = User::where('api_token', $api_token)->first();
        if ($user === null) {
            return response()->json(["errMessage" => "unAuthoriaze User"], 400);
        }

        //* create record in oc_order
        $order = Order::create(["total" => $total, "date_added" => $today, "date_modified" => $today, "user_id" => $user->user_id]);
        $order_id = $order->order_id;

        //* create record in oc_order_history
        $orderHistory = OrderHistory::create(["order_id" => $order_id, "date_added" => $today]);

        //* create record in oc_order_total
        //Todo
        //* create record in oc_order_product
        $this->createOrderProductHelper($cart, $order_id);

        //* create record in oc_table_linsub
        TableLinkSub::create(["link_id" => $request->input("link_id"), "order_id" => $order_id, "sub_add_time" => $today]);
        //* create response
        $cart = $this->getCart($request->input("link_id"));

        return response()->json(compact("cart"), 200);
    }

    public function getCart($link_id)
    {
        //* find all linksubs
        $tableLink = TableLink::find($link_id);
        $tableLinksubs = $tableLink->linksubs()->get();
        //* find all order_products
        $cart = collect([]);
        foreach ($tableLinksubs as $linksub) {
            $products = $linksub->orderProducts()->get();
            $cart = $cart->merge($products);
        }
        //* return list of order products
        return $cart;
    }

    public function createOrderProductHelper($cart, $order_id)
    {
        foreach ($cart as $orderItem) {
            $orderItem = json_decode(json_encode($orderItem));

            $new_order_product = OrderProduct::create([
                "order_id" => $order_id,
                "product_id" => $orderItem->product_id,
                "quantity" => $orderItem->quantity,
                "name" => $orderItem->name,
                "price" => $orderItem->price,
                "total" => $orderItem->quantity * (float) $orderItem->price,
            ]);

        }
    }
    public function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $orderItem) {
            $orderItem = json_decode(json_encode($orderItem));
            $total += $orderItem->quantity * (float) $orderItem->price;
        }
        return $total;
    }
}

//example of orderItem in cart
// completed: false
// image: "http://localhost:8000/images/products/19.jpg"
// name: "大羊腰"
// price: "5.80"
// product_id: 19
// quantity: 2
// sku: ""
