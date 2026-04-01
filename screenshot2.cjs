const puppeteer = require('puppeteer-core');

(async () => {
    const browser = await puppeteer.launch({
        executablePath: '/root/.openclaw/browsers/chromium-1208/chrome-linux64/chrome',
        headless: true,
        args: ['--no-sandbox', '--disable-setuid-sandbox', '--disable-dev-shm-usage']
    });

    const page = await browser.newPage();
    await page.setViewport({ width: 1280, height: 800 });

    // Login page
    console.log('Taking login screenshot...');
    await page.goto('http://localhost:8080/login', { waitUntil: 'networkidle2' });
    await page.screenshot({ path: '/root/.openclaw/workspace/library-system/screenshot-login.png', fullPage: true });

    // Register page
    console.log('Taking register screenshot...');
    await page.goto('http://localhost:8080/register', { waitUntil: 'networkidle2' });
    await page.screenshot({ path: '/root/.openclaw/workspace/library-system/screenshot-register.png', fullPage: true });

    // Search page
    console.log('Taking search screenshot...');
    await page.goto('http://localhost:8080/search?q=buku', { waitUntil: 'networkidle2' });
    await page.screenshot({ path: '/root/.openclaw/workspace/library-system/screenshot-search.png', fullPage: true });

    await browser.close();
    console.log('Done!');
})();
