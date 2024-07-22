# Constituency Explorer

sss

## Installation

1. Clone repository.
2. Install dependencies.

```sh
npm ci
composer install
```

3. Create `.env`

```sh
cp .env.example .env
```

4. Generate app key

```sh
php artisan key:generate
```

5. Run migrations

```sh
php artisan migrate
```

### Import data

```sh
php artisan import:constituencies parliament_con_2025.csv

php artisan import:localauthorities  local_authority_districts.csv

php artisan import:pivot overlap_local_authorities_cons_2025.csv

php artisan import:charities CharityBase_6a177e34883233ee698fa2b9a69a34d4.csv
```

### Assets

```sh
npm run dev   # Local development build, runs a watcher
npm run build # Production build, commit to Git
```
