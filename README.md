# WP Nonce

This is an oop version WP Nonce from Inpsyde. 

## Getting Started

Copy this below code snipped to your composer.json file and run composer update to load it in your vendor directory.

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
                "psr-0" : {
                    "Inpsyde\\WPNonce" : "src"
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
$wpnonce->createField();
```

**Create nonce url:**
```
$wpnonce = new \Inpsyde\WPNonce();
$wpnonce->createUrl();
```

**Verify nonce** 
```
$wpnonce = new \Inpsyde\WPNonce();
$wpnonce->verify();
```

## Authors

* **Fazle Elahee**


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
