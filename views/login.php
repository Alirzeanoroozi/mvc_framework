<h1>login</h1>
<br>
<?php use Alireza\Untitled\core\form\Form;

echo $form = Form::begin('', 'post') ?>

<?php echo $form->field($model, 'email')?>
<?php echo $form->field($model, 'password')?>
<button type="submit" class="btn btn-primary">Submit</button>

<?php echo Form::end() ?>



