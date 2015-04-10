<div>
    <ul class="cart-title">
        <li @if($step > 0) class="active" @endif>
            <a href="{{ route('cart.show') }}">
                {{ trans('common.Cart') }}
                <i class="fa fa-chevron-right"></i>
            </a>
        </li>
        <li @if($step > 1) class="active" @endif>
            <a href="{{ route('cart.delivery-information') }}">
                {{ trans('common.Delivery information') }} <i class="fa fa-chevron-right"></i>
            </a>
        </li>
        <li @if($step > 2) class="active" @endif>
            <a href="{{ route('cart.shipping-and-payment') }}">
                {{ trans('common.Shipping and payment') }} <i class="fa fa-chevron-right"></i>
            </a>
        </li>
        <li @if($step > 3) class="active" @endif>
            <a href="{{ route('cart.summary') }}">
                {{ trans('common.Summary') }}
            </a>
        </li>
    </ul>
    <hr/>
</div>