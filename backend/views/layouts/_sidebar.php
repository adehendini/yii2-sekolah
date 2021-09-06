<?php
use yii\widgets\Menu;
?>
<aside class="main-sidebar">
  <section class="sidebar">
    <?php
    echo Menu::widget([
      'encodeLabels' => false,
      'activateParents'=>true,
      'activeCssClass'=>'active',
      'options' => ['class' => 'sidebar-menu'],
      'submenuTemplate' => "\n<ul class='treeview-menu'>\n{items}\n</ul>\n",
      'items'=>[
        ['label'=>'<i class="fa fa-home"></i> <span>Beranda</span>','url'=>['site/index']],
        ['label'=>'<i class="fa fa-book"></i> <span>Mata Pelajaran</span>','url'=>['mata-pelajaran/index']],
        ['label'=>'<i class="fa fa-male"></i> <span>Guru</span>','url'=>['guru/index']],
        ['label'=>'<i class="fa fa-child"></i> <span>Siswa</span>','url'=>['siswa/index']],
        ['label'=>'<i class="fa fa-building"></i> <span>Kelas</span>','url'=>['kelas/index']],
        ['label'=>'<i class="fa fa-calendar-o"></i> <span>Jadwal Pelajaran</span>','url'=>['jadwal-pelajaran/index']],
        ['label'=>'<i class="fa fa-user-secret"></i> <span>Administrator</span> <i class="fa fa-angle-left pull-right"></i>',
          'url'=>['#'],
          'options'=>['class'=>'treeview'],
          'items'=>[
            ['label'=>'Admin','url'=>['admin/index'],'visible'=>backend\models\Admin::isRoot(Yii::$app->user->identity->username)],
            ['label'=>'Ubah Username','url'=>['site/ubah-username']],
            ['label'=>'Ubah Password','url'=>['site/ubah-password']],
          ],
        ],
        ['label'=>'<i class="fa fa-info-circle"></i> <span>Tentang Website</span>','url'=>['tentang-website/index']],
        ['label'=>'<i class="fa fa-lock fa-fw"></i> <span>Logout</span>',
          'url'=>['/site/logout'],
          'template' => '<a href="{url}" data-method="post">{label}</a>',
        ]
      ],
    ]); 
    ?>      
  </section>
</aside>

