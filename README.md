```
composer install
symfony console doctrine:migrations:migrate --no-interaction
symfony console doctrine:fixtures:load --no-interaction
symfony serve -d
```

go to https://127.0.0.1:8000/product/test or whatever `symfony serve` is showing
and to https://127.0.0.1:8000/custom-product/test

Open each url twice