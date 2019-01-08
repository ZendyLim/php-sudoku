# PHP SUDOKU
This project is created with Laravel + Vue. You can create your own Sudoku puzzles and solve puzzles made by other 
people.

## Development Environment
- PHP 7.3
- Node.JS 10.14.2 (npm 6.4.1)
- Vagrant 2.2
- VirtualBox 6.0.0

## Setup Guide

### Clone Repository
```
git clone git@github.com:ZendyLim/php-sudoku.git      # With SSH
```

```
git clone https://github.com/ZendyLim/php-sudoku.git     # With HTTPS
```

### Install Dependencies
```
composer install
```

### Install Node Dependencies
```
npm install
```

### Build JS files
```
npm run dev     # Single run
npm run watch   # Run with wather
```

### Initialize Homestead
```
vendor/bin/homestead make     # Initialize Homestead.yaml
```

Open up `Homestead.yaml` file and edit the value as you wish.

```
vagrant up    # Initialize VM
```

### Setup Hosts File
Open up `hosts` file based on your OS and add IP from your `Homestead.yaml` into the file with the domain.
```
192.168.100.100   sudoku.test     # Sample only
```

### Generate your .env
SSH into the VM
```
vagrant ssh
```

Copy `.env.example` to `.env` by running script below
```
cd code       # Your path might differs
cp .env.example .env
php artisan key:generate    # Create app key
```

