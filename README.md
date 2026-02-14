# Mobile Bottom Navigation for Filament

[![Latest Version on Packagist](https://img.shields.io/packagist/v/hammadzafar05/mobile-bottom-nav.svg?style=flat-square)](https://packagist.org/packages/hammadzafar05/mobile-bottom-nav)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/hammadzafar05/mobile-bottom-nav/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/hammadzafar05/mobile-bottom-nav/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/hammadzafar05/mobile-bottom-nav.svg?style=flat-square)](https://packagist.org/packages/hammadzafar05/mobile-bottom-nav)

A thumb-friendly mobile bottom navigation bar for Filament v5 panels. Automatically extracts items from the Filament navigation registry and renders a fixed bottom bar on mobile viewports with full support for dark mode, safe-area insets, badges, and Alpine.js sidebar integration.

## Installation

Install the package via Composer:

```bash
composer require hammadzafar05/mobile-bottom-nav
```

> [!IMPORTANT]
> If you have not set up a custom theme and are using Filament Panels, follow the instructions in the [Filament Docs](https://filamentphp.com/docs/5.x/styling/overview#creating-a-custom-theme) first.

After setting up a custom theme, add the plugin's views to your theme CSS file:

```css
@source '../../../../vendor/hammadzafar05/mobile-bottom-nav/resources/**/*.blade.php';
```

Optionally, you can publish the views:

```bash
php artisan vendor:publish --tag="mobile-bottom-nav-views"
```

## Usage

### Basic Setup

Register the plugin on your Filament panel. By default, it extracts the top navigation items automatically:

```php
use Hammadzafar05\MobileBottomNav\MobileBottomNav;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            MobileBottomNav::make(),
        ]);
}
```

### Custom Items

Provide your own navigation items instead of extracting from the registry:

```php
use Hammadzafar05\MobileBottomNav\MobileBottomNav;
use Hammadzafar05\MobileBottomNav\MobileBottomNavItem;

MobileBottomNav::make()
    ->items([
        MobileBottomNavItem::make('Home')
            ->icon('heroicon-o-home')
            ->activeIcon('heroicon-s-home')
            ->url('/admin')
            ->isActive(fn () => request()->is('admin')),
        MobileBottomNavItem::make('Inbox')
            ->icon('heroicon-o-inbox')
            ->url('/admin/inbox')
            ->badge(5, 'danger'),
        MobileBottomNavItem::make('Profile')
            ->icon('heroicon-o-user')
            ->url('/admin/profile'),
    ])
```

### Configuration Options

All configuration is done via the fluent API:

| Method | Default | Description |
|--------|---------|-------------|
| `fromNavigation(int $limit)` | `3` | Extract items from Filament's navigation registry with a limit |
| `items(array $items)` | `null` | Provide custom `MobileBottomNavItem` instances (disables auto-extraction) |
| `moreButton(bool $enabled)` | `true` | Show/hide the "More" button that opens the sidebar |
| `moreButtonLabel(string $label)` | `'More'` (translatable) | Customize the "More" button label |
| `renderHook(string $hook)` | `PanelsRenderHook::BODY_END` | Change which Filament render hook is used |

### Navigation Limit & More Button

When using automatic extraction with the "More" button enabled (default), the plugin reserves one slot for the "More" button. So `fromNavigation(4)` shows 3 navigation items + 1 "More" button.

```php
MobileBottomNav::make()
    ->fromNavigation(5)     // 4 nav items + More button
    ->moreButton(true)      // opens the sidebar on tap
```

To disable the "More" button and use all slots for navigation:

```php
MobileBottomNav::make()
    ->fromNavigation(4)     // 4 nav items, no More button
    ->moreButton(false)
```

### Visibility

Items support conditional visibility:

```php
MobileBottomNavItem::make('Admin')
    ->icon('heroicon-o-shield-check')
    ->url('/admin/settings')
    ->visible(fn () => auth()->user()?->isAdmin())
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [Hammad Zafar](https://github.com/hammadzafar05)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
