<?php
/**
 * Created by PhpStorm.
 * User: chadi
 */
require_once '../app/settings/conf.php';
@$error=$_GET["r"];
$msg="";
switch ($error)
{
    case "errorSystem" :
        {
            $msg ="System Error please try again later ";
            break;
        }
    case "duplicate":
        {
            $msg ="Email Already in use, please try Another one ";
            break;
        }
}

if($msg !="")
{
    ?>
    <div class="modal fade" id="error_modal" tabindex="-1" role="dialog" aria-labelledby="error_modal" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <form >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i> Error Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <h4 class="text-center"><i class="fas fa-exclamation-triangle"></i> <?=$msg?> </h4>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php }
?>
<html>
<head>
    <title>ART COFFEE-Registration</title>
    <script src="<?=$_paths['assets']?>js/registration.js"></script>
    <?php require "../prefabs/head.php"; ?>
    <style>
        .borderR {
            border-right: 1px solid gray
        }
    </style>
</head>
<body>
<div class="container my-5 ">
    <div class="row">
        <div class="col-md-12 text-center">
            <a class="badge badge-secondary" href="../"><h4> Shops  </h4></a>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-8 ">
            <form action="../Api/app.php" method="post" name="regform" onsubmit="return validateForm();">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header text-center progress-bar progress-bar-striped progress-bar-animated"
                         role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                        <i class="fas fa-pen"></i> Sign Up using your Email
                    </div>
                    <div class="card-body">
                        <div class="form-group my-3">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="Email" name="email"
                                   placeholder="Email">
                            <small id="emailHelp" class="form-text text-muted">We will never share your email
                                with someone else.
                            </small>
                        </div>
                        <div class="form-group my-3">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="Password" name="password"
                                   placeholder="Password">
                        </div>
                        <hr>
                        <div class="form-group">
                            <input type="hidden" value="signup" name="REQUEST">
                            <button type="submit" class="form-control btn btn-secondary" id="submit" name="signmeup" >
                                Inscrivez-moi <i class="fas fa-pen"></i>
                            </button>
                        </div>
                        <input type="hidden" value="" name="location" id="location">
                        <div class="form-group">
                            <div class="col-lg-12 bg-danger" id="errors" style="display: none">

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
</body>
<? if($msg!="") :?>
<script type="text/javascript">
        $(window).on('load',function(){
            $('#error_modal').modal('show');
        });
    </script>
<?endif?>
<script>
    getLocation();
</script>
</html>
