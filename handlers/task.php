<?php

// Create request object
$request = system_web_Request::createFromCurrentRequest();

// Create root controller
$rootController = new system_mvc_CompositeController();

// Create child controllers
$rootController->addChildController(
    $navbarController = new modules_navigation_NavigationLinksController('task', $request));
$rootController->addChildController(
    $taskDetailsController = new modules_tasks_TaskDetailsController($request));

// Handle all actions via root controller
$rootController->handleActions();

// Instantiate page and set parameters
$taskName = $taskDetailsController->getModel()->getName();
$page = new templates_TwoColumns();
$page->setPageTitle("Task: '{$taskName}' - " . Configuration::SITE_NAME);
$page->setPageHeading("Task: '{$taskName}'");
$page->addNavbarColumnController($navbarController);
$page->addContentColumnController($taskDetailsController);

// Render page
$page->render();
