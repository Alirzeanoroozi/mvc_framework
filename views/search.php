<h1>Search</h1>
<?php use Alireza\Untitled\core\form\Form;

echo $form = Form::begin('', 'post') ?>

<?php echo $form->field($model, 'author_name')?>
<?php echo $form->field($model, 'subject')?>
<?php echo $form->field($model, 'inscription_id')?>
<?php echo $form->field($model, 'author_id')?>
<button type="submit" class="btn btn-primary">Submit</button>

<?php echo Form::end() ?>


