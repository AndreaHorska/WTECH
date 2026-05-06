<section class="cart-main">

    <ul class="cart-list">
        <h2 id="summary-heading" class="order-summary-title">Order summary</h2>

        @foreach ($cartItems as $item)
            @php
                $product = data_get($item, 'product');
                $productId = data_get($item, 'product_id', data_get($product, 'id'));
                $name = data_get($item, 'name', data_get($product, 'name', 'Product'));
                $price = (float) data_get($item, 'price', data_get($product, 'price', 0));
                $quantity = (int) data_get($item, 'quantity', 1);
                $lineTotal = $price * $quantity;
                $image = $product->images->first();
            @endphp

            <li class="summary-item">
                <a href="{{ route('product.show', $productId) }}">
                    <img src="{{  $image ? asset($image->image_path) : asset('image/duck.png')  }}" alt="{{ $name }}" class="cart-item-image">
                </a>

                <div class="summary-item-details">
                    <a href="{{ $productId ? route('product.show', $productId) : '#' }}" class="summary-item-title">
                        {{ $name }}
                    </a>
                    <span class="summary-product-quantity">{{ $quantity }}×</span>
                </div>

                <p class="summary-item-price">{{ number_format($lineTotal, 2, ',', ' ') }} €</p>


            </li>
        @endforeach

    </ul>

    <hr class="summary-divider">

    <dl class="summary-prices">
        <dt>Subtotal</dt>
        <dd id="subtotalPrice">{{ number_format($subtotal, 2, ',', ' ') }} €</dd>

        <dt>Delivery</dt>
        <dd id="deliveryPrice">{{ number_format($shippingFee, 2, ',', ' ') }} €</dd>

        <dt>Payment</dt>
        <dd id="paymentPrice">{{ number_format($paymentFee, 2, ',', ' ') }} €</dd>
    </dl>

    <hr class="summary-divider">

    <dl class="summary-totals">
        <dt>Total</dt>
        <dd id="totalPrice">{{ number_format($total, 2, ',', ' ') }} €</dd>
    </dl>

</section>
