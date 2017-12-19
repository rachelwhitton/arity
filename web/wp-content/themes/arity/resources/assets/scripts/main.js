/** import external dependencies */
// import $ from 'jquery';

/** import local dependencies */
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import routeReportInfo from './routes/route-report-info';
import ces2018 from './routes/ces2018';

/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */
const routes = new Router({
  /** All pages */
  common,
  /** Specific Pages */
  home,
  routeReportInfo,
  ces2018,
});

/** Load Events */
jQuery(document).ready(() => routes.loadEvents());
