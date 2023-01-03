# Tutorial Symfony HTMX

*Inspired from YoanDev tutorial: [Une SPA avec SYMFONY et l'incroyable HTMX](https://youtu.be/fte1SDPcLZs).*

Doc:
- Tailwin CSS for Symfony : [here](https://tailwindcss.com/docs/guides/symfony)
- htmx: [high power tools for HTML](https://htmx.org/)

## Init project

```shell
mkdir tuto-symfony-htmx
cd tuto-symfony-htmx

# Install WebPack Encore
composer require symfony/webpack-encore-bundle

# Install Tailwind CSS
npm i
npm install -D tailwindcss postcss autoprefixer postcss-loader
npx tailwindcss init -p

npm run build

npm i htmx.org
```