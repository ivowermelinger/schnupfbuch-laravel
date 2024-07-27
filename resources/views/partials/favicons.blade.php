<link
    rel="apple-touch-icon"
    sizes="180x180"
    href="/favicons/apple-touch-icon.png"
/>
<link
    rel="icon"
    type="image/png"
    sizes="32x32"
    href="/favicons/favicon-32x32.png"
/>
<link
    rel="icon"
    type="image/png"
    sizes="16x16"
    href="/favicons/favicon-16x16.png"
/>
<link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#000000" />
<link rel="shortcut icon" href="/favicons/favicon.ico" />
<link rel="manifest" href="/favicons/site.webmanifest" />

<meta name="apple-mobile-web-app-title" content="Schnupfbuch" />
<meta name="application-name" content="Schnupfbuch" />
<meta name="msapplication-TileColor" content="#ffffff" />
<meta name="msapplication-config" content="/favicons/browserconfig.xml" />
<meta name="theme-color" content="#ffffff" />

<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js', { scope: '/' });
        });
    }
</script>
