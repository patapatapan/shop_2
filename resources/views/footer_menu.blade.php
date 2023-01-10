@foreach ($items as $item)
<div class="col-xl-2 col-lg-3 col-md-3 col-sm-5">
  <div class="single-footer-caption mb-50">
    <div class="footer-tittle">
      <h4>{{ $item->title }}</h4>
        <ul>
          @foreach ($item->children as $subitem)
            <li><a href="{{ $subitem->link() }}">{{ $subitem->title }}</a></li>
          @endforeach
        </ul>
    </div>
  </div>
</div>
@endforeach

