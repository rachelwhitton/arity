<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      T9 Blog Article
  Template Type:      Page Template
  Description:
  Last Updated:       1/19/2018
  Since:              1.1.0
*/
//$related['posts'] = get_field('related_posts');
$category_name = yoast_get_primary_term('category', $post);
$abstract = get_field('abstract');
$author = [];
$blauthor = get_field('author_override');
if($blauthor){
  $blost = get_post($blauthor);
  $bloouthor = get_fields($blauthor);
  $author['author-name'] = $blost->post_title;
  $author['description'] = $bloouthor['author']['biography'];
  $author['twitter'] = $bloouthor['author']['twitter'];
  $author['display_image'] = $bloouthor['author']['image'];
}
?> 
<?php get_header(); ?>

<?php do_action('theme/before_content') ?>
<div id="main" class="site-content <?=$_ENV['PANTHEON_ENVIRONMENT']?>">
  <div class="container">
    <div class="blog-post newco-insights-category-<?php echo strtolower($category_name) ?>">
      <?php /* Start the Loop */
        while ( have_posts() ) : the_post();

        if(empty($blauthor)){
          $author['author-name'] = get_the_author();
          $author['description'] = get_the_author_meta( 'user_description' );
          $author['twitter'] = get_the_author_meta('twitter');
          $author['display_image'] = get_avatar( get_the_author_meta( 'ID' ) , 245 );
        }
      ?>
      <div class="blog-post__content">
        <div class="blog-post__header">
          <div class="row">
            <div class="blog-post__image">
              <?php the_post_thumbnail(); ?>

              <div class="blog-post__bg"></div>
            </div>
          </div>
          <div class="row">
            <div class="blog-post__inner">
              <div class="blog-post__cat">
                <span><?php echo $category_name ?></span>
              </div>
              <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?><?php  ?>
              <div class="blog-post__stats"><?php echo $author['author-name']; echo ' &middot; '; echo get_the_date();?> &middot; <?= do_shortcode('[ttr]'); ?></em>
            </div>
          </div>
        </div>
        <div class="blog-post__col">
          <div class="row">
            <div class="blog-post__excerpt-col">
              <?php echo $abstract; ?>
            </div>
            <div class="blog-post__content-col">
              <?php the_content();?>
            </div>
          </div>
          <div class="row">
            <div class="blog-post__author-col">
              <?php module('blog-author', $author);?>
            </div>
          </div>
        </div>
      </div>
      <?php
      endwhile; // End of the loop.
      ?>
    </div>
  </div>

  <div class="blog-post__related-content">
    <h2 class="blog-post__related-content-header">You Might Also Like</h2>
    <?php
      $related['posts'] = get_field('related_posts');
      module('blog-promo', $related);
    ?>
  </div>

</div>
<?php do_action('theme/after_content') ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5a6f42f0b4c9f84d"></script>
<?php get_footer(); ?>


<div id="thankyou_modal" class="blogPopup1">
    <div class="modal-dialog" style="text-align:center; color:#fff">
      <p>Thank you for joining.</p>
        We will send you an email to verify<br/>your subscription.
    </div>
    <button type="button" class="close" id="btnClose" data-dismiss="modal">
      <svg class="icon-svg" title="" role="img">
          <use xlink:href="#close"></use>
      </svg>
    </button>
</div>


<div id="thankyou_modal" class="blogPopup">
    <div class="modal-dialog">
    <form id="myPopupForm" action="//go.pardot.com/l/669483/2018-12-17/6sb" method="POST">
    <!-- Modal content-->
      <p>Stay ahead of the mobility curve</p>
      <div style="color:#fff; display:flex">
        <div style="flex:1">
          <div class="form-group form-group--required">
            <label class="form-group-label" for="input_first_name">First name</label>
            <input type="text" class="form-control" name="first_name" id="input_first_name" placeholder="" required="" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
            <div class="form-control-feedback" data-error="required">*</div>
            <div class="form-control-feedback" data-error="invalid">*</div>
          </div>
        </div>
        <div>&nbsp;</div>
        <div style="flex:1">
          <div class="form-group form-group--required">
            <label class="form-group-label" for="input_last_name">Last name</label>
            <input type="text" class="form-control" name="last_name" id="input_last_name" placeholder="" required="">
            <div class="form-control-feedback" data-error="required">*</div>
            <div class="form-control-feedback" data-error="invalid">*</div>
          </div>
        </div>
      </div>
      
      <div class="form-group form-group--required">
        <label class="form-group-label" for="input_email">Business Email</label>
        <input type="email" class="form-control" name="email" id="input_email" placeholder="" required="">
        <div class="form-control-feedback" data-error="required">Please enter email</div>
        <div class="form-control-feedback" data-error="invalid">Please enter a valid email</div>
      </div>

      <label class="checkbox_container">I’d like to be contacted with the latest news and offers from Arity
      <input id="get_emails_option" name="get_emails_option" type="checkbox" checked="checked" />
          <span class="checkmark"></span>
      </label>



    <button style="width:100%" type="submit" class="btn btn-primary">Join our mailing list</button>

    <button type="button" class="close" id="btnClose" data-dismiss="modal">
      <svg class="icon-svg" title="" role="img">
          <use xlink:href="#close"></use>
      </svg>
    </button>
    </div>
    </div>
