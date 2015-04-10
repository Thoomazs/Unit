
<?php
    $p = $paginator;
    $current = $p->currentPage();
    $last = $p->lastPage();
    $total = $p->total();
    $p->appends($_GET);
    
?>

@if ($last > 0)

    @if( isset($type) && $type == "simple")
      <div class="pager simple">
          <div class="item-count">
              {{ $p->firstItem() }}–{{ $p->lastItem() }} <span class="muted font-weight-light">/</span> {{ $total }}
          </div>
          <ul class="pagination">
              <li class="{{ ($current == 1) ? ' disabled' : '' }}">
                 <a @if($current !== 1) href="{{ $p->url($current-1) }}" @endif><i class="fa fa-angle-left"></i></a>
             </li>
              <li class="{{ ($current == $last) ? ' disabled' : '' }}">
              <a @if(($current !== $last)) href="{{ $p->url($current+1) }}" @endif>
              <i class="fa fa-angle-right"></i>
              </a>
          </li>
          </ul>
      </div>
    @else
        <div class="pager">
            <ul class="pagination">

                <li class="{{ ($current == 1) ? ' disabled' : '' }}">
                    <a
                    @if($current !== 1) href="{{ $p->url(1) }}" @endif><i class="fa fa-angle-double-left"></i></a>
                </li>

                <li class="{{ ($current == 1) ? ' disabled' : '' }}">
                    <a
                    @if($current !== 1) href="{{ $p->url($current-1) }}" @endif><i class="fa fa-angle-left"></i></a>
                </li>


                @for ($i = ( (($current - 5) < 1) ? 1 : ($current - 5) ); $i <= (  (($current + 5) > $last) ? $last : ($current + 5)); $i++)
                    <li class="{{ ($current == $i) ? ' active' : '' }}">
                        <a href="{{ $p->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                <li class="{{ ($current == $last) ? ' disabled' : '' }}">
                    <a
                    @if(($current !== $last)) href="{{ $p->url($current+1) }}" @endif>
                    <i class="fa fa-angle-right"></i>
                    </a>
                </li>

                <li class="{{ ($current == $last) ? ' disabled' : '' }}">
                    <a
                    @if(($current !== $last)) href="{{ $p->url($last) }}" @endif>
                    <i class="fa fa-angle-double-right"></i>
                    </a>
                </li>
            </ul>
        </div>
    @endif
@endif

