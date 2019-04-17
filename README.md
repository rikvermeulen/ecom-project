# ecom-project-jaar-3-examen

website demo voor techniek college rotterdam - stage opdracht leerjaar 3

## Installatie

1. Clone de repository en `cd` in root map
1. `composer install`
1. hernoem of kopieer `.env.example` file naar `.env`
1. `php artisan key:generate`
1. zet jou database gegevens in je in `.env` file
1. stel Stripe in met deze test gegevens in je `.env` file. specifiek `STRIPE_KEY=pk_test_1gbuFbVe7ckatXh7dbgMeEWp00QxgnKmLB` en `STRIPE_SECRET=sk_test_dEsVoIBXvHh1YGhvF8oxNUQY00EO8Q6IL8`
1. stel jou `APP_URL` in jour `.env` file. dit is nootzakelijk voor admin page
1. start `php artisan migrate` en `php artisan db:seed` .dit zal alle database gegevens in je database zetten en test data aanleveren.
1. `npm install`
1. `npm run dev`
1. `php artisan serve` voor gebruik Laravel Valet of Laravel Homestead
1. Visit `localhost:8000` in your browser
1. bezoek `/admin` als je de backend admin pagina wil bezoeken.
