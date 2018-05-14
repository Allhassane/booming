<li class="col-sm-3 col-xs-12">
    <div class="feature-image">
        <a href="{{ route('annonce.detail', $item->slug) }}">
            <img src="/assets/img/annonces/{{ $item->vignette }}" alt="{{ $item->name }}" title="{{ $item->name }}">
            <div class="price">{{ $item->categorie->libelle }}</div>
        </a>
    </div>
    <div class="feature">
        <div class="feat-bg">
            <h3><a href="{{ route('annonce.detail', $item->slug) }}">{{ substr($item->name, 0,22) }} @if(strlen($item->name) > 22) ... @endif</a></h3>
            <p>
                {{ $item->vues }} vues |

                @if($item->note == 0)
                    @include('template.pages.annonces.note.0')
                @elseif($item->note == 1)
                    @include('template.pages.annonces.note.1')
                @elseif($item->note == 2)
                    @include('template.pages.annonces.note.2')
                @elseif($item->note == 3)
                    @include('template.pages.annonces.note.3')
                @elseif($item->note == 4)
                    @include('template.pages.annonces.note.4')
                @else
                    @include('template.pages.annonces.note.5')
                @endif
            </p>
        </div>
        <div class="feature-detail">
            <ul class="featureList">
                <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{ substr($item->city, 0, 10) }} @if(strlen($item->city) > 10) ... @endif</li>
                <li>
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                    @if(date('d', strtotime($item->created_at)) == date('d'))
                        Aujourd'hui
                    @elseif(date('d', strtotime($item->created_at))+1 == date('d'))
                        Hier
                    @else
                        {{ date('d', strtotime($item->created_at)).' / '.date('m', strtotime($item->created_at)) }}
                    @endif
                </li>
            </ul>
        </div>
    </div>
</li>