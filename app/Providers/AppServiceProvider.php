<?php

    namespace App\Providers;

    use Illuminate\Support\ServiceProvider;
    use Illuminate\Pagination\Paginator;
    use Illuminate\Routing\Router;

    class AppServiceProvider extends ServiceProvider {
        public function register(): void {

        }

        public function boot(Router $router): void {
            Paginator::useBootstrapFive();
            $router->aliasMiddleware('role', \Spatie\Permission\Middleware\RoleMiddleware::class);
        }
    }