</div>
<style>
.blogPopup, .blogPopup1{
    z-index: 300;
    position: fixed;
    right: -400px;
    color: #000;
    height: 400px;
    width: 400px;
    top: 25%;

    background: rgb(2,60,87); /* Old browsers */
    background: -moz-linear-gradient(top, rgba(2,60,87,1) 0%, rgba(1,28,44,1) 99%); /* FF3.6-15 */
    background: -webkit-linear-gradient(top, rgba(2,60,87,1) 0%,rgba(1,28,44,1) 99%); /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(to bottom, rgba(2,60,87,1) 0%,rgba(1,28,44,1) 99%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#023c57', endColorstr='#011c2c',GradientType=0 ); /* IE6-9 */
}
.blogPopup1{
  height: 200px;
}
.blogPopup .modal-dialog, .blogPopup1 .modal-dialog{
  padding: 0px 20px;
}
.blogPopup .close{
  top:-10px !important;
}
.blogPopup p, .blogPopup1 p{
  padding-top:20px;
  font-size: 21px;
  font-weight:bold;
  color:#fff;
}
.blogPopup label{
  color:#fff;
}
.blogPopup form .form-group {
  margin-bottom: 20px;
}
.blogPopup input[type='text'], .blogPopup input[type='email']{
  background-color:#153f54;
  border-color:#153f54;
  color: #fff;
}
</style>

<?php
$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<script>
//Split url to check
var popupTrigger = 1;

<?php
if($link == $_SERVER["HTTP_REFERER"]){
  echo "console.log('SHOW Conformation and do not trigger scroll thing.');";
  echo "showPopupBox1();";
  echo "popupTrigger = 0;";
} 
?>

function updatePopupStatus(){
  console.log('Update POPUP status');
  var cookieCheck = (getCookie('cookieBanner-agreed')?1:0);
    if (cookieCheck){
        console.log('COOKIE IS AVAILABLE set new status');
        setCookie('cookie-showPopup','0');
        showPopupBox();
    }else{
      var url = "popup/?a=update&showPopup=0";
      jQuery.ajax({url:  url,
        success: function(result){
          showPopupBox();
          }
        });
    }
}

function showPopupBox() {
  console.log('Me Clicked');
  var hidden = jQuery('.blogPopup');
    if (hidden.hasClass('visible')){
        hidden.animate({"right":"-400px"}, "slow").removeClass('visible');
    } else {
        hidden.animate({"right":"0"}, "slow").addClass('visible');
    }
}
function showPopupBox1() {
  console.log('Me Clicked');
  var hidden = jQuery('.blogPopup1');
    if (hidden.hasClass('visible')){
        hidden.animate({"right":"-400px"}, "slow").removeClass('visible');
    } else {
        hidden.animate({"right":"0"}, "slow").addClass('visible');
    }
}
function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}
function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

jQuery('#btnClose').click(function(){
  updatePopupStatus();
});

var scrollTrigger = 0;
jQuery(document).scroll(function(){
  if (!popupTrigger){
    console.log('Disable scroll');
    return;
  }
  if (!scrollTrigger){
    console.log('SCROLL TRIGGER');
    scrollTrigger = 1;
    setTimeout(
      function() {
        //Step 1: Checks Cookie is enabled or not
        var cookieCheck = (getCookie('cookieBanner-agreed')?1:0);
        if (cookieCheck){
          console.log('COOKIE IS AVAILABLE');
          
          if (typeof getCookie('cookie-showPopup') == 'undefined'){
            console.log('cookie-showPopup not defined');
            setCookie('cookie-showPopup','1');
          }

          var showPopup = getCookie('cookie-showPopup');
          console.log('showPopup',showPopup,getCookie('cookie-showPopup'));

          if (showPopup == 1){
            console.log('SHOW POPUP and HANDEL IT in COOKIES');
            showPopupBox();
          }else{
            console.log('DONOT SHOW POPUP and HANDEL IT in COOKIES');
          }
        }else{
          // Cookie is not avaiable handel in PHP Session
          console.log('COOKIE IS NOT AVAILABLE HANDEL in PHP');
          var url = "popup/";
          jQuery.ajax({url:  url,
            success: function(result){
                console.log(result);
                var data = JSON.parse(result);
                console.log(data.showPopup);
                if (data.showPopup == 1){
                  console.log('LAUNCH POPUP');
                  showPopupBox();
                }else{
                  console.log('STOP POPUP');
                }
              }
            });
        }
      }, 5000);
  }
});
</script>