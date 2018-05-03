package perkins.bowe.database2project;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import org.json.JSONException;
import org.json.JSONObject;

public class LoginQueries extends AppCompatActivity {
    TextView LoginStatusT;
    EditText CreatePostEt, SearchTypeEt, TwitIDEt;
    Button ReturnBtn, CreatePostBtn, CreateCommentBtn, KeywordSearchBtn, UserSearchBtn;
    int uid = 0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login_queries);
        LoginStatusT = findViewById(R.id.tStatus);
        CreatePostEt = findViewById(R.id.etCreatePost);
        CreatePostBtn = findViewById(R.id.btnCreatePost);
        KeywordSearchBtn = findViewById(R.id.btnKeywordSearch);
        UserSearchBtn = findViewById(R.id.btnUserSearch);
        SearchTypeEt = findViewById(R.id.etSearchType);
        TwitIDEt = findViewById(R.id.etTwitID);
        CreateCommentBtn = findViewById(R.id.btnCreateComment);

        configureLogoutButton();

        Intent intent = this.getIntent();
        Bundle b = intent.getExtras();
        if (b != null) {
            String test = b.getString("json");
            String status = "", username = "";
            JSONObject c = null;

            try {
                c = new JSONObject(test);
                status = c.getString("status");
                username = c.getString("username");
                uid = c.getInt("uid");
            } catch (JSONException e) {
                e.printStackTrace();
            }

            if (status.equals("failure")) {
                LoginStatusT.setText("Login Failure");
                ReturnBtn.setText("Return");
                CreatePostBtn.setVisibility(View.INVISIBLE);
                CreatePostEt.setVisibility(View.INVISIBLE);
                UserSearchBtn.setVisibility(View.INVISIBLE);
                KeywordSearchBtn.setVisibility(View.INVISIBLE);
                SearchTypeEt.setVisibility(View.INVISIBLE);
                CreateCommentBtn.setVisibility(View.INVISIBLE);
                TwitIDEt.setVisibility(View.INVISIBLE);
            }
            else if (status.equals("success")) {
                String loginString = "Welcome, " + username;
                LoginStatusT.setText(loginString);
                ReturnBtn.setText("Logout");
                CreatePostBtn.setVisibility(View.VISIBLE);
                CreatePostEt.setVisibility(View.VISIBLE);
                UserSearchBtn.setVisibility(View.VISIBLE);
                KeywordSearchBtn.setVisibility(View.VISIBLE);
                SearchTypeEt.setVisibility(View.VISIBLE);
                CreateCommentBtn.setVisibility(View.VISIBLE);
                TwitIDEt.setVisibility(View.VISIBLE);
            }
        }
    }

    private void configureLogoutButton() {
        ReturnBtn = findViewById(R.id.btnLogout);
        ReturnBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
    }

    public void OnCreatePost(View view) {
        String postBody = CreatePostEt.getText().toString();
        String type = "createpost";

        BackgroundWorker backgroundWorker = new BackgroundWorker(this);
        backgroundWorker.execute(type, Integer.toString(uid), postBody);
    }

    public void OnCreateComment(View view) {
        String commentBody = CreatePostEt.getText().toString();
        String type = "createcomment";
        String parentID = TwitIDEt.getText().toString();

        BackgroundWorker backgroundWorker = new BackgroundWorker(this);
        backgroundWorker.execute(type, Integer.toString(uid), commentBody, parentID);
    }

    public void OnKeywordSearch(View view) {
        String keyword = SearchTypeEt.getText().toString();
        String type = "keywordsearch";

        BackgroundWorker backgroundWorker = new BackgroundWorker(this);
        backgroundWorker.execute(type, keyword);
    }

    public void OnUserSearch(View view) {
        String userSearch = SearchTypeEt.getText().toString();
        String type = "usersearch";

        BackgroundWorker backgroundWorker = new BackgroundWorker(this);
        backgroundWorker.execute(type, userSearch);

    }
}
