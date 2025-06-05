![](./thumbnail.png)

# Constituency Explorer

An app for people to explore the new UK constituency boundaries.

Data can be mapped to the new constituencies via a few different methods:

- [Mapped by Common Knowledge](https://mapped.commonknowledge.coop/)
- [MySociety Postcode Converter](https://pages.mysociety.org/2025-constituencies/postcode-converter)
- [MySociety postcodes](https://pages.mysociety.org/2025-constituencies/datasets/uk_parliament_2025_postcode_lookup/latest)
- [ONS postcodes](https://geoportal.statistics.gov.uk/datasets/a8a2d8d31db84ceea45b261bb7756771/about)
- [ONS Postcode to Westminster Parliamentary Constituencies](https://geoportal.statistics.gov.uk/search?q=postcode%20to%20constituency)

## Datasets

### Geographical Datasets

| Dataset | Source | Fixture file | Import command |
|---------|--------|--------------|----------------|
| New (post-July 2024) constituencies | [ONS](https://geoportal.statistics.gov.uk/datasets/9a876e4777bc47e392e670a7b8bc3f5c_0/explore) | [parliament_con_2025.csv](https://github.com/CampaignLab/constituency-explorer/blob/refs/heads/main/database/fixtures/parliament_con_2025.csv) | [`import:constituencies`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportConstituencies.php) |
| Constituency populations | [Just Register](https://check.justregister.org.uk/) | [constituencies_population.csv](https://github.com/CampaignLab/constituency-explorer/blob/refs/heads/main/database/fixtures/constituencies_population.csv) | [`import:constituencies-population`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportConstituenciesPopulation.php) |
| Constituency shapefiles | - | [pcon24.geojson](https://github.com/CampaignLab/constituency-explorer/blob/refs/heads/main/database/fixtures/pcon24.geojson) | [`import:constituency-geojson`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportConstituencyGeojsonCommand.php) |
| Parliament constituency IDs | [UK Parliament API](https://members-api.parliament.uk/index.html) | - | [`import:parliament-constituency-ids`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportParliamentConstituencyIds.php) |
| Old (pre-July 2024) constituencies | [ONS](https://geoportal.statistics.gov.uk/datasets/b2498c2781134c87a7d7648045ed3252_0/explore) | [Westminster_Parliamentary_Constituencies[...].csv](https://github.com/CampaignLab/constituency-explorer/blob/main/database/fixtures/Westminster_Parliamentary_Constituencies_(December_2023)_Names_and_Codes_in_the_UK.csv) | [`import:old-constituencies`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportOldConstituenciesCommand.php) |
| Old constituency overlaps | [MySociety](https://pages.mysociety.org/2025-constituencies/datasets/geographic_overlaps/latest) | [PARL10_PARL25_combo_overlap.csv](https://github.com/CampaignLab/constituency-explorer/blob/main/database/fixtures/PARL10_PARL25_combo_overlap.csv) | [`import:old-constituency-overlaps`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportOldConstituencyOverlapsCommand.php) |
| Local Authorities Districts | [ONS](https://geoportal.statistics.gov.uk/datasets/e8b361ba9e98418ba8ff2f892d00c352_0/explore) | [local_authority_districts.csv](https://github.com/CampaignLab/constituency-explorer/blob/main/database/fixtures/local_authority_districts.csv) | [`import:local-authorities`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportLocalAuthorities.php) |
| Constituency -> Local authority mappings | [MySociety](https://pages.mysociety.org/2025-constituencies/datasets/geographic_overlaps/latest) | [overlap_local_authorities_cons_2025.csv](https://github.com/CampaignLab/constituency-explorer/blob/main/database/fixtures/overlap_local_authorities_cons_2025.csv) | [`import:constituency-local-authority-pivot-data`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportConstituencyLocalAuthorityPivotData.php) |

### Place Datasets

| Dataset | Source | Fixture file | Fields | Import command |
|---------|--------|--------------|--------|----------------|
| Charities | [CharityBase](https://search.charitybase.uk/chc?download=f) | [CharityBase_6a177[...].csv](https://github.com/CampaignLab/constituency-explorer/blob/refs/heads/main/database/fixtures/CharityBase_6a177e34883233ee698fa2b9a69a34d4.csv) | Charity ID, Name, Registered, Financial Year, Address, Constituency ID | [`import:charities`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportCharities.php) |
| Towns | [Unknown (Campaign Lab)](https://drive.google.com/file/d/1AeRnZSxRrVxPBSLeF3QQScrdRZ8GJhkl/view) | [uktowns.csv](https://github.com/CampaignLab/constituency-explorer/blob/main/database/fixtures/uktowns.csv) |  | [`import:towns`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportTownsCommand.php) |
| Constituency town mappings | - | [towns-map.csv](https://github.com/CampaignLab/constituency-explorer/blob/refs/heads/main/database/fixtures/towns-map.csv) | Constituency name, Town name | [`import:constituency-town-mappings`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportConstituencyTownMappingsCommand.php) |
| Dentists (England) | [Unknown (CampaignLab)](https://github.com/CampaignLab/New-Constituency-Almanac/blob/main/data/dentists%20england%20mapped.csv) | [dentists-england.csv](https://github.com/CampaignLab/constituency-explorer/blob/refs/heads/main/database/fixtures/dentists-england.csv) | Name, Address, Postcode, Latitude, Longitude, Constituency ID | [`import:dentists`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportDentistsCommand.php) |
| Hospitals (England) | [Unknown (CampaignLab)](https://github.com/CampaignLab/New-Constituency-Almanac/blob/main/data/english%20hospitals%20by%20constituency.csv) | [hospitals-england.csv](https://github.com/CampaignLab/constituency-explorer/blob/refs/heads/main/database/fixtures/hospitals-england.csv) | Name, Address, Postcode, Latitude, Longitude, Constituency ID | [`import:english-hospitals`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportEnglishHospitalsCommand.php) |
| Hospitals (Scotland) | [Unknown (CampaignLab)](https://github.com/CampaignLab/New-Constituency-Almanac/blob/main/data/hospitals%20in%20scotland%20by%20constituency.csv) | [hospitals-scotland.csv](https://github.com/CampaignLab/constituency-explorer/blob/refs/heads/main/database/fixtures/hospitals-scotland.csv) | Name, Address, Postcode, Latitude, Longitude, Constituency ID | [`import:scottish-hospitals`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportScottishHospitalsCommand.php) |
| Schools (England) | [Gov.uk](https://get-information-schools.service.gov.uk/Downloads) | [schools-england.csv](https://github.com/CampaignLab/constituency-explorer/blob/refs/heads/main/database/fixtures/schools-england.csv) | Name, Phase of education, Gender, Latitude, Longitude, Constituency ID | [`import:english-schools`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportEnglishSchoolsCommand.php) |
| Schools (Scotland) | [Gov.uk](https://www.data.gov.uk/dataset/9a6f9d86-9698-4a5d-a2c8-89f3b212c52c/scottish-school-roll-and-locations) | [schools-scotland.xlsx](https://github.com/CampaignLab/constituency-explorer/blob/refs/heads/main/database/fixtures/schools-scotland.xlsx) | Name, Phase of education, Latitude, Longitude, Constituency ID | [`import:scottish-schools`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportScottishSchoolsCommand.php) |
| Community centres | - | [community-centres.csv](https://github.com/CampaignLab/constituency-explorer/blob/refs/heads/main/database/fixtures/community-centres.csv) | Name, Religion, Denomination, Postcode, Latitude, Longitude, Constituency ID | [`import:community-centres`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportCommunityCentres.php) |
| Places of worship | - | [places-of-worship.csv](https://github.com/CampaignLab/constituency-explorer/blob/refs/heads/main/database/fixtures/places-of-worship.csv) | Name, Religion, Denomination, Postcode, Latitude, Longitude, Constituency ID | [`import:places-of-worship`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportPlacesOfWorship.php) |
| Green spaces | - | [green-spaces.csv](https://github.com/CampaignLab/constituency-explorer/blob/refs/heads/main/database/fixtures/green-spaces.csv) | Name, Opening hours, Postcode, Latitude, Longitude, Constituency ID | [`import:green-spaces`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportGreenSpaces.php) |
| Local media | - | [local-media.csv](https://github.com/CampaignLab/constituency-explorer/blob/refs/heads/main/database/fixtures/local-media.csv) | Name, Address, Twitter, Type of owner, Frequency, Cost, Media Type, Website, Local Authority ID, Constituency ID | [`import:local-media`](https://github.com/CampaignLab/constituency-explorer/blob/main/app/Console/Commands/ImportLocalMedia.php) |

> [!IMPORTANT]
> Shortly before the boundary change in July 2024, the GSS codes for five constituencies were changed (for more details, see: [issue #35](https://github.com/CampaignLab/constituency-explorer/issues/35)).
>
> This site launched using the previous codes for these five constituencies, but the underlying datasets have since been updated to reflect the change.

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
php artisan import:constituencies-population
php artisan import:constituency-geojson
php artisan import:parliament-constituency-ids
php artisan import:old-constituencies
php artisan import:old-constituency-overlaps
php artisan import:local-authorities
php artisan import:constituency-local-authority-pivot-data
php artisan import:charities
php artisan import:towns
php artisan import:constituency-town-mappings
php artisan import:dentists
php artisan import:english-hospitals
php artisan import:scottish-hospitals
php artisan import:english-schools
php artisan import:scottish-schools
php artisan import:community-centres
php artisan import:places-of-worship
php artisan import:green-spaces
php artisan import:local-media
```