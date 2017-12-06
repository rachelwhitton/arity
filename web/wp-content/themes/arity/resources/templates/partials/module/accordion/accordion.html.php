<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Career List
  Template Type:      Module
  Description:        List of career links - built by javascript
  Last Updated:       08/01/2017
  Since:              1.0.0
*/
?>
<div <?php module_class('career-list'); ?>>
  <div class="container">
      <div class="block_title">
        <<?= $data['h_el']; ?> class="career-list__headline">Open Positions</<?= $data['h_el']; ?>>
        <div class="block_jobCount" aria-hidden="true"><span id="job_count">0</span> available positions</div>
      </div>
    </div>
  <div class="container">
    <div id="careers_feed">
      <div class="careers-table__error">
        <div class="error_icon">
          <svg class="icon-svg" title="" role="img">
              <use xlink:href="#icon-careers-loading"></use>
          </svg>
        </div>
        <div>
          We're sorry, we can't pull in current job listings at this time. But you can still view them on our <a style="color: #006BF9" href="https://jobsearch.allstate.com/ListJobs/All/Search/jobtitle/arity/" target="_blank">listings site</a>.
        </div>
      </div>
    </div>
  </div>
</div>

<div id="careers_modal" class="modal" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-body--left">
          <div class="logo logo--arity-allstate"></div>
        </div>
        <div class="modal-body--right">
          <p>Heads up: you’re about to be directed to the Allstate careers site. You’re still looking at Arity jobs, but because we were founded by Allstate, we share the same application system.</p>
          <a id="listing_href" href="#" target="_blank" class="ar-element button button--primary blue-button--">
            <svg class="icon-svg" title="" role="img">
              <use xlink:href="#link-external"></use>
            </svg>
            <span class="button__label">View position</span>
          </a>
        </div>
      </div>
    </div>
    <button type="button" class="close" data-dismiss="modal">
      <svg class="icon-svg" title="" role="img">
          <use xlink:href="#close"></use>
      </svg>
    </button>
  </div>
</div>
