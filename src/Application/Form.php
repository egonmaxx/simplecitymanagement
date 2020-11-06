<?php

namespace Application;
use Application\Services\DetectLanguageService;

/**
 * Form - represent the main html page source
 */
class Form
{
    private $language;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->language = DetectLanguageService::detectLanguage();
    }
    
    /**
     * renderForm - rendering the main page
     *
     * @return string
     */
    public function renderForm()
    {
        //return file_get_contents(__DIR__.'/../../files/'.$this->language.'/form.html');
        return file_get_contents(__DIR__.'/../../public/files/form.html');
    }
}