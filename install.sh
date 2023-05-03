#!/bin/bash
composer install
/var/www/html/vendor/bin/rr get-binary
curl -sSf https://temporal.download/cli.sh | sh
echo export PATH="\$PATH:/home/sail/.temporalio/bin" >> ~/.bashrc
echo export PATH="\$PATH:/var/www/html" >> ~/.bashrc
