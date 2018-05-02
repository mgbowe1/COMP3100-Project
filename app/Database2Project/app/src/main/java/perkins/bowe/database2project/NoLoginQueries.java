package perkins.bowe.database2project;

import android.app.AlertDialog;
import android.content.Context;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class NoLoginQueries extends AppCompatActivity {
    EditText KeywordEt, UserSearchEt;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_no_login_queries);

        KeywordEt = findViewById( R.id.etKeyword);
        UserSearchEt = findViewById(R.id.etUserSearch);

        configureReturnButton();
        //configureKeywordSearch();
        //configureUserSearch();
    }

    private void configureReturnButton() {
        Button returnButton = (Button) findViewById(R.id.btnReturn);
        returnButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
    }

    /*private void configureKeywordSearch() {
        Button keywordSearchButton = (Button) findViewById(R.id.btnKeywordSearch);
        keywordSearchButton.setOnClickListener(new View.OnClickListener() {
            //public static final String TAG = "MyActivity";

            @Override
            public void onClick(View view) {
                String keyword = KeywordEt.getText().toString();
                String type = "keywordsearch";

                BackgroundWorker backgroundWorker = new BackgroundWorker(this);
                backgroundWorker.execute(type, keyword);
               //Log.i(TAG, "Keyword Searching");
            }
        });
    }*/

    public void OnKeywordSearch(View view) {
        String keyword = KeywordEt.getText().toString();
        String type = "keywordsearch";

        BackgroundWorker backgroundWorker = new BackgroundWorker(this);
        backgroundWorker.execute(type, keyword);
        //Log.i(TAG, "Keyword Searching");
    }

    public void OnUserSearch(View view) {
        String userSearch = UserSearchEt.getText().toString();
        String type = "usersearch";

        BackgroundWorker backgroundWorker = new BackgroundWorker(this);
        backgroundWorker.execute(type, userSearch);
        //Log.i(TAG, "User Searching");
    }

    /*private void configureUserSearch() {
        Button userSearchButton = (Button) findViewById(R.id.btnUserSearch);
        userSearchButton.setOnClickListener(new View.OnClickListener() {
            //public static final String TAG = "MyActivity";

            @Override
            public void onClick(View view) {
                String userSearch = UserSearchEt.getText().toString();
                String type = "usersearch";

                BackgroundWorker backgroundWorker = new BackgroundWorker(this);
                backgroundWorker.execute(type, userSearch);
                //Log.i(TAG, "User Searching");
            }
        });
    }*/
}
