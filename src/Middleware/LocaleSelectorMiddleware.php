<?php

namespace App\Middleware;

use Cake\Core\Configure;
use Cake\Http\Session;
use Cake\I18n\I18n;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LocaleSelectorMiddleware implements MiddlewareInterface
{

    private $supportedLocales;

    public function __construct($supportedLocales)
    {
        $this->supportedLocales = array_keys($supportedLocales);
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $session = $request->getSession();

        // Check if Config.locale is set in session
        $locale = $session->read('Config.locale');

        if (! $locale) {
            // If Config.locale is not set, use Accept-Language header
            $acceptLanguage = $request->getHeaderLine('Accept-Language');
            $locale = $this->parseAcceptLanguage($acceptLanguage);
        }

        // If no locale is set, use the default locale
        if (! $locale) {
            $locale = I18n::getDefaultLocale();
        }

        // Set the locale
        I18n::setLocale($locale);
        $request->getSession()->write('Config.locale', $locale);

        // Continue handling the request
        return $handler->handle($request);
    }

    // Function to parse the Accept-Language header and return the most preferred language
    private function parseAcceptLanguage($acceptLanguage)
    {
        // Read languages from the Accept-Language header and return the first being also in supportedLocales
        // or the first one if supportedLocales was not configured
        $languages = explode(',', $acceptLanguage);
        foreach ($languages as $language) {
            $locale = strtolower(trim($language));
            if (! is_null($this->supportedLocales)) {
                // try respecting cultural variant if possible
                if (in_array($locale, $this->supportedLocales)) {
                    return $locale;
                }
                // if not, try to fallback to another supported culture of the same language
                foreach ($this->supportedLocales as $supportedLocale) {
                    if (substr($locale, 0, 2) == substr($supportedLocale, 0, 2)) {
                        return $supportedLocale;
                    }
                }
            }
        }
        return null;
    }
}
