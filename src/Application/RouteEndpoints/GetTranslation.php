<?php
namespace Application\RouteEndpoints;

use Application\Entities\RouteInterface;

/**
 * GetTranslation represent text translations
 */
class GetTranslation implements RouteInterface
{    
    /**
     * requestData
     *
     * @var mixed
     */
    private $requestData;
    
    /**
     * acceptedLanguages
     *
     * @var array
     */
    private $acceptedLanguages = [
        'en', 
        'hu'
    ];
    
    /**
     * __construct
     *
     * @param  mixed $request
     * @return void
     */
    public function __construct($request)
	{
        $this->requestData = json_decode($request->getBody()->getContents());
    }
        
    /**
     * response - returns the content data
     *
     * @return string
     */
    public function response()
    {
        if (!in_array($this->requestData->language,$this->acceptedLanguages)) {
            return file_get_contents(__DIR__.'/../../../public/files/en/translation.json');
        }

        set_error_handler(
            function ($severity, $message, $file, $line) {
                throw new \ErrorException($message, $severity, $severity, $file, $line);
            }
        );        

        try {
            $respond = file_get_contents(__DIR__.'/../../../public/files/'.$this->requestData->language.'/translation.json');
        } catch (\Exception $e) {
            $error = $e->getMessage();
            restore_error_handler();
            return json_encode(['error' => $error]);
        }
        
        return $respond;

    }
}