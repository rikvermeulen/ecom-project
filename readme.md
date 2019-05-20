# ecom-project-jaar-3-examen

Website Demo ecom-project-jaar-3-examen. installer lokaal voor complete toegang.

## Installatie

1. Clone de repository en `cd` in root map
2. `composer install`
3. hernoem of kopieer `.env.example` file naar `.env`
4. `php artisan key:generate`
5. zet jou database gegevens in je in `.env` file
6. stel Stripe in met deze test gegevens in je `.env` file. specifiek `STRIPE_KEY=pk_test_1gbuFbVe7ckatXh7dbgMeEWp00QxgnKmLB` en `STRIPE_SECRET=sk_test_dEsVoIBXvHh1YGhvF8oxNUQY00EO8Q6IL8`
7. stel jou `APP_URL` in jour `.env` file. dit is nootzakelijk voor admin page
8. start `php artisan migrate` en `php artisan db:seed` .dit zal alle database gegevens in je database zetten en test data aanleveren.
9. `npm install`
10. `npm run dev`
11. `php artisan serve` voor gebruik Laravel Valet of Laravel Homestead
12. Visit `localhost:8000` in your browser
13. bezoek `/admin` als je de backend admin pagina wil bezoeken.
