package com.hayward.spring.events;

import org.apache.commons.io.FileUtils;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RestController;

import java.io.File;
import java.io.IOException;
import java.sql.SQLException;
import java.text.ParseException;

import static com.hayward.spring.events.GetMeetingMinutes.cleanDB;
import static com.hayward.spring.events.GetMeetingMinutes.parseTable;

@RestController
public class Rest {
    @PostMapping("/update")
    public String getvalues() throws IOException, InterruptedException, SQLException, ParseException {
        cleanDB();
        System.out.println("Cleaned DB");
        parseTable(8);
        FileUtils.cleanDirectory(new File("src/main/tmp"));
        return "Complete: inserted values";
    }

}
