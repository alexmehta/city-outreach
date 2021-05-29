package com.hayward.spring.events;

public class PDFreader {
    //main runner class
    public void attemptZoomLink(int id){
        Update(parsePDF(), id);
    }
    //go through pdf and try to find mentions of hayward.zoom.us
    public static String parsePDF(){

    }
    //update the sql row
    public static void Update(String url, int id){

    }

}
