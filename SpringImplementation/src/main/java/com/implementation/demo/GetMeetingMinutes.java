package com.implementation.demo;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.chrome.ChromeOptions;
import org.openqa.selenium.firefox.FirefoxProfile;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;

import java.io.File;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.HashMap;
import java.util.Map;
import java.util.concurrent.TimeUnit;

public class GetMeetingMinutes {
    public static void main(String[] args) throws IOException, InterruptedException {
        parseTable(8);

    }
    static void getTable(String url) throws InterruptedException {
        //https://hayward.legistar.com/Calendar.aspx
        //get excel doc
        System.setProperty("webdriver.chrome.driver", "chromedriver.exe");
        System.setProperty("webdriver.gecko.driver", "C:\\GeckoDriver\\geckodriver.exe");
        // Setting new download directory path
        Map<String, Object> prefs = new HashMap<String, Object>();
        // Use File.separator as it will work on any OS
        prefs.put("download.default_directory",
                System.getProperty("user.dir") + File.separator + "src" + File.separator + "main" + File.separator + "tmp");
        // Adding cpabilities to ChromeOptions
        ChromeOptions options = new ChromeOptions();
        options.setExperimentalOption("prefs", prefs);
        // Printing set download directory
        System.out.println(options.getExperimentalOption("prefs"));
        // Launching browser with desired capabilities
        FirefoxProfile profile = new FirefoxProfile();
        profile.setAssumeUntrustedCertificateIssuer(false);
        WebDriver driver = new ChromeDriver(options);
        driver.navigate().to("https://hayward.legistar.com/"+url);
        String downloadFilepath = "C:\\Users\\alex\\Documents\\Programming\\pilotcity-first\\java\\src\\main\\tmp";
        profile.setPreference("browser.download.dir", downloadFilepath);
        profile.setPreference("browser.helperapps.neverAsk.saveToDisk", "application/xls");
        new WebDriverWait(driver, 5).until(ExpectedConditions.elementToBeClickable(By.xpath("/html/body/form/div[3]/div[6]/div/div/table/tbody/tr/td/div[3]/div/div[2]/div[1]/table[1]/tbody/tr/td/div/ul/li[3]"))).click();
        new WebDriverWait(driver, 5).until(ExpectedConditions.elementToBeClickable(By.xpath("/html/body/form/div[3]/div[6]/div/div/table/tbody/tr/td/div[3]/div/div[2]/div[1]/table[1]/tbody/tr/td/div/ul/li[3]/div/ul/li[1]/a"))).click();
        TimeUnit.SECONDS.sleep(2);
        driver.close();
        File export = new File("src/main/tmp/info.xls");
        File newname = new File("src/main/tmp/info.html");

        if (export.renameTo(newname)) {
            System.out.println("renamed");
        } else {
            System.out.println("error");
        }
        parseTable(new File("src/main/tmp/info.html"));

    }
    static void parseTable(File file) throws FileNotFoundException {
        PrintWriter fout = new PrintWriter("src/main/tmp/info.txt");
        Document doc = Jsoup.parse(file, null);
        Element table = doc.body();
        Elements rows = table.select("tr");
        Elements ths = rows.select("td");
        String thstr = "";

        for (Element row : rows) {
            Elements tds = row.select("td");
            for (Element td : tds) {
                fout.println(td.text());  // --> This will print them
                // individually
            }
            // in the row
        }
        fout.close();
    }
    static void click(String url) throws IOException, InterruptedException {
        Document doc = Jsoup.connect("https://hayward.legistar.com/" + url).get();
        String meetingname = doc.getElementById("ctl00_ContentPlaceHolder1_hypName").text();
        System.out.println(meetingname);
        Element meetingitems = doc.getElementsByClass("rtsLI rtsFirst rtsLast").get(1);
        if (!meetingitems.text().equals("Meeting Items (0)")){
            getTable(url);
        }

    }

    static void parseTable(int num) throws IOException, InterruptedException {
        Document doc = Jsoup.connect("https://hayward.legistar.com/Calendar.aspx").get();
        Element table = doc.select("table").get(num);
        Elements rows = table.select("tr");
        Elements header = table.select("th");
        Elements ths = rows.select("td");
        for (int i = 0; i < rows.size(); i++) {
            Element row = rows.get(i);
            Elements columns = row.select("td");
            for (int j = 0; j < columns.size(); j++) {
                if (j == 5) {
                    //get link and then send to webdrivwer
                    Element atag = columns.get(j).select("a").first();
                    click(atag.attr("href"));
                    System.out.println();
                }

            }
        }
    }
}
