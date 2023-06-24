<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class ScrapeController extends Controller
{
    public function coba()
    {
        // $client = new Client();

        // $website = $client->request('GET', 'https://www.businesslist.com.ng/category/interior-design/city:lagos');

        // $data = $website->filter('.with_img')->each(function ($node) {
        //     $nama = $node->filter('h4')->text();
        //     $alamat = $node->filter('.address')->text();
        //     $image = $node->filter('.details > a ')->attr('href');

        //     return [
        //         'nama' => $nama,
        //         'alamat' => $alamat,
        //         'gambar' => $image
        //     ];
        // });

        // dd($data);

        // $url = "https://kreasijabar.id/uploads/ekraf_products/7c5983715f7534934602de15ce29f157.png";
        // $contents = file_get_contents($url);
        // $name = 'tes/'.substr($url, strrpos($url, '/') + 1);
        // // file_put_contents($name,$contents);
        // dd(file_put_contents($name,$contents));

        $client = new Client();

        $url = 'https://www.tiket.com/hotel/search?room=1&adult=1&checkin=2023-05-31&checkout=2023-06-01&type=CITY&q=Bandung&id=bandung-108001534490276290';

        $crawler = $client->request('GET', $url);

        $data = $crawler->filter('.ProductCard_container__Ll1Py')->each(function ($node) {
            $nama = $node->filter('.ProductDetails_product_details__I2_hA > .ProductDetails_product_info__bB7vW > div > .ProductDetails_product_name_container__Z_ssS')->text();
            $alamat = $node->filter('.ProductDetails_product_details__I2_hA > .ProductDetails_product_info__bB7vW > div > .ProductDetails_address_desktop__iSJue > .ProductDetails_address__bnYQH')->text();

            return [
                'nama' => $nama,
                'alamat' => $alamat
            ];
        });

        dd($data);

    }
}
