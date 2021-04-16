package com.implementation.demo;

import org.springframework.beans.factory.annotation.Autowired;

import java.io.File;
import java.io.IOException;
import java.io.PrintWriter;
import java.nio.file.Files;
import java.sql.Date;
import java.sql.Time;
import java.util.Scanner;

public class ReaderClass {
    @Autowired
    BasicRepo basicRepo;
    public int RW(File file) throws IOException {
        long lines = Files.lines(file.toPath()).count();
        Scanner s = new Scanner(file);
        int st = (int) (lines / 7);
        PrintWriter printWriter = new PrintWriter(new File("src/main/tmp/test.txt"));
        for (int i = 0; i < st; i++) {
            String[] string = new String[7];
            for (int j = 0; j < 7; j++) {
                String s1 = s.nextLine();
                string[i] = s1;
                printWriter.println(s1);
            }
            EntityEvent event = new EntityEvent();
            event.setName(string[0]);

            event.setDate(string[1]);
            event.setTime(string[2]);
            event.setLocation(string[3]);
            event.setPresentations(string[4]);
            event.setDocuments(string[5]);
            event.setOfficalmin(string[6]);
            basicRepo.save(event);
            printWriter.println();
        }
        printWriter.close();

        return st;
    }
}
