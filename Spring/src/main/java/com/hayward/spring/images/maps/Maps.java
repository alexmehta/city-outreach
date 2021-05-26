package com.hayward.spring.images.maps;

import javax.imageio.ImageIO;
import java.awt.*;
import java.io.IOException;
import java.io.InputStream;
import java.net.MalformedURLException;
import java.net.URL;
import java.nio.file.Files;
import java.nio.file.Paths;

public class Maps {
    public void saveMap(String url) throws MalformedURLException {
        try(InputStream in = new URL(url).openStream()){
            Files.copy(in, Paths.get(""));
        } catch (IOException e) {
            e.printStackTrace();
        }

    }
}
