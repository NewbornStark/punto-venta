<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket</title>
    <style>
        body {
            font-size: 12px;
        }
        .center {
            text-align: center;
        }
        .left {
            text-align: left;
        }
        .right {
            text-align: right;
        }
        .pr {
            padding-right: 10px;
        }
        .mt {
            margin-top: 10px;
        }
        .mt-2 {
            margin-top: 20px;
        }
        .mt-3 {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <p class="center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate earum, obcaecati quo facilis quos tempore ut ex, consectetur, reprehenderit maxime dolore similique deserunt? Unde, ducimus assumenda iure magnam vitae aut.</p>
    <table class="mt-2">
        <tr>
            <td class="center">Sku</td>
            <td class="center">Articulo</td>
            <td class="center">Cantidad</td>
            <td class="center">Precio</td>
        </tr>
        @php
            $subtotal = 0;
        @endphp
        @foreach ($articles as $article)
        <tr>
            <td class="center pr">{{$article->sku}}</td>
            <td class="left">{{$article->name}}</td>
            <td class="center">{{$article->amount}}</td>
            <td class="right">${{number_format($article->price * $article->amount, 2, '.', ',')}}</td>
        </tr>
        @php
            $subtotal += $article->price * $article->amount;
        @endphp
        @endforeach
        <tr>
            <td colspan="4" class="right">
                Subtotal: $@php echo number_format($subtotal,2,'.',',') @endphp
            </td>
        </tr>
        <tr>
            <td colspan="4" class="right">
                Descuento: ${{number_format($sale->discount,2,'.',',')}}
            </td>
        </tr>
        <tr>
            <td colspan="4" class="right">
                Total: $@php echo number_format($subtotal-$sale->discount,2,'.',',') @endphp
            </td>
        </tr>
        <tr>
            <td colspan="4" class="right">
                Forma de pago: {{$sale->payment_method}}
            </td>
        </tr>
    </table>
    <p class="center mt-3">Ducimus laboriosam atque dolorum dolore recusandae commodi possimus reiciendis soluta praesentium</p>
    <p class="center mt">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempore molestiae dignissimos, fugit debitis aliquam tempora iste voluptates atque eaque ullam unde quasi facilis.</p>
</body>
</html>