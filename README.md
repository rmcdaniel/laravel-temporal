# Laravel Temporal Example

## Start Temporal

```bash
curl -sSf https://temporal.download/cli.sh | sh
/home/sail/.temporalio/bin/temporal server start-dev
```

## Start Workers

```bash
./vendor/bin/rr get-binary
./rr serve
```

## Start Workflow

```bash
php artisan workflow:start
```
