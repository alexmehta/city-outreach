package com.hayward.spring.email;

import javax.mail.MessagingException;

public interface EmailSender {
    void send(String to, String subject) throws MessagingException;
}
