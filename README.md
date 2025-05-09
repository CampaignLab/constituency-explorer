![](./thumbnail.png)

# Constituency Explorer

An app for people to explore the new UK constituency boundaries.

Data can be mapped to the new constituencies via a few different methods:

- [Mapped by Common Knowledge](https://mapped.commonknowledge.coop/)
- [MySociety Postcode Converter](https://pages.mysociety.org/2025-constituencies/postcode-converter)
- [MySociety postcodes](https://pages.mysociety.org/2025-constituencies/datasets/uk_parliament_2025_postcode_lookup/latest)
- [ONS postcodes](https://geoportal.statistics.gov.uk/datasets/a8a2d8d31db84ceea45b261bb7756771/about)
- [ONS Postcode to Westminster Parliamentary Constituencies](https://geoportal.statistics.gov.uk/search?q=postcode%20to%20constituency)

## Data sets

- [New constituencies](https://geoportal.statistics.gov.uk/datasets/9a876e4777bc47e392e670a7b8bc3f5c_0/explore)
- [Old constituencies](https://geoportal.statistics.gov.uk/datasets/b2498c2781134c87a7d7648045ed3252_0/explore)
- [Local Authority Districts](https://geoportal.statistics.gov.uk/datasets/e8b361ba9e98418ba8ff2f892d00c352_0/explore)
- [Overlaps](https://pages.mysociety.org/2025-constituencies/datasets/geographic_overlaps/latest)
- [Population](https://check.justregister.org.uk/)
- [Charities](https://search.charitybase.uk/chc?download=f)
- [UK towns](https://drive.google.com/file/d/1AeRnZSxRrVxPBSLeF3QQScrdRZ8GJhkl/view)
- [Dentists (England)](https://raw.githubusercontent.com/CampaignLab/New-Constituency-Almanac/main/data/dentists%20england%20mapped.csv?token=GHSAT0AAAAAACML3AZO3A7GSRXGNL7VEXBIZU6AQPA)
- [Hospitals (Scotland)](https://github.com/CampaignLab/New-Constituency-Almanac/blob/main/data/hospitals%20in%20scotland%20by%20constituency.csv)
- [Hospitals (England)](https://github.com/CampaignLab/New-Constituency-Almanac/blob/main/data/english%20hospitals%20by%20constituency.csv)
- [Schools in England](https://www.gov.uk/government/publications/schools-in-england)
- [Schools in Scotland](https://www.data.gov.uk/dataset/9a6f9d86-9698-4a5d-a2c8-89f3b212c52c/scottish-school-roll-and-locations)

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

On a fresh installation, you can use the following command to import all datasets at once.

```sh
php artisan import:data
```

If you wish to import datasets separately, e.g. after pulling, use the following commands:

```sh
php artisan import:constituencies
php artisan import:local-authorities
php artisan import:pivot
php artisan import:charities
php artisan import:towns
php artisan import:constituency-town-mappins
php artisan import:old-constituencies
php artisan import:old-constituency-overlaps
php artisan import:dentists
php artisan import:english-hospitals
php artisan import:scottish-hospitals
php artisan import:english-schools
php artisan import:scottish-schools
php artisan import:green-spaces
php artisan import:constituencies-population
php artisan import:parliament-constituency-ids
```

### Assets

```sh
npm run dev   # Local development build, runs a watcher
npm run build # Production build, commit to Git
```
