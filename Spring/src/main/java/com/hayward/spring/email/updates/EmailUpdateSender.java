package com.hayward.spring.email.updates;

import javax.mail.MessagingException;
import java.io.IOException;
import java.util.ArrayList;
public interface EmailUpdateSender {
    void send(String to, String subject, ArrayList<Event> events,String name) throws MessagingException, IOException;
}
