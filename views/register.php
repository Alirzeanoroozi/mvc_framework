<h1>Sign Up new Account</h1>
<br>
<?php use Alireza\Untitled\core\form\Form;

echo $form = Form::begin('', 'post') ?>
    <?php echo $form->field($model, 'firstname')?>
    <?php echo $form->field($model, 'lastname')?>
    <?php echo $form->field($model, 'email')?>
    <?php echo $form->field($model, 'password')?>
    <?php echo $form->field($model, 'confirmPassword')?>
<button type="submit" class="btn btn-primary">Submit</button>

<?php echo Form::end() ?>

<!--<form action="" method="post">-->
<!--    <div>-->
<!--        <div class="row">-->
<!--            <div class="col">-->
<!--                <label>Firstname</label>-->
<!--                <input type="text" name="firstname" class="form-control">-->
<!--            </div>-->
<!--            <div class="col">-->
<!--                <label>Lastname</label>-->
<!--                <input type="text" name="lastname" class="form-control">-->
<!--            </div>-->
<!--        </div>-->
<!--        <br>-->
<!--        <label>Email</label>-->
<!--        <input type="text" name="email" class="form-control">-->
<!--        <br>-->
<!--        <label>Password</label>-->
<!--        <input type="password" name="password" class="form-control">-->
<!--        <br>-->
<!--        <label>Confirm Password</label>-->
<!--        <input type="password" name="confirmPassword" class="form-control">-->
<!--        <br>-->
<!--        <button type="submit" class="btn btn-primary">Submit</button>-->
<!--    </div>-->
<!--</form>-->
