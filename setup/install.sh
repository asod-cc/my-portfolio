#!/bin/sh
# Installs a complete WordPress site: core, Aurora theme, Aurora Core plugin,
# essential plugins and demo content. Used by the `setup` service in
# docker-compose.yml, but works on any server with WP-CLI:
#   WP_URL=https://example.com WP_ADMIN_PASSWORD=... sh setup/install.sh
set -e
cd /var/www/html 2>/dev/null || true

echo "Waiting for WordPress files and database..."
i=0
until [ -f wp-config.php ] && wp db check >/dev/null 2>&1; do
  i=$((i + 1)); [ "$i" -gt 60 ] && { echo "Database not reachable"; exit 1; }
  sleep 3
done

if ! wp core is-installed 2>/dev/null; then
  wp core install \
    --url="${WP_URL:-http://localhost:8080}" \
    --title="Asad Khan" \
    --admin_user="${WP_ADMIN_USER:-asad}" \
    --admin_password="${WP_ADMIN_PASSWORD:-change-me-now}" \
    --admin_email="${WP_ADMIN_EMAIL:-admin@example.com}" \
    --skip-email
fi

wp theme activate aurora
wp plugin activate aurora-core

# WordPress essentials (all free, from wordpress.org)
#   elementor        visual page builder (use the "Blank Canvas" or "Landing" template)
#   wordpress-seo    Yoast SEO: titles, sitemaps, schema
#   wordfence        firewall, malware scan, login security
#   updraftplus      scheduled backups
#   wp-mail-smtp     reliable email for the contact form
#   redirection      301 redirects and 404 monitoring
#   wp-super-cache   page caching
#   wp-smushit       image compression and lazy loading
#   complianz-gdpr   cookie consent / GDPR
wp plugin install elementor wordpress-seo wordfence updraftplus wp-mail-smtp redirection wp-super-cache wp-smushit complianz-gdpr --activate || true
# Google Site Kit is installed but left inactive until you connect your Google account.
wp plugin install google-site-kit || true

wp plugin delete hello akismet >/dev/null 2>&1 || true
wp theme delete twentytwentythree twentytwentyfour >/dev/null 2>&1 || true

wp rewrite structure '/%postname%/'
wp eval-file wp-content/plugins/aurora-core/demo/seed.php
wp rewrite flush

echo ""
echo "Done! Site: ${WP_URL:-http://localhost:8080}   Admin: ${WP_URL:-http://localhost:8080}/wp-admin"
echo "User: ${WP_ADMIN_USER:-asad}   Password: ${WP_ADMIN_PASSWORD:-change-me-now}  (change it!)"
