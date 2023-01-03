<?php

namespace SergeyBruhin\HtmlSitemap\Dto;

use Illuminate\Support\Collection;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class HtmlSitemapCategory
{
    public Collection $links;

    public string $name;
    public ?string $url = null;

    #[Pure] public function __construct(string $categoryName, string $url = null)
    {
        $this->name = $categoryName;
        $this->url = $url;
        $this->links = new Collection();
    }


    public function addLink(string $name, string $url): HtmlSitemapCategory
    {
        $this->links->add((new HtmlSitemapLink($name, $url)));
        return $this;
    }

    public function links(): Collection
    {
        return $this->links;
    }

    #[ArrayShape(['name' => "string", 'url' => "string", 'links' => "array"])]
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'url' => $this->url,
            'links' => $this->links->map(function (HtmlSitemapLink $link) {
                return $link->toArray();
            })->toArray(),
        ];
    }
}
