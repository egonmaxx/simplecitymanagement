<?php

namespace Application\Services;

/**
 * DetectLanguageService - represent the language dtetection on backend
 */
class DetectLanguageService
{    
    /**
     * detectLanguage
     *
     * @return void
     */
    public static function detectLanguage()
    {
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        $acceptLang = ['hu', 'en']; 
        $lang = in_array($lang, $acceptLang) ? $lang : 'en';
        return $lang;
    }
}