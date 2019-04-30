<?php ?>
<div class="<?=$class;?>__col <?=$class;?>__img-box">
    <form action="<?= $data['pardot-form-post']; ?>" method="POST" class="needs-validation">
        <?php 
        $fields = $data['pardot-form'];
        for($f=0; $f<sizeof($fields); $f++){

            if ($fields[$f]['field_type']=='textbox'){?>
                <div class="form-group <?=($fields[$f]['field_required'][0]=='1')?'form-group--required':''?>">
                    <label class="form-group-label" for="<?=$fields[$f]['field_id'];?>"><?=$fields[$f]['field_label']?></label>
                    <input type="text" class="form-control" name="<?=$fields[$f]['field_id'];?>" id="<?=$fields[$f]['field_id'];?>" placeholder="" <?=($fields[$f]['field_required'][0]=='1')?'required':''?>>
                    <?php if($fields[$f]['field_required'][0]=='1'){?>
                        <div class="form-control-feedback" data-error="required"><?=$fields[$f]['field_error_required'];?></div>
                        <div class="form-control-feedback" data-error="invalid"><?=$fields[$f]['field_error_invalid'];?></div>
                    <?php }?>
                </div>
            <?php }


            if ($fields[$f]['field_type']=='textarea'){?>
                <div class="form-group <?=($fields[$f]['field_required'][0]=='1')?'form-group--required':''?>">
                    <label class="form-group-label" for="<?=$fields[$f]['field_id'];?>"><?=$fields[$f]['field_label']?></label>
                    <textarea class="form-control" name="description" id="input_description" rows="3" <?=($fields[$f]['field_required'][0]=='1')?'required':''?>></textarea>
                    <?php if($fields[$f]['field_required'][0]=='1'){?>
                        <div class="form-control-feedback" data-error="required"><?=$fields[$f]['field_error_required'];?></div>
                        <div class="form-control-feedback" data-error="invalid"><?=$fields[$f]['field_error_invalid'];?></div>
                    <?php }?>
                </div>
            <?php }


            if ($fields[$f]['field_type']=='hidden'){?>
                <input type=hidden name="<?= $fields[$f]['field_id']; ?>" id="<?= $fields[$f]['field_id']; ?>" value="<?= $fields[$f]['field_value']; ?>">
            <?php }


            if ($fields[$f]['field_type']=='select'){?>
                <div class="form-group <?=($fields[$f]['field_required'][0]=='1')?'form-group--required':''?>">
                    <label class="form-group-label" for="<?=$fields[$f]['field_id'];?>"><?=$fields[$f]['field_label']?></label>
                    <select class="form-control custom-select" name="<?=$fields[$f]['field_id'];?>" id="<?=$fields[$f]['field_id'];?>" <?=($fields[$f]['field_required'][0]=='1')?'required':''?>>
                        <?php for($g=0; $g<sizeof($fields[$f]['pardot-form-select']); $g++){ ?>
                            <option value="<?=$fields[$f]['pardot-form-select'][$g]['select-value']?>" <?=($fields[$f]['pardot-form-select'][$g]['select-by-default'][0]=='1')?'selected':''?>><?=$fields[$f]['pardot-form-select'][$g]['select-label']?></option>
                        <?php }?>
                    </select>
                    <?php if($fields[$f]['field_required'][0]=='1'){?>
                        <div class="form-control-feedback" data-error="required"><?=$fields[$f]['field_error_required'];?></div>
                        <div class="form-control-feedback" data-error="invalid"><?=$fields[$f]['field_error_invalid'];?></div>
                    <?php }?>
                </div>

            <?php }

            if ($fields[$f]['field_type']=='check'){?>
                <div class="form-group <?=($fields[$f]['field_required'][0]=='1')?'form-group--required':''?>" >
                    <label class="form-group-label"><?=$fields[$f]['pardot-form-check-body']?></label>
                    <?php for($g=0; $g<sizeof($fields[$f]['pardot-form-check']); $g++){ ?>
                        <div style="display:flex; align-items: flex-start;" >
                            <label class="checkbox_container">
                            <input class="form-control" id="<?=$fields[$f]['field_id'];?>" name="<?=$fields[$f]['field_id'];?>[]" type="checkbox" value="<?=$fields[$f]['pardot-form-check'][$g]['check-value']?>" <?=($fields[$f]['pardot-form-check'][$g]['check-by-default'][0]=='1')?'checked':''?> <?=($fields[$f]['field_required'][0]=='1')?'required':''?> />
                                <span class="checkmark"></span>
                            </label>
                            <p style="margin: 5px 0 0 0; font-size: 88%; line-height: 1.2352; padding-bottom: 10px;"><?=$fields[$f]['pardot-form-check'][$g]['check-label']?></p>
                        </div>
                    <?php }?>
                    <?php if($fields[$f]['field_required'][0]=='1'){?>
                        <div class="form-control-feedback" data-error="required"><?=$fields[$f]['field_error_required'];?></div>
                        <div class="form-control-feedback" data-error="invalid"><?=$fields[$f]['field_error_invalid'];?></div>
                    <?php }?>
                </div>
            <?php }

            if ($fields[$f]['field_type']=='radio'){?>
                <div class="form-group <?=($fields[$f]['field_required'][0]=='1')?'form-group--required':''?>" >
                    <label class="form-group-label"><?=$fields[$f]['pardot-form-radio-body']?></label>
                    <?php for($g=0; $g<sizeof($fields[$f]['pardot-form-radio']); $g++){ ?>
                        <label class="container radio-container"><?=$fields[$f]['pardot-form-radio'][$g]['check-label']?>
                            <input class="form-control" type="radio" name="<?=$fields[$f]['field_id'];?>[]" value="<?=$fields[$f]['pardot-form-radio'][$g]['radio-value']?>" <?=($fields[$f]['pardot-form-radio'][$g]['radio-by-default'][0]=='1')?'checked':''?> <?=($fields[$f]['field_required'][0]=='1')?'required':''?> /><?=$fields[$f]['pardot-form-radio'][$g]['radio-label']?>
                            <span class="radio-checkmark"></span>
                        </label>
                    <?php }?>
                    <?php if($fields[$f]['field_required'][0]=='1'){?>
                        <div class="form-control-feedback" data-error="required"><?=$fields[$f]['field_error_required'];?></div>
                        <div class="form-control-feedback" data-error="invalid"><?=$fields[$f]['field_error_invalid'];?></div>
                    <?php }?>
                </div>
            <?php }

        }
        ?>
        <button type="submit" class="btn btn-primary"><?=$data['pardot-form-btntext'];?></button>   
        
        <div class="form-group" style="position:absolute; left:-9999px; top: -9999px;">
            <label class="form-group-label" for="pardot_extra_field">Comments</label>
            <input type="text" class="form-control" id="pardot_extra_field" name="pardot_extra_field">
        </div>

        <?php if(!empty($data['pardot-form-use_captcha'])) : ?>
            <!-- div class="g-recaptcha" data-size="invisible" data-badge="inline"></div -->
        <?php endif; ?>
    </form>
</div>
<!-- <div id="thankyou_modal" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">
        // Modal content
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
</div> -->
<?php ?>
<script>
(function () {
        'use strict';
        window.addEventListener('load', function () {
            $('.needs-validation').submit(function(){
                var err = 0;
                var requiredCheckboxes = $('.form-group--required :radio[required]');
                var name_map = {};
                $(".form-group--required :checkbox[required], .form-group--required :radio[required]")  // for all checkboxes
                .each(function() {  // first pass, create name mapping
                    var name = this.name;
                    name_map[name] = (name_map[name]) ? name + "[]" : name;
                })
                .each(function() {  // replace name based on mapping
                    this.name = name_map[this.name];
                });
               
               // console.log(name_map);
                $.each(name_map,function( index, value ){
                    var checked = $('input[name="' + value + '"]:checked');
                    if (checked.length == 0){
                        $('input[name="' + value + '"]').closest('.form-group--required').addClass('has-error--').attr('data-error','required');
                        err = 1;
                    }
                });
               if (err){
                return false;
               }else{
                return true;
               }
                
            });
        }, false);
    })();
</script>