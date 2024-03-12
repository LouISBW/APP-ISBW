<?php

namespace App\Providers\Filament;

use App\Filament\Pages\EditProfile;
use Awcodes\FilamentGravatar\GravatarPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('user')
            ->path('')
            ->login()
            ->profile()
            ->userMenuItems([
                'profile' => MenuItem::make()->url(fn (): string => EditProfile::getUrl()),

            ])
            ->colors([
                'primary' => '#004494',
                'danger' => '#e2001a',
                'gray' => Color::Slate,
                'info' => Color::Blue,
                'warning' => Color::Orange,
            ])
            ->font('Poppins')
            ->favicon('images/isbwapp.ico')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
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
            ->plugins([
                GravatarPlugin::make(),
            ])
            ->navigationGroups([
                'Mes demandes',
                'Approbations',
                'Salles',
                'Pôle Budget et Finances',
                'Pôle RH',
                'Paramètres',
            ])

            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    public function navigation(): array
    {
        return [

        ];
    }
}
