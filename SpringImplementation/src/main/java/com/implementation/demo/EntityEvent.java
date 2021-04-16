package com.implementation.demo;

import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;
import java.sql.Time;
import java.util.Date;
@Entity
@Table(name = "EventsHappening")

public class EntityEvent {
    @Id
    private int id;
    private String name;
    private String date;
    private String time;
    private String location;
    private String presentations;
    private String documents;
    private String officalmin;

    public EntityEvent(){

    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public String getTime() {
        return time;
    }

    public void setTime(String time) {
        this.time = time;
    }

    public String getLocation() {
        return location;
    }

    public void setLocation(String location) {
        this.location = location;
    }

    public String getPresentations() {
        return presentations;
    }

    public void setPresentations(String presentations) {
        this.presentations = presentations;
    }

    public String getDocuments() {
        return documents;
    }

    public void setDocuments(String documents) {
        this.documents = documents;
    }

    public String getOfficalmin() {
        return officalmin;
    }

    public void setOfficalmin(String officalmin) {
        this.officalmin = officalmin;
    }

    public EntityEvent(int id, String name, String date, String time, String location, String presentations, String documents, String officalmin) {
        this.id = id;
        this.name = name;
        this.date = date;
        this.time = time;
        this.location = location;
        this.presentations = presentations;
        this.documents = documents;
        this.officalmin = officalmin;
    }
}
