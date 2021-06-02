#!/bin/bash

# Test installing this plugin using the Wordpress CLI, with a command like this
# one:
#
# wp plugin install --activate (github link)/archive/master.zip
#
# If this fails, we know we have an issue that we need to fix to make the plugin
# installable again

set -x
set -e

tmpdir=$(mktemp -d)

cd "$tmpdir"

curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
php wp-cli.phar --info
chmod +x wp-cli.phar

# Set up basic Wordpress installation:
./wp-cli.phar core download
./wp-cli.phar config create --force --dbname="$DB_NAME" --dbuser="$DB_USER" --dbpass="$DB_PASSWORD"
./wp-cli.phar core install --url=localhost --title=test --admin_user=admin --admin_email=example@example.com

# Install plugin
./wp-cli.phar plugin install --activate "$GITHUB_WORKSPACE/$PACKAGE_NAME".zip
