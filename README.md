# AS207111 Whois for PHP

Geolocation, Proxy, VPN or Tor exit address detection, for free.

AS207111 provides a free Whois service for content customization, advertising, digital rights management, compliance, fraud & proxy detection, security and more.

You will always have the most accurate location data available for every API request, without having to worry about maintaining a local database. For Proxy, VPN or Tor exit address detection, we use machine learning & probability theory techniques using large datasets from different sources with 11,500+ networks from 2,200+ privacy providers.


## Installation

The recommended way to install AS207111 Whois is through Composer.

```bash
composer require as207111/whois
```

## Getting Started

First, request a free api access token from https://whois.as207111.net to get access to all api features, including all premium features, like privacy lookups.

Then initialize a new `Client` with your API Access Token and call the `whois` method to lookup any IPv4 or IPv6 address.

```php
use AS207111\Whois\Client;

require_once __DIR__ . '/vendor/autoload.php';

$client = new Client('your-api-access-token');

$ipAddress = '2001:67c:770::';

$result = $client->whois(['ip_address' => $ipAddress]);

if ($result->isSuccess()) {
    $usingVpn = $result->getData()->privacy->proxy;

    if ($usingVpn) {
        print(sprintf('%s is using a proxy service like vpn, proxy or tor!', $ipAddress));
    } else {
        print(sprintf('%s is not using a proxy service!', $ipAddress));
    }
} else {
    print('Cannot reach whois database.');
}
```

## API Response Reference



```json
{
    "ip": "2001:67c:770::1",
    "city": "Cologne",
    "postal": "50733",
    "region": "NW",
    "country": "DE",
    "lat": 50.9655,
    "lon": 6.95378,
    "timezone": "Europe/Berlin",
    "asn": {
        "asn": 207111,
        "name": "PREUSS-AS",
        "isp": "Rene Preuss",
        "network": "2001:67c:770::/48"
    },
    "company": {
        "name": "Rene Preuss"
    },
    "privacy": {
        "proxy": false,
        "hosting": false,
        "mobile": false
    }
}
```
