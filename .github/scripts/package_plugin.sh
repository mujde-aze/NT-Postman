#!/bin/bash

set -e

mkdir "$PACKAGE_NAME"
cp -r nt-postman.php LICENSE tile site-link magic-link documentation version-control.json "$PACKAGE_NAME"/
zip -r "$PACKAGE_NAME".zip "$PACKAGE_NAME"
