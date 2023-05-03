#!/bin/bash
composer install
/var/www/html/vendor/bin/rr get-binary
curl -sSf https://temporal.download/cli.sh | sh
`export PATH="\$PATH:/home/sail/.temporalio/bin"`
`echo export PATH="\$PATH:/home/sail/.temporalio/bin" >> ~/.bashrc`
