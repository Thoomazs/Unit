
<div class="col-sm-3">
    <div class="product-box">
        <a href="{{ route('products.detail', [$product->slug]) }}">
            <div class="product-img">
                <img src="{{ $product->photo }}" class="img-responsive" alt=""/>
            </div>

            <div class="clearfix">
                <h4 class="product-name">{{ $product->name }}</h4>
                <span class="product-price">{{ $product->price . ' ' . trans('common.CURRENCY')}}</span>
            </div>

        </a>
    </div>
</div>