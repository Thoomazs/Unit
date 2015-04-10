<?php
    // TODO: repair packeges
    if ( ! isset( $data ) ) $data = null;
    $bs = Breadcrumbs::generate( $render, $data );
?>
@if ( isset($bs) )

    <ul class="breadcrumb">
        @foreach ($bs as $b)
            @if (!$b->last)
                <li>
                    <a href="{{ $b->url }}">{{ $b->title }}</a>
                    <span class="divider"> > </span>
                </li>
            @else
                <li class="active">{{ $b->title }}</li>
            @endif
        @endforeach
    </ul>
@endif
