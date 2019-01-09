<?php ?>
<div class="<?=$class;?>__col wide-- <?=$class;?>__img-box">
    <form action="<?= $data['pardot-form-post']; ?>" method="POST">
        <?php 
        $fields = $data['pardot-form'];
        for($f=0; $f<sizeof($fields); $f++){
            //echo '<br/>'.$fields[$f]['field_type'];

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
                    <?=$fields[$f]['pardot-form-check-body']?>
                    <?php for($g=0; $g<sizeof($fields[$f]['pardot-form-check']); $g++){ ?>
                        
                        <div style="display:flex; align-items: flex-start;" >
                            <label class="checkbox_container">
                            <input id="<?=$fields[$f]['field_id'];?>" name="<?=$fields[$f]['field_id'];?>" type="checkbox" value="<?=$fields[$f]['pardot-form-check'][$g]['check-value']?>" <?=($fields[$f]['pardot-form-check'][$g]['check-by-default'][0]=='1')?'checked':''?> />
                                <span class="checkmark"></span>
                            </label>
                            <p style="margin: 5px 0 0 0; font-size: 88%; line-height: 1.2352"><?=$fields[$f]['pardot-form-check'][$g]['check-label']?></p>
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
                    <?=$fields[$f]['pardot-form-radio-body']?>
                    <?php for($g=0; $g<sizeof($fields[$f]['pardot-form-radio']); $g++){ ?>
                        <label class="container radio-container"><?=$fields[$f]['pardot-form-radio'][$g]['check-label']?>
                            <input type="radio" name="<?=$fields[$f]['field_id'];?>" value="<?=$fields[$f]['pardot-form-radio'][$g]['radio-value']?>" <?=($fields[$f]['pardot-form-radio'][$g]['radio-by-default'][0]=='1')?'checked':''?> /><?=$fields[$f]['pardot-form-radio'][$g]['radio-label']?>
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
    </form>
</div>
<?php ?>