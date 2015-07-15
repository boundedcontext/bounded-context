#!/bin/sh -e

DIR=$(dirname "$0")

$DIR/vendor/phpunit/phpunit/phpunit --colors --configuration tests/phpunit.xml