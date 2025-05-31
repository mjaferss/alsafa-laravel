<?php

namespace App\Traits;

trait Localizable
{
    /**
     * Get a localized attribute based on current locale
     *
     * @param string $attribute The base attribute name
     * @return string|null
     */
    public function getLocalizedAttribute(string $attribute)
    {
        $locale = app()->getLocale();
        $attributeName = "{$attribute}_{$locale}";
        
        return $this->$attributeName;
    }

    /**
     * Set a localized attribute
     *
     * @param string $attribute The base attribute name
     * @param string $value The value to set
     * @param string|null $locale The locale to set (defaults to current locale)
     * @return void
     */
    public function setLocalizedAttribute(string $attribute, string $value, ?string $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $attributeName = "{$attribute}_{$locale}";
        
        $this->$attributeName = $value;
    }
}
