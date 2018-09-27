<?php

namespace Concrete\Core\Page\Sitemap\Event;

use phpDocumentor\Reflection\Types\Parent_;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * @since 8.5.0
 */
class SitemapXmlElementEvent extends GenericEvent
{
    /**
     * @inheritdoc
     */
    public function __construct($subject = null, array $arguments = [])
    {
        parent::__construct($subject, $arguments);

        // This is for backward compatibility
        if (isset($subject['sitemapPage'])) {
            $this->setArgument('element', $subject['sitemapPage']);
        }
    }

    /**
     * Get the current XML element.
     *
     * @see \Concrete\Core\Page\Sitemap\Element\SitemapPage
     *
     * @return \Concrete\Core\Page\Sitemap\Element\SitemapElement
     */
    public function getElement()
    {
        return $this->getArgument('element');
    }

    /**
     * @param \Concrete\Core\Page\Sitemap\Element\SitemapElement $element
     */
    public function setElement($element)
    {
        $this->setArgument('element', $element);
    }
}
