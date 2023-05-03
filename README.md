# Laravel Temporal Example

## Install Dependencies

```bash
bash install.sh
source ~/.bashrc
```

## Start Temporal

```bash
temporal server start-dev
```

## Start Workers

```bash
rr serve
```

## Start Workflow

```bash
php artisan workflow:start simple
```

## Monitor Workflow

```bash
temporal workflow list
temporal workflow show -w simple-workflow
```
