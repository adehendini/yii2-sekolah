<?php
use yii\widgets\Menu;
use frontend\models\Guru;
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
        ['label'=>'<i class="fa fa-calendar"></i> <span>Jadwal Mengajar</span>','url'=>['jadwal-mengajar/index']],
        ['label'=>'<i class="fa fa-building"></i> <span>Data Kelas</span>','url'=>['data-kelas/index']],
        ['label'=>'<i class="fa fa-user"></i> <span>'.Guru::namaGuru().'</span> <i class="fa fa-angle-left pull-right"></i>',
          'url'=>['#'],
          'options'=>['class'=>'treeview'],
          'items'=>[
            ['label'=>'Biodata','url'=>['site/biodata']],
            ['label'=>'Ubah Password','url'=>['site/ubah-password']],
          ],
        ],
        ['label'=>'<i class="fa fa-lock fa-fw"></i> <span>Logout</span>',
          'url'=>['/site/logout'],
          'template' => '<a href="{url}" data-method="post">{label}</a>',
        ]
      ],
    ]); 
    ?>      
  </section>
</aside>

