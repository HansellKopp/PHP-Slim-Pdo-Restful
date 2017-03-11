<?php
/**
 *  Definition of application routes
 *
 * @author hansellkopp <hansellkopp@gmail.com.com>
 */

  /**
   *  Home route
   */
  $app->get('/', 'App\Controllers\HomeController:home');

  /**
   *  Company routes group
   */
  $app->group('/company', function () use ($app) {

      // Get all
      $app->get('', 'App\Controllers\CompanyController:get');
      // Create new record
      $app->post('', 'App\Controllers\CompanyController:post');
      // Update record
      $app->put('', 'App\Controllers\CompanyController:put');
      // Get by id
      $app->get('/{id}', 'App\Controllers\CompanyController:getById');
      // Delete record with ID
      $app->delete('/{id}', 'App\Controllers\CompanyController:delete');
  });
