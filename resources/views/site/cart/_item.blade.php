<li class="cart-item">

        <div class="row">
            <div class="cart-item-name col-sm-7">
                <a href="{{ route("products.detail", [ $item->slug ]) }}">
                    <img class="img-responsive img-rounded" src="{{ $item->photo }}" alt="{{ $item->name }}"/>
                    <h4>{{ $item->name }}</h4>
                </a>
            </div>
            <div class="cart-item-quantity col-sm-2 text-right">
                {!! Form::open([ 'route' => 'cart.update', 'method' => 'PATCH', 'autocomplete' => 'off', 'novalidate' ]) !!}

                    {!! Form::hidden('product_id', $item->product_id) !!}

                    <div class="input-group">
                        {!! Form::input('number','quantity', $item->quantity, ['class' => 'form-control','min' => 1, 'step'=> 1, 'max' => $item->quantity+$item->stock, 'autocomplete' => 'off']) !!}

                        <span class="input-group-btn">
                            {!! Form::button('<i class="fa fa-refresh"></i>', ['type' => 'submit', 'class' => 'btn btn-info']) !!}
                        </span>
                    </div>

                {!! Form::close() !!}
            </div>
            <div class="cart-item-price col-sm-2 text-right h4">
                <span class="text-info font-weight-semibold">{{ $item->price }} {{ trans("common.CURRENCY")  }}</span>
            </div>
            <div class="cart-item-remove col-sm-1 text-right h3">
              {!! Form::open([ 'route' => 'cart.delete', 'method' => 'DELETE', 'autocomplete' => 'off', 'novalidate' ]) !!}
                    {!! Form::hidden('product_id', $item->product_id) !!}
                    {!! Form::button('<i class="fa fa-times"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
              {!! Form::close() !!}
            </div>
        </div>
</li>