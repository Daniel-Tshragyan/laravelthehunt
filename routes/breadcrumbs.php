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
Breadcrumbs::for('cityUpdate', function (BreadcrumbTrail $trail,$city) {
    $trail->parent('city');
    $trail->push($city->name,route('city.show',['city'=>$city]));
    $trail->push('Update City');
});
Breadcrumbs::for('cityShow', function (BreadcrumbTrail $trail) {
    $trail->parent('city');
    $trail->push('City');
});
Breadcrumbs::for('job', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('All Jobs', route('admin-job.index'));
});
Breadcrumbs::for('jobCreate', function (BreadcrumbTrail $trail) {
    $trail->parent('job');
    $trail->push('Create Job', route('admin-job.create'));
});
Breadcrumbs::for('jobUpdate', function (BreadcrumbTrail $trail,$job) {
    $trail->parent('job');
    $trail->push($job->title,route('admin-job.show',['admin_job'=>$job]));
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
Breadcrumbs::for('categoryUpdate', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('category');
    $trail->push($category->title,route('category.show',['category'=>$category]));
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

Breadcrumbs::for('userUpdate', function (BreadcrumbTrail $trail,$user) {
    $trail->parent('user');
    $trail->push($user->name,route('user.show',['user'=>$user]));
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
Breadcrumbs::for('tagUpdate', function (BreadcrumbTrail $trail,$tag) {
    $trail->parent('tag');
    $trail->push($tag->title,route('tag.show',['tag'=>$tag]));
    $trail->push('Update tag');
});
Breadcrumbs::for('tagShow', function (BreadcrumbTrail $trail) {
    $trail->parent('tag');
    $trail->push('tag');
});
Breadcrumbs::for('plan', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('All Plans', route('plan.index'));
});
Breadcrumbs::for('planCreate', function (BreadcrumbTrail $trail) {
    $trail->parent('plan');
    $trail->push('Create Plan', route('plan.create'));
});
Breadcrumbs::for('planUpdate', function (BreadcrumbTrail $trail,$plan) {
    $trail->parent('plan');
    $trail->push($plan->title,route('plan.show',['plan'=>$plan]));
    $trail->push('Update Plan');
});
Breadcrumbs::for('planShow', function (BreadcrumbTrail $trail) {
    $trail->parent('plan');
    $trail->push('Plan');
});
