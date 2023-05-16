const express = require('express')
const puppeteer = require('puppeteer')
const app = express()

const port = 3000

const cookie = {
    'name': 'cookie',
    'value': 'e991f6e6-2b7c-474c-949e-e30bb6eda749',
    'secure': false,
    'sameSite': 'none',
}

const sleep = (ms) => {
  return new Promise(resolve => {setTimeout(resolve, ms)})
}


const monitorConsoleOutput = async (botData) => {
    await botData.on('console', async msg => {
        msg.args().forEach(arg => {
            arg.jsonValue().then(_arg => {
                console.log(`[$] Console Output: `, _arg);
            });
        });
    });
}

async function visit(url){
    const browser = await puppeteer.launch({
      args: ['--no-sandbox', '--disable-setuid-sandbox',  '--disable-web-security', '--disable-features=IsolateOrigins', '--disable-site-isolation-trials'],
      executablePath: '/usr/bin/firefox-esr',
      pipe: true,
      dumpio: true,
      product: 'firefox'
    }
    );
    const page = await browser.newPage();

    monitorConsoleOutput(page)

    try {
      await page.tracing.start({ path: `/tmp/${new Date()}-trace.json` });            
    } catch (error) {
      console.log(error)
    }

    page.on('error', err => {
        console.error(`[#] Error: `, err);
    });

    page.on('pageerror', msg => {
        console.error(`[-] Page Error: `, msg);
    });

    page.on('dialog', async dialog => {
        console.debug(`[#] Dialog: [${dialog.type()}] "${dialog.message()}" ${dialog.defaultValue() || ""}`);
        dialog.dismiss();
    });

    page.on('requestfailed', req => {
        console.error(`[-] Request failed: ${req.url()} ${JSON.stringify(req.failure())}`);
    });


    // For Docker 172.12.47.14:80

    try{
        await page.goto("http://54.254.34.140:11111/memo.php");
        await page.setCookie(cookie);
        await sleep(5000);
        const cookies = await page.cookies();
        console.log("===================================================================================")
        console.log(cookies);
        
        
        
    } catch(err){
      throw new Error(err)
    }

    try{
      await page.goto(url, {waitUntil:"load"});
      const cookies = await page.cookies();
      console.log("===================================================================================")
      console.log(cookies);
    } catch(err){
      throw new Error(err)
    }

    await sleep(5000);
    await browser.close();
}

app.get('/admin_check', async (req, res) => {
    const url = req.query.url
    try{
        await visit(url);
        res.status(200).send(`Success visiting URL: ${url}`);
    }catch(e){
      console.log(e)
      res.status(500).send(`Error visiting URL: ${e.message}`);
    }
})


app.listen(port, () => {
  console.log(`Admin server running on ${port}`)
  
})


