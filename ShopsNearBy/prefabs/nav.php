<?php
/**
 * Created by PhpStorm.
 * User: chadi
 */ ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="/ART_COFFEE/">< Shops ></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav ml-auto">

            <?php if (!$USER_EXISTS) { ?>
                <li class="nav-item borderR">
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#SIGNIN_MODAL" href="#">Sign in</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registration">Sign up</a>
                </li>

            <?php } else { ?>
                <li class="nav-item ">
                    <a class="nav-link" href="#" onclick="showShops('');">Nearby Shops</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showShops('liked');">Prefered Shops</a>
                </li>
                <li class="nav-item borderR">
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" id="drop" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false" href="#">
                        <span class="fa fa-user"></span> User
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="drop">
                        <form action="Api/logout.php" method="post">
                            <input type="hidden" name="token" id="token" value="<?= $s->__get("CSRF") ?>">
                            <input type="submit" class="dropdown-item" value="< Log out >">
                        </form>
                    </div>

                </li>

            <?php } ?>
        </ul>
    </div>
</nav>

