package com.hayward.spring;

import com.hayward.spring.email.GetNotifications;
import lombok.AllArgsConstructor;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.scheduling.annotation.EnableScheduling;
import org.springframework.scheduling.annotation.Scheduled;

@SpringBootApplication
@AllArgsConstructor

public class EventsBackend {
    private final GetNotifications getNotifications;
    public static void main(String[] args) {
        SpringApplication.run(EventsBackend.class, args);
    }

    //0 0 0 * * * should be actual time
    @Scheduled(fixedRate = 900 * 1000)
    void sendEmails(){
    }
    @Scheduled(fixedRate = 5*1000)
    void test(){
        getNotifications.getEvents();
    }
    @EnableScheduling
    class SchedulingConfiguration{

    }
}
