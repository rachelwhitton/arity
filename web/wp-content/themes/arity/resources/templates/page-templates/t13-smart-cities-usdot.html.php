<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      T13 Smart Cities USDot
  Template Type:      Page Template
  Description:
  Last Updated:       11/12/2018
  Since:              1.0.0
*/
?>

<?php get_header() ?>

<style>
  #action-bar {
    padding-bottom: 0 !important;
  }
  .content-datavis-block {
    padding-top: 0 !important;
  }
  .dataVis {
    width: 1040px !important;
    overflow: scroll;
  }
  .hero-elaborated{
    padding-bottom:150px;
  }
  .right--.hero-a__image {
    opacity: 0.6;
  }
  .block-video {
    margin-top:-152px;
  }
  .video-wrapper {
    border:5px solid #fff;
  }
  .block-video .container { 
    padding-left: 50px;
    padding-right: 50px;
  }
  .action-bar:before {
    width:0px !important
  }
  .action-bar__left p {
    font-size: 1.25rem !important;
    line-height: 1.3 !important;
  }
  .sc-panel-num a {
    margin-top:-15px;
  }
  #sc-nav-panel-container {
  	font-family: 'Roboto', sans-serif;
  	font-size: 1rem;
  	position: relative;
  	width: 100%;
  	max-width: 430px;
  	height: 315px;
  	margin: 2rem auto;
	}
	#sc-nav-panel-bg {
		position: absolute;
		width: 100%;
		height: 100%;
    background-color: #F7F7F7;
	}
	#sc-nav-timeline {
	 position: absolute;
		left: 0;
		top: 0;
		width: 37px;
		height: 314px;
	}
	#sc-timeline-bar {
		position: absolute;
		left: 15px;
		top: 0;
		width: 7px;
		height: 314px;
	}
	#sc-num-1 {
		top: 10px;
	}
	#sc-num-2 {
		top: 68px;
	}
	#sc-num-3 {
		top: 138px;
	}
	#sc-num-4 {
		top: 205px;
	}
	#sc-num-5 {
		top: 266px;
	}
	.sc-panel-num {
		position: absolute;
		left: 0;
		width: 36px;
		height: 36px;
	}
	.sc-panel-num a {
		position: absolute;
		text-decoration: none;
	}
	#sc-nav-panel-text {
		position: absolute;
		top: 0;
		left: 61px;
		width: 369px;
	}
	.sc-panel-text {
		position: absolute;
		left: 0;
	}
	.sc-nav-panel-header {
		font-weight: 500;
		font-size: 1.125rem;
		line-height: 1.2;
		margin: 0;
	}
	.sc-nav-panel-header a {
		color: #011c2c;
		text-decoration: none;
		transition: color 0.2s ease;
	}
	.sc-nav-panel-body {
		font-weight: 400;
		color: #63727e;
		font-size: 0.875rem;
		line-height: 1.3;
		margin: 0;
	}
	#sc-panel-text-1 {
		top: 10px;
	}
	#sc-panel-text-2 {
		top: 68px;
	}
	#sc-panel-text-3 {
		top: 128px;
	}
	#sc-panel-text-4 {
		top: 205px;
	}
	#sc-panel-text-5 {
		top: 266px;
	}
	.opaque-circle {
		position: absolute;
		left: 0;
		top: 0;
		width: 36px;
		height: 36px;
		background-color: #011c2c;
		transition: background-color 0.2s ease;
		border-radius: 50%;
	}
</style>


<?php do_action('theme/before_content') ?>

<div id="main" class="site-content">
  <?php the_acf_content(); ?>
</div>

<?php do_action('theme/after_content') ?>

<?php get_footer() ?>


<script>
  // remove data disclaimer indent
  var indentDiv = document.querySelector(".body-inset-ten-col__col");
  indentDiv.removeAttribute("class");

  // remove scrollable attribute in iframe
  var iframe = document.querySelector(".dataVis");
  iframe.setAttribute("scrolling", "auto");

  // build external data viz nav
  var scNums = Array.prototype.slice.call(document.querySelectorAll(".sc-panel-num"));
  var scPanelHeaders = Array.prototype.slice.call(document.querySelectorAll(".sc-nav-panel-header"));

  function extractNum(string, charIndex) {
    var num = string.substring(charIndex);
    return num;
  }
  function mouseoverNumber(event) {
    var num = extractNum(this.id, 7);
    var mouseoverColor = "#0070d6";
    var targetHeader = document.getElementById("sc-panel-text-" + num).firstElementChild;
    this.firstElementChild.style.backgroundColor = mouseoverColor;
    targetHeader.firstElementChild.style.color = mouseoverColor;
  }
  function mouseoutNumber(event) {
    var num = extractNum(this.id, 7);
    var mouseoutColor = "#011c2c";
    var targetHeader = document.getElementById("sc-panel-text-" + num).firstElementChild;
    this.firstElementChild.style.backgroundColor = mouseoutColor;
    targetHeader.firstElementChild.style.color = mouseoutColor;
  }
  function mouseoverHeader(event) {
    var num = extractNum(this.parentElement.id, 14);
    var mouseoverColor = "#0070d6";
    var targetNum = document.getElementById("sc-num-" + num)
    this.firstElementChild.style.color = mouseoverColor;
    targetNum.firstElementChild.style.backgroundColor = mouseoverColor;
  }
  function mouseoutHeader(event) {
    var num = extractNum(this.parentElement.id, 14);
    var mouseoutColor = "#011c2c";
    var targetNum = document.getElementById("sc-num-" + num)
    this.firstElementChild.style.color = mouseoutColor;
    targetNum.firstElementChild.style.backgroundColor = mouseoutColor;
  }

  scNums.forEach(function(num) {
    num.addEventListener("mouseover", mouseoverNumber, true);
    num.addEventListener("mouseout", mouseoutNumber, true);
  });
  scPanelHeaders.forEach(function(header) {
    header.addEventListener("mouseover", mouseoverHeader, true);
    header.addEventListener("mouseout", mouseoutHeader, true);
  });
</script>
