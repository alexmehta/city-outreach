package com.implementation.demo;
//todo insert links
import org.apache.commons.io.FileUtils;
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

import java.io.*;
import java.nio.file.Files;
import java.sql.*;
import java.util.HashMap;
import java.util.Map;
import java.util.concurrent.TimeUnit;

public class GetMeetingMinutes {
    public static void main(String[] args) throws IOException, InterruptedException, SQLException {
        cleanDB();
        System.out.println("Cleaned DB");
        parseTable(8);
    }

    static void cleanDB() throws SQLException {
        Connection conn = null;
        Statement stmt = null;
        try {
            try {
                Class.forName("com.mysql.cj.jdbc.Driver");
            } catch (Exception e) {
                System.out.println(e);
            }
            String url = "jdbc:mysql://localhost:3306/cityofhayward";
            conn = DriverManager.getConnection(url, "devuser", "devpass");
            System.out.println("Connection is created successfully:");
            stmt = conn.createStatement();
            String query1 = "TRUNCATE TABLE meetingminutes";
            PreparedStatement ps = conn.prepareStatement(query1, Statement.RETURN_GENERATED_KEYS);
            System.out.println(query1);
            ps.executeUpdate();
            query1 = "TRUNCATE TABLE upcomingevents";
            stmt = conn.createStatement();
            stmt.executeUpdate(query1);
        } catch (Exception excep) {
            excep.printStackTrace();
        } finally {
            try {
                if (stmt != null)
                    conn.close();
            } catch (SQLException ignored) {
            }
            try {
                if (conn != null)
                    conn.close();
            } catch (SQLException se) {
                se.printStackTrace();
            }
        }

    }

