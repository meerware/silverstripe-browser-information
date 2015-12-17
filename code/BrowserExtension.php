<?php
/**
 * Extension which exposes the {@link Browser} as methods
 * for a {@link Page_Controller}.
 *
 */
class BrowserExtension extends Extension
{

    /**
     * @return Browser is the browser object.
     */
    public function getBrowser()
    {
        return Browser::current_browser();
    }

    /**
     * Template method for getting the {@link $_SERVER} supplied browser.
     * @return Browser
     */
    public function Browser()
    {
        return $this->getBrowser();
    }
}
