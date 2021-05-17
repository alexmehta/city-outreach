package com.hayward.spring.email;

import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;

import javax.mail.MessagingException;
import java.io.IOException;
import java.sql.*;
import java.text.SimpleDateFormat;
import java.time.Instant;

@Service
@AllArgsConstructor
public class GetNotifications {
    private final EmailSender emailSender;

    //}
    public static boolean upcoming(int eventId) {
        Connection conn = null;
        Statement stmt = null;
        try {
            String url = "jdbc:mysql://localhost:3306/cityofhayward";
            conn = DriverManager.getConnection(url, "devuser", "devpass");
            stmt = conn.createStatement();
            String sql = "SELECT date FROM upcomingevents WHERE id = %s";
            sql = String.format(sql, eventId);
            System.out.println(sql);
            ResultSet statement = stmt.executeQuery(sql);
            while (statement.next()) {
                String date = statement.getString("date");
                SimpleDateFormat simpleDateFormat = new SimpleDateFormat("MM/dd/yy");
                java.util.Date dateObject = simpleDateFormat.parse(date);
                //time + one day
                long unixTimestamp = Instant.now().getEpochSecond() + 24 * 3600;

                if (unixTimestamp > dateObject.getTime() / 1000) {
                    System.out.println("event is date away");
                    return true;
                }
            }

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

        return false;
    }
    public static String getEventDate(int id) {

        Connection conn = null;
        Statement stmt = null;
        try {
            String url = "jdbc:mysql://localhost:3306/cityofhayward";
            conn = DriverManager.getConnection(url, "devuser", "devpass");
            stmt = conn.createStatement();
            ResultSet statement = stmt.executeQuery("SELECT * FROM upcomingevents WHERE id= " + id);
            while (statement.next()) {
                return statement.getString("date");
            }
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
        return "Not Found";

    }
    public static String getEventName(int id) {
        Connection conn = null;
        Statement stmt = null;
        try {
            String url = "jdbc:mysql://localhost:3306/cityofhayward";
            conn = DriverManager.getConnection(url, "devuser", "devpass");
            stmt = conn.createStatement();
            ResultSet statement = stmt.executeQuery("SELECT * FROM upcomingevents WHERE id= " + id);
            while (statement.next()) {
                return statement.getString("name");
            }
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
        return "Not Found";
    }
    public void SendEmail(int event, String email, int id) throws MessagingException, SQLException, IOException {
        String reminder = String.format("Reminder that %s is happening on %s", getEventName(event), getEventDate(event));
        String to = email;
        emailSender.send(to, reminder,getEventName(event),getEventDate(event));

        Connection conn = null;
        Statement stmt = null;
        try {
            try {
                Class.forName("com.mysql.cj.jdbc.Driver");
            } catch (Exception e) {
//                    System.out.println(e);
            }
            String url = "jdbc:mysql://localhost:3306/cityofhayward";
            conn = DriverManager.getConnection(url, "devuser", "devpass");
//                System.out.println("Connection is created successfully:");
            stmt = conn.createStatement();
            String query1 = "UPDATE notifications SET sent = true WHERE id = %s";
            query1 = String.format(query1, id);
            PreparedStatement ps = conn.prepareStatement(query1, Statement.RETURN_GENERATED_KEYS);
//                System.out.println(query1);
            ps.executeUpdate();


        } finally {
            System.out.println("done");
        }
    }

    //gets all the events that are happening in the next day
    public void getEvents() {
        Connection conn = null;
        Statement stmt = null;
        try {
            String url = "jdbc:mysql://localhost:3306/cityofhayward";
            conn = DriverManager.getConnection(url, "devuser", "devpass");
            stmt = conn.createStatement();
            ResultSet statement = stmt.executeQuery("SELECT * FROM notifications WHERE sent = false");
            while (statement.next()) {

                int eventid = statement.getInt("eventid");
                stmt = conn.createStatement();
                ResultSet stmts = stmt.executeQuery("SELECT * FROM users WHERE id = " + statement.getInt("userid"));
                String email = "";
                while (stmts.next()) {
                    email = stmts.getString("email");
                }
                if (upcoming(eventid)) {
                    System.out.println("true");
                    SendEmail(eventid, email, statement.getInt("id"));
                }
            }
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
}
