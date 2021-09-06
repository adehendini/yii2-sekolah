<?php
use yii\helpers\Html;
?>
<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <span class="hidden-xs">Guru</span>
    </a>
    <ul class="dropdown-menu">
        <li class="user-header">
        </li>
        <li class="user-body">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <?php echo Html::a('<i class="fa fa-user"></i> Profil',['site/profil'],['class'=>'btn btn-default btn-flat']) ?>
                </div>
            </div>
        </li>
        <li class="user-footer">
            <div class="pull-left">
                <?php echo Html::a('<i class="fa fa-lock"></i> Ubah Password',['site/ubah-password'],['class'=>'btn btn-default btn-flat']) ?>
            </div>
            <div class="pull-right">
                <?php echo Html::a('<i class="fa fa-sign-out"></i> Logout',['site/logout'],['class'=>'btn btn-default btn-flat','data-method'=>'post']) ?>
            </div>
        </li>
    </ul>
</li>

