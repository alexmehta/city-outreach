package com.implementation.demo;

import org.springframework.beans.factory.annotation.Autowired;

import javax.transaction.Transactional;
import java.io.File;
import java.io.IOException;
import java.io.PrintWriter;
import java.nio.file.Files;
import java.sql.*;
import java.util.Scanner;

public class ReaderClass {
    @Autowired
    BasicRepo basicRepo;
    public int RW(File file) throws IOException, SQLException {
        long lines = Files.lines(file.toPath()).count();
        Scanner s = new Scanner(file);
        int number = (int) (lines / 7);
        PrintWriter printWriter = new PrintWriter(new File("src/main/tmp/test.txt"));
        for (int i = 0; i < number; i++) {
            String[] string = new String[7];
            for (int j = 0; j < 7; j++) {
                String s1 = s.nextLine();
                string[i] = s1;
                printWriter.println(s1);
            }

            Connection con = null;
            String url = "jdbc:mysql://localhost:6033/";
            String db = "cityofhayward";
            String driver = "com.mysql.jdbc.Driver";
            String user = "devuser";
            String pass = "devpass";
            try{
                Class.forName(driver).newInstance();
                con = DriverManager.getConnection(url+db, user, pass);
                Statement st = con.createStatement();
                String prepared = String.format("INSERT INTO events (name,date,time,location,presentations,documents,officalmin) INTO VALUES ('%s','%s','%s','%s','%s','%s','%s')", string[0],string[1],string[2],string[3],string[4],string[5],string[6]);
                System.out.println(prepared);
                ResultSet res = st.executeQuery(prepared);
                System.out.println("Emp_code: " + "\t" + "Emp_name: ");
                while (res.next()) {
                    int code = res.getInt("Emp_code");
                    String sring = res.getString("Emp_name");
                    System.out.println(i + "\t\t" + sring);
                }
            }
            catch (SQLException srings){
                System.out.println("SQL code does not execute.");
            }
            catch (Exception e){
                e.printStackTrace();
            }
            finally {
                con.close();
            }
        }

        printWriter.close();
        return number;
    }
}
