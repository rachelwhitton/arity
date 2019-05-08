<?php
namespace App\Theme;

?>

<?php
/*
  Template Name:      Pardot Form
  Template Type:      Module
  Description:        Build your own form for submission to Pardot
  Last Updated:       04/30/2019
  Since:              1.0.0
*/

// echo '<pre>'; print_r($data); echo '</pre>'; 

$class = 'content-image-block';
if($data['content-chooser']=='layout__form'){
  global $wp;

  $data['is_salesforce'] = false;
  $data['is_pardot'] = true;
  $data['use_captcha'] = true;
  
  $data['form_return_url'] = home_url( $wp->request );
  $data['form_return_url'] = trailingslashit($data['form_return_url']) . '#thank-you';
}

if($data['vertical-align']=='Top'){
  $data['classes'][] = 'alignTop';
}

?>

<div class="contact-form"> 
  <div <?php module_class($data['classes']); ?>>
    <?php if (!empty($data['module-headline'])) : ?>
      <div class="container module-intro">
        <div class="row">
          <div class="<?= $data['headline-alignment']; ?>">
            <?php if(!empty($data['eyebrow'])) : ?>
              <?php element('eyebrow', array(
                'classes' => 'eyebrow',
                'label' => $data['eyebrow']
              )); ?>
            <?php endif; ?>

            <?php if (!empty($data['module-headline'])) : ?>
              <?php element('headline', array(
              'classes' => $class.'__title' . $data['headline_color'],
              'headline' => $data['module-headline']
            )); ?>
            <?php endif; ?>

            <?php if(!empty($data['subhead'])) : ?>
              <div class="block-highlights__subhead <?='text-'.$data['headline-alignment'];?>">
                <?= $data['subhead']; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
    <div class="container">
      <div class="row">
      <?php 
        if ($data['content-chooser'] == "layout__pardot-form") :
            require_once('layout__pardot-form.php');
        endif; 
      ?>

      </div>
    </div>
  </div>
</div>

<div id="thankyou_modal" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-body--left">
                <div class="align-vertical-middle">
                    <h2><?=$data['pardot-form-thankyou-title'];?></h2>
                </div>
                </div>
            <div class="modal-body--right">
                <p><?=$data['pardot-form-thankyou-copy'];?></p>
                <a href="<?=$data['pardot-form-thankyou-url'];?>" class="ar-element button button--primary blue-button--">
                <span class="button__label"><?=$data['pardot-form-thankyou-btncopy'];?></span>
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
