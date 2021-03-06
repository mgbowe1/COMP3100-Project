package perkins.bowe.database2project;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class UserFeed extends AppCompatActivity {
    TextView UserNameT;
    private RecyclerView mRecyclerView;
    private RecyclerView.Adapter mRVAdapter;
    private RecyclerView.LayoutManager mRVLayoutMan;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_userfeed);

        configureReturnButton();

        Intent intent = this.getIntent();
        Bundle b = intent.getExtras();

        if (b != null) {
            String test = b.getString("json");
            String body = "", time = "", name = "";
            int tid = 0, uid = 0;
            JSONObject c = null, postObject = null;
            JSONArray postArray = null;
            try {
                c = new JSONObject(test);
                postArray = c.getJSONArray("result");
                ArrayList<Post> posts = new ArrayList<Post>();
                for (int i = 0; i < postArray.length(); i++) {
                    postObject = postArray.getJSONObject(i);
                    tid = postObject.getInt("tid");
                    body = postObject.getString("body");
                    time = postObject.getString("time");
                    uid = postObject.getInt("uid");
                    name = postObject.getString("name");
                    posts.add(new Post(tid, uid, body, time, name));
                }
                //Instantiate RecyclerView
                mRecyclerView = (RecyclerView) findViewById(R.id.UserFeedList);

                // Set Layout Manager
                mRVLayoutMan = new LinearLayoutManager(this);
                mRecyclerView.setLayoutManager(mRVLayoutMan);

                // Set Adapter
                mRVAdapter = new MyPostRecyclerViewAdapter(posts, new PostFragment.OnListFragmentInteractionListener() {
                    @Override
                    public void onListFragmentInteraction(Post post) {

                    }
                });
                mRecyclerView.setAdapter(mRVAdapter);
            } catch (JSONException e) {
                e.printStackTrace();
            }
            // String tempString = "tid: " + Integer.toString(tid) + body + time + "uid: " + Integer.toString(uid) + name;
            // UserNameT.setText(test); // SET THE TEXT TO THE WHOLE JSON
        }
    }

    private void configureReturnButton() {
        Button returnButton = findViewById(R.id.btnReturn);
        returnButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
    }
}
