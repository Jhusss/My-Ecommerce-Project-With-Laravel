<!DOCTYPE html>
<html lang="en">
<body>
  <table width='700px'>
    <tr><td>&nbsp;</td></tr>
    <tr><td><img height="150px" width="150px" src="{{ asset('images/frontend_images/logo.png') }}" alt=""></td></tr>
    <tr><td>&nbsp;</td></tr>

    <tr><td>Hello {{ $name }}, </td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Thank you for shopping with us. Your order details are as below: </td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Order No: {{ $order_id }}</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
      <td>
        <table width="80%" cellpadding="5" cellspacing="5" bgcolor="#f7f4f4">
          <tr bgcolor="#cccccc">
            <td>Product Name</td>
            <td>Size</td>
            <td>Quantity</td>
            <td>Price</td>
          </tr>

          @foreach($productDetails['orders'] as $product)
            <tr>
              <td>{{ $product['product_name'] }}</td>
              <td>{{ $product['product_size'] }}</td>
              <td>{{ $product['product_quantity'] }}</td>
              <td>{{ $product['product_price'] }}</td>
            </tr>
          @endforeach
          <tr>
            <td colspan="3" align="right">Shipping Charges</td><td>PHP{{ $productDetails['shipping_charges'] }}</td>
          </tr>
          <tr>
            <td colspan="3" align="right">Grand Total</td><td>PHP{{ $productDetails['grand_total'] }}</td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td>
        <table width="100%">
          <tr>
            <td width="50%">
              <table>
                <tr>
                  <tr>
                      <td><strong>Bill To: </strong></td>
                  </tr>            
                  <tr>
                    <td>{{ $userDetails['name'] }}</td>
                  </tr>
                  <tr>
                    <td>{{ $userDetails['address'] }}</td>
                  </tr>
                  <tr>
                    <td>{{ $userDetails['city'] }}</td>
                  </tr>
                  <tr>
                    <td>{{ $userDetails['country'] }}</td>
                  </tr>
                  <tr>
                    <td>{{ $userDetails['pincode'] }}</td>
                  </tr>
                  <tr>
                    <td>{{ $userDetails['mobile'] }}</td>
                  </tr>
                </tr>
              </table>
            </td>
            <td width="50%">
                <table>
                    <tr>
                      <tr>
                          <td><strong>Ship To:</strong></td>
                      </tr>            
                      <tr>
                        <td>{{ $productDetails['name'] }}</td>
                      </tr>
                      <tr>
                        <td>{{ $productDetails['address'] }}</td>
                      </tr>
                      <tr>
                        <td>{{ $productDetails['city'] }}</td>
                      </tr>
                      <tr>
                        <td>{{ $productDetails['country'] }}</td>
                      </tr>
                      <tr>
                        <td>{{ $productDetails['pincode'] }}</td>
                      </tr>
                      <tr>
                        <td>{{ $productDetails['mobile'] }}</td>
                      </tr>
                    </tr>
                  </table> 
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>For inquiries, you can contact us at <a href="mailto:info@ailoveyu-apparel.com">info@ailoveyu-apparel.com</a></td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Best Regards, <br> Ailoveyu Apparel</td></tr>
    <tr><td>&nbsp;</td></tr>
  </table>
  
</body>
</html>