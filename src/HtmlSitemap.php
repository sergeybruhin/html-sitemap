<?php

namespace SergeyBruhin\HtmlSitemap;


use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;
use SergeyBruhin\HtmlSitemap\Dto\HtmlSitemapCategory;

class HtmlSitemap
{
    /**
     * @var Collection<HtmlSitemapCategory>
     */
    private Collection $categories;

    #[Pure] public function __construct()
    {
        $this->categories = new Collection();
    }

    public function addCategory(HtmlSitemapCategory $categoryDto): HtmlSitemap
    {
        $this->categories->add($categoryDto);
        return $this;
    }

    public function categories(): Collection
    {
        return $this->categories;
    }

    public function toArray(): array
    {
        return $this->categories->map(function (HtmlSitemapCategory $category) {
            return $category->toArray();
        })->toArray();
    }


}
