<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

class TentangWebsiteController extends Controller
{
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }


	public function actionIndex()
	{
		$judul ="Tentang Website";
		$list =[
				['halaman'=>'Beranda','deskripsi'=>'Menampilkan halaman muka'],
				['halaman'=>'Mata Pelajaran','deskripsi'=>'Halaman untuk mengelola mata pelajaran'],
				['halaman'=>'Guru','deskripsi'=>'Halaman untuk mengelola data Guru'],
				['halaman'=>'Siswa','deskripsi'=>'Halaman untuk mengelola data Siswa'],
				['halaman'=>'Kelas','deskripsi'=>'Halaman untuk mengelola data kelas dan wali kelasnya'],
				['halaman'=>'Jadwal Pelajaran','deskripsi'=>'Halaman untuk mengelola Jadwal Pelajaran tiap kelas'],
				['halaman'=>'Admin','deskripsi'=>'Halaman untuk mengelola data admin'],
				['halaman'=>'Ubah Username','deskripsi'=>'Halaman untuk mengubah username admin yang login'],
				['halaman'=>'Ubah Password','deskripsi'=>'Halaman untuk mengubah password admin yang login'],
				['halaman'=>'Logout','deskripsi'=>'Keluar dari status login admin website'],
			];
		return $this->render('index',['title'=>$judul,'list'=>$list]);
	}
}

