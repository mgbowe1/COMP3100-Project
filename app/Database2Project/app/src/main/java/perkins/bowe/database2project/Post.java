package perkins.bowe.database2project;

import java.util.List;

import perkins.bowe.database2project.Comment;

public class Post {
    private Integer tid;
    private Integer uid;
    private String body;
    private String time;
    private String name;
    public List<Comment> comments;

    public Post(Integer tid, Integer uid, String body, String time, String name) {
        this.tid = tid;
        this.uid = uid;
        this.body = body;
        this.time = time;
        this.name = name;
    }

    public Integer getTid(){
        return tid;
    }

    public Integer getUid() {
        return uid;
    }

    public String getBody() {
        return body;
    }

    public String getTime() {
        return time;
    }

    public String getName() {
        return name;
    }

    public void setTid(Integer tid) {
        this.tid = tid;
    }

    public void setUid(Integer uid) {
        this.uid = uid;
    }

    public void setBody(String body) {
        this.body = body;
    }

    public void setTime(String time) {
        this.time = time;
    }

    public void setName(String name) {
        this.name = name;
    }
}
