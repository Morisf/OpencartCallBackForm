<div class="container-fluid feedback feedback-form">
    <div class="alert alert-danger alert-dismissible" role="alert" id="feedback_error">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Внимание!</strong> Пожалуста убедитесь в том что форма зполнена верно.
    </div>

    <div class="alert alert-success alert-dismissible" role="alert" id="feedback_success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Спасбо, Ваша форма отправлена.
    </div>

    <div class="top-text">
        <span><?php echo $top_text ?></span>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $head_text ?></h3>
        </div>
        <div class="panel-body">
            <form>
                <div class="form-group">
                    <label for="feedback_name" class="control-label"><?php echo $entry_name ?></label>
                    <input class="form-control" name="name" id="feedback_name" placeholder="<?php echo $entry_name_placeholder ?>">
                </div>

                <div class="form-group">
                    <label for="feedback_email" class="control-label"><?php echo $entry_email ?></label>
                    <input type="email" class="form-control" name="email" id="feedback_email" placeholder="<?php echo $entry_email_placeholder ?>">
                </div>

                <div class="form-group">
                    <label for="feedback_phone" class="control-label"><?php echo $entry_phone ?></label>
                    <input class="form-control" name="phone" id="feedback_phone" placeholder="<?php echo $entry_phone_placeholder ?>">
                </div>
                <div class="form-group">
                    <a href="#" onclick="submitFeedback(); return false;" class=""><?php echo $entry_submit ?></a>
                </div>
            </form>
            <div class="addition-text">
                <?php echo $addition_text ?>
            </div>
        </div>
    </div>

</div>
<style>
    @media only screen
    and (min-width : 1224px) {
        .container-fluid.feedback.feedback-form {
            background-image: url(<?php echo $bacgroudImage['image'] ?>);
            min-height: <?php echo $min_height ?>px !important;
            min-width: <?php echo $min_width ?>px !important;
        }
    }
</style>