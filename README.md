# Cefr
CEFR (Common European Framework of Reference for Languages) operations.

This class helps to do arithmetic on CEFR language proficecy values, e.g take the average of, for example, B2 and C1 (see example below).

More information about CEFR:
https://en.wikipedia.org/wiki/Common_European_Framework_of_Reference_for_Languages

Example:

```php
use Dream\Cefr;
$avg = (
	Cefr::toNum('B2') +
	Cefr::toNum('C1')
) / 2;
return Cefr::fromNum($avg); // 'B2+' 
```
