<?php

namespace App\Service;

class RssService
{
    public function fetch(string $url): array
    {
        $xml = simplexml_load_file($url);

        $items = [];

        foreach ($xml->channel->item as $item) {
            $items[] = [
                'titre'       => (string) $item->title,
                'description' => strip_tags((string) $item->description),
                'lien'        => (string) $item->link,
                'date'        => (string) $item->pubDate,
            ];
        }

        return $items;
    }
}
