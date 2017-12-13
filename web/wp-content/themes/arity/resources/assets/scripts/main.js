/** import external dependencies */
// import $ from 'jquery';

/** import local dependencies */
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import routeReport from './routes/route-report';

/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */
const routes = new Router({
  /** All pages */
  common,
  /** Home page */
  home,
  routeReport,
});

/** Load Events */
jQuery(document).ready(() => routes.loadEvents());
