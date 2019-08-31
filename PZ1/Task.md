Create following project structure
```
.
├── src
|   ├── inc
|   |   └──Utilities.php
|   └── index.php
├── vendor
|   └── [Composer stuff...]
├── .gitignore (And add vendor dir to it)
└── composer.json
```

PHP Code sniffer documentation [here](https://github.com/squizlabs/PHP_CodeSniffer).
Everything you need to know, you can find there.

## What Utilities.php should contain?
- Namespace
- Class "Utilities"
- Public method that returns some string.
- Public method "getEurToCzk" with (strict typed) float input that defaults to null. If method input remains null, return current rate for 1 €. If input is not null, calculate value of inputted € in CZK, round in to two decimal places and return the value.

Currency API 
- https://api.exchangeratesapi.io/latest?base=EUR&symbols=CZK

### Another APIs:
- http://garbage.world/posts/libgen/
