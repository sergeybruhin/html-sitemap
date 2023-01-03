<?php

namespace SergeyBruhin\HtmlSitemap\Dto;

use JetBrains\PhpStorm\ArrayShape;

class HtmlSitemapLink
{
    public string $name;
    public string $url;

    public function __construct(string $name, string $url)
    {
        $this->name = $name;
        $this->url = $url;

    }

    /**
     * @param string $name
     * @return HtmlSitemapLink
     */
    public function setName(string $name): HtmlSitemapLink
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $url
     * @return HtmlSitemapLink
     */
    public function setUrl(string $url): HtmlSitemapLink
    {
        $this->url = $url;
        return $this;
    }

    #[ArrayShape(['name' => "string", 'url' => "string"])]
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'url' => $this->url,
        ];
    }
}
