<h1>Sign Up new Account</h1>
<?php use Alireza\Untitled\core\form\Form;

echo $form = Form::begin('', 'post') ?>
    <div class="row">
        <div class="col-sm">
            <?php echo $form->field($model, 'firstname')?>
        </div>
        <div class="col-sm">
            <?php echo $form->field($model, 'lastname')?>
        </div>
    </div>
    <?php echo $form->field($model, 'email')?>
    <?php echo $form->field($model, 'password', 'password')?>
    <?php echo $form->field($model, 'confirmPassword', 'password')?>
<button type="submit" class="btn btn-primary">Submit</button>

<?php echo Form::end() ?>


