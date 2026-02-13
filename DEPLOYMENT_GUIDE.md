# Deployment Guide for The Psycho Math

## Step 1: Initialize Git and Push to Remote Repository

### 1.1 Initialize Git Repository (if not already done)
```bash
cd "F:/Rohit Development/thepsychomath.org"
git init
```

### 1.2 Create .env.example file (for server reference)
The `.env` file is already in `.gitignore`, so create a template:
```bash
# Copy .env to .env.example (you'll need to remove sensitive values)
cp .env .env.example
```

### 1.3 Stage and Commit All Files
```bash
git add .
git commit -m "Initial commit: The Psycho Math website"
```

### 1.4 Create New Repository on GitHub/GitLab
- Go to GitHub (github.com) or GitLab (gitlab.com)
- Create a new repository named `thepsychomath.org` (or your preferred name)
- **DO NOT** initialize with README, .gitignore, or license (we already have files)
- Copy the repository URL (e.g., `https://github.com/yourusername/thepsychomath.org.git`)

### 1.5 Update Remote and Push
```bash
# Update remote URL to your new repository
git remote set-url origin https://github.com/rohit03993/thepsychomath.git
git branch -M main
git push -u origin main
```

---

## Step 2: Server Setup - Prerequisites Check

### 2.1 Access Server via SSH
From CloudPanel, use the SSH/FTP tab to get SSH credentials, or use:
```bash
ssh thepsychomath@72.60.201.175
```

### 2.2 Check Server Requirements
On the server, verify you have:
```bash
php -v          # Should be PHP 8.1 or higher
composer -v     # Composer should be installed
mysql --version # MySQL should be available
git --version   # Git should be installed
```

If Composer is not installed:
```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

---

## Step 3: Clone Repository on Server

### 3.1 Navigate to Web Root
```bash
cd /home/thepsychomath/htdocs
```

### 3.2 Backup Existing Files (if any)
```bash
# If index.php exists, backup it
mkdir -p ../backups
mv thepsychomath.org/index.php ../backups/index.php.backup 2>/dev/null || true
```

### 3.3 Clone Your Git Repository
```bash
# Remove existing directory if needed (be careful!)
rm -rf thepsychomath.org

# Clone your repository
git clone https://github.com/rohit03993/thepsychomath.git thepsychomath.org

# Navigate into the project
cd thepsychomath.org
```

---

## Step 4: Install Dependencies

### 4.1 Install PHP Dependencies via Composer
```bash
composer install --optimize-autoloader --no-dev
```

### 4.2 Install Node Dependencies (if using Vite)
```bash
npm install
npm run build
```

---

## Step 5: Configure Environment

### 5.1 Copy Environment File
```bash
cp .env.example .env
```

### 5.2 Edit .env File
```bash
nano .env
```

Update these key values:
```env
APP_NAME="The Psycho Math"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://thepsychomath.org

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=thepsychomath
DB_USERNAME=thepsychomath
DB_PASSWORD=your_database_password_here
```

### 5.3 Generate Application Key
```bash
php artisan key:generate
```

---

## Step 6: Database Setup

### 6.1 Create Database via CloudPanel
- Go to CloudPanel → Sites → thepsychomath.org → Databases
- Create a new database named `thepsychomath`
- Create a database user and grant privileges
- Note the database credentials

### 6.2 Run Migrations
```bash
php artisan migrate --force
```

### 6.3 Run Seeders
```bash
php artisan db:seed --force
```

---

## Step 7: File Permissions and Storage

### 7.1 Set Proper Permissions
```bash
# Set ownership
sudo chown -R thepsychomath:thepsychomath /home/thepsychomath/htdocs/thepsychomath.org

# Set directory permissions
find /home/thepsychomath/htdocs/thepsychomath.org -type d -exec chmod 755 {} \;

# Set file permissions
find /home/thepsychomath/htdocs/thepsychomath.org -type f -exec chmod 644 {} \;

# Storage and cache directories need write permissions
chmod -R 775 storage bootstrap/cache
```

### 7.2 Create Storage Link
```bash
php artisan storage:link
```

---

## Step 8: Configure Web Server

### 8.1 Update Document Root in CloudPanel
- Go to CloudPanel → Sites → thepsychomath.org → Settings
- Set **Document Root** to: `/home/thepsychomath/htdocs/thepsychomath.org/public`
- Save changes

### 8.2 Configure PHP Settings (if needed)
- Go to CloudPanel → Sites → thepsychomath.org → Settings → PHP
- Ensure PHP version is 8.1 or higher
- Increase memory limit if needed: `memory_limit = 256M`

---

## Step 9: SSL Certificate (Important!)

### 9.1 Enable SSL via CloudPanel
- Go to CloudPanel → Sites → thepsychomath.org → SSL/TLS
- Enable SSL certificate (Let's Encrypt is free)
- Force HTTPS redirect

---

## Step 10: Final Checks

### 10.1 Clear Cache
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### 10.2 Test the Website
Visit: `https://thepsychomath.org`

---

## Step 11: Future Updates (Deployment Workflow)

When you make changes locally:

1. **Commit and Push:**
   ```bash
   git add .
   git commit -m "Your commit message"
   git push origin main
   ```

2. **On Server, Pull Changes:**
   ```bash
   cd /home/thepsychomath/htdocs/thepsychomath.org
   git pull origin main
   composer install --optimize-autoloader --no-dev
   php artisan migrate --force
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

---

## Troubleshooting

### Issue: 500 Internal Server Error
- Check file permissions: `chmod -R 775 storage bootstrap/cache`
- Check `.env` file exists and has correct values
- Check logs: `tail -f storage/logs/laravel.log`

### Issue: Database Connection Failed
- Verify database credentials in `.env`
- Ensure database user has proper permissions
- Check MySQL is running: `sudo systemctl status mysql`

### Issue: Permission Denied
- Fix ownership: `sudo chown -R thepsychomath:thepsychomath /home/thepsychomath/htdocs/thepsychomath.org`
- Fix permissions: `chmod -R 755 .` and `chmod -R 775 storage bootstrap/cache`

---

## Important Notes

1. **Never commit `.env` file** - it's already in `.gitignore`
2. **Always use `--force` flag** in production for migrations/seeders
3. **Keep `APP_DEBUG=false`** in production
4. **Use HTTPS** - SSL certificate is essential
5. **Backup database** regularly via CloudPanel
