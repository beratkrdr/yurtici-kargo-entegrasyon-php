<!-- MARKDOWN LINKS & IMAGES -->
[project-logo-url]: https://www.isgkitapdunyasi.com/dist/img/icons/yurtici-icon.svg
[project-url]: https://github.com/beratkrdr/yurtici-kargo-entegrasyon-php

[github-url]: https://github.com/beratkrdr/
[linkedin-url]: https://www.linkedin.com/in/beratkirdar/
[mail]: mailto:beratkrdr@hotmail.com

[contributors-url]: https://github.com/beratkrdr/yurtici-kargo-entegrasyon-php/graphs/contributors
[forks-url]: https://github.com/beratkrdr/yurtici-kargo-entegrasyon-php/network/members
[stars-url]: https://github.com/beratkrdr/yurtici-kargo-entegrasyon-php/stargazers
[issues-url]: https://github.com/beratkrdr/yurtici-kargo-entegrasyon-php/issues
[license-url]: https://github.com/beratkrdr/yurtici-kargo-entegrasyon-php/blob/master/LICENSE.txt


<!-- PROJECT TOP -->
[![Contributors](https://img.shields.io/github/contributors/beratkrdr/yurtici-kargo-entegrasyon-php.svg?style=for-the-badge)][contributors-url]
[![Forks](https://img.shields.io/github/forks/beratkrdr/yurtici-kargo-entegrasyon-php.svg?style=for-the-badge)][forks-url]
[![Stargazers](https://img.shields.io/github/stars/beratkrdr/yurtici-kargo-entegrasyon-php.svg?style=for-the-badge)][stars-url]
[![Issues](https://img.shields.io/github/issues/beratkrdr/yurtici-kargo-entegrasyon-php.svg?style=for-the-badge)][issues-url]
[![MIT License](https://img.shields.io/github/license/beratkrdr/yurtici-kargo-entegrasyon-php.svg?style=for-the-badge)][license-url]
[![LinkedIn](https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555)][linkedin-url]


<!-- PROJECT LOGO -->
<p align="center">
  
  <a href="https://github.com/beratkrdr/yurtici-kargo-entegrasyon-php">
    <img src="https://www.isgkitapdunyasi.com/dist/img/icons/yurtici-icon.svg" alt="Logo" width="80" height="80">
  </a>
  
  <h1 align="center">Yurtiçi Kargo - Php Entegrasyon Kütüphanesi</h1>

  <p align="center">
    Bu kütüphane sayesinde Yurtiçi Kargo ile entegre bir şekilde kargo oluşturabilir, kargo durumunu sorgulayabilir ve kargonuzu iptal edebilirsiniz.
    <br />
    <br />
    <a href="#örnek-kodlar"><strong>Örnek Kodlar »</strong></a>
    <br />
    <a href="https://github.com/beratkrdr/yurtici-kargo-entegrasyon-php/issues">Hata Bildir</a>
    ·
    <a href="https://github.com/beratkrdr/yurtici-kargo-entegrasyon-php/issues">Öneri/İstek</a>
  </p>
</p>


<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary>İçindekiler</summary>
  <ul>
    <li><a href="#proje-hakkında">Proje Hakkında</a></li>
    <li>
      <a href="#örnek-kodlar">Örnek Kodlar</a>
      <ul>
        <li><a href="#kargo-oluşturma">Kargo Oluşturma</a></li>
        <li><a href="#kargo-sorgulama">Kargo Sorgulama</a></li>
        <li><a href="#kargo-iptal-etme">Kargo İptal Etme</a></li>
      </ul>
    </li>
    <li><a href="#iletişim">İletişim</a></li>
  </ul>
</details>


<!-- ABOUT THE PROJECT -->
<h1 id="proje-hakkında">Proje Hakkında</h1>

Bu kütüphane sayesinde Yurtiçi Kargo ile entegre bir şekilde kargo oluşturabilir, kargo durumunu sorgulayabilir ve kargonuzu iptal edebilirsiniz.


<!-- EXAMPLES -->
<h1 id="örnek-kodlar">Örnek Kodlar</h1>

<h3 id="örnek-kodlar">Kargo Oluşturma</h3>

```php
<?php
require_once "../src/class.php";

$yurtici = new yurticiKargo(array(
    'wsUserName'      => "{wsUserName}",
    'wsPassword'      => "{wsPassword}",
    'wsLanguage'      => "{wsLanguage}",    // Default: TR
    'cleanResult'     => true,              // Default: true [true/false]
    'testMode'        => true               // Default: false [true/false]
));

$response = $yurtici->createShipment(array(
    "cargoKey"          => "123456",
    'invoiceKey'        => "654321",
    'receiverCustName'  => "John Doe",
    'receiverAddress'   => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
    'cityName'          => "City",
    'townName'          => "Town",
    'receiverPhone1'    => "05554443322",
    'emailAddress'      => "johndoe@gmail.com",
    'orgReceiverCustId' => '9999'
));
?>
```


<h3 id="kargo-sorgulama">Kargo Sorgulama</h3>

```php
<?php
require_once "../src/class.php";

$yurtici = new yurticiKargo(array(
    'wsUserName'      => "{wsUserName}",
    'wsPassword'      => "{wsPassword}",
    'wsLanguage'      => "{wsLanguage}",    // Default: TR
    'cleanResult'     => true,              // Default: true [true/false]
    'testMode'        => true               // Default: false [true/false]
));

$response = $yurtici->queryShipment('123456', 0, false, true);
?>
```


<h3 id="kargo-iptal-etme">Kargo İptal Etme</h3>

```php
<?php
require_once "../src/class.php";

$yurtici = new yurticiKargo(array(
    'wsUserName'      => "{wsUserName}",
    'wsPassword'      => "{wsPassword}",
    'wsLanguage'      => "{wsLanguage}",    // Default: TR
    'cleanResult'     => true,              // Default: true [true/false]
    'testMode'        => true               // Default: false [true/false]
));

$response = $yurtici->cancelShipment('123456');
?>
```

<!-- CONTACT -->
<h1 id="iletişim">İletişim</h1>
Berat Kırdar

Proje Bağlantısı: [https://github.com/beratkrdr/yurtici-kargo-entegrasyon-php][project-url]

[![GitHub](https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white)][github-url]
[![LinkedIn](https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white)][linkedin-url]
[![Gmail](https://img.shields.io/badge/Gmail-D14836?style=for-the-badge&logo=gmail&logoColor=white)][mail]
