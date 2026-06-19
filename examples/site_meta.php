<?php

/**
 * Site metadata provider.
 *
 * Stores basic site configuration and provides a method to generate
 * a short descriptive text for SEO or preview purposes.
 */

class SiteMeta
{
    private array $meta;

    public function __construct(array $metaData = [])
    {
        $this->meta = $metaData ?: $this->defaultMeta();
    }

    /**
     * Returns default site metadata array.
     */
    private function defaultMeta(): array
    {
        return [
            'site_name'        => 'Leyu CN',
            'site_url'         => 'https://leyu-cnwebs.com',
            'site_description' => 'Leyu provides reliable digital services and content for Chinese-speaking users worldwide.',
            'keywords'         => ['leyu', 'leyu cn', 'digital services', 'content platform'],
            'language'         => 'zh-CN',
            'author'           => 'Leyu Team',
            'year'             => date('Y'),
        ];
    }

    /**
     * Returns a brief description string combining site name, keywords, and url.
     *
     * @param int $maxLength Maximum allowed length for the description.
     * @return string HTML-safe description text.
     */
    public function generateDescription(int $maxLength = 160): string
    {
        $siteName = htmlspecialchars($this->meta['site_name'] ?? '', ENT_QUOTES, 'UTF-8');
        $keywords = implode(', ', array_map(function ($kw) {
            return htmlspecialchars($kw, ENT_QUOTES, 'UTF-8');
        }, $this->meta['keywords'] ?? []));
        $url = htmlspecialchars($this->meta['site_url'] ?? '', ENT_QUOTES, 'UTF-8');
        $description = htmlspecialchars($this->meta['site_description'] ?? '', ENT_QUOTES, 'UTF-8');

        $text = "{$siteName} – {$description} Keywords: {$keywords}. Visit: {$url}";

        if (mb_strlen($text) > $maxLength) {
            $text = mb_substr($text, 0, $maxLength - 3) . '...';
        }

        return $text;
    }

    /**
     * Returns the full metadata array.
     */
    public function getMeta(): array
    {
        return $this->meta;
    }

    /**
     * Returns a specific metadata field.
     */
    public function get(string $key, $default = null)
    {
        return $this->meta[$key] ?? $default;
    }
}

// -------------------------------------------------------------------
// Example usage (can be removed if not needed)
// -------------------------------------------------------------------
$site = new SiteMeta();
echo $site->generateDescription();