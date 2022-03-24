<?php

namespace App\NYTimesApi\Response\node;

class Article
{
    public function __construct(
        private array $data
    ) {}

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->data['headline']['main'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getPublicationDate(): ?string
    {
        return $this->data['pub_date'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getLeadParagraph(): ?string
    {
        return $this->data['lead_paragraph'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        if(!empty($this->data['multimedia'])) {
            foreach ($this->data['multimedia'] as $item) {
                if(!empty($item['url']) && str_contains($item['url'], 'superJumbo')){
                    return $item['url'];
                }
            }
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getWebUrl(): ?string
    {
        return $this->data['web_url'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getSection(): ?string
    {
        return $this->data['section_name'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getSubsection(): ?string
    {
        return $this->data['subsection_name'] ?? null;
    }
}