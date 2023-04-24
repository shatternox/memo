const express = require('express')
const puppeteer = require('puppeteer')
const app = express()

const port = 3000

const cookie = {
    'name': 'cookie',
    'value': 'e991f6e6-2b7c-474c-949e-e30bb6eda749',
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

app.get('/admin_check', async (req, res) => {

    const browser = await puppeteer.launch({args: ['--no-sandbox', '--disable-setuid-sandbox']});
    const page = await browser.newPage();

    res.status(200).send(`${req.query.id}`)
    res.end()

    monitorConsoleOutput(page)

    try {
        await page.tracing.start({ path: `/tmp/${new Date()}-trace.json` });            
      } catch (error) {
          
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
    const url = "http://undisclosedweb/order.php?id=" + req.query.id 

    await page.goto("http://undisclosedweb/");
    await page.setCookie(cookie);

    try{
      await page.goto(url, {waitUntil:"load"});
    } catch(err){
      console.log(err);
    }

    await sleep(5000);
    await browser.close();
    

})


app.listen(port, () => {
  console.log(`Admin server running on ${port}`)
  
})


