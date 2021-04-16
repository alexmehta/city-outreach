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
    private Date date;
    private Time time;
    private String location;
    private String presentations;
    private String documents;
    private String officalmin;

    public EntityEvent(){

    }

    public EntityEvent(int id, String name, Date date, Time time, String location, String presentations, String documents, String officalmin) {
        this.id = id;
        this.name = name;
        this.date = date;
        this.time = time;
        this.location = location;
        this.presentations = presentations;
        this.documents = documents;
        this.officalmin = officalmin;
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

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    public Time getTime() {
        return time;
    }

    public void setTime(Time time) {
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
}
