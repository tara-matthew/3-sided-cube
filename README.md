## You will need to: 

* Install php 8.1
* Run `composer install`

## To run the program:

```
$ chmod a+x bin/converter
$ bin/converter convert-temperature {temperatureValue}
```

## For negative temperature values:

```
$ bin/converter convert-temperature -- {temperatureValue}
```

## Observations/Notes

* There was a bug on Windows in the webmozart package. I had to change l.823 of vendor/webmozart/console/src/Api/Config/ApplicationConfig.php to `return ucwords(preg_replace('~[\s/-_]+~', ' ', $this->name));`.

* I didn't want to amend the package files and go committing those changes, so it's a change worth making locally if you want to run the command on Windows (there was no need to change anything on a Mac).

* I noticed that this package hadn't had any updates for a few years, otherwise I would have submitted an issue.

## Tests

* The `TemperatureCommandHandlerTest` encompasses my attempt to test the command handler

* Because of this file, the console will wait for output when you run the tests (simply press enter). 
I had trouble mocking a user response, as the only documentation I could find was related to the underlying Symfony console, 
rather than this package specifically.

I would be interested in discussing this with you!

## Future plans

* Allow for other units of measurement.
* Allow a user to enter another temperature after their first one has been converted.
* Style the console.
* Learn more about this package and the underlying Symfony console.
* Explore PHP enums in more detail, as they were only added recently! I'd love to discuss this new feature wih you.
* Overall this was a very enjoyable task!




