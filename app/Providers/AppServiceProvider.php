<?php

namespace App\Providers;

use App\Actions\MyAction;
use App\Actions\PayoutAction;
use App\Actions\ViewInvoicePDF;
use App\Actions\ViewThread;
use App\Actions\ThreadReplyCount;
use App\Models\OrganizationRole;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use TCG\Voyager\Facades\Voyager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        /**
         * CUstom directive to get user detail from 
         * currently logged in user 
         */
        Blade::directive('user', function ($attr_name){
            $user = Auth::user();
            if ($user == true){
                $value = $user[$attr_name];
                return $value;
            }
            
        });



        /**
         * directive to check if the logged in user is part 
         * of any organization or not 
         * 
         * This directive also checks if the organization status is active or not.
         */
        Blade::if('organization_member', function ($checkInactive = false){
            // dd("GOING HERE");
            return is_user_organization_member($checkInactive);
        });


        /**
         * directive to check if the logged in user has required permission to 
         * access the page or not . only if the user has equal to or higher permission 
         * than specified, then only it'll return true, else false.
         */
        Blade::if('organization_role', function ($role_slug){
            return organization_role($role_slug);
        });


        /**
         * Directive to check if users organization is inactive or not
         */
        Blade::if('organization_inactive', function (){
            return organization_inactive();
        });



        Paginator::useBootstrap();


        /**
         * Custom action for voyager
         */
        Voyager::addAction(MyAction::class);
        Voyager::addAction(ViewInvoicePDF::class);
        Voyager::addAction(PayoutAction::class);
        Voyager::addAction(ViewThread::class);
        Voyager::addAction(ThreadReplyCount::class);

        Schema::defaultStringLength(191);
    }
}
