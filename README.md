![Build Status](https://travis-ci.org/Antoine07/hiCode.svg?branch=master)

# hiCode

## Requirements

* PHP >=5.6 
* there are tests just for part testing into directory dev2/testing

## Behat

You can see this one on a directory dev2/behat. Must be installed selenium2 not IDE just server.
For testing this examples you must start selenium with this command: java -jar selenium.

Discovery, simples examples to manage Scenario with Behat Mink and Selenium.
You must change require on reuire-dev into composer.json file if you wont to test with a specific dev/prod

Some commands with Behat:

# see commands in english
vendor/bin/behat -dl --lang=en

# start tests
 vendor/bin/behat