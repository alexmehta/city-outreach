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

@RestController
public class Rest {
    @PostMapping("/update")
    public int getvalues() throws IOException, InterruptedException {
        FileUtils.cleanDirectory(new File("src/main/tmp"));
        GetExcel getExcel1 = new GetExcel();
        getExcel1.DownloadXLS();
        getExcel1.readInCSVFormat(new File("src\\main\\tmp\\Export.html"));
        ReaderClass reader = new ReaderClass();
        int f = reader.RW(new File("src\\main\\tmp\\File.txt"));

        return f;

    }
}
