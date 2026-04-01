const puppeteer = require('puppeteer-core');
const path = require('path');

(async () => {
    const browser = await puppeteer.launch({
        executablePath: '/root/.openclaw/browsers/chromium-1208/chrome-linux64/chrome',
        headless: true,
        args: ['--no-sandbox', '--disable-setuid-sandbox', '--disable-dev-shm-usage']
    });

    const page = await browser.newPage();
    await page.setViewport({ width: 1280, height: 800 });

    // Screenshot Dashboard (landing page)
    console.log('Taking dashboard screenshot...');
    await page.goto('http://localhost:8080', { waitUntil: 'networkidle2' });
    await page.screenshot({ path: '/root/.openclaw/workspace/library-system/screenshot-dashboard.png', fullPage: true });

    // Screenshot Books page
    console.log('Taking books page screenshot...');
    await page.goto('http://localhost:8080/books', { waitUntil: 'networkidle2' });
    await page.screenshot({ path: '/root/.openclaw/workspace/library-system/screenshot-books.png', fullPage: true });

    // Screenshot Create Book page
    console.log('Taking create book screenshot...');
    await page.goto('http://localhost:8080/books/create', { waitUntil: 'networkidle2' });
    await page.screenshot({ path: '/root/.openclaw/workspace/library-system/screenshot-create-book.png', fullPage: true });

    await browser.close();
    console.log('Done!');
})();
