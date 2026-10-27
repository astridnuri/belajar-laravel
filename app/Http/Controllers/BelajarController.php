<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BelajarController extends Controller
{
    public function index()
    {
        $title="Belajar Laravel asik asik";
        return view('belajar', compact('title'));
    }

    public function tambah()
    {
        $title="Tambah-tambahan";
        return view('tambah', compact('title'));
        }
        public function actionTambah(Request $request)
        {
            // $request = new Request()
            $title="Tambah-tambahan";
            $angka1 = $request->angka1;
            $angka2= $request->input('angka2');
            $jumlah=$angka1+$angka2;
            return view('tambah', compact('jumlah', 'title'));
        }

        public function kurang()
        {
        $title="Pengurangan";
        return view('pengurangan', compact('title'));
        }

        public function actionKurang(Request $request)
        {
            // $request = new Request()
            $title="Kurang-kurangan";
            $angka1 = $request->angka1;
            $angka2= $request->input('angka2');
            $kurangan=$angka1-$angka2;
            return view('pengurangan', compact('kurangan', 'title'));
         }

         public function actionKali(Request $request)
         {
             // $request = new Request()
             $title="Kali-kalian";
             $angka1 = $request->angka1;
             $angka2= $request->input('angka2');
             $kalian=$angka1*$angka2;
             return view('perkalian', compact('kalian', 'title'));
          }

          public function actionBagi(Request $request)
          {
              // $request = new Request()
              $title="Bagi-bagian";
              $angka1 = $request->angka1;
              $angka2= $request->input('angka2');
              if ($angka2===0) {
                return $bagian = "~";
              } else {
                return $bagian = $angka1/$angka2;
              }

              return view('bagi', compact('bagian', 'title'));
           }

        public function kali()
    {
        $title="Perkalian";
        return view('perkalian', compact('title'));
    }
    public function bagi()
    {
        $title="Pembagian";
        return view('bagi', compact('title'));
    }
}
