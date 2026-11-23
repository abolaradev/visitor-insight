# VisitorInsight

**VisitorInsight** is a Laravel package designed to collect and organize visitor information into structured Collections. It provides information about authenticated users, IP addresses, client devices, browsers, geographic locations, and timezones.

## Installation

Install the package via Composer:

```bash
composer require abolaradev/visitor-insight
```

## Usage

Retrieve the visitor's profile:

```php
$visitor = Visitor::profile();
```

The `profile()` method returns a `VisitorCollection` containing the following information:

| Key | Collection / Type | Description |
|---|---|---|
| `user` | Authenticatable / null | Authenticated user information |
| `ip` | string | Visitor's IP address |
| `client` | ClientCollection | Browser, platform, device, and User-Agent information |
| `location` | LocationCollection / null | Geographic location information |
| `timezone` | string / null | Visitor's timezone |

**IP Address:** In the local development environment, the public IP address is retrieved from [ipify](https://api.ipify.org). This external request may introduce a slight delay in the execution of `profile()`. In the production environment, the IP address is retrieved directly from Laravel's request using `request()->ip()`.

### Available Collection Methods

Each Collection provides dedicated methods to access its data. To use a nested Collection, first retrieve it using the corresponding method from its parent Collection.

#### VisitorCollection

| Method | Description |
|---|---|
| `getAuthUser()` | Get the authenticated user |
| `getIp()` | Get the visitor's IP address |
| `getClient()` | Get client information |
| `getLocation()` | Get location information |
| `getTimezone()` | Get the visitor's timezone |

Example:

```php
$visitor = Visitor::profile();

$user = $visitor->getAuthUser();
$ip = $visitor->getIp();
$client = $visitor->getClient();
$location = $visitor->getLocation();
$timezone = $visitor->getTimezone();
```

#### ClientCollection

| Method | Description |
|---|---|
| `getUserAgent()` | Get the User-Agent |
| `getDevice()` | Get device information |
| `getPlatform()` | Get the operating system |
| `getBrowser()` | Get the browser name |

Example:

```php
$client = Visitor::profile()
    ->getClient();

$userAgent = $client->getUserAgent();
$device = $client->getDevice();
$platform = $client->getPlatform();
$browser = $client->getBrowser();
```

#### DeviceCollection

| Method | Description |
|---|---|
| `getDeviceType()` | Get the device type |
| `getDeviceFamily()` | Get the device family |
| `getDeviceModel()` | Get the device model |

Example:

```php
$device = Visitor::profile()
    ->getClient()
    ->getDevice();

$type = $device->getDeviceType();
$family = $device->getDeviceFamily();
$model = $device->getDeviceModel();
```

#### LocationCollection

| Method | Description |
|---|---|
| `getPlaceId()` | Get the OpenStreetMap place ID |
| `getLatitude()` | Get the geographic latitude |
| `getLongitude()` | Get the geographic longitude |
| `getFullAddress()` | Get the full formatted address |
| `getRoad()` | Get the road name |
| `getSuburb()` | Get the suburb |
| `getCity()` | Get the city |
| `getDistrict()` | Get the district |
| `getCounty()` | Get the county |
| `getState()` | Get the state |
| `getStateCode()` | Get the state code |
| `getPostcode()` | Get the postal code |
| `getCountry()` | Get the country name |
| `getCountryCode()` | Get the country code |

Example:

```php
$location = Visitor::profile()
    ->getLocation();

$latitude = $location->getLatitude();
$longitude = $location->getLongitude();
$city = $location->getCity();
$country = $location->getCountry();
```

## Geographic Location

VisitorInsight requires geographic coordinates (latitude and longitude) to retrieve both the visitor's location information and timezone.

**You must set the coordinates before calling `Visitor::profile()`.** Without coordinates, both `location` and `timezone` will return `null`.

```php
Visitor::location($latitude, $longitude);

$visitor = Visitor::profile();
```

The package uses [OpenStreetMap Nominatim](https://nominatim.openstreetmap.org/reverse) for reverse geocoding.

Location information retrieved through reverse geocoding is cached for **7 days** to reduce repeated API requests and improve performance.


If you find this package useful, please don't forget to give it a ⭐ on GitHub. ❤️

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) for information on how to report security vulnerabilities.

## Credits

* [abolaradev](https://github.com/abolaradev)

* [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
