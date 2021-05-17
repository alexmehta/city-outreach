package com.hayward.spring.email;

import com.hayward.spring.email.updates.EmailUpdateSender;
import com.hayward.spring.email.updates.Event;
import lombok.AllArgsConstructor;
import org.apache.commons.io.FileUtils;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.mail.javamail.JavaMailSender;
import org.springframework.mail.javamail.MimeMessageHelper;
import org.springframework.scheduling.annotation.Async;
import org.springframework.stereotype.Service;

import javax.mail.MessagingException;
import javax.mail.internet.MimeMessage;
import java.io.File;
import java.io.IOException;
import java.sql.*;
import java.util.ArrayList;

@Service
@AllArgsConstructor
public class EmailService implements EmailSender {

    private final JavaMailSender mailSender;

    @Override
    @Async
    public void send(String to, String subject, String event, String date) throws MessagingException, IOException {
        System.out.println("trying");
        MimeMessage message = mailSender.createMimeMessage();

        MimeMessageHelper helper = new MimeMessageHelper(message, "utf-8");
        helper.setSubject(subject);
        String mess  = FileUtils.readFileToString(new File("src/main/resources/message.html"));
        helper.setText(String.format(mess, event,date),true);

        helper.setTo(to);
        helper.setFrom("cyberorangelord17@gmail.com");
        mailSender.send(message);

    }
}
