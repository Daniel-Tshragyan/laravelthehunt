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
    $trail->push('All Categories', route('category.index'));
});
Breadcrumbs::for('categoryCreate', function (BreadcrumbTrail $trail) {
    $trail->parent('category');
    $trail->push('Create Category', route('category.create'));
});
Breadcrumbs::for('categoryUpdate', function (BreadcrumbTrail $trail) {
    $trail->parent('category');
    $trail->push('Update Category');
});
Breadcrumbs::for('categoryShow', function (BreadcrumbTrail $trail) {
    $trail->parent('category');
    $trail->push('Category');
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
Breadcrumbs::for('tag', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('All Tags', route('tag.index'));
});
Breadcrumbs::for('tagCreate', function (BreadcrumbTrail $trail) {
    $trail->parent('tag');
    $trail->push('Create tag', route('tag.create'));
});
Breadcrumbs::for('tagUpdate', function (BreadcrumbTrail $trail) {
    $trail->parent('tag');
    $trail->push('Update tag');
});
Breadcrumbs::for('tagShow', function (BreadcrumbTrail $trail) {
    $trail->parent('tag');
    $trail->push('tag');
});
