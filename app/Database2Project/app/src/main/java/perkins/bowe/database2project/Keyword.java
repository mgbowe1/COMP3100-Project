package perkins.bowe.database2project;

import java.io.Serializable;

public class Keyword implements Serializable{
    private Integer count;
    private String Location;

    public Keyword(int count, String location) {
        this.count = count;
        Location = location;
    }

    public Integer getCount() {
        return count;
    }

    public String getLocation() {
        return Location;
    }

    public void setCount(Integer count) {
        this.count = count;
    }

    public void setLocation(String location) {
        Location = location;
    }
}
