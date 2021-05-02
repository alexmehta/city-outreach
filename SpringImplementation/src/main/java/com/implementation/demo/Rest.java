package com.implementation.demo;

import org.apache.commons.io.FileUtils;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.Mapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RestController;

import java.io.File;
import java.io.IOException;
import java.io.PrintStream;
import java.io.Reader;
import java.sql.SQLException;

import static com.implementation.demo.GetMeetingMinutes.cleanDB;
import static com.implementation.demo.GetMeetingMinutes.parseTable;

@RestController
public class Rest {
    @PostMapping("/update")
    public String getvalues() throws IOException, InterruptedException, SQLException {
        cleanDB();
        System.out.println("Cleaned DB");
        parseTable(8);
        return "Complete";
    }
}
