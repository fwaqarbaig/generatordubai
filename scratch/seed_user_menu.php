<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\MenuItem;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

DB::transaction(function () {
    // Delete existing header menu items
    MenuItem::where('location', 'header')->orWhereNull('location')->delete();

    // 1. Home
    $home = MenuItem::create([
        'title' => 'Home',
        'url' => '/',
        'route_name' => 'home',
        'type' => 'standard',
        'target' => '_self',
        'order' => 1,
        'is_active' => true,
        'location' => 'header',
    ]);

    // 2. About
    $about = MenuItem::create([
        'title' => 'About',
        'url' => '/about-us',
        'route_name' => 'about',
        'type' => 'standard',
        'target' => '_self',
        'order' => 2,
        'is_active' => true,
        'location' => 'header',
    ]);

    // 3. Services (Dropdown / Flyout Root)
    $services = MenuItem::create([
        'title' => 'Services',
        'url' => '/services',
        'route_name' => 'service.index',
        'type' => 'services_dropdown',
        'target' => '_self',
        'order' => 3,
        'is_active' => true,
        'location' => 'header',
    ]);

    // Category 3.1: Rental Cooling
    $cooling = MenuItem::create([
        'parent_id' => $services->id,
        'title' => 'Rental Cooling',
        'url' => '/services#rental-cooling',
        'type' => 'standard',
        'target' => '_self',
        'order' => 1,
        'is_active' => true,
        'location' => 'header',
    ]);

    $coolingItems = [
        ['Rental Chiller', '/service/rental-chiller-in-uae'],
        ['Rental AC', '/service/rental-ac-in-uae'],
        ['Rental Packaged Unit', '/service/packaged-ac-units-rental-uae'],
        ['Wild Air Rental', '/service/wild-air-in-uae'],
        ['Air Cooled Rental', '/service/air-cooled-chiller-rental-uae'],
        ['Temporary Cooling', '/service/temporary-cooling-in-uae'],
    ];
    foreach ($coolingItems as $idx => [$title, $url]) {
        MenuItem::create([
            'parent_id' => $cooling->id,
            'title' => $title,
            'url' => $url,
            'type' => 'standard',
            'target' => '_self',
            'order' => $idx + 1,
            'is_active' => true,
            'location' => 'header',
        ]);
    }

    // Category 3.2: Rental Power
    $power = MenuItem::create([
        'parent_id' => $services->id,
        'title' => 'Rental Power',
        'url' => '/services#rental-power',
        'type' => 'standard',
        'target' => '_self',
        'order' => 2,
        'is_active' => true,
        'location' => 'header',
    ]);

    $powerItems = [
        ['Rental Generator', '/service/rental-generator-in-uae'],
        ['Rental Power', '/service/rental-power-in-uae'],
        ['Silent Generator Rental', '/service/silent-generator-rental-uae'],
        ['Diesel Generators', '/service/diesel-generator-rental-uae'],
    ];
    foreach ($powerItems as $idx => [$title, $url]) {
        MenuItem::create([
            'parent_id' => $power->id,
            'title' => $title,
            'url' => $url,
            'type' => 'standard',
            'target' => '_self',
            'order' => $idx + 1,
            'is_active' => true,
            'location' => 'header',
        ]);
    }

    // Category 3.3: Maintenance
    $maintenance = MenuItem::create([
        'parent_id' => $services->id,
        'title' => 'Maintenance',
        'url' => '/services#maintenance',
        'type' => 'standard',
        'target' => '_self',
        'order' => 3,
        'is_active' => true,
        'location' => 'header',
    ]);

    $maintItems = [
        ['Generator Maintenance', '/service/generator-maintenance-uae'],
        ['Generator AMC', '/service/generator-amc-uae'],
        ['Chiller Maintenance', '/service/chiller-maintenance'],
        ['Chiller AMC', '/service/chiller-amc-uae'],
    ];
    foreach ($maintItems as $idx => [$title, $url]) {
        MenuItem::create([
            'parent_id' => $maintenance->id,
            'title' => $title,
            'url' => $url,
            'type' => 'standard',
            'target' => '_self',
            'order' => $idx + 1,
            'is_active' => true,
            'location' => 'header',
        ]);
    }

    // Category 3.4: New Generators
    $newGen = MenuItem::create([
        'parent_id' => $services->id,
        'title' => 'New Generators',
        'url' => '/services#new-generators',
        'type' => 'standard',
        'target' => '_self',
        'order' => 4,
        'is_active' => true,
        'location' => 'header',
    ]);

    $newGenItems = [
        ['Perkins Generators', '/service/perkins-generators-uae'],
        ['Cummins Generators', '/service/cummins-generator-rental-uae'],
    ];
    foreach ($newGenItems as $idx => [$title, $url]) {
        MenuItem::create([
            'parent_id' => $newGen->id,
            'title' => $title,
            'url' => $url,
            'type' => 'standard',
            'target' => '_self',
            'order' => $idx + 1,
            'is_active' => true,
            'location' => 'header',
        ]);
    }

    // Category 3.5: Used & Refurbished
    $usedRefurb = MenuItem::create([
        'parent_id' => $services->id,
        'title' => 'Used & Refurbished',
        'url' => '/used-refurbished-generators',
        'type' => 'standard',
        'target' => '_self',
        'order' => 5,
        'is_active' => true,
        'location' => 'header',
    ]);

    $usedRefurbItems = [
        ['Used Generators', '/service/used-generators-uae'],
        ['Refurbished Generators', '/service/refurbished-generators-uae'],
        ['Used Chillers', '/service/used-chiller-in-uae'],
        ['Refurbished Chillers', '/service/refurbished-chillers-uae'],
        ['Used Portacabin', '/service/portacabin-for-sale-in-uae'],
        ['Refurbished Portacabin', '/service/refurbished-portacabin-uae'],
    ];
    foreach ($usedRefurbItems as $idx => [$title, $url]) {
        MenuItem::create([
            'parent_id' => $usedRefurb->id,
            'title' => $title,
            'url' => $url,
            'type' => 'standard',
            'target' => '_self',
            'order' => $idx + 1,
            'is_active' => true,
            'location' => 'header',
        ]);
    }

    // 4. Blog
    $blog = MenuItem::create([
        'title' => 'Blog',
        'url' => '/blog',
        'route_name' => 'blog.index',
        'type' => 'standard',
        'target' => '_self',
        'order' => 4,
        'is_active' => true,
        'location' => 'header',
    ]);

    // 5. Contacts
    $contacts = MenuItem::create([
        'title' => 'Contacts',
        'url' => '/contact-us',
        'route_name' => 'contact',
        'type' => 'standard',
        'target' => '_self',
        'order' => 5,
        'is_active' => true,
        'location' => 'header',
    ]);

    // Update Footer Menu
    MenuItem::where('location', 'footer')->delete();
    $footerItems = [
        ['Home', '/', 1],
        ['About Us', '/about-us', 2],
        ['Services', '/services', 3],
        ['Blog', '/blog', 4],
        ['Contact Us', '/contact-us', 5],
    ];
    foreach ($footerItems as [$title, $url, $order]) {
        MenuItem::create([
            'title' => $title,
            'url' => $url,
            'type' => 'standard',
            'target' => '_self',
            'order' => $order,
            'is_active' => true,
            'location' => 'footer',
        ]);
    }
});

echo "User requested menu successfully populated in database!\n";
