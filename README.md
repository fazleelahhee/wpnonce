# WP Nonce

This is an oop version WP Nonce from Inpsyde. 

## Getting Started

Copy this below code snipped to your composer.json file and run "composer update" this package load in your vendor directory.

```
"repositories": [
    {
        "url": "https://github.com/fazleelahhee/wpnonce.git",
        "type": "git"
    }
],
"require": {
    "fazleelahhee/inpsyde": "@dev"
}

```

### How to use?

**Create nonce field:**
```
$wpnonce = new \Fazleelahhee\Inpsyde\WPNonce();
$wpnonce->fieldField('wp_nonce_test_sction', 'wp_nonce_test_name', true, false);
```

**Create nonce url:**
```
$wpnonce = new \Fazleelahhee\Inpsyde\WPNonce();
$wpnonce->getUrl('http://< domain name >/');
```

**Verify nonce** 
```
$wpnonce = new \Fazleelahhee\Inpsyde\WPNonce();
$wpnonce->verify($nonce);
```

## Authors

* **Fazle Elahee**


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
