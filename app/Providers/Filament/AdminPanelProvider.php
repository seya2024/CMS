<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Support\Enums\Width;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
use App\Filament\Widgets\PatientVisit;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->topNavigation(true)
             ->maxContentWidth(Width::Full)
              ->unsavedChangesAlerts()
            /////////////////////////////////
            ->brandLogo(asset('images/logo2.png'))
            ->brandLogoHeight('10rem')
            ->brandName('CarePlus')
            ->favicon(asset('favicon.png'))
            // ->colors([
            //     'primary' => '#0847f4',
            // ])
        
            ->colors([
                'primary' => Color::Blue,
            ])

            ->passwordReset()
           // ->emailChangeVerification()

            // ->colors([
            //     'primary' => Color::Amber,
            // ])

       
             ->renderHook(
                PanelsRenderHook::FOOTER,
              //  fn (): string => Blade::render('@include(\'filament.footer\')'),
            fn () => '<div style="background:#64748b;color:white;text-align:center">       <div class="fixed bottom-0 left-0 w-screen bg-white z-50 border-t border-gray-200 py-4 text-center shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
            
            <p class="text-sm font-semibold uppercase tracking-wide text-[#012169]">
                © ' . now()->year . ' 
                <span class="text-[#5d03f7]">CarePlus Clinic</span> 
                | All Rights Reserved.
            </p>

            <p class="text-xs text-gray-500 hover:text-[#5d03f7] transition cursor-pointer">
                Developed by: <span class="underline">Seid Mohammed</span>
            </p>

        </div></div>',
            )





            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
             Dashboard::class,
            ])

      

            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
             ->widgets([

                   PatientVisit::class,
                  // AccountWidget::class,
                 //  FilamentInfoWidget::class,
             ])

            ->discoverResources(
                in: app_path('Filament/Resources'),
                for: 'App\\Filament\\Resources'
            )

            ->discoverPages(
                in: app_path('Filament/Pages'),
                for: 'App\\Filament\\Pages'
            )

      
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
