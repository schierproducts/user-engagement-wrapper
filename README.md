# Schier User Engagement Platform API wrapper

This package is an API wrapper for the Schier User Engagement platform API.

## Installation

You can install the package via composer:

```bash
composer require schierproducts/user-engagement-api-wrapper
```

## Usage

TODO

### Security

If you discover any security related issues, please email doug@builtwellstudio.com instead of using the issue tracker.

### Example Commands

To import the available engineers

```bash
user-engagement:import-engineers
```

To add Logged In event

```bash
user-engagement:import-events activity_log description loggedIn --user=causer_id
```

To add Signed Up event

```bash
user-engagement:import-events users created_at signedUp --user=id
```

To add Project Created event

```bash
user-engagement:import-events configurations created_at createProject --user=created_by --project
```

To add Kickout Viewed event

```bash
user-engagement:import-events configurations kickout_viewed viewedKickout --query=true --user=created_by --project
```

To add Address Added event

```bash
user-engagement:import-events configurations street_address addedAddress --exists --user=created_by --project
```

To add Project Submitted event

```bash
user-engagement:import-events configurations submitted_at submittedPreApproval --exists --user=created_by --project
```

To add Project Closed event

```bash
user-engagement:import-events configurations status closeProject --query=closed --user=created_by --project
```

To add Notes Added event

```bash
user-engagement:import-events configurations pre_approval_notes addedNote --exists --user=created_by --project
```
