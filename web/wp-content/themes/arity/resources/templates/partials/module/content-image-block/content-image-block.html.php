<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Content and Image Block
  Template Type:      Module
  Description:        Product or feature highlight ("River")
  Last Updated:       08/01/2017
  Since:              1.0.0
*/
//echo '<pre>'; print_r($data); echo '</pre>'; 

$class = 'content-image-block';
if($data['content-chooser']=='layout__form'){
  global $wp;

  $data['is_salesforce'] = true;
  $data['use_captcha'] = true;
  
  $data['form_return_url'] = home_url( $wp->request );
  $data['form_return_url'] = trailingslashit($data['form_return_url']) . '#thank-you';
  echo '<pre>'; print_r($data); echo '</pre>'; 
}

if($data['content-chooser']=='layout__datavis'){
  $class = 'content-datavis-block';

  if (!empty($data['visualization'])){
    $ext = pathinfo($data['visualization']['url'], PATHINFO_EXTENSION);
    $newUrl =  str_replace('.'.$ext,'',$data['visualization']['url']);
    $newUrl .= '/index.html'; 
    $iframeUrl = $newUrl;
  }

  if (!empty($data['url-iframe'])){
    $iframeUrl = $data['url-iframe'];
  }

}

if($data['vertial-align']=='Top'){
  $data['classes'][] = 'alignTop';
}

