<?php
/**
 * Created by PhpStorm.
 * User: chadi
 * Date: 05/01/19
 * Time: 13:49
 */?>

<!--MODAL SIGN IN-->
<div class="modal fade" id="SIGNIN_MODAL" tabindex="-1" role="dialog" aria-labelledby="SIGNIN_MODAL" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-sign-in-alt"></i> Sign In</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="email" class="form-control" id="Email" name="Email" aria-describedby="emailHelp" placeholder="Email / Username">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password"  placeholder="Password" name="password">
                </div>
                <div  class="bg-dark text-white text-center" style="display: none"  id="errorlog">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="log()">Log in</button>
            </div>
        </div>
    </div>
</div>
<!--END MODAL SIGN IN-->
