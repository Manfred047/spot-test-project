## INSTRUCCIONES
1. Ejecutar `php artisan migrate`
2. Ejecutar `php artisan db:seed`

### API PARA CONSULTA
- https://spot-laravel-test.herokuapp.com/api/price-m2/zip-codes/{zipCode}/aggregate/{aggregate}?construction_type={constructionType}

### EJEMPLO: 
- https://spot-laravel-test.herokuapp.com/api/price-m2/zip-codes/7800/aggregate/max?construction_type=4
