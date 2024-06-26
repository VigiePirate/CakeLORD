<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.3.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App;

use Cake\Core\Configure;
use Cake\Core\Exception\MissingPluginException;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\ORM\Behavior\TranslateBehavior;
use Cake\ORM\Behavior\Translate\ShadowTableStrategy;

use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Authentication\Middleware\AuthenticationMiddleware;
use Authorization\AuthorizationService;
use Authorization\AuthorizationServiceInterface;
use Authorization\AuthorizationServiceProviderInterface;
use Authorization\Middleware\AuthorizationMiddleware;
use Authorization\Policy\ResolverCollection;
use Authorization\Policy\MapResolver;
use Authorization\Policy\OrmResolver;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

//use Cake\I18n\Middleware\LocaleSelectorMiddleware;
use App\Middleware\LocaleSelectorMiddleware;

/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 */
class Application extends BaseApplication
    implements AuthenticationServiceProviderInterface, AuthorizationServiceProviderInterface
{
    /**
     * Load all the application configuration and bootstrap logic.
     *
     * @return void
     */
    public function bootstrap(): void
    {
        // Call parent to load bootstrap from files.
        parent::bootstrap();

        if (PHP_SAPI === 'cli') {
            $this->bootstrapCli();
        }

        /*
         * Only try to load DebugKit in development mode
         * Debug Kit should not be installed on a production system
         */
        if (Configure::read('debug')) {
            $this->addPlugin('DebugKit');
        }

        // Load more plugins here
        $this->addPlugin('Authentication');
        $this->addPlugin('Authorization');
        $this->addPlugin('Ajax', ['bootstrap' => true]);
        $this->addPlugin('Geo', ['bootstrap' => true]);

        // Setup default strategy for translations
        TranslateBehavior::setDefaultStrategyClass(ShadowTableStrategy::class);

    }

    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            // Catch any exceptions in the lower layers,
            // and make an error page/response
            ->add(new ErrorHandlerMiddleware(Configure::read('Error')))

            // Add Locale selection Middleware
            //->add(new LocaleSelectorMiddleware(['*']))
            ->add(new LocaleSelectorMiddleware(Configure::read('App.supportedLocales')))

            // Handle plugin/theme assets like CakePHP normally does.
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))

            // Add routing middleware.
            // If you have a large number of routes connected, turning on routes
            // caching in production could improve performance. For that when
            // creating the middleware instance specify the cache config name by
            // using it's second constructor argument:
            // `new RoutingMiddleware($this, '_cake_routes_')`
            ->add(new RoutingMiddleware($this))

            // add Authentication after RoutingMiddleware
            //->add(new AuthenticationMiddleware($this->configAuth()));
            ->add(new AuthenticationMiddleware($this))
            ->add(new AuthorizationMiddleware($this));

            // ->add(new AuthorizationMiddleware($this, [
            //     // FOR DEV PHASE ONLY !!!!!
            //     'requireAuthorizationCheck' => false
            // ]))
            // ;

            /*
             * Not necessary as the DebugKit.ignoreAuthorization in bootstrap.php already does this
            if (Configure::read('debug')) {
                // Disable authz for debugkit
                $middlewareQueue->add(function ($req, $res, $next) {
                    if ($req->getParam('plugin') === 'DebugKit') {
                        $req->getAttribute('authorization')->skipAuthorization();
                    }
                    return $next($req, $res);
                });
            }
             */

        return $middlewareQueue;
    }

    /**
     * Bootrapping for CLI application.
     *
     * That is when running commands.
     *
     * @return void
     */
    protected function bootstrapCli(): void
    {
        try {
            $this->addPlugin('Bake');
        } catch (MissingPluginException $e) {
            // Do not halt if the plugin is missing
        }

        $this->addPlugin('Migrations');

        // Load more plugins here
    }

    /**
     * Returns a service provider instance.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request Request
     * @param \Psr\Http\Message\ResponseInterface $response Response
     * @return \Authentication\AuthenticationServiceInterface
     */
    public function getAuthenticationService(ServerRequestInterface $request) : AuthenticationServiceInterface
    {
        $authenticationService = new AuthenticationService([
            'unauthenticatedRedirect' => '/users/login',
            'queryParam' => 'redirect',
        ]);

        // Load identifiers, ensure we check email and password fields
        $authenticationService->loadIdentifier('Authentication.Password', [
            'fields' => [
                'username' => 'email',
                'password' => 'password',
            ],
            'passwordHasher' => [
                'className' => 'Authentication.Fallback',
                'hashers' => [
                    'Authentication.Default',
                    [
                        'className' => 'Authentication.Legacy',
                        'hashType' => 'md5',
                        'salt' => false // turn off default usage of salt
                    ],
                ]
            ]
        ]);

        // Load the authenticators, you want session first
        $authenticationService->loadAuthenticator('Authentication.Session');
        // Configure form data check to pick email and password
        $authenticationService->loadAuthenticator('Authentication.Form', [
            'fields' => [
                'username' => 'email',
                'password' => 'password',
            ],
            'loginUrl' => [
                '/users/login',
                '/users/reset-password',
                '/users/change-password',
                '/users/change-email',
            ],
        ]);

        return $authenticationService;
    }

    public function getAuthorizationService(ServerRequestInterface $request): AuthorizationServiceInterface
    {
        // custom resolvers for policy factorization
        $mapResolver = new MapResolver();

        $mapResolver->map(Model\Entity\Article::class, Policy\DocumentationPolicy::class);
        $mapResolver->map(Model\Entity\Category::class, Policy\DocumentationPolicy::class);
        $mapResolver->map(Model\Entity\Faq::class, Policy\DocumentationPolicy::class);
        $mapResolver->map(Model\Table\ArticlesTable::class, Policy\DocumentationsTablePolicy::class);
        $mapResolver->map(Model\Table\CategoriesTable::class, Policy\DocumentationsTablePolicy::class);
        $mapResolver->map(Model\Table\FaqsTable::class, Policy\DocumentationsTablePolicy::class);

        $mapResolver->map(Model\Entity\Coat::class, Policy\DescriptionPolicy::class);
        $mapResolver->map(Model\Entity\Color::class, Policy\DescriptionPolicy::class);
        $mapResolver->map(Model\Entity\Dilution::class, Policy\DescriptionPolicy::class);
        $mapResolver->map(Model\Entity\Earset::class, Policy\DescriptionPolicy::class);
        $mapResolver->map(Model\Entity\Eyecolor::class, Policy\DescriptionPolicy::class);
        $mapResolver->map(Model\Entity\Marking::class, Policy\DescriptionPolicy::class);
        $mapResolver->map(Model\Entity\Singularity::class, Policy\DescriptionPolicy::class);
        $mapResolver->map(Model\Entity\DeathPrimaryCause::class, Policy\DescriptionPolicy::class);
        $mapResolver->map(Model\Entity\DeathSecondaryCause::class, Policy\DescriptionPolicy::class);

        $mapResolver->map(Model\Table\CoatsTable::class, Policy\DescriptionsTablePolicy::class);
        $mapResolver->map(Model\Table\ColorsTable::class, Policy\DescriptionsTablePolicy::class);
        $mapResolver->map(Model\Table\DilutionsTable::class, Policy\DescriptionsTablePolicy::class);
        $mapResolver->map(Model\Table\EarsetsTable::class, Policy\DescriptionsTablePolicy::class);
        $mapResolver->map(Model\Table\EyecolorsTable::class, Policy\DescriptionsTablePolicy::class);
        $mapResolver->map(Model\Table\MarkingsTable::class, Policy\DescriptionsTablePolicy::class);
        $mapResolver->map(Model\Table\SingularitiesTable::class, Policy\DescriptionsTablePolicy::class);
        $mapResolver->map(Model\Table\DeathPrimaryCausesTable::class, Policy\DescriptionsTablePolicy::class);
        $mapResolver->map(Model\Table\DeathSecondaryCausesTable::class, Policy\DescriptionsTablePolicy::class);

        $mapResolver->map(Model\Entity\Country::class, Policy\DescriptionPolicy::class);
        $mapResolver->map(Model\Table\CountriesTable::class, Policy\DescriptionsTablePolicy::class);

        $mapResolver->map(Model\Entity\Compatibility::class, Policy\DescriptionPolicy::class);
        $mapResolver->map(Model\Entity\Operator::class, Policy\DescriptionPolicy::class);
        $mapResolver->map(Model\Table\CompatibilitiesTable::class, Policy\DescriptionsTablePolicy::class);
        $mapResolver->map(Model\Table\OperatorsTable::class, Policy\DescriptionsTablePolicy::class);

        $mapResolver->map(Model\Entity\ContributionType::class, Policy\ConfigurationPolicy::class);
        $mapResolver->map(Model\Entity\Role::class, Policy\ConfigurationPolicy::class);
        $mapResolver->map(Model\Entity\State::class, Policy\ConfigurationPolicy::class);
        $mapResolver->map(Model\Table\RolesTable::class, Policy\ConfigurationsTablePolicy::class);
        $mapResolver->map(Model\Table\StatesTable::class, Policy\ConfigurationsTablePolicy::class);

        $mapResolver->map(Model\Entity\RatMessage::class, Policy\MessagePolicy::class);
        $mapResolver->map(Model\Entity\RatteryMessage::class, Policy\MessagePolicy::class);
        $mapResolver->map(Model\Entity\LitterMessage::class, Policy\MessagePolicy::class);
        $mapResolver->map(Model\Table\RatMessagesTable::class, Policy\MessagesTablePolicy::class);
        $mapResolver->map(Model\Table\RatteryMessagesTable::class, Policy\MessagesTablePolicy::class);
        $mapResolver->map(Model\Table\LitterMessagesTable::class, Policy\MessagesTablePolicy::class);


        // default resolver (based on naming conventions)
        $ormResolver = new OrmResolver();

        // Check the map resolver, and fallback to the orm resolver if a resource is not explicitly mapped
        $resolver = new ResolverCollection([$mapResolver, $ormResolver]);
        return new AuthorizationService($resolver);
    }
}
