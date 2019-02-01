<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Content and Image Block
  Template Type:      Module
  Description:        Product or feature highlight ("River"). Template name has been updated to Block: 2 column
  Last Updated:       08/01/2017
  Since:              1.0.0
*/

//echo '<pre>'; print_r($data); echo '</pre>'; 

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
            'classes' => $class.'__title',
            'headline' => $data['module-headline']
          )); ?>
          <?php endif; ?>

          <?php if(!empty($data['subhead'])) : ?>
            <div class="block-highlights__subhead">
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
  </form>