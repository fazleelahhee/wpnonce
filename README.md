# WP Nonce

This is an oop version WP Nonce from Inpsyde. 

## Getting Started

Copy this below code snipped to your composer.json file and run "composer update" this package load in your vendor directory.

```
"repositories": [
    {
        "type": "package",
        "package": {
            "name": "fazleelahhee/wpnonce",
            "version": "dev-master",
            "source": {
                "url": "git://github.com/fazleelahhee/wpnonce.git",
                "type": "git",
                "reference": "master"
            },
            "autoload": {
                "psr-4": {
                      "Inpsyde\\": "src/"
                    }
            }
        }
    }
],


```

### How to use?

**Create nonce field:**
```
$wpnonce = new \Inpsyde\WPNonce();
$wpnonce->fieldField('wp_nonce_test_sction', 'wp_nonce_test_name', true, false);
```

**Create nonce url:**
```
$wpnonce = new \Inpsyde\WPNonce();
$wpnonce->getUrl('http://< domain name >/');
```

**Verify nonce** 
```
$wpnonce = new \Inpsyde\WPNonce();
$wpnonce->verify($nonce);
```

## Authors

* **Fazle Elahee**


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
