<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin', function (BreadcrumbTrail $trail) {
    $trail->push('Admin', route('adminDashboard'));
});



Breadcrumbs::for('city', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('All Cities', route('city.index'));
});
Breadcrumbs::for('cityCreate', function (BreadcrumbTrail $trail) {
    $trail->parent('city');
    $trail->push('Create City', route('city.create'));
});
Breadcrumbs::for('cityUpdate', function (BreadcrumbTrail $trail) {
    $trail->parent('city');
    $trail->push('Update City');
});
Breadcrumbs::for('cityShow', function (BreadcrumbTrail $trail) {
    $trail->parent('city');
    $trail->push('City');
});
Breadcrumbs::for('job', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('All Jobs', route('job.index'));
});
Breadcrumbs::for('jobCreate', function (BreadcrumbTrail $trail) {
    $trail->parent('job');
    $trail->push('Create Job', route('job.create'));
});
Breadcrumbs::for('jobUpdate', function (BreadcrumbTrail $trail) {
    $trail->parent('job');
    $trail->push('Update Job');
});
Breadcrumbs::for('jobShow', function (BreadcrumbTrail $trail) {
    $trail->parent('job');
    $trail->push('Job');
});
Breadcrumbs::for('category', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('All Jobs', route('category.index'));
});
Breadcrumbs::for('categoryCreate', function (BreadcrumbTrail $trail) {
    $trail->parent('job');
    $trail->push('Create Job', route('category.create'));
});
Breadcrumbs::for('categoryUpdate', function (BreadcrumbTrail $trail) {
    $trail->parent('job');
    $trail->push('Update Job');
});
Breadcrumbs::for('categoryShow', function (BreadcrumbTrail $trail) {
    $trail->parent('job');
    $trail->push('Job');
});
Breadcrumbs::for('user', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('All Users', route('user.index'));
});

Breadcrumbs::for('userUpdate', function (BreadcrumbTrail $trail) {
    $trail->parent('user');
    $trail->push('Update User');
});
Breadcrumbs::for('userShow', function (BreadcrumbTrail $trail) {
    $trail->parent('user');
    $trail->push('User');
});
