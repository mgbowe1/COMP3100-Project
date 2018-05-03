package perkins.bowe.database2project;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class NoLoginQueries extends AppCompatActivity {
    EditText SearchTypeEt;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_no_login_queries);

        SearchTypeEt = findViewById(R.id.etSearchType);

        configureReturnButton();
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