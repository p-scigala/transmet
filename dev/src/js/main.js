'use strict';

import slickCall from './modules/slick';
import cf7FloatingLabels from './modules/cf7FloatingLabels';
import scrollAnim from './modules/scrollAnim';

jQuery(document).ready(function ($) {
  cf7FloatingLabels($);

  scrollAnim($);
  slickCall($);
});
