import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.chrome.ChromeOptions;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.firefox.FirefoxProfile;
import org.openqa.selenium.remote.CapabilityType;
import org.openqa.selenium.remote.DesiredCapabilities;
import org.openqa.selenium.support.ui.ExpectedCondition;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;

import java.io.File;
import java.util.HashMap;
import java.util.Hashtable;
import java.util.Map;

public class GetExcel {
    public void DownloadXLS(){
        //https://hayward.legistar.com/Calendar.aspx
        //get excel doc
        System.setProperty("webdriver.chrome.driver","C:\\GeckoDriver\\chromedriver.exe");
        System.setProperty("webdriver.gecko.driver", "C:\\GeckoDriver\\geckodriver.exe");
        // Setting new download directory path
        Map<String, Object> prefs = new HashMap<String, Object>();
        // Use File.separator as it will work on any OS
        prefs.put("download.default_directory",
                System.getProperty("user.dir") + File.separator + "src" + File.separator + "main" + File.separator + "resources");
        // Adding cpabilities to ChromeOptions
        ChromeOptions options = new ChromeOptions();
        options.setExperimentalOption("prefs", prefs);
        // Printing set download directory
        System.out.println(options.getExperimentalOption("prefs"));
        // Launching browser with desired capabilities
        FirefoxProfile profile = new FirefoxProfile();
        profile.setAssumeUntrustedCertificateIssuer(false);
        WebDriver driver = new ChromeDriver(options);
        driver.navigate().to("https://hayward.legistar.com/Calendar.aspx");
        String downloadFilepath = "C:\\Users\\alex\\Documents\\Programming\\pilotcity-first\\java\\src\\main\\resources";
        profile.setPreference("browser.download.dir", downloadFilepath);
        profile.setPreference("browser.helperapps.neverAsk.saveToDisk","application/xls");
        new WebDriverWait(driver, 20).until(ExpectedConditions.elementToBeClickable(By.xpath("/html/body/form/div[3]/div[6]/div/div/div[6]/div[1]/div/table[3]/tbody/tr/td/div/ul/li[3]"))).click();
        new WebDriverWait(driver, 20).until(ExpectedConditions.elementToBeClickable(By.xpath("/html/body/form/div[3]/div[6]/div/div/div[6]/div[1]/div/table[3]/tbody/tr/td/div/ul/li[3]/div/ul/li[1]/a"))).click();
        driver.close();
    }
}
