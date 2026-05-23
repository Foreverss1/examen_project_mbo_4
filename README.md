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
de eisen voor dit project was(sit is een stuk uit de plan van eisen van dit project):  
Accountsysteem 
Inloggen:
Dit is er nodig om in te loggen
    • Email 
    • Wachtwoord 
        ◦ Moet encryptie zijn.
Rollen:
Dit zijn de rollen en de dingen die ze kunnen doen(als een functie er niet instaat mag die rol het niet doen):
    • gast 
        ◦ kan een account maken op de website 
        ◦ kan reservering maken en die beheren 
    • medewerker
        ◦ kan reserveringen beheren en aanmaken
    • administrator
        ◦ heel de applicatie beheren
        ◦ medewerkers accounts aan maken 
        ◦ kan financiële administratie zien en beheren

Reserveringsysteem
    • Kanten kunnen reservering maken.
        ◦ Kan reservering terug zien.
        ◦ Kan eigen reservering bewerken.
        ◦ Kan eigen reservering annuleren.
    • Medewerken kunnen reserveringen maken. 
        ◦ Kan reserveringen terug zien 
        ◦ Kan  reserveringen beheren
        ◦ Kan reserveringen in zien
    • Bij reserveringen kan worden gekozen voor deze opties:
        ◦ Snackpakket (basis € 7,50 p.p. of luxe € 10,00 р.р.) 
        ◦ Kinderpartij (chips, cola en verrassing € 6,50 p.p.)
        ◦ Vrijgezellenfeest (4 consumpties € 15,00 p.p.)
    • Als er meerde banen worden gereserveerd moeten zo dicht bij elkaar komen.
    • Als klant reservatie maakt word er een baan aan gewezen(hij kan niet de baan kiezen).  
Style eisen 
