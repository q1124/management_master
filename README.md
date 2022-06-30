# morimoriex
![千森集運系統](https://i.imgur.com/NeYYuwG.jpg)
![千森集運系統](https://i.imgur.com/iED5MIF.jpg)
![千森集運系統](https://i.imgur.com/D4p4jMj.jpg)

日本千森集運系統

morimoriex [link](https://cms.morimoriex.com/)

## Technique & skill
* Html
* CSS
* JS
* PHP
* Laravel


專案建置
- 請先執行composer install安裝
```
composer install
```
- 複製.env.example檔案
```
cp .env.example .env
```
- 編輯.env檔案，填入DB相關連線資料
```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=management
DB_USERNAME=root
DB_PASSWORD=
```
- 建置資料庫
```
php artisan migrate --seed
```

abc# management_master