?>

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
    <?php if (!empty($data['image_id']) && $data['content-chooser'] == "layout__form") : ?>
        <div class="<?=$class?>__col wide-- <?=$class?>__img-box">
        <div class="contact-form__indicates">
          <span class="required">*</span> indicates required field
        </div>
        <form action="<?= $data['form-posturl']; ?>" method="POST">
            <?php if(!empty($data['is_salesforce'])) : ?>
              <input type=hidden name="oid" value="<?= $data['form-oid']; ?>">
              <input type=hidden name="retURL" value="<?= $data['form_return_url']; ?>">
              <input type="hidden" name="lead_source" id="input_lead_source" value="<?= $data['form-leadsource']; ?>">
            <?php endif; ?>

            <div class="form-group form-group--required">
              <label class="form-group-label" for="<?=$data['form-fname']?>">First name</label>
              <input type="text" class="form-control" name="<?=$data['form-fname']?>" id="<?=$data['form-fname']?>" placeholder="" required>
              <div class="form-control-feedback" data-error="required">Please enter first name</div>
              <div class="form-control-feedback" data-error="invalid">Please enter a valid name</div>
            </div>

            <div class="form-group form-group--required">
              <label class="form-group-label" for="<?=$data['form-lname']?>">Last name</label>
              <input type="text" class="form-control" name="<?=$data['form-lname']?>" id="<?=$data['form-lname']?>" placeholder="" required>
              <div class="form-control-feedback" data-error="required">Please enter last name</div>
              <div class="form-control-feedback" data-error="invalid">Please enter a valid name</div>
            </div>

            <div class="form-group form-group--required">
              <label class="form-group-label" for="<?=$data['form-email']?>">Email</label>
              <input type="email" class="form-control" name="<?=$data['form-email']?>" id="<?=$data['form-email']?>" placeholder="" required>
              <div class="form-control-feedback" data-error="required">Please enter email</div>
              <div class="form-control-feedback" data-error="invalid">Please enter a valid email</div>
            </div>


            <div class="form-group form-group--required">
              <label class="form-group-label" for="<?=$data['form-industry']?>">What industry do you work in?</label>
              <select class="form-control custom-select" name="<?=$data['form-industry']?>" id="<?=$data['form-industry']?>" required>
                <option value="">Select an industry</option>
                <option value="Auto Aftermarket" <?=strtolower($_GET['industry'])=='auto aftermarket'?'selected':''?>>Auto Aftermarket</option>
                <option value="Automotive Solutions" <?=strtolower($_GET['industry'])=='automotive solutions'?'selected':''?>>Automotive Solutions</option>
                <option value="Financial Services" <?=strtolower($_GET['industry'])=='financial services'?'selected':''?>>Financial Services</option>
                <option value="Gig Economy" <?=strtolower($_GET['industry'])=='gig economy'?'selected':''?>>Gig Economy</option>
                <option value="Government" <?=strtolower($_GET['industry'])=='government'?'selected':''?>>Government</option>
                <option value="Insurance" <?=strtolower($_GET['industry'])=='insurance'?'selected':''?>>Insurance</option>
                <option value="OEM" <?=strtolower($_GET['industry'])=='oem'?'selected':''?>>OEM</option>
                <option value="Shared Mobility" <?=strtolower($_GET['industry'])=='shared mobility'?'selected':''?>>Shared Mobility</option>
                <option value="Smart Cities" <?=strtolower($_GET['industry'])=='smart cities'?'selected':''?>>Smart Cities</option>
                <option value="Other" <?=strtolower($_GET['industry'])=='other'?'selected':''?>>Other</option>
              </select>
              <div class="form-control-feedback" data-error="required">Please select an industry</div>
            </div>

            <label class="checkbox_container">By checking this box, I am providing express consent to receive marketing communications from Arity at the email address provided.
            <input id="<?=$data['form-contactme']?>" name="<?=$data['form-contactme']?>" type="checkbox" value="1" checked="checked" />
                <span class="checkmark"></span>
            </label>

            <button type="submit" class="btn btn-primary"><?=$data['form-btntext']?></button>

            <?php if(!empty($data['use_captcha'])) : ?>
              <div class="g-recaptcha" data-size="invisible" data-badge="inline"></div>
            <?php endif; ?>
            </form>
        </div>
        <div id="emailform_modal" class="modal" role="dialog">
          <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-body">
                  <div class="modal-body--left">
                    <div class="align-vertical-middle">
                      <h2>Thank You</h2>
                    </div>
                  </div>
                <div class="modal-body--right">
                  <p><?=$data['form-thankyou']?></p>
                  <a href="<?=$data['form-downloadurl']?>" class="ar-element button button--primary blue-button--">
                    <span class="button__label">Download</span>
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
      <?php endif; ?>
      <?php if (!empty($data['image_id']) && $data['content-chooser'] == "layout__image") : ?>
        <div class="<?=$class?>__col wide-- <?=$class?>__img-box">
          <?php element('image', [
            'id' => $data['image_id'],
            'classes' => $data['img-classes']
          ]); ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($data['url']) && $data['content-chooser'] == "layout__video") : ?>
        <div class="<?=$class?>__col wide-- <?=$class?>__video-box">
          <figure class="video-wrapper">
            <?php the_video($data['url']); ?>
          </figure>
        </div>
      <?php endif; ?>
      <?php if ((!empty($data['url-iframe']) || !empty($data['visualization'])) && $data['content-chooser'] == "layout__datavis") : ?>
        <div class="<?=$class?>__col wide-- <?=$class?>__img-box">
          <iframe scrolling="no" class="dataVis" style="border: 0px solid transparent; height:<?=$data['url-height-xlarge']?>px" 
                  src="<?=$iframeUrl?>?rand=<?=time()?>"
                  data-height-xlarge="<?=$data['url-height-xlarge']?>"
                  data-height-large="<?=$data['url-height-large']?>"
                  data-height-medium="<?=$data['url-height-medium']?>"
                  data-height-small="<?=$data['url-height-small']?>"
          ></iframe>
        </div>
      <?php endif; ?>
      <div class="<?=$class?>__col narrow--">
        <div class="<?=$class?>__col-group">
          <?php if (!empty($data['headline'])) : ?>
            <<?= $data['h_el']; ?> class="<?=$class?>__headline type3"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
          <?php endif; ?>
          <?php if (!empty($data['body_copy'])) : ?>
          <div class="content-image-block__content type0">
            <?= apply_filters('the_content', $data['body_copy']); ?>
          </div>
          <?php endif; ?>
          <?php
            if (!empty($data['link_groups'])) :
          ?>
            <div class="buttons">
            <?php $i=0; foreach ($data['link_groups'] as $cta) : $i++; if(empty($cta['group']['cta__link'])) continue; ?>
              <?php
                $cta = $cta['group'];
                if ($cta['cta__type'] == 'link'){
                  $classes = 'button block_link';

                  if ($cta['cta__icon_link'] != 'none') {
                    $cta['cta__link']['icon'] = 'arrow-right';
                  }

                  if((isLinkEmail($cta['cta__link']['url']) || ($cta['cta__icon_link'] == "mailto")) && ($cta['cta__icon_link'] != 'none')) {
                    $cta['cta__link']['icon'] = 'email';
                  }

                  if(($cta['cta__icon_link'] == "download") && $cta['cta__icon_link'] != 'none') {
                    $cta['cta__link']['icon'] = 'download';
                  }

                  if(($cta['cta__icon_link'] == "external") && $cta['cta__icon_link'] != 'none') {
                    $cta['cta__link']['icon'] = 'external';
                  }
                }else{
                  $classes = 'button button--primary blue-button-- blue-hover-border';

                  if(isLinkEmail($cta['cta__link']['url']) || $cta['cta__icon_button'] == "mailto" && $cta['cta__icon_button'] != 'none') {
                    $cta['cta__link']['icon'] = 'email';
                  }

                  if(($cta['cta__icon_button'] == "download") && $cta['cta__icon_button'] != 'none') {
                    $cta['cta__link']['icon'] = 'download';
                  }

                  if(($cta['cta__icon_button'] == "external") && $cta['cta__icon_button'] != 'none') {
                    $cta['cta__link']['icon'] = 'external';
                  }
                }
              ?>
              <p>
                <?php $cta['cta__link']['analytics'] = $data['headline']; ?>
                <?php element('button', array_merge($cta['cta__link'], [
                  'classes' => $classes
                ])); ?>
              </p>
            <?php endforeach; ?>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>
</div>
