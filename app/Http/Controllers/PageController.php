<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLogin()
    {
        return view('login');
    }

    /**
     * Proses login: redirect ke splash dengan query parameter username
     */
    public function doLogin(Request $req)
    {
        $u = urlencode($req->input('username'));
        return redirect("/splash?username={$u}");
    }

    /**
     * Tampilkan splash screen dan redirect otomatis ke dashboard
     */
    public function splash(Request $req)
    {
        $username = $req->query('username', '');
        return view('splash', compact('username'));
    }

    /**
     * Tampilkan dashboard
     */
    public function dashboard(Request $req)
    {
        $username = $req->query('username', '');
        return view('dashboard', compact('username'));
    }

    /**
     * Tampilkan halaman pengelolaan buku dengan session storage
     */
    public function pengelolaan(Request $req)
    {
        $username = $req->query('username', '');

        // Inisialisasi session books jika belum ada
        if (! $req->session()->has('books')) {
            $req->session()->put('books', $this->defaultBooks());
        }

        // Ambil daftar buku dari session
        $books = $req->session()->get('books');

        return view('pengelolaan', compact('username', 'books'));
    }

    /**
     * Simulasi tambah buku: persisten di session
     */
    public function createBook(Request $req)
    {
        $username = $req->query('username', '');

        // Pastikan session books sudah ter-inisialisasi
        if (! $req->session()->has('books')) {
            $req->session()->put('books', $this->defaultBooks());
        }

        $books = $req->session()->get('books');

        // Generate ID baru
        $ids   = array_column($books, 'id');
        $newId = empty($ids) ? 1 : max($ids) + 1;

        // Tambah entri buku baru
        $books[] = [
            'id'    => $newId,
            'name'  => $req->input('name'),
            'price' => $req->input('price'),
        ];

        // Simpan kembali ke session
        $req->session()->put('books', $books);

        // Redirect kembali ke pengelolaan dengan mempertahankan username
        return redirect("/pengelolaan?username=" . urlencode($username));
    }

    /**
     * Simulasi delete buku: hapus dari session
     */
    public function deleteBook(Request $req, $id)
    {
        $username = $req->query('username', '');

        // Ambil daftar buku dari session (fallback ke defaultBooks jika kosong)
        $books = $req->session()->get('books', $this->defaultBooks());

        // Filter buku yang id-nya tidak sama dengan $id
        $books = array_filter($books, fn($b) => $b['id'] != $id);

        // Reset index dan simpan kembali
        $req->session()->put('books', array_values($books));

        // Redirect kembali ke pengelolaan dengan mempertahankan username
        return redirect("/pengelolaan?username=" . urlencode($username));
    }

    /**
     * Tampilkan profil penyihir
     */
    public function profile(Request $req)
    {
        $username = $req->query('username', '');
        // Daftar link gambar (direct image URLs)
        $photos = [
            'https://i.pinimg.com/236x/31/4c/35/314c350648867306698012c50cebf0a7.jpg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrtb56DDE5yF79s8fpxdLYMFUZt6_vKOOJZV4TTmpyNLHUiDdzJGGpYUQ3BEEH5Awe0fA&usqp=CAU',
            'https://risibank.fr/cache/medias/0/35/3581/358142/full.png',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQBZeBUVKwqwFW-xF6NGuSt2FXU-AUHP1GGf3OXLk5S8IwowWOkXqUrxLaHdko0QtkXQZQ&usqp=CAU',
            'https://static.wikia.nocookie.net/wutheringwaves/images/b/b4/Yangyang_Sticker_Slice_of_Life_01_01.png',
            'https://static.wikia.nocookie.net/wutheringwaves/images/6/60/Yangyang_Sticker_Slice_of_Life_01_03.png',
            'https://static.wikia.nocookie.net/53844cb4-f04c-4452-a4ac-6bc88d89d0f6/scale-to-width/755',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwPna2OWvpAyRIjkWcTDL2DOHCgvW9kibKfPWOEYuEmK45jqGphbb8ISdmuhhwL1wlxRQ&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZ1_4bWGadG76axhTdaWeY7rCuAiTu3k3nOkkxFd1-dR6cz2_SWkUGuJpXwbH7D4qNeeY&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9CGzfxoP8KmnA_5lHr6l7cOegL87pXN-ODA&s',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTAUSRfbfKUjPAmghWdiiDsJR3WlOd_LeeYXUo2gqooqY4uAe2dOfCD0ynlCGLSMhStlkk&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy590LpDSmplnswBSKO3osMXMpzenQiclbxHW5Dfzk-6aQMDaAbYgKlh097VATAkIhe9M&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQDWHaIImvrzY-8N4fiS2Mcqbx-np9PceRdDi6lcICpGXHA-rFAZPLkZybCVHTLrA4YLWk&usqp=CAU'
        ];
        $photo = $photos[array_rand($photos)];
        $entity = 'manusia';
        $planet = 'bumi';
        return view('profile', compact('username', 'photo', 'entity', 'planet'));
    }

    /**
     * Data default 30 buku sihir
     */
    private function defaultBooks()
    {
        return [
            ['id'=>1,'name'=>'Buku Sihir Api Dasar','price'=>'150 gold'],
            ['id'=>2,'name'=>'Buku Sihir Air Murni','price'=>'160 gold'],
            ['id'=>3,'name'=>'Buku Sihir Tanah Kuat','price'=>'170 gold'],
            ['id'=>4,'name'=>'Buku Sihir Angin Purnama','price'=>'140 gold'],
            ['id'=>5,'name'=>'Buku Sihir Cahaya Ilahi','price'=>'200 gold'],
            ['id'=>6,'name'=>'Buku Sihir Bayangan Gelap','price'=>'220 gold'],
            ['id'=>7,'name'=>'Buku Sihir Anti Kutukan','price'=>'300 gold'],
            ['id'=>8,'name'=>'Buku Sihir Penyembuhan Ilmiah','price'=>'250 gold'],
            ['id'=>9,'name'=>'Buku Sihir Ilusi Memikat','price'=>'180 gold'],
            ['id'=>10,'name'=>'Buku Sihir Pemanggilan Arwah','price'=>'350 gold'],
            ['id'=>11,'name'=>'Buku Sihir Nekromansi Rahasia','price'=>'400 gold'],
            ['id'=>12,'name'=>'Buku Sihir Enchantmen Purba','price'=>'230 gold'],
            ['id'=>13,'name'=>'Buku Sihir Transmutasi Logam','price'=>'280 gold'],
            ['id'=>14,'name'=>'Buku Sihir Rune Kuno','price'=>'260 gold'],
            ['id'=>15,'name'=>'Buku Sihir Chronomancy Waktu','price'=>'500 gold'],
            ['id'=>16,'name'=>'Buku Sihir Divinasi Takdir','price'=>'240 gold'],
            ['id'=>17,'name'=>'Buku Sihir Proteksi Suci','price'=>'210 gold'],
            ['id'=>18,'name'=>'Buku Sihir Evokasi Guruh','price'=>'330 gold'],
            ['id'=>19,'name'=>'Buku Sihir Konjurasi Bintang','price'=>'360 gold'],
            ['id'=>20,'name'=>'Buku Mastery Elemen Primal','price'=>'450 gold'],
            ['id'=>21,'name'=>'Buku Ritual Arcana Tertua','price'=>'380 gold'],
            ['id'=>22,'name'=>'Buku Penenun Mimpi','price'=>'320 gold'],
            ['id'=>23,'name'=>'Buku Pengikatan Roh Abadi','price'=>'440 gold'],
            ['id'=>24,'name'=>'Buku Sihir Darah Hitam','price'=>'480 gold'],
            ['id'=>25,'name'=>'Buku Sihir Glamour Memikat','price'=>'300 gold'],
            ['id'=>26,'name'=>'Buku Sihir Psionik Pikiran','price'=>'370 gold'],
            ['id'=>27,'name'=>'Buku Pembuatan Glyph Magis','price'=>'290 gold'],
            ['id'=>28,'name'=>'Buku Pembuatan Ward Pelindung','price'=>'310 gold'],
            ['id'=>29,'name'=>'Buku Projeksi Astral','price'=>'420 gold'],
            ['id'=>30,'name'=>'Buku Sihir Alkemi Purifikasi','price'=>'260 gold'],
        ];
    }
}
