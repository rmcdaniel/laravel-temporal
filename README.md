# Laravel Temporal Example

## Install Dependencies

```bash
composer install
curl -sSf https://temporal.download/cli.sh | sh
echo export PATH="\$PATH:/home/sail/.temporalio/bin" >> ~/.bashrc
export PATH="\$PATH:/home/sail/.temporalio/bin"
./vendor/bin/rr get-binary
```

## Start Temporal

```bash
temporal server start-dev
```

## Start Workers

```bash
./rr serve
```

## Start Workflow

```bash
php artisan workflow:start
```

## Monitor Workflow

```bash
temporal workflow list
temporal workflow show -w simple-workflow
```
