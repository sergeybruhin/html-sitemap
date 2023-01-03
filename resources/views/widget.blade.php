<h1>Loaded</h1>
<link rel="stylesheet" href="{{ asset('vendor/html-sitemap/css/html-sitemap.css') }}">
@php /** @var SergeyBruhin\HtmlSitemap\HtmlSitemap $htmlSitemap */ @endphp
@if(isset($htmlSitemap) && $htmlSitemap->categories()->count())
    @forelse($htmlSitemap->categories() as $category)
        <div class="w-sitemapWidget__section">
            @if($category->url)
                <a href="{{ $category->url }}" title="{{ $category->name }}"><h2
                        class="w-sitemapWidget__head">{{ $category->name }}</h2></a>
            @else
                <h2 class="w-sitemapWidget__head"><span>{{ $category->name }}</span></h2>
            @endif
            @if($category->links()->count())
                <ul class="w-sitemapWidget__sublist">
                    @forelse($category->links() as $link)
                        <li><a href="{{ $link->url }}" class="" title="{{ $link->name }}">{{ $link->name }}</a></li>
                    @empty
                    @endforelse
                </ul>
            @endif
        </div>
    @empty
    @endforelse
@endif

