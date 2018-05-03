public class Comment {
    private Integer cid;
    private Integer tid;
    private Integer uid;
    private String name;
    private String body;
    private String time;

    public void setTime(String time) {
        this.time = time;
    }

    public void setBody(String body) {
        this.body = body;
    }

    public void setUid(Integer uid) {
        this.uid = uid;
    }

    public void setTid(Integer tid) {
        this.tid = tid;
    }

    public void setCid(Integer cid) {
        this.cid = cid;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getTime() {
        return time;
    }

    public String getBody() {
        return body;
    }

    public Integer getUid() {
        return uid;
    }

    public Integer getTid() {
        return tid;
    }

    public Integer getCid() {
        return cid;
    }

    public String getName() {
        return name;
    }
}
