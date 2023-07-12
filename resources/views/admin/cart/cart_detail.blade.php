@extends('layout.admin')

@section('title')
    <title>Chi tiết đơn hàng</title>
@endsection

@section('css')
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            height: 100%;
        }

        h1, h2 {
            text-align: center;
        }

        .order-details {
            display: flex;
            justify-content: space-between;
        }

        .order-info, .customer-info {
            flex-basis: 48%;
            border: 1px solid #ccc;
            padding: 20px;
        }

        .order-info h2, .customer-info h2 {
            margin-top: 0;
        }

        .product-list {
            margin-top: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color: #f0f0f0;
        }

    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h1>Chi tiết đơn hàng</h1>
            <div class="order-details">
                <div class="order-info">
                    <h2>Thông tin đơn hàng</h2>
                    <p><strong>Ngày đặt hàng:</strong> {{ $carts->created_at }}</p>
                    <p><strong>Tổng tiền:</strong> {{ number_format($carts->total) }}</p>
                </div>
                <div class="customer-info">
                    <h2>Thông tin khách hàng</h2>
                    <p><strong>Tên khách hàng:</strong> {{$carts->name}}</p>
                    <p><strong>Phone:</strong> {{'0'. $carts->number_phone}}</p>
                    <p><strong>Địa chỉ:</strong>{{$carts->address}}</p>
                </div>
            </div>
            <div class="product-list">
                <h2>Danh sách sản phẩm</h2>
                <table>
                    <?php
                        $index = 0;
                    ?>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Hình ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($carts->getCartItem as $cartItem)
                        <tr>
                            <th>{{++$index}}</th>
                            <td style="display: flex; align-items: center;">
                                <img style=" width: 80px;" src="{{$cartItem->image_product}}"
                                     alt="">
                            </td>
                            <td>{{$cartItem->name}}</td>
                            <td>{{$cartItem->quantity}}</td>
                            <td>{{number_format($cartItem->price)}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

