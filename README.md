<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## het project 
de eisen voor dit project was(sit is een stuk uit de plan van eisen van dit project):  <br/>
Accountsysteem <br/>
Inloggen:<br/>
Dit is er nodig om in te loggen<br/>
    • Email <br/>
    • Wachtwoord <br/>
        ◦ Moet encryptie zijn.<br/>
Rollen:<br/>
Dit zijn de rollen en de dingen die ze kunnen doen(als een functie er niet instaat mag die rol het niet doen):
    • gast <br/>
        ◦ kan een account maken op de website <br/>
        ◦ kan reservering maken en die beheren <br/>
    • medewerker<br/>
        ◦ kan reserveringen beheren en aanmaken<br/>
    • administrator<br/>
        ◦ heel de applicatie beheren<br/>
        ◦ medewerkers accounts aan maken <br/>
        ◦ kan financiële administratie zien en beheren<br/>

Reserveringsysteem.<br/>
    • Kanten kunnen reservering maken.<br/>
        ◦ Kan reservering terug zien.<br/>
        ◦ Kan eigen reservering bewerken.<br/>
        ◦ Kan eigen reservering annuleren.<br/>
    • Medewerken kunnen reserveringen maken. <br/>
        ◦ Kan reserveringen terug zien <br/>
        ◦ Kan  reserveringen beheren<br/>
        ◦ Kan reserveringen in zien<br/>
    • Bij reserveringen kan worden gekozen voor deze opties:<br/>
        ◦ Snackpakket (basis € 7,50 p.p. of luxe € 10,00 р.р.) <br/>
        ◦ Kinderpartij (chips, cola en verrassing € 6,50 p.p.)<br/>
        ◦ Vrijgezellenfeest (4 consumpties € 15,00 p.p.)<br/>
    • Als er meerde banen worden gereserveerd moeten zo dicht bij elkaar komen.<br/>
    • Als klant reservatie maakt word er een baan aan gewezen(hij kan niet de baan kiezen).  <br/>
Style eisen <br/>
