<!-- MARKDOWN LINKS & IMAGES -->
[project-logo-url]: /img/yurtici-logo.svg
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
[![Hits](https://shields-io-visitor-counter.herokuapp.com/badge?page=beratkrdr.yurtici-kargo-entegrasyon-php&color=017EC5&label=hits&logo=GitHub&logoColor=FFFFFF&style=for-the-badge)][project-url]
[![Downloads](https://img.shields.io/github/downloads/beratkrdr/yurtici-kargo-entegrasyon-php/total?color=blue&style=for-the-badge)][project-url]
[![Contributors](https://img.shields.io/github/contributors/beratkrdr/yurtici-kargo-entegrasyon-php.svg?style=for-the-badge)][contributors-url]
[![Forks](https://img.shields.io/github/forks/beratkrdr/yurtici-kargo-entegrasyon-php.svg?style=for-the-badge)][forks-url]
[![Stargazers](https://img.shields.io/github/stars/beratkrdr/yurtici-kargo-entegrasyon-php.svg?style=for-the-badge)][stars-url]
[![Issues](https://img.shields.io/github/issues/beratkrdr/yurtici-kargo-entegrasyon-php.svg?style=for-the-badge)][issues-url]
[![MIT License](https://img.shields.io/github/license/beratkrdr/yurtici-kargo-entegrasyon-php.svg?style=for-the-badge)][license-url]
[![LinkedIn](https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555)][linkedin-url]


<!-- PROJECT LOGO -->
<p align="center">
  
  <a href="https://github.com/beratkrdr/yurtici-kargo-entegrasyon-php">
    <img src="/img/yurtici-logo.svg" alt="Logo" width="80" height="80">
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
<h1>İçindekiler</h1>

<ul>
   <li><a href="#proje-hakkında">Proje Hakkında</a></li>
   <li>
     <a href="#örnek-kodlar">Örnek Kodlar</a>
     <ul>
        <li>
          <a href="#kargo-oluşturma">Kargo Oluşturma</a>
          <ul>
            <li><a href="#kargo-oluşturma-sonuç">Sonuç</a></li>
          </ul>
        </li>
        <li>
          <a href="#kargo-sorgulama">Kargo Sorgulama</a>
           <ul>
            <li><a href="#kargo-sorgulama-sonuç">Sonuç</a></li>
           </ul>
        </li>
        <li>
          <a href="#kargo-iptal-etme">Kargo İptal Etme</a>
          <ul>
            <li><a href="#kargo-iptal-etme-sonuç">Sonuç</a></li>
          </ul>
        </li>
      </ul>
   </li>
   <li><a href="#iletişim">İletişim</a></li>
</ul>


<!-- ABOUT THE PROJECT -->
<h1 id="proje-hakkında">Proje Hakkında</h1>

Bu kütüphane sayesinde Yurtiçi Kargo ile entegre bir şekilde kargo oluşturabilir, kargo durumunu sorgulayabilir ve kargonuzu iptal edebilirsiniz.

Yurtiçi Kargo entegrasyonu için gerekli olan web servis kullanıcı adı ve web servis şifresi için entegrasyon başvurusu yapmanız gerekmektedir. Entegrasyon dökümanını Yurtiçi Kargo pazarlama sorumlusundan alarak entegrasyon bilgilerine, parametrelere ve örneklere erişebilirsiniz.

Kodların sorunsuz çalışabilmesi için sunucunun 80 numaralı portu ve soket, openssl, SOAP, curl gibi eklentilerin açık olması gerekmektedir.


<!-- EXAMPLES -->
<h1 id="örnek-kodlar">Örnek Kodlar</h1>

<h4><em>Zorunlu Parametreler: </em></h4>

`wsUserName`  : Web servis kullanıcı adı

`wsPassword`  : Web servis şifresi

`wsLanguage`  : Web servis dil seçeneği (Örnek: 'TR')

`cleanResult` : Sonuç dizisinin daha yalın olmasını sağlar. (true/false)(Varsayılan: true)

`testMode`    : Test modu (true/false)

<b>NOT:</b> Yukarıdaki parametreler tüm örnekler için geçerlidir.

---

<h3 id="kargo-oluşturma">Kargo Oluşturma</h3>

<h4><em>Zorunlu Parametreler: </em></h4>

`cargoKey` : Kargo anahtarı (Her gönderi için benzersiz olmalıdır)

`invoiceKey` : Fatura anahtarı (Her gönderi için benzersiz olmalıdır)

`receiverCustName` : Alıcı adı (Min 5 karakter olmalı en az 4 harf içermelidir.)

`receiverAddress` : Alıcı adresi (Min 5 max 200 karakter olmalıdır. İl ve ilçe bilgisi cityName ve townName alanlarında gönderildiğinde bu alanda gönderilmemelidir.)

`receiverPhone1` : Alıcı telefon-1 (Alan kodu ile birlikte 10 adet rakamdan oluşmalıdır.)


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

<h4 id="kargo-oluşturma-sonuç">Sonuç</h4>

```
Array
(
    [outFlag] => 0
    [outResult] => Başarılı
    [count] => 1
    [jobId] => 2198077
    [shippingOrderDetailVO] => Array
        (
            [cargoKey] => 123456
            [invoiceKey] => 654321
        )

)
```

---


<h3 id="kargo-sorgulama">Kargo Sorgulama</h3>

<h4><em>Zorunlu Parametreler: </em></h4>

`keys` : Kargo/Fatura anahtarı

`keyType` : Keys parametresinde belirtilen anahtarların tipini belirler. 0 – Kargo Anahtarı / 1 – Fatura Anahtarı

`addHistoricalData` : Gönderiye ait taşıma hareketlerinin raporlanması için belirtilmelidir.

`onlyTracking` : Sadece takip linkinin raporlanmasını sağlar.


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

<h4 id="kargo-sorgulama-sonuç">Sonuç</h4>

```
Array
(
    [outFlag] => 0
    [outResult] => Başarılı
    [count] => 1
    [senderCustId] => 1010954
    [shippingDeliveryDetailVO] => Array
        (
            [cargoKey] => 123456
            [invoiceKey] => 654321
            [jobId] => 2198077
            [operationCode] => 0
            [operationMessage] => Kargo İşlem Görmemiş.
            [operationStatus] => NOP
        )

)
```

---


<h3 id="kargo-iptal-etme">Kargo İptal Etme</h3>

<h4><em>Zorunlu Parametreler: </em></h4>

`cargoKeys` : Kargo anahtarı

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

<h4 id="kargo-iptal-etme-sonuç">Sonuç</h4>

```
Array
(
    [outFlag] => 0
    [outResult] => Başarılı
    [count] => 1
    [senderCustId] => 1010954
    [shippingCancelDetailVO] => Array
        (
            [cargoKey] => 123456
            [docId] => 0
            [invoiceKey] => 654321
            [jobId] => 2198077
            [operationCode] => 3
            [operationMessage] => Verisi İptal Edilmiştir.Kargo Çıkışı Engellendi.
            [operationStatus] => CNL
        )

)
```



<!-- CONTACT -->
<h1 id="iletişim">İletişim</h1>
Berat Kırdar

Proje Bağlantısı: [https://github.com/beratkrdr/yurtici-kargo-entegrasyon-php][project-url]

[![GitHub](https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white)][github-url]
[![LinkedIn](https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white)][linkedin-url]
[![Gmail](https://img.shields.io/badge/Gmail-D14836?style=for-the-badge&logo=gmail&logoColor=white)][mail]
