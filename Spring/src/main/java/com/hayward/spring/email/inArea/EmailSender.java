package com.hayward.spring.email.inArea;

import javax.mail.MessagingException;
import java.io.IOException;

public interface EmailSender {
    void send(String to, String subject,String event, String date, String location) throws MessagingException, IOException;
}
