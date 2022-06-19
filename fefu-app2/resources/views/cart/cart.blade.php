<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Cart </title>

</head>
<body>
Cart
<table>
    @foreach($cart['items'] as $cartItem)
        <tr>
            <td><a href="{{ route('product', ['slug' => $cartItem['product']['slug']]) }}"> {{$cartItem['product']['name']}} </a> </td>
            <td>
                <div>
                    <div>Количество: {{ $cartItem['quantity'] }}</div>
                    <div>Стоимость: {{ $cartItem['price_item'] }} руб.</div>
                </div>
            </td>
        </tr>
    @endforeach
</table>
<b>Итого: {{ $cart['price_total'] }} руб.</b>
</body>
</html>
