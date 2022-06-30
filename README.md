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
