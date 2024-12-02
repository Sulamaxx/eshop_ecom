<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CartService
{
  public function addToSessionCart($productId, $quantity = 1)
  {
    $cart = Session::get('cart', []);
    if (isset($cart[$productId])) {
      $cart[$productId]['quantity'] += $quantity;
    } else {
      $cart[$productId] = [
        'product_id' => $productId,
        'quantity' => $quantity

      ];
    }
    Session::put('cart', $cart);
  }

  public function updateSessionCart($productId, $quantity)
  {
    $cart = Session::get('cart', []);
    if (isset($cart[$productId])) {
      $cart[$productId]['quantity'] = $quantity;
      Session::put('cart', $cart);
    }
  }

  public function removeFromSessionCart($productId)
  {
    $cart = Session::get('cart', []);
    unset($cart[$productId]);
    Session::put('cart', $cart);
  }

  public function getSessionCart()
  {
    return Session::get('cart', []);
  }
}
