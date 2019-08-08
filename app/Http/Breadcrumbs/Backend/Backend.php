<?php

Breadcrumbs::register('admin.dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('後台管理', route('admin.dashboard'));
});

require __DIR__ . '/Access.php';
require __DIR__ . '/LogViewer.php';