    //todo: deal with duplicates
    static void getTable(String url) throws InterruptedException, IOException {
        //downloads table and renames to info.html
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
        driver.navigate().to("https://hayward.legistar.com/" + url);
        String downloadFilepath = "C:\\Users\\alex\\Documents\\Programming\\pilotcity-first\\java\\src\\main\\tmp";
        profile.setPreference("browser.download.dir", downloadFilepath);
        profile.setPreference("browser.helperapps.neverAsk.saveToDisk", "application/xls");
        new WebDriverWait(driver, 10).until(ExpectedConditions.elementToBeClickable(By.xpath("//*[@id=\"ctl00_ContentPlaceHolder1_menuMain\"]/ul/li[2]/a"))).click();
        new WebDriverWait(driver, 10).until(ExpectedConditions.elementToBeClickable(By.xpath("//*[@id=\"ctl00_ContentPlaceHolder1_menuMain\"]/ul/li[2]/div/ul/li[2]/a"))).click();

        new WebDriverWait(driver, 10).until(ExpectedConditions.elementToBeClickable(By.xpath("//*[@id=\"ctl00_ContentPlaceHolder1_menuMain\"]/ul/li[3]/a"))).click();

        new WebDriverWait(driver, 5).until(ExpectedConditions.elementToBeClickable(By.xpath("//*[@id=\"ctl00_ContentPlaceHolder1_menuMain\"]/ul/li[3]/div/ul/li[1]/a"))).click();
        TimeUnit.SECONDS.sleep(2);
        driver.close();
        File source = new File("src/main/tmp/Export.xls");
        File target = new File("src/main/tmp/info.html");
        try {
            Files.move(source.toPath(),target.toPath());
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    static void insertData(String name, String date, String time, String location) throws IOException {
        ClassificationRunner runner = new ClassificationRunner();
        Connection conn = null;
        Statement stmt = null;
        try {
            try {
                Class.forName("com.mysql.cj.jdbc.Driver");
            } catch (Exception e) {
                System.out.println(e);
            }
            String url = "jdbc:mysql://localhost:3306/cityofhayward";
            conn = DriverManager.getConnection(url, "devuser", "devpass");
            System.out.println("Connection is created successfully:");
            stmt = conn.createStatement();
            String query1 = "INSERT INTO upcomingevents (name,date,time,location,tag) " + "VALUES ('%s','%s','%s','%s','%s')";
            query1 = String.format(query1, name, date, time, location, runner.tag(name));
            PreparedStatement ps = conn.prepareStatement(query1, Statement.RETURN_GENERATED_KEYS);
            System.out.println(query1);
            ps.executeUpdate();
        } catch (Exception excep) {
            excep.printStackTrace();
        } finally {
            try {
                if (stmt != null)
                    conn.close();
            } catch (SQLException ignored) {
            }
            try {
                if (conn != null)
                    conn.close();
            } catch (SQLException se) {
                se.printStackTrace();
            }
        }
        parse(new File("src/main/tmp/info.html"), 0);

    }

    static void insertevents(String name, String tag, int event) {
        Connection conn = null;
        Statement stmt = null;
        try {
            try {
                Class.forName("com.mysql.cj.jdbc.Driver");
            } catch (Exception e) {
                System.out.println(e);
            }
            String url = "jdbc:mysql://localhost:3306/cityofhayward";
            conn = DriverManager.getConnection(url, "devuser", "devpass");
            System.out.println("Connection is created successfully:");
            Statement statement = conn.createStatement();
            String query = "SELECT id FROM upcomingevents WHERE id=(SELECT MAX(id) FROM upcomingevents)";
            ResultSet resultSet = statement.executeQuery(query);
            long id = 0;
            while (resultSet.next()) {
                id = resultSet.getLong("id");
            }

            String query1 = "INSERT INTO meetingminutes (name,tag,event) " + "VALUES ('%s','%s','%s')";
            stmt = conn.createStatement();
            FileUtils.cleanDirectory(new File("src/main/tmp"));
            query1 = String.format(query1, name, tag, id);
            System.out.println(query1);
            stmt.executeUpdate(query1);


        } catch (SQLException excep) {
            excep.printStackTrace();
        } catch (Exception excep) {
            excep.printStackTrace();
        } finally {
            try {
                if (stmt != null)
                    conn.close();
            } catch (SQLException se) {
            }
            try {
                if (conn != null)
                    conn.close();
            } catch (SQLException se) {
                se.printStackTrace();
            }
        }
    }

    static void parse(File file, int id) throws IOException {
        Document doc = Jsoup.parse(file, null);
        Element table = doc.body();
        if (!doc.body().text().equals("NULL")) {
            Elements rows = table.select("tr");
            Elements ths = rows.select("td");
            String thstr = "";
            ClassificationRunner runner = new ClassificationRunner();

            for (Element row : rows) {
                Elements tds = row.select("td");
                int i = 0;
                String type = "";
                for (Element td : tds) {
                    if (i == 3) {
                        type = td.text();
                        insertevents(type, runner.tag(type), id);
                        break;
                    }
                    i++;
                    //System.out.println(td.text());
                    //fout.println(td.text());  // --> This will print them
                    // individually
                }
                // in the row
            }
        }

    }

    static void click(String url) throws IOException, InterruptedException {
        Document doc = Jsoup.connect("https://hayward.legistar.com/" + url).get();
        System.out.println(doc.title());
        System.out.println("https://hayward.legistar.com/" + url);
        Element meetingitems = doc.getElementsByClass("rtsUL").get(1);
        if (!meetingitems.text().equals("Meeting Items (0)")) {
            getTable(url);

        } else {
            File f = new File("src/main/tmp/info.html");
            PrintWriter fout = new PrintWriter(new OutputStreamWriter(new FileOutputStream("src/main/tmp/info.html")));
            fout.println("NULL");
            fout.close();

        }
        String name = doc.getElementById("ctl00_ContentPlaceHolder1_hypName").text();
        String date = doc.getElementById("ctl00_ContentPlaceHolder1_lblDate").text();
        String time = doc.getElementById("ctl00_ContentPlaceHolder1_lblTime").text();
        String location = doc.getElementById("ctl00_ContentPlaceHolder1_lblLocation").text();
        insertData(name, date, time, location);

    }

    static void insertEventNOTNULL(String name, String date, String time, String location) {
        ClassificationRunner runner = new ClassificationRunner();
        Connection conn = null;
        Statement stmt = null;
        try {
            try {
                Class.forName("com.mysql.cj.jdbc.Driver");
            } catch (Exception e) {
                System.out.println(e);
            }
            String url = "jdbc:mysql://localhost:3306/cityofhayward";
            conn = DriverManager.getConnection(url, "devuser", "devpass");
            System.out.println("Connection is created successfully:");
            stmt = conn.createStatement();
            String query1 = "INSERT INTO upcomingevents (name,date,time,location,tag) " + "VALUES ('%s','%s','%s','%s','%s')";
            query1 = String.format(query1, name, date, time, location, runner.tag(name));
            PreparedStatement ps = conn.prepareStatement(query1, Statement.RETURN_GENERATED_KEYS);
            System.out.println(query1);
            ps.executeUpdate();
        } catch (Exception excep) {
            excep.printStackTrace();
        } finally {
            try {
                if (stmt != null)
                    conn.close();
            } catch (SQLException ignored) {
            }
            try {
                if (conn != null)
                    conn.close();
            } catch (SQLException se) {
                se.printStackTrace();
            }
        }
    }

    static void parseTable(int num) throws IOException, InterruptedException {
        Document doc = Jsoup.connect("https://hayward.legistar.com/Calendar.aspx").get();
        Element table = doc.getElementById("ctl00_ContentPlaceHolder1_gridCalendar_ctl00");
        Elements rows = table.select("tr");
        for (int i = 0; i < rows.size(); i++) {
            Element row = rows.get(i);
            Elements columns = row.select("td");

            String name = null;
            String date = null;
            String time = null;
            String location = null;
            for (int j = 0; j < columns.size(); j++) {
                if (j == 0) name = columns.get(j).text();
                if (j == 1) date = columns.get(j).text();
                if (i == 2) time = columns.get(j).text();
                if (i == 4) location = columns.get(j).text();
                if (j == 5) {
                    //get link and then send to webdrivwer
                    System.out.println(time);

                    Element atag = columns.get(j).select("a").first();
                    System.out.println(atag.attr("href"));
                    String url = atag.attr("href");
                    System.out.println(url);
                    if (atag.attr("href").equals("") || !atag.attr("href").startsWith("MeetingDetail")) {
                        //  System.out.println("no adj, defaulting to inserting regularly");
                        insertEventNOTNULL(name, date, time, location);
                    } else {
                        click(atag.attr("href"));

                    }
                    System.out.println();
                }

            }
        }

        for (int i = 0; i < 100; i++) {
            System.out.println();
        }
        for (Element row : rows) {
            Elements columns = row.select("td");
            for (int j = 0; j < columns.size(); j++) {
                System.out.println(columns.get(j).text());
            }
        }




    }
}
