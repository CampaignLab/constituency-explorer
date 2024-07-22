# Constituency Explorer

An app for people to explore the new UK constituency boundaries.

## Data sets

- [New constituencies](https://geoportal.statistics.gov.uk/datasets/9a876e4777bc47e392e670a7b8bc3f5c_0/explore)
- [Old constituencies](https://geoportal.statistics.gov.uk/datasets/b2498c2781134c87a7d7648045ed3252_0/explore)
- [Local Authority Districts](https://geoportal.statistics.gov.uk/datasets/e8b361ba9e98418ba8ff2f892d00c352_0/explore)
- [Overlaps](https://pages.mysociety.org/2025-constituencies/datasets/geographic_overlaps/latest)
- [Charities](https://search.charitybase.uk/chc?download=f)

DRAFT:

```
Schools in England: https://www.gov.uk/government/publications/schools-in-england
Schools in Scotland: https://www.data.gov.uk/dataset/9a6f9d86-9698-4a5d-a2c8-89f3b212c52c/scottish-school-roll-and-locations
```

